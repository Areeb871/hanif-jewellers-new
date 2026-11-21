<?php

namespace Tests\Unit;

use App\Services\DiamondPriceCalculator;
use PHPUnit\Framework\TestCase;

class DiamondPriceCalculatorTest extends TestCase
{
    public function test_emirati_arabic_karat_labels_are_detected(): void
    {
        $detect = new \ReflectionMethod(DiamondPriceCalculator::class, 'detectKarat');
        $detect->setAccessible(true);

        $this->assertSame(18, $detect->invoke(null, 'المعدن: ذهب ١٨ قيراط'));
        $this->assertSame(21, $detect->invoke(null, 'ذهب ٢١ قيراط'));
        $this->assertSame(22, $detect->invoke(null, '٢٢ قيراط'));
        $this->assertSame(24, $detect->invoke(null, 'ذهب عيار ٢٤ قيراط'));
        $this->assertSame(21, $detect->invoke(null, 'Metal: rose gold 21k'));
        $this->assertSame(18, $detect->invoke(null, 'Metal: 18k'));
    }
}
