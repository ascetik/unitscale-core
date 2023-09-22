<?php

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\Scaler;
use Ascetik\UnitscaleCore\Parsers\ScaleCommandInterpreter;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;
use BadMethodCallException;
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

    public function testScaleCommandInterpreterWithFromCommand()
    {
        $parser = ScaleCommandInterpreter::parse('fromBlah');
        $this->assertSame('blah', $parser->action);
        $this->assertSame('FROM', $parser->command->name);
    }

    public function testScaleCommandInterpreterWithToCommand()
    {
        $parser = ScaleCommandInterpreter::parse('toBlah');
        $this->assertSame('blah', $parser->action);
        $this->assertSame('TO', $parser->command->name);
    }

    public function testBadCommandShouldThrowAnException()
    {
        $this->expectException(BadMethodCallException::class);
        ScaleCommandInterpreter::parse('getBlah');
    }

    public function testCustomScaleValueConvertionUsingFromCommand()
    {
        $value = new CustomScaleValue(1, unit: 'm');
        $value = $value->fromCenti();

        $this->assertSame('1cm', (string) $value);
    }

    public function testCustomScaleValueConvertionUsingToCommand()
    {
        $value = new CustomScaleValue(1, unit: 'm');
        $value = $value->toCenti();

        $this->assertSame('100cm', (string) $value);
    }

    public function testCustomScaleValueWithBothCommands()
    {
        $value = new CustomScaleValue(1, unit: 'm');
        $result = $value->fromCenti()->toMilli();
        $this->assertSame('10mm', (string) $result);
    }

    public function testCustomScaleValueWithLargeTransposition()
    {
        $value = new CustomScaleValue(1000000, unit: 'm');
        $result = $value->fromMilli()->toKilo();
        $this->assertSame('1km', (string) $result);
    }

    public function testCustomScaleValueFactory()
    {
        $value = Scaler::calculate(2000000, 'm')->fromCenti()->toHecto();
        $this->assertSame('200hm', (string) $value);
    }
}