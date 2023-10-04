<?php

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\Scaler;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;
use PHPUnit\Framework\TestCase;

class CustomScaleValueTest extends TestCase
{
    public function testSimpleCustomValue()
    {
        $value = new CustomScaleValue(1, unit: 'm');
        $this->assertSame('1m', (string) $value);
        $this->assertSame(1, $value->raw());
        $this->assertTrue($value->isInteger());
    }


    /**
     * change
     */
    public function testShouldThowExceptionOnUnknownCommand()
    {
        $this->expectException(\BadMethodCallException::class);
        $value = new CustomScaleValue(1, unit: 'm');
        $value = $value->fromCenti();
    }

    public function testCustomScaleValueConvertionUsingToCommand()
    {
        $value = new CustomScaleValue(1, unit: 'm');
        $value = $value->toCenti();

        $this->assertSame('100cm', (string) $value);
    }

    /**
     * change
     */
    public function testCustomScaleValueWithBothCommands()
    {
        $value = Scaler::fromCenti(1, 'm')->toMilli();
        $this->assertSame('10mm', (string) $value);
    }

    /**
     * change
     */
    public function testCustomScaleValueWithLargeTransposition()
    {
        $value = Scaler::fromMilli(1000000, 'm')->toKilo();
        $this->assertSame('1km', (string) $value);
    }

    /**
     * change
     */
    public function testCustomScaleValueFactory()
    {
        $unit = Scaler::fromCenti(2000000, 'm')->toHecto();
        $this->assertSame('200hm', (string) $unit);
    }
}
