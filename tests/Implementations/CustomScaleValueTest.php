<?php

namespace Ascetik\UnitscaleCore\Tests\Implementations;

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
        $this->assertSame('from', $parser->command->value);
    }

    public function testScaleCommandInterpreterWithToCommand()
    {
        $parser = ScaleCommandInterpreter::parse('toBlah');
        $this->assertSame('blah', $parser->action);
        $this->assertSame('to', $parser->command->value);
    }

    public function testBadCommandShouldThrowAnException()
    {
        $this->expectException(BadMethodCallException::class);
        ScaleCommandInterpreter::parse('getBlah');
        // $this->assertSame('blah',$parser->method);
        // $this->assertSame('from', $parser->command->value);
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

}
