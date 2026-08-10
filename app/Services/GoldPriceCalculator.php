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
        ?int $goldServiceId = null
    ): ?float {
        if (!$description) {
            Log::warning('GoldPriceCalculator: empty description');
            return null;
        }

        $description = self::normalizeText($description);
        $karat = self::detectKarat($description);
        $grams = (float) ($goldWeight ?? 0);

        if (!$karat || $grams <= 0) {
            Log::warning('GoldPriceCalculator: missing karat or gold weight', [
                'karat' => $karat,
                'grams' => $grams,
            ]);
            return null;
        }

        $rateSetting = GoldRateSetting::where('karat', $karat)
            ->where('is_active', true)
            ->first();
        $service = self::resolveService($goldServiceId);

        if (!$rateSetting || !$service) {
            Log::warning('GoldPriceCalculator: active rate or service not found', [
                'karat' => $karat,
                'gold_service_id' => $goldServiceId,
            ]);
            return null;
        }

        $threshold = (float) $service->weight_threshold;
        $isLightTier = $grams <= $threshold;
        $ocFinal = $isLightTier
            ? (float) $service->light_oc_final_per_article
            : $grams * (float) $service->heavy_oc_final_per_gram;

        $subtotal = (
            (float) $rateSetting->gold_rate_per_gram * $grams
        ) + $ocFinal;
        $vat = $subtotal * ((float) $rateSetting->vat_percent / 100);
        $final = self::calculateUsingSettings($rateSetting, $service, $grams);

        Log::info('GoldPriceCalculator: service rule applied', [
            'karat' => $karat,
            'service' => $service->slug,
            'tier' => $isLightTier ? 'up_to_threshold' : 'above_threshold',
            'grams' => $grams,
            'oc_final' => $ocFinal,
            'vat' => $vat,
            'final' => $final,
        ]);

        return round($final, 2);
    }

    /** Kept public so the business formula can be verified without database access. */
    public static function calculateUsingSettings(
        GoldRateSetting $rateSetting,
        GoldServiceSetting $service,
        float $grams
    ): float {
        $isLightTier = $grams <= (float) $service->weight_threshold;
        $ocFinal = $isLightTier
            ? (float) $service->light_oc_final_per_article
            : $grams * (float) $service->heavy_oc_final_per_gram;
        $subtotal = ((float) $rateSetting->gold_rate_per_gram * $grams) + $ocFinal;

        return round($subtotal * (1 + ((float) $rateSetting->vat_percent / 100)), 2);
    }

    private static function resolveService(?int $goldServiceId): ?GoldServiceSetting
    {
        if ($goldServiceId) {
            $service = GoldServiceSetting::whereKey($goldServiceId)
                ->where('is_active', true)
                ->first();

            if ($service) {
                return $service;
            }
        }

        return GoldServiceSetting::where('slug', 'fine')
            ->where('is_active', true)
            ->first()
            ?? GoldServiceSetting::where('is_active', true)->orderBy('sort_order')->first();
    }

    private static function normalizeText(string $text): string
    {
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/<\/(p|div|li|h[1-6])>/i', ' ', $text);
        $text = preg_replace('/<(br|br\/)\s*>/i', ' ', $text);
        $text = strip_tags($text);
        $text = str_replace("\xC2\xA0", ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    private static function detectKarat(string $description): ?int
    {
        if (preg_match('/\bmetal\s*:\s*(18|21|22|24)\s*k/i', $description, $matches)) {
            return (int) $matches[1];
        }

        if (preg_match('/\b(18|21|22|24)\s*k/i', $description, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }
}
