<?php

namespace App\Services;

use App\Models\GoldRateSetting;
use App\Models\GoldServiceSetting;
use Illuminate\Support\Facades\Log;

class GoldPriceCalculator
{
    /**
     * Calculate a product's live gold price using its karat and jewellery service.
     * The service threshold selects OC Final per article or OC Final per gram.
     */
    public static function calculateFromDescription(
        ?string $description,
        ?float $goldWeight = null,
        ?int $goldServiceId = null,
        string $market = 'pk'
    ): ?float {
        $breakdown = self::calculateBreakdownFromDescription(
            $description,
            $goldWeight,
            $goldServiceId,
            $market
        );

        return $breakdown['final_price'] ?? null;
    }

    /**
     * @return array{regular_price: float, sale_price: float, final_price: float, is_sale: bool}|null
     */
    public static function calculateBreakdownFromDescription(
        ?string $description,
        ?float $goldWeight = null,
        ?int $goldServiceId = null,
        string $market = 'pk'
    ): ?array {
        if (!$description) {
            Log::warning('GoldPriceCalculator: empty description');
            return null;
        }

        $description = self::normalizeText($description);
        $karat = self::detectKarat($description);
        $grams = (float) ($goldWeight ?? 0);
        if ($grams <= 0) {
            $grams = self::extractWeightFromDescription($description) ?? 0;
        }

        if (!$karat || $grams <= 0) {
            Log::warning('GoldPriceCalculator: missing karat or gold weight', [
                'karat' => $karat,
                'grams' => $grams,
                'market' => $market,
            ]);
            return null;
        }

        $rateSetting = GoldRateSetting::forMarket($market)
            ->where('karat', $karat)
            ->where('is_active', true)
            ->first();
        $service = self::resolveService($goldServiceId, $market);

        if (!$rateSetting || !$service) {
            Log::warning('GoldPriceCalculator: active rate or service not found', [
                'karat' => $karat,
                'gold_service_id' => $goldServiceId,
                'market' => $market,
            ]);
            return null;
        }

        $isSale = (bool) ($service->is_sale ?? false);
        $threshold = $isSale
            ? (float) $service->sale_weight_threshold
            : (float) $service->weight_threshold;
        $isLightTier = $grams <= $threshold;
        $ocFinal = self::ocFinal($service, $grams, $isSale);

        $subtotal = (
            (float) $rateSetting->gold_rate_per_gram * $grams
        ) + $ocFinal;
        $vat = $subtotal * ((float) $rateSetting->vat_percent / 100);
        $breakdown = self::calculateBreakdownUsingSettings($rateSetting, $service, $grams);
        $regularPrice = $breakdown['regular_price'];
        $salePrice = $breakdown['sale_price'];
        $final = $breakdown['final_price'];

        Log::info('GoldPriceCalculator: service rule applied', [
            'karat' => $karat,
            'service' => $service->slug,
            'is_sale' => $isSale,
            'tier' => $isLightTier ? 'up_to_threshold' : 'above_threshold',
            'grams' => $grams,
            'oc_final' => $ocFinal,
            'vat' => $vat,
            'final' => $final,
        ]);

        return $breakdown;
    }

    /** Kept public so the business formula can be verified without database access. */
    public static function calculateUsingSettings(
        GoldRateSetting $rateSetting,
        GoldServiceSetting $service,
        float $grams
    ): float {
        return self::calculateWithSaleState(
            $rateSetting,
            $service,
            $grams,
            (bool) ($service->is_sale ?? false)
        );
    }

    /**
     * @return array{regular_price: float, sale_price: float, final_price: float, is_sale: bool}
     */
    public static function calculateBreakdownUsingSettings(
        GoldRateSetting $rateSetting,
        GoldServiceSetting $service,
        float $grams
    ): array {
        $regularPrice = self::calculateWithSaleState($rateSetting, $service, $grams, false);
        $salePrice = self::calculateWithSaleState($rateSetting, $service, $grams, true);
        $isSale = (bool) ($service->is_sale ?? false);

        return [
            'regular_price' => $regularPrice,
            'sale_price' => $salePrice,
            'final_price' => $isSale ? $salePrice : $regularPrice,
            'is_sale' => $isSale,
        ];
    }

