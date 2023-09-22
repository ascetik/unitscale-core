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
 * having a value associated to a Scale
 *
 * @version 1.0.0
 */
interface ScaleDimension extends \Stringable
{
    public function raw(): int|float;
    public function getScale(): Scale;
    public function getUnit(): string;
}
