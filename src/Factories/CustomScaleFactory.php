<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
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
    use UseHighestScales;
    use UseIntermediateScales;
    use UseLowestScales;

    public function base(): CustomScale
    {
        return new CustomScale(0, '');
    }
}
