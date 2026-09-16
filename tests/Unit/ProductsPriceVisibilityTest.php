<?php

namespace Tests\Unit;

use App\Models\Products;
use PHPUnit\Framework\TestCase;

class ProductsPriceVisibilityTest extends TestCase
{
    public function test_selene_prices_stay_hidden_when_enabled_and_weight_is_present(): void
    {
        foreach ([['slug' => 'selene', 'name' => 'Collection'], ['slug' => 'other', 'name' => ' SELENE ']] as $subcategory) {
            $product = new Products(['show_price' => 1, 'gold_weight' => 12, 'price' => 157000]);
            $product->setRelation('subcategory', (object) $subcategory);

            $this->assertTrue($product->isSeleneProduct());
            $this->assertFalse($product->show_price);
            $this->assertEquals(12, $product->gold_weight);
            $this->assertEquals(157000, $product->getAttributes()['price']);
        }
    }

    public function test_other_products_keep_their_price_visibility_setting(): void
    {
        foreach ([0, 1] as $setting) {
            $product = new Products(['show_price' => $setting]);
            $product->setRelation('subcategory', null);

            $this->assertFalse($product->isSeleneProduct());
            $this->assertSame($setting, $product->show_price);
        }
    }
}
