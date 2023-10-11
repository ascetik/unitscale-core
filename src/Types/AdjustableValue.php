<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    unitscale-core
 * @category   interface
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

/**
 * Contract for any ScaleDimension
 * able to adjust a ScaleValue
 *
 * @version 1.0.0
 */
interface AdjustableValue extends ScaleDimension
{
    public static function buildWith(ScaleValue $value): AdjustableValue;
}
