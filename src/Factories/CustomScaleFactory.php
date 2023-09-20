<?php

namespace Ascetik\UnitscaleCore\Factories;

use Ascetik\UnitscaleCore\Scales\CustomScale;
use Ascetik\UnitscaleCore\Traits\UseHighestScales;
use Ascetik\UnitscaleCore\Traits\UseIntermediateScales;
use Ascetik\UnitscaleCore\Traits\UseLowestScales;
use Ascetik\UnitscaleCore\Types\ScaleFactory;

class CustomScaleFactory implements ScaleFactory
{
    use UseHighestScales;
    use UseIntermediateScales;
    use UseLowestScales;

    public function base(): CustomScale
    {
        return new CustomScale(1, '');
    }
}