    private static function calculateWithSaleState(
        GoldRateSetting $rateSetting,
        GoldServiceSetting $service,
        float $grams,
        bool $isSale
    ): float {
        $goldValue = (float) $rateSetting->gold_rate_per_gram * $grams;

        if (strtolower((string) $service->market) === 'uae') {
            $making = self::dubaiMaking($service, $goldValue, $grams, $isSale);
            $subtotal = $goldValue + $making;

            return round($subtotal * (1 + ((float) $rateSetting->vat_percent / 100)), 2);
        }

        $ocFinal = self::ocFinal($service, $grams, $isSale);
        $subtotal = $goldValue + $ocFinal;

        return round($subtotal * (1 + ((float) $rateSetting->vat_percent / 100)), 2);
    }

    /**
     * Dubai making charge: selling % of the gold value above 6 g.
     * At 6 g or below, a fixed 650 AED replaces that percent.
     */
    private static function dubaiMaking(
        GoldServiceSetting $service,
        float $goldValue,
        float $grams,
        bool $isSale
    ): float {
        if ($grams <= 6) {
            return 650.0;
        }

        $percent = $isSale
            ? (float) ($service->sale_selling_percent ?? 0)
            : (float) ($service->selling_percent ?? 0);

        return $goldValue * ($percent / 100);
    }

    private static function ocFinal(
        GoldServiceSetting $service,
        float $grams,
        bool $isSale
    ): float {
        $threshold = $isSale
            ? (float) $service->sale_weight_threshold
            : (float) $service->weight_threshold;
        $isLightTier = $grams <= $threshold;

        if ($isSale) {
            return $isLightTier
                ? (float) $service->sale_light_oc_final_per_article
                : $grams * (float) $service->sale_heavy_oc_final_per_gram;
        }

        return $isLightTier
            ? (float) $service->light_oc_final_per_article
            : $grams * (float) $service->heavy_oc_final_per_gram;
    }

    private static function resolveService(?int $goldServiceId, string $market = 'pk'): ?GoldServiceSetting
    {
        $market = strtolower($market) === 'uae' ? 'uae' : 'pk';

        if ($goldServiceId) {
            // Only accept a service that belongs to this country/market.
            $service = GoldServiceSetting::forMarket($market)
                ->whereKey($goldServiceId)
                ->where('is_active', true)
                ->first();

            if ($service) {
                return $service;
            }

            // Legacy: product may still store the other country's service id — map by slug.
            $foreign = GoldServiceSetting::whereKey($goldServiceId)->first();
            if ($foreign) {
                $mapped = GoldServiceSetting::forMarket($market)
                    ->where('slug', $foreign->slug)
                    ->where('is_active', true)
                    ->first();
                if ($mapped) {
                    return $mapped;
                }
            }
        }

        return GoldServiceSetting::forMarket($market)
            ->where('slug', 'fine')
            ->where('is_active', true)
            ->first()
            ?? GoldServiceSetting::forMarket($market)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->first();
    }

    private static function normalizeText(string $text): string
    {
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/[\x{FEFF}\x{200B}\x{200C}\x{200D}\x{2060}]/u', '', $text);
        $text = preg_replace('/<\/(p|div|li|h[1-6])>/i', ' ', $text);
        $text = preg_replace('/<(br|br\/)\s*>/i', ' ', $text);
        $text = strip_tags($text);
        $text = str_replace("\xC2\xA0", ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    /** Extract an explicitly labelled product weight for legacy/imported products. */
    public static function extractWeightFromDescription(string $description): ?float
    {
        $description = self::normalizeText($description);

        if (preg_match(
            '/\b(?:gross\s+)?weight\s*:\s*(\d+(?:\.\d+)?)\s*(?:g|grams?)\b/i',
            $description,
            $matches
        )) {
            return (float) $matches[1];
        }

        $normalized = strtr($description, [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        // Arabic: الوزن: 9.25 غرامًا / جرامًا / غرام / g
        if (preg_match(
            '/الوزن\s*:\s*(\d+(?:\.\d+)?)\s*(?:جرامًا?|غرامًا?|غ(?:رام)?|g|grams?)/u',
            $normalized,
            $matches
        )) {
            return (float) $matches[1];
        }

        return null;
    }

    private static function detectKarat(string $description): ?int
    {
        if (preg_match('/\bmetal\s*:\s*(18|21|22|24)\s*k/i', $description, $matches)) {
            return (int) $matches[1];
        }

        if (preg_match('/\b(18|21|22|24)\s*k/i', $description, $matches)) {
            return (int) $matches[1];
        }

        // Emirati / Arabic labels, e.g. "المعدن: ذهب عيار 21" or Eastern numerals.
        $normalized = strtr($description, [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        if (preg_match('/عيار\s*(18|21|22|24)/u', $normalized, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }
}
