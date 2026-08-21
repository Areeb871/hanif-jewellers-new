<?php

namespace Tests\Unit;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Subcategory;
use App\Models\WatchPricingSetting;
use App\Services\WatchPriceCalculator;
use PHPUnit\Framework\TestCase;

class WatchPriceCalculatorTest extends TestCase
{
    public function test_it_applies_chf_rate_percentage_discount_and_gst_in_order(): void
    {
        $price = WatchPriceCalculator::calculate(1000, 320, 10, 18);

        $this->assertSame(339840.0, $price);
    }

    public function test_a_full_percentage_discount_makes_price_zero(): void
    {
        $price = WatchPriceCalculator::calculate(10, 100, 100, 18);

        $this->assertSame(0.0, $price);
    }

    public function test_sale_breakdown_keeps_regular_price_and_uses_sale_price_as_final(): void
    {
        $breakdown = WatchPriceCalculator::calculateBreakdown(
            watchRate: 1000,
            chfRate: 320,
            discountPercent: 10,
            saleDiscountPercent: 20,
            gstPercent: 18,
            isSale: true
        );

        $this->assertSame([
            'regular_price' => 339840.0,
            'sale_price' => 302080.0,
            'final_price' => 302080.0,
            'regular_discount_percent' => 10.0,
            'sale_discount_percent' => 20.0,
            'is_sale' => true,
        ], $breakdown);
    }

    public function test_disabled_sale_keeps_regular_price_as_final(): void
    {
        $breakdown = WatchPriceCalculator::calculateBreakdown(
            watchRate: 1000,
            chfRate: 320,
            discountPercent: 10,
            saleDiscountPercent: 20,
            gstPercent: 18,
            isSale: false
        );

        $this->assertSame(339840.0, $breakdown['final_price']);
        $this->assertFalse($breakdown['is_sale']);
    }

    public function test_watch_product_display_price_uses_its_subcategory_settings(): void
    {
        $setting = new WatchPricingSetting([
            'chf_rate' => 320,
            'discount_value' => 10,
            'gst_percent' => 18,
        ]);
        $subcategory = new Subcategory(['name' => 'Franck Muller']);
        $subcategory->setRelation('watchPricingSetting', $setting);

        $product = new Products([
            'name' => 'Vanguard',
            'price' => 100,
            'watch_rate' => 1000,
        ]);
        $product->setRelation('category', new Categories(['name' => 'Watches']));
        $product->setRelation('subcategory', $subcategory);

        $this->assertSame(339840.0, $product->displayPrice());
    }

    public function test_watch_product_sale_uses_sale_discount_and_exposes_regular_price(): void
    {
        $setting = new WatchPricingSetting([
            'chf_rate' => 320,
            'discount_value' => 10,
            'sale_discount_value' => 20,
            'gst_percent' => 18,
            'is_sale' => true,
        ]);
        $subcategory = new Subcategory(['name' => 'Franck Muller']);
        $subcategory->setRelation('watchPricingSetting', $setting);

        $product = new Products([
            'name' => 'Vanguard',
            'price' => 100,
            'watch_rate' => 1000,
        ]);
        $product->setRelation('category', new Categories(['name' => 'Watches']));
        $product->setRelation('subcategory', $subcategory);

        $breakdown = WatchPriceCalculator::calculateBreakdownForProduct($product);

        $this->assertSame(339840.0, $breakdown['regular_price']);
        $this->assertSame(302080.0, $breakdown['sale_price']);
        $this->assertSame(302080.0, $breakdown['final_price']);
        $this->assertTrue($breakdown['is_sale']);
        $this->assertSame(302080.0, $product->displayPrice());
    }

    public function test_watch_category_slug_enables_live_pricing_without_watch_in_the_names(): void
    {
        $setting = new WatchPricingSetting([
            'chf_rate' => 320,
            'discount_value' => 10,
            'gst_percent' => 18,
        ]);
        $subcategory = new Subcategory(['name' => 'Franck Muller']);
        $subcategory->setRelation('watchPricingSetting', $setting);

        $product = new Products([
            'name' => 'Vanguard',
            'price' => 100,
            'watch_rate' => 1000,
        ]);
        $product->setRelation('category', new Categories([
            'name' => 'International Brands',
            'slug' => 'watches',
        ]));
        $product->setRelation('subcategory', $subcategory);

        $this->assertTrue($product->isWatchProduct());
        $this->assertSame(339840.0, $product->displayPrice());
    }
}
