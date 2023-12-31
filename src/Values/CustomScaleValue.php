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

use Ascetik\UnitscaleCore\Extensions\AdjustedValue;
use Ascetik\UnitscaleCore\Factories\CustomScaleFactory;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleValue;

/**
 * Handle a value associated to a CustomScale
 * from pico to tera.
 * Use it with any unit abbreviation : meters (m), inches (in), bytes (b)...
 *
 * @method static toTera()
 * @method static toGiga()
 * @method static toMega()
 * @method static toKilo()
 * @method static toHecto()
 * @method static toDeca()
 * @method static toBase()
 * @method static toDeci()
 * @method static toCenti()
 * @method static toMilli()
 * @method static toMicro()
 * @method static toNano()
 * @method static toPico()
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

    public function adjust(): AdjustedValue
    {
       return AdjustedValue::buildWith($this);
    }
    
    public static function selector(): CustomScaleFactory
    {
        return new CustomScaleFactory();
    }

    public static function createFromScale(int|float $value, string $scale, string $unit = ''):static
    {
        // echo $scale.PHP_EOL;
        $realScale = self::createScale($scale);
        // echo $realScale->unit().PHP_EOL;
        return new self($value, $realScale, $unit);
    }

}
