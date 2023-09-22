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
 * Main behaviour for any instance
 * having a value associated to a
 * Scale and able to adapt to a new Scale
 *
 * @version 1.0.0
 */
interface ConvertibleDimension extends ScaleDimension
{
    public function withScale(string|Scale $scale): self;
    public function convertTo(Scale|string $scale): self;
    public function with(int|float $value, Scale $scale): self;
    public function adjust(): FullValue;
}
