<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    unitscale-core
 * @category   Scale Factory
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Factories;

use Ascetik\UnitscaleCore\Scales\CustomScale;
use Ascetik\UnitscaleCore\Traits\UseHighestScales;
use Ascetik\UnitscaleCore\Traits\UseIntermediateScales;
use Ascetik\UnitscaleCore\Traits\UseLowestScales;
use Ascetik\UnitscaleCore\Types\ScaleFactory;

/**
 * Build CustomScales
 *
 * @version 1.0.0
 */
class CustomScaleFactory implements ScaleFactory
{
    public function tera()
    {
        return new CustomScale(12, 'T');
    }

    public function giga()
    {
        return new CustomScale(9, 'G');
    }

    public function mega()
    {
        return new CustomScale(6, 'M');
    }

    public function kilo()
    {
        return new CustomScale(3, 'k');
    }

    public function hecto()
    {
        return new CustomScale(2, 'h');
    }

    public function deca()
    {
        return new CustomScale(1, 'da');
    }

    public function base(): CustomScale
    {
        return new CustomScale(0, '');
    }

    public function deci()
    {
        return new CustomScale(-1, 'd');
    }

    public function centi()
    {
        return new CustomScale(-2, 'c');
    }

    public function milli()
    {
        return new CustomScale(-3, 'm');
    }

    public function micro()
    {
        return new CustomScale(-6, 'μ');
    }

    public function nano()
    {
        return new CustomScale(-9, 'n');
    }

    public function pico()
    {
        return new CustomScale(-12, 'p');
    }
}
