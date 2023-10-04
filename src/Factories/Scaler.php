<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   ScaleValue Factory
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Factories;

use Ascetik\UnitscaleCore\Extensions\AdjustedValue;
use Ascetik\UnitscaleCore\Parsers\ScaleCommandParser;
use Ascetik\UnitscaleCore\Types\ScaleValueFactory;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;

/**
 * Build CustomScaleValues
 *
 * @method static CustomScaleValue fromTera(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromGiga(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromMega(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromKilo(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromHecto(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromDeca(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromBase(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromDeci(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromCenti(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromMilli(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromMicro(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromNano(int|float|null $value, string $unit = '')
 * @method static CustomScaleValue fromPico(int|float|null $value, string $unit = '')
 *
 * @version 1.0.0
 */
class Scaler implements ScaleValueFactory
{
    public static function unit(int|float $value, string $unit = ''): CustomScaleValue
    {
        return new CustomScaleValue($value, unit: $unit);
    }

    /**
     * Use commands prefixed by "from"
     *
     * @param  string $method prefixed ScaleFactory method
     * @param  mixed  $args   value and unit to use,
     *
     * @return void
     */
    public static function __callStatic(string $method, $args): CustomScaleValue
    {
        $checker = new ScaleCommandParser('from');
        $command = $checker->parse($method)->name;
        [$value, $unit] = match (count($args)) {
            2 => [...$args],
            1 => [$args[0], ''],
            default => [0, '']
        };
        return CustomScaleValue::createFromScale((float) $value, $command, $unit);
    }

    /**
     * @deprecated
     */
    public static function adjust(int|float $value, string $unit = ''): AdjustedValue
    {
        return self::unit($value, $unit)->adjust();
    }
}
