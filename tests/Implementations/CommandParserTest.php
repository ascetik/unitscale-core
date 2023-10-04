<?php

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Parsers\ScaleCommandParser;
use PHPUnit\Framework\TestCase;

class CommandParserTest extends TestCase
{
    public function testCommandParserUsingFrom()
    {
        $parser = new ScaleCommandParser('from');
        $this->assertSame('milli', $parser->parse('fromMilli'));
    }

    public function testCommandParserThrowsExceptionOnPrefixMismatch()
    {
        $this->expectException(\BadMethodCallException::class);
        $parser = new ScaleCommandParser('from');
        $parser->parse('toMilli');
    }

    public function testParserWithTwoPrefixes()
    {
        $parser = new ScaleCommandParser('as', 'to');
        $as = $parser->parse('asKilo');
        $to = $parser->parse('toKilo');
        $this->assertSame($as, $to);
    }
}
