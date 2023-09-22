<?php

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\Scaler;
use PHPUnit\Framework\TestCase;

class CustomScaleAdjusterTest extends TestCase
{
    public function testSimpleAdjustment()
    {
        $value = Scaler::unit(3000, 'm');
        $adjusted = $value->adjust();
        $this->assertSame('3km', (string) $adjusted);
    }

    public function testAnotherAdjustment()
    {
        $value = Scaler::unit(0.003, 'm');
        $adjusted = $value->adjust();
        $this->assertSame('3mm', (string) $adjusted);
    }

    public function testAnotherAdjustmentFromADifferentScale()
    {
        $value = Scaler::unit(0.003, 'm')->fromMicro();
        $adjusted = $value->adjust();
        $this->assertSame('3nm', (string) $adjusted);
    }
}
