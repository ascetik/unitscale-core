<?php

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\Scaler;
use PHPUnit\Framework\TestCase;

class CustomScaleAdjusterTest extends TestCase
{
    public function testShouldAdjustFromBaseToKilo()
    {
        $value = Scaler::unit(3000, 'm')->adjust();
        $this->assertSame('3km', (string) $value);
        $this->assertSame(3, $value->raw());
    }
    public function testShouldAdjustToScaleLittlerThanBase()
    {
        $value = Scaler::unit(3000, 'm')->toCenti();
        $this->assertSame('300000cm', (string) $value);
    }

    public function testShouldAdjustFromBaseStoppingAtHecto()
    {
        $value = Scaler::unit(3000, 'm')->toHecto();
        $this->assertSame('30hm', (string) $value);
        $this->assertSame(30, $value->raw());
    }

    public function testShouldIncreaseAmountAndDecreaseScale()
    {
        $value = Scaler::unit(0.003, 'm')->adjust();
        $this->assertSame('3mm', (string) $value);
    }

    public function testShouldAdaptStartingFromADifferentScale()
    {
        $value = Scaler::unit(0.003, 'm')->adjust();
        $this->assertSame('3mm', (string) $value);
    }

    public function testShouldAdaptStartingFromAdifferentScaleAndLimitedToAnother()
    {
        $adjusted = Scaler::fromMicro(3000000000000, 'm')
            ->adjust()
            ->asKilo();
        $this->assertSame('3000km', (string) $adjusted);
    }


}
