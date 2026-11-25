<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldSkip($request)) {
            return $next($request);
        }

        $locale = $request->session()->get('locale', 'en');
        if (! in_array($locale, ['en', 'ar'], true)) {
            $locale = 'en';
        }

        $market = $request->session()->get('market');
        $source = $request->session()->get('market_source');
        $publicIp = $this->clientIp($request);

        $region = strtolower((string) $request->query('region', ''));
        $isAuto = $request->query('auto') === '1';
        $detectedMarket = null;

        if (in_array($region, ['pk', 'uae', 'ar'], true)) {
            [$locale, $market] = match ($region) {
                'uae' => ['en', 'uae'],
                'ar' => ['ar', 'uae'],
                default => ['en', 'pk'],
            };
            $source = $isAuto ? 'geo' : 'manual';
        } elseif ($source === 'manual' && in_array($market, ['pk', 'uae'], true)) {
            // Header PK / UAE / عربي. Do not override from the browser location.
        } else {
            [, $detectedMarket] = $this->detectRegion($request);

            if ($detectedMarket === 'uae') {
                $market = 'uae';
                if ($locale !== 'ar') {
                    $locale = 'en';
                }
                $source = 'geo';
            } elseif ($detectedMarket === 'pk') {
                $market = 'pk';
                $locale = 'en';
                $source = 'geo';
            } elseif (! in_array($market, ['pk', 'uae'], true)) {
                $market = 'pk';
                $source = 'geo';
            }
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
        $request->session()->put('market_source', $source);
        $request->session()->put('market_ip', $publicIp);

        if (
            $request->isMethod('GET')
            && $request->routeIs('index')
            && ! $request->query->has('region')
            && in_array($detectedMarket, ['pk', 'uae'], true)
        ) {
            return redirect()->to(url('/').'?region='.$detectedMarket.'&auto=1');
        }

        return $next($request);
    }

    private function shouldSkip(Request $request): bool
    {
        return $request->is('admin')
            || $request->is('admin/*')
            || $request->is('livewire/*');
    }

    /**
     * Free only: country header already on the request (Cloudflare / host).
     * No outbound geo API.
     *
     * @return array{0: string, 1: ?string} [visitor ip, market pk|uae, or null when unknown]
     */
    private function detectRegion(Request $request): array
    {
        $ip = $this->clientIp($request);
        $headerCountry = $this->countryFromHeaders($request);

        if ($headerCountry === 'AE') {
            return [$ip, 'uae'];
        }

        if ($headerCountry === 'PK') {
            return [$ip, 'pk'];
        }

        $browserRegion = strtolower(trim((string) $request->cookie('hj_browser_region', '')));
        if (in_array($browserRegion, ['pk', 'uae'], true)) {
            return [$ip, $browserRegion];
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
