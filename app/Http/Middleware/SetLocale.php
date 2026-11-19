<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', 'en');
        if (! in_array($locale, ['en', 'ar'], true)) {
            $locale = 'en';
        }

        $market = $request->session()->get('market');
        $publicIp = $this->clientIp($request);

        // Header buttons send ?region= so production caches of "/" cannot keep
        // showing the Pakistan homepage after UAE / عربي is selected.
        $region = strtolower((string) $request->query('region', ''));
        if (in_array($region, ['pk', 'uae', 'ar'], true)) {
            [$locale, $market] = match ($region) {
                'uae' => ['en', 'uae'],
                'ar' => ['ar', 'uae'],
                default => ['en', 'pk'],
            };
            $request->session()->put('market_source', 'manual');
        } elseif (! in_array($market, ['pk', 'uae'], true)) {
            [, $detectedMarket] = $this->detectRegion($request);
            $market = in_array($detectedMarket, ['pk', 'uae'], true) ? $detectedMarket : 'pk';
            $request->session()->put('market_source', 'geo');
        }

        if ($locale === 'ar') {
            $market = 'uae';
        }

        if ($market === 'pk') {
            $locale = 'en';
        }

        app()->setLocale($locale);
        $request->session()->put('locale', $locale);
        $request->session()->put('market', $market);
        $request->session()->put('market_ip', $publicIp);

        return $next($request);
    }

    /**
     * @return array{0: string, 1: ?string} [visitor ip, market pk|uae, or null when unknown]
     */
    private function detectRegion(Request $request): array
    {
        $ip = $this->clientIp($request);
        $headerCountry = $this->countryFromHeaders($request);

        // Cloudflare (or the host) already knows the visitor's country.
        // Trust that even when PHP only sees a private proxy address.
        if ($headerCountry !== '') {
            return [$ip, $headerCountry === 'AE' ? 'uae' : 'pk'];
        }

        // A private address is the server or the load balancer, not the visitor.
        // Looking that up without an IP asks ipwho.is for the server, which is
        // in Pakistan, so Dubai was shown PKR.
        if ($this->isPrivateIp($ip)) {
            return [$ip, null];
        }

        $cached = $request->session()->get('geo_lookup');
        if (
            is_array($cached)
            && ($cached['ip'] ?? '') === $ip
            && in_array($cached['market'] ?? null, ['pk', 'uae'], true)
        ) {
            return [(string) ($cached['public_ip'] ?? $ip), (string) $cached['market']];
        }

        try {
            $response = Http::timeout(3)->acceptJson()->get('https://ipwho.is/'.rawurlencode($ip));
            $data = $response->json();

            if (is_array($data) && ($data['success'] ?? false)) {
                $country = strtoupper((string) ($data['country_code'] ?? ''));
                $publicIp = (string) ($data['ip'] ?? $ip);
                $market = $country === 'AE' ? 'uae' : 'pk';

                $request->session()->put('geo_lookup', [
                    'ip' => $ip,
                    'public_ip' => $publicIp,
                    'market' => $market,
                ]);

                return [$publicIp, $market];
            }
        } catch (\Throwable $e) {
            Log::warning('Region IP lookup failed', ['message' => $e->getMessage()]);
        }

        return [$ip, null];
    }

    private function countryFromHeaders(Request $request): string
    {
        foreach (['CF-IPCountry', 'CloudFront-Viewer-Country', 'X-Country-Code'] as $header) {
            $country = strtoupper(trim((string) $request->header($header, '')));
            if (strlen($country) === 2 && $country !== 'XX') {
                return $country;
            }
        }

        return '';
    }

    private function clientIp(Request $request): string
    {
        $candidates = [];

        $cloudflareIp = trim((string) $request->header('CF-Connecting-IP', ''));
        if ($cloudflareIp !== '') {
            $candidates[] = $cloudflareIp;
        }

        foreach (explode(',', (string) $request->header('X-Forwarded-For', '')) as $forwarded) {
            $forwarded = trim($forwarded);
            if ($forwarded !== '') {
                $candidates[] = $forwarded;
            }
        }

        $candidates[] = (string) $request->ip();

        foreach ($candidates as $ip) {
            if (! $this->isPrivateIp($ip)) {
                return $ip;
            }
        }

        return $candidates[0] !== '' ? $candidates[0] : (string) $request->ip();
    }

    private function isPrivateIp(string $ip): bool
    {
        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        }

        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
    }
}
