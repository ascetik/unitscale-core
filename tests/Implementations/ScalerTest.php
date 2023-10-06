<?php

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\CustomScaler;
use PHPUnit\Framework\TestCase;

class ScalerTest extends TestCase
{
    public function testShouldReturnValueWithBaseScale()
    {
        $value = CustomScaler::unit(3, 'm');
        $this->assertSame('m', $value->getUnit());
    }

    public function testShouldBuildScaleValueWithMilliScale()
    {
        $value = CustomScaler::fromMilli(3, 'm');
        $this->assertSame('mm', $value->getUnit());
    }

    public function testShouldNowUseKiloAsBaseScale()
    {
        $value = CustomScaler::fromKilo(3, 'm');
        $this->assertSame('3km', (string) $value);
    }

    public function testGivingNoArgumentsShouldReturnSomethingAnyway()
    {
        $value = CustomScaler::fromBase();
        $this->assertSame('0', (string) $value);
    }

    public function testShouldThrowAnExceptionOnUnknownCommand()
    {
        $this->expectException(\BadMethodCallException::class);
        CustomScaler::fromSomethingElse(4);
    }

    public function testShouldThrowExceptionOnBadCommandPrefix()
    {
        $this->expectException(\BadMethodCallException::class);
        CustomScaler::toMilli(4);
    }
}
