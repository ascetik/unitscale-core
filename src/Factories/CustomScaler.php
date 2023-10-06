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

use Ascetik\UnitscaleCore\Types\ScaleValue;
use Ascetik\UnitscaleCore\Types\ScaleValueFactory;
use Ascetik\UnitscaleCore\Utils\PrefixedCommand;
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
class CustomScaler extends ScaleValueFactory
{
    public static function unit(int|float $value, string $unit = ''): CustomScaleValue
    {
        return self::fromBase($value, $unit);
    }

    protected static function createWithCommand(PrefixedCommand $command, array $args = []): ScaleValue
    {
        [$value, $unit] = match (count($args)) {
            2 => [...$args],
            1 => [$args[0], ''],
            default => [0, '']
        };
        return CustomScaleValue::createFromScale((float) $value, $command->name, $unit);
    }
}
