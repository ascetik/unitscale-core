<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    unitscale-core
 * @category   Interface
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

use Ascetik\UnitscaleCore\Parsers\ScaleCommandParser;
use Ascetik\UnitscaleCore\Types\ScaleValue;
use Ascetik\UnitscaleCore\Utils\PrefixedCommand;

/**
 * Build ScaleValues
 *
 * @version 1.0.0
 */
abstract class ScaleValueFactory
{
    public static function __callStatic(string $method, $args): ScaleValue
    {
        $checker = new ScaleCommandParser('from');
        $command = $checker->parse($method);
        return static::createWithCommand($command, $args);
    }

    abstract public static function unit(int|float $value): ConvertibleDimension;

    abstract protected static function createWithCommand(PrefixedCommand $command, array $args = []): ScaleValue;
}
