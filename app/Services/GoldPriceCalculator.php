<?php

namespace App\Services;

use App\Models\GoldRateSetting;
use Illuminate\Support\Facades\Log;

class GoldPriceCalculator
{
    private const SMALL_WEIGHT_LIMIT = 4.7;
    private const SMALL_WEIGHT_FIXED_CHARGE = 15000;

    private const MARKUP_PERCENT = 4;
    private const USE_DB_VAT_INSTEAD_OF_4_PERCENT = true;

    public static function calculateFromDescription(?string $description, ?float $goldWeight = null): ?float
    {
        if (!$description) {
            Log::warning('GoldPriceCalculator: empty description');
            return null;
        }

        $raw = $description;
        $description = self::normalizeText($description);

        Log::info('GoldPriceCalculator: start', [
            'raw_sample' => mb_substr($raw, 0, 250),
            'normalized' => $description,
        ]);

        $karat = self::detectKarat($description);
        if (!$karat) {
            Log::warning('GoldPriceCalculator: karat not found', ['description' => $description]);
            return null;
        }
        Log::info('GoldPriceCalculator: karat detected', ['karat' => $karat]);

        $grams = (float) ($goldWeight ?? 0);
        if ($grams <= 0) {
            Log::warning('GoldPriceCalculator: gold weight not set', ['grams' => $grams]);
            return null;
        }
        Log::info('GoldPriceCalculator: weight from admin', ['grams' => $grams]);

        // ✅ METAL COLOR ONLY (rose/white/yellow)
        $metalColor = self::detectMetalColor($description);
        Log::info('GoldPriceCalculator: metal color detected', ['metalColor' => $metalColor]);

        // DB setting
        $setting = GoldRateSetting::where('karat', $karat)
            ->where('is_active', true)
            ->first();

        if (!$setting) {
            Log::warning('GoldPriceCalculator: no active setting found', ['karat' => $karat]);
            return null;
        }

        $goldRate   = (float) $setting->gold_rate_per_gram;
        $making     = (float) $setting->making_charges_per_gram;
        $vatPercent = (float) $setting->vat_percent;

        Log::info('GoldPriceCalculator: DB loaded', [
            'gold_rate_per_gram' => $goldRate,
            'making_charges_per_gram' => $making,
            'vat_percent' => $vatPercent,
        ]);

        /**
         * RULE A: If Rose/White/Yellow -> (goldRate * grams) * 1.04
         */
        if ($metalColor !== null) {
            $base = $goldRate * $grams;
            $final = $base * (1 + (self::MARKUP_PERCENT / 100));

            Log::info('GoldPriceCalculator: RULE A applied', [
                'metalColor' => $metalColor,
                'base' => $base,
                'markup_percent' => self::MARKUP_PERCENT,
                'final' => $final,
            ]);

            return round($final, 2);
        }

        /**
         * RULE B: grams < 4.7 -> (goldRate * grams) + 15000 + VAT
         */
        if ($grams < self::SMALL_WEIGHT_LIMIT) {
            $base = $goldRate * $grams;
            $subtotal = $base + self::SMALL_WEIGHT_FIXED_CHARGE;
            $vat = $subtotal * ($vatPercent / 100);
            $final = $subtotal + $vat;

            Log::info('GoldPriceCalculator: RULE B applied', [
                'grams' => $grams,
                'base' => $base,
                'fixed_charge' => self::SMALL_WEIGHT_FIXED_CHARGE,
                'subtotal' => $subtotal,
                'vat_percent' => $vatPercent,
                'vat' => $vat,
                'final' => $final,
            ]);

            return round($final, 2);
        }

        /**
         * RULE C: grams >= 4.7 AND NOT Rose/White/Yellow
         * perGram = (goldRate + making) * (1 + (4% OR vat%))
         */
        $ratePlusMaking = $goldRate + $making;

        $percentToApply = self::USE_DB_VAT_INSTEAD_OF_4_PERCENT
            ? $vatPercent
            : self::MARKUP_PERCENT;

        $perGram = $ratePlusMaking * (1 + ($percentToApply / 100));
        $final = $grams * $perGram;

        Log::info('GoldPriceCalculator: RULE C applied', [
            'grams' => $grams,
            'ratePlusMaking' => $ratePlusMaking,
            'percent_used' => $percentToApply,
            'use_db_vat_instead_of_4' => self::USE_DB_VAT_INSTEAD_OF_4_PERCENT,
            'perGram' => $perGram,
            'final' => $final,
        ]);

        return round($final, 2);
    }

    private static function normalizeText(string $text): string
    {
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // ✅ prevent joining words when stripping HTML
        $text = preg_replace('/<\/(p|div|li|h[1-6])>/i', ' ', $text);
        $text = preg_replace('/<(br|br\/)\s*>/i', ' ', $text);

        $text = strip_tags($text);

        $text = str_replace("\xC2\xA0", ' ', $text); // nbsp
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    private static function detectKarat(string $description): ?int
    {
        // Prefer Metal line
        if (preg_match('/\bmetal\s*:\s*(18|21|22|24)\s*k/i', $description, $m)) {
            return (int) $m[1];
        }

        // Fallback anywhere (supports "21kGross" too)
        if (preg_match('/\b(18|21|22|24)\s*k/i', $description, $m)) {
            return (int) $m[1];
        }

        return null;
    }

    private static function detectMetalColor(string $description): ?string
    {
        if (preg_match('/\brose\s+gold\b/i', $description)) return 'rose';
        if (preg_match('/\bwhite\s+gold\b/i', $description)) return 'white';
        if (preg_match('/\byellow\s+gold\b/i', $description)) return 'yellow';
        return null;
    }
}
