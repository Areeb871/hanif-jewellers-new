<?php

namespace Tests\Unit;

use App\Models\GoldRateSetting;
use App\Models\GoldServiceSetting;
use App\Services\GoldPriceCalculator;
use PHPUnit\Framework\TestCase;

class GoldPriceCalculatorTest extends TestCase
{
    public function test_weight_at_threshold_uses_final_oc_per_article(): void
    {
        $rate = new GoldRateSetting([
            'gold_rate_per_gram' => 32332,
            'vat_percent' => 4,
        ]);
        $service = $this->fineService();

        $price = GoldPriceCalculator::calculateUsingSettings($rate, $service, 4.7);

        $this->assertSame(168438.82, $price);
    }

    public function test_weight_above_threshold_uses_final_oc_per_gram(): void
    {
        $rate = new GoldRateSetting([
            'gold_rate_per_gram' => 32332,
            'vat_percent' => 4,
        ]);
        $service = $this->fineService();

        $price = GoldPriceCalculator::calculateUsingSettings($rate, $service, 5.0);

        $this->assertSame(172286.4, $price);
    }

    public function test_price_uses_actual_weight_without_wastage(): void
    {
        $rate = new GoldRateSetting([
            'gold_rate_per_gram' => 1000,
            'vat_percent' => 0,
        ]);
        $service = $this->fineService();
        $price = GoldPriceCalculator::calculateUsingSettings($rate, $service, 1.0);

        $this->assertSame(11000.0, $price);
    }

    private function fineService(): GoldServiceSetting
    {
        return new GoldServiceSetting([
            'weight_threshold' => 4.7,
            'light_oc_final_per_article' => 10000,
            'heavy_oc_final_per_gram' => 800,
        ]);
    }
}
