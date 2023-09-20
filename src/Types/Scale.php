<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   Interface
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

/**
 * A Scale must be able to return a value
 * increassed OR decreased by its own
 * calculation strategy.
 * Each Scale has its own string representation
 * and a factor to use for calculations.
 *
 * @version 1.0.0
 */
interface Scale
{
    /**
     * Increase value
     * (value can decrease with a negative factor)
     */
    public function forward(int|float $value): int|float;
    /**
     * Decrease value
     * (value can increase with a negative factor)
     */
    public function backward(int|float $value): int|float;

    /**
     * Return Scale string representation
     *
     * @return string
     */
    public function unit(): string;

    /**
     * Return the factor used for calculation
     *
     * @return int|float
     */
    public function factor(): int|float;
}
