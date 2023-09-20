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

trait UseHighestScales
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
}
