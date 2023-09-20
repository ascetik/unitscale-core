<?php

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\CustomScaleFactory;
use PHPUnit\Framework\TestCase;

class CustomScaleFactoryTest extends TestCase
{
    private CustomScaleFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new CustomScaleFactory();
    }

    public function testShouldReturnABaseScaleWithNoPrefix()
    {
        $base = $this->factory->base();
        $forward = $base->forward(1);
        $backward = $base->backward(1);
        $this->assertSame(1, $forward);
        $this->assertSame($forward, $backward);
        $this->assertEmpty($base->unit());
    }

    public function testShouldReturnAKiloScale()
    {
        $base = $this->factory->kilo();
        $forward = $base->forward(1);
        $backward = $base->backward(1);
        $this->assertSame(1000, $forward);
        $this->assertSame(0.001, $backward);
        $this->assertSame('k', $base->unit());
    }

    public function testShouldReturnAMicroScale()
    {
        $base = $this->factory->micro();
        $forward = $base->forward(1);
        $backward = $base->backward(1);
        $this->assertSame(0.000001, $forward);
        $this->assertSame(1000000, $backward);
        $this->assertSame('μ', $base->unit());
    }
}
