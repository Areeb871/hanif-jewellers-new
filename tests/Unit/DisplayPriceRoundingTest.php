<?php

namespace Tests\Unit;

use App\Models\Products;
use PHPUnit\Framework\TestCase;

class DisplayPriceRoundingTest extends TestCase
{
    public function test_dubai_prices_round_to_the_nearest_hundred(): void
    {
        $this->assertSame(9500.0, Products::roundDisplayPrice(9470, 'uae'));
        $this->assertSame(9400.0, Products::roundDisplayPrice(9445, 'uae'));
        $this->assertSame(9500.0, Products::roundDisplayPrice(9450, 'uae'));
        $this->assertSame(11300.0, Products::roundDisplayPrice(11342, 'uae'));
        $this->assertSame(11400.0, Products::roundDisplayPrice(11350, 'uae'));
        $this->assertSame(11400.0, Products::roundDisplayPrice(11400, 'uae'));
    }

    public function test_pakistan_prices_still_round_to_the_nearest_thousand(): void
    {
        $this->assertSame(391000.0, Products::roundDisplayPrice(391499, 'pk'));
        $this->assertSame(392000.0, Products::roundDisplayPrice(391500, 'pk'));
    }
}
