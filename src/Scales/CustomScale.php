<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   Scale
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Scales;

use Ascetik\UnitscaleCore\Types\Scale;

/**
 * Handle calculation of all Custom scales
 * using multiples of ten as calculation strategy
 *
 * @version 1.0.0
 */
class CustomScale implements Scale
{
    public function __construct(private int $exponent, private string $prefix)
    {
    }

    public function forward(int|float $value): int|float
    {
        return $value * pow(10, $this->exponent);
    }

    public function backward(int|float $value): int|float
    {
        return $value * pow(10, $this->exponent * -1);
    }

    public function unit(): string
    {
        return $this->prefix;
    }

    public function factor(): int|float
    {
        return $this->exponent;
    }
}
