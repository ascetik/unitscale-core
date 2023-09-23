<?php

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Scales\CustomScale;
use Ascetik\UnitscaleCore\Types\Scale;
use PHPUnit\Framework\TestCase;

class CustomScaleTest extends TestCase
{
    private Scale $scale;

    protected function setUp(): void
    {
        $this->scale = new CustomScale(3, 'units of anything');
    }

    public function testForwardScaleCalculation()
    {
        $this->assertSame(1000, $this->scale->forward(1));
    }

    public function testBackwardScaleCalculation()
    {
        $this->assertSame(0.001, $this->scale->backward(1));
    }

    public function testScaleUnit()
    {
        $this->assertSame('units of anything', $this->scale->unit());
    }

    public function testScaleFactor()
    {
        $this->assertSame(3, $this->scale->factor());
    }
}
