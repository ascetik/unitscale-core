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
 * @method CustomScaleValue fromTera(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromGiga(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromMega(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromKilo(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromHecto(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromDeca(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromBase(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromDeci(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromCenti(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromMilli(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromMicro(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromNano(int|float|null $value, string $unit = '')
 * @method CustomScaleValue fromPico(int|float|null $value, string $unit = '')
 *
 * @version 1.0.0
 */
class Scaler implements ScaleValueFactory
{
    public static function unit(int|float $value, string $unit = ''): CustomScaleValue
    {
        return new CustomScaleValue($value, unit: $unit);
    }


    public static function __callStatic(string $method, $args)
    {
        echo $method . PHP_EOL;
        $checker = new ScaleCommandParser('from');
        $command = $checker->parse($method);
        // on devra prendre une valeur dans fromMethod()
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
