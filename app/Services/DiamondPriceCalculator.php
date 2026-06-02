<?php

namespace App\Services;

use App\Models\DiamondRateSetting;
use App\Models\Products;

class DiamondPriceCalculator
{
    public static function calculateForProduct(Products $product): ?float
    {
        $diamondPrice = (float) ($product->diamond_price ?? 0);
        if ($diamondPrice <= 0) {
            return null;
        }

        return self::calculateFromDescription($product->description ?? '', $diamondPrice);
    }

    public static function calculateFromDescription(?string $description, float $diamondPrice): ?float
    {
        if (!$description) {
            return null;
        }

        $description = self::normalizeText($description);

        $karat = self::detectKarat($description);
        if (!$karat) {
            return null;
        }

        if (!preg_match(
            '/(?:gross\s*weight|net\s*weight|weight)?\s*:?[\s]*([\d]+(?:\.\d+)?)\s*(g|gram|grams)\b/i',
            $description,
            $weightMatch
        )) {
            return null;
        }

        $grams = (float) $weightMatch[1];
        if ($grams <= 0) {
            return null;
        }

        $setting = DiamondRateSetting::where('karat', $karat)
            ->where('is_active', true)
            ->first();

        if (!$setting) {
            return null;
        }

        $rate = (float) $setting->rate_per_carat;
        $making = (float) $setting->making_charge;
        $gstPercent = (float) $setting->gst_percent;
        $dollarRate = (float) $setting->dollar_rate;
        $discountPercent = (float) $setting->discount_percent;

        $value1 = ($rate + $making) * $grams;
        $value2 = ($dollarRate * $diamondPrice) * (1 - ($discountPercent / 100));
        $subtotal = $value1 + $value2;
        $final = $subtotal * (1 + ($gstPercent / 100));

        return round($final, 2);
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
        if (preg_match('/\bmetal\s*:\s*(?:rose|white|yellow)\s+gold\s+(18|21|22|24)\s*k/i', $description, $m)) {
            return (int) $m[1];
        }

        if (preg_match('/\bmetal\s*:\s*(18|21|22|24)\s*k/i', $description, $m)) {
            return (int) $m[1];
        }

        if (preg_match('/\b(18|21|22|24)\s*k/i', $description, $m)) {
            return (int) $m[1];
        }

        return null;
    }
}
