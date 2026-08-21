<?php

namespace App\Services;

use App\Models\Products;

class WatchPriceCalculator
{
    public static function calculateForProduct(Products $product): ?float
    {
        $breakdown = self::calculateBreakdownForProduct($product);

        return $breakdown['final_price'] ?? null;
    }

    /**
     * @return array{regular_price: float, sale_price: float, final_price: float, regular_discount_percent: float, sale_discount_percent: float, is_sale: bool}|null
     */
    public static function calculateBreakdownForProduct(Products $product): ?array
    {
        $watchRate = (float) ($product->watch_rate ?? 0);
        if ($watchRate <= 0) {
            return null;
        }

        $subcategory = $product->relationLoaded('subcategory')
            ? $product->subcategory
            : $product->subcategory()->first();
        $setting = $subcategory?->watchPricingSetting;

        if (!$setting || (float) $setting->chf_rate <= 0) {
            return null;
        }

        return self::calculateBreakdown(
            $watchRate,
            (float) $setting->chf_rate,
            (float) $setting->discount_value,
            (float) ($setting->sale_discount_value ?? 0),
            (float) $setting->gst_percent,
            (bool) ($setting->is_sale ?? false)
        );
    }

    /**
     * @return array{regular_price: float, sale_price: float, final_price: float, regular_discount_percent: float, sale_discount_percent: float, is_sale: bool}
     */
    public static function calculateBreakdown(
        float $watchRate,
        float $chfRate,
        float $discountPercent,
        float $saleDiscountPercent,
        float $gstPercent,
        bool $isSale
    ): array {
        $regularPrice = self::calculate(
            $watchRate,
            $chfRate,
            $discountPercent,
            $gstPercent
        );
        $salePrice = self::calculate(
            $watchRate,
            $chfRate,
            $saleDiscountPercent,
            $gstPercent
        );

        return [
            'regular_price' => $regularPrice,
            'sale_price' => $salePrice,
            'final_price' => $isSale ? $salePrice : $regularPrice,
            'regular_discount_percent' => $discountPercent,
            'sale_discount_percent' => $saleDiscountPercent,
            'is_sale' => $isSale,
        ];
    }

    public static function calculate(
        float $watchRate,
        float $chfRate,
        float $discountPercent,
        float $gstPercent
    ): float {
        $convertedPrice = $watchRate * $chfRate;
        $discountedPrice = max(0, $convertedPrice * (1 - ($discountPercent / 100)));
        $finalPrice = $discountedPrice * (1 + ($gstPercent / 100));

        return round($finalPrice, 2);
    }
}
