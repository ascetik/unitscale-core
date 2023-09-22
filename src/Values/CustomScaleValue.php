<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   Scale value
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

 declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Values;

use Ascetik\UnitscaleCore\Factories\CustomScaleFactory;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleValue;

/**
 * Handle a value associated to a CustomScale
 * from pico to tera.
 * Use it with any unit abbreviation : m (meter), inches (in)...
 *
 * @version 1.0.0
 */
class CustomScaleValue extends ScaleValue
{
    /**
     * @param  string     $unit  chosen unit
     */
    public function __construct(
        int|float $value,
        ?Scale $scale = null,
        private string $unit = ''
    ) {
        parent::__construct($value, $scale);
    }

    /** @override */
    public function getUnit(): string
    {
        return parent::getUnit() . $this->unit;
    }

    /** @override */
    public function with(int|float $value, Scale $scale): static
    {
        return new self($value, $scale, $this->unit);
    }

    /** @abstract */
    protected static function selector(): CustomScaleFactory
    {
        return new CustomScaleFactory();
    }
}
