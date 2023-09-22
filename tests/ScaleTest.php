<?php

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Tests;

use Ascetik\UnitscaleCore\Tests\Mocks\FakeScale;
use Ascetik\UnitscaleCore\Types\Scale;
use PHPUnit\Framework\TestCase;

class ScaleTest extends TestCase
{
    private Scale $scale;

    protected function setUp(): void
    {
        $this->scale = new FakeScale(10, 'units of fake');
    }

    public function testForwardScaleCalculation()
    {
        $this->assertSame(10, $this->scale->forward(1));
    }

    public function testBackwardScaleCalculation()
    {
        $this->assertSame(0.1, $this->scale->backward(1));
    }

    public function testScaleUnit()
    {
        $this->assertSame('units of fake', $this->scale->unit());
    }

    public function testScaleFactor()
    {
        $this->assertSame(10, $this->scale->factor());
    }
}
