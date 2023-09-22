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

use Ascetik\UnitscaleCore\Types\ScaleValueFactory;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;

/**
 * Build CustomScaleValues
 *
 * @version 1.0.0
 */
class Scaler implements ScaleValueFactory
{
    public static function unit(int|float $value, string $unit = ''): CustomScaleValue
    {
        return new CustomScaleValue($value, unit: $unit);
    }
}
