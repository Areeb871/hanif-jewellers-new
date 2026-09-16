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

    public function test_active_sale_uses_sale_threshold_and_sale_oc_final(): void
    {
        $rate = new GoldRateSetting([
            'gold_rate_per_gram' => 1000,
            'vat_percent' => 0,
        ]);
        $service = $this->fineService();
        $service->is_sale = true;
        $service->sale_weight_threshold = 3.0;
        $service->sale_light_oc_final_per_article = 4000;
        $service->sale_heavy_oc_final_per_gram = 500;

        $this->assertSame(6500.0, GoldPriceCalculator::calculateUsingSettings($rate, $service, 2.5));
        $this->assertSame(6000.0, GoldPriceCalculator::calculateUsingSettings($rate, $service, 4.0));
    }

    public function test_inactive_sale_keeps_regular_price(): void
    {
        $rate = new GoldRateSetting([
            'gold_rate_per_gram' => 1000,
            'vat_percent' => 0,
        ]);
        $service = $this->fineService();
        $service->sale_weight_threshold = 3.0;
        $service->sale_light_oc_final_per_article = 4000;
        $service->sale_heavy_oc_final_per_gram = 500;
        $service->is_sale = false;

        $this->assertSame(14000.0, GoldPriceCalculator::calculateUsingSettings($rate, $service, 4.0));
    }

    public function test_sale_breakdown_exposes_crossed_regular_and_active_sale_prices(): void
    {
        $rate = new GoldRateSetting([
            'gold_rate_per_gram' => 1000,
            'vat_percent' => 0,
        ]);
        $service = $this->fineService();
        $service->is_sale = true;
        $service->sale_weight_threshold = 3.0;
        $service->sale_light_oc_final_per_article = 4000;
        $service->sale_heavy_oc_final_per_gram = 500;

        $breakdown = GoldPriceCalculator::calculateBreakdownUsingSettings($rate, $service, 4.0);

        $this->assertSame(14000.0, $breakdown['regular_price']);
        $this->assertSame(6000.0, $breakdown['sale_price']);
        $this->assertSame(6000.0, $breakdown['final_price']);
        $this->assertTrue($breakdown['is_sale']);
    }

    public function test_weight_can_be_extracted_for_legacy_products_without_gold_weight(): void
    {
        $description = '<p>Metal: 21k<br>Gross Weight: 6.25g</p>';

        $this->assertSame(6.25, GoldPriceCalculator::extractWeightFromDescription($description));
    }

    public function test_unlabelled_numbers_are_not_mistaken_for_gold_weight(): void
    {
        $description = '<p>Metal: 21k<br>Diamond: 0.18ct</p>';

        $this->assertNull(GoldPriceCalculator::extractWeightFromDescription($description));
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
