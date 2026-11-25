<?php

namespace Tests\Unit;

use App\Models\Order;
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

    public function test_admin_dubai_order_keeps_aed_nearest_hundred_instead_of_thousand(): void
    {
        $order = new Order(['currency' => 'AED']);

        $this->assertSame('AED 2,300', $order->formattedAmount(2300));
        $this->assertSame('AED 11,300', $order->formattedAmount(11300));
        $this->assertSame('AED 2,300', $order->formattedAmount(2349));
        $this->assertNotSame('AED 2,000', $order->formattedAmount(2300));
        $this->assertNotSame('AED 11,000', $order->formattedAmount(11300));
    }

    public function test_admin_pakistan_order_still_rounds_to_nearest_thousand(): void
    {
        $order = new Order(['currency' => 'PKR']);

        $this->assertSame('PKR 391,000', $order->formattedAmount(391499));
        $this->assertSame('PKR 392,000', $order->formattedAmount(391500));
    }
}
