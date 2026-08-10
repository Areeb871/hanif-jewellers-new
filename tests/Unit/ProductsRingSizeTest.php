<?php

namespace Tests\Unit;

use App\Models\Products;
use PHPUnit\Framework\TestCase;

class ProductsRingSizeTest extends TestCase
{
    public function test_ring_tag_requires_an_asian_size(): void
    {
        $product = $this->productWith(['name' => 'Diamond Solitaire']);
        $product->setRelation('tags', collect([(object) ['slug' => 'rings']]));

        $this->assertTrue($product->requiresAsianRingSize());
    }

    public function test_ring_name_requires_an_asian_size(): void
    {
        $product = $this->productWith(['name' => 'Three Diamond Curls Ring']);

        $this->assertTrue($product->requiresAsianRingSize());
    }

    public function test_ring_category_requires_an_asian_size(): void
    {
        $product = $this->productWith(['name' => 'Diamond Solitaire']);
        $product->setRelation('category', (object) ['name' => 'Rings', 'slug' => 'rings']);

        $this->assertTrue($product->requiresAsianRingSize());
    }

    public function test_earrings_do_not_match_ring_detection(): void
    {
        $product = $this->productWith(['name' => 'Diamond Earrings']);
        $product->setRelation('tags', collect([(object) ['slug' => 'earrings']]));

        $this->assertFalse($product->requiresAsianRingSize());
    }

    private function productWith(array $attributes): Products
    {
        $product = new Products($attributes);
        $product->setRelation('tags', collect());
        $product->setRelation('category', null);
        $product->setRelation('subcategory', null);

        return $product;
    }
}
