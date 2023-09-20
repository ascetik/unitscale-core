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

trait UseLowestScales
{
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
