<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   Scale Factory trait
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Traits;

use Ascetik\UnitscaleCore\Scales\CustomScale;

/**
 * @version 1.0.0
 */
trait UseIntermediateScales
{
    public function hecto()
    {
        return new CustomScale(2, 'h');
    }

    public function deca()
    {
        return new CustomScale(1, 'da');
    }


    public function deci()
    {
        return new CustomScale(-1, 'd');
    }

    public function centi()
    {
        return new CustomScale(-2, 'c');
    }
}
