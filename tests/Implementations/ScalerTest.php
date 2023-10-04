<?php

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\Scaler;
use PHPUnit\Framework\TestCase;

class ScalerTest extends TestCase
{
    public function testShouldReturnValueWithBaseScale()
    {
        $value = Scaler::unit(3, 'm');
        $this->assertSame('m', $value->getUnit());
    }

    public function testShouldBuildScaleValueWithMilliScale()
    {
        $value = Scaler::fromMilli(3, 'm');
        $this->assertSame('mm', $value->getUnit());
    }

    public function testShouldNowUseKiloAsBaseScale()
    {
        $value = Scaler::fromKilo(3, 'm');
        $this->assertSame('3km', (string) $value);
    }

    public function testGivingNoArgumentsShouldReturnSomethingAnyway()
    {
        $value = Scaler::fromBase();
        $this->assertSame('0', (string) $value);
    }

    public function testShouldThrowAnExceptionOnUnknownCommand()
    {
        $this->expectException(\BadMethodCallException::class);
        Scaler::fromSomethingElse(4);
    }

    public function testShouldThrowExceptionOnBadCommandPrefix()
    {
        $this->expectException(\BadMethodCallException::class);
        Scaler::toMilli(4);
    }
}
