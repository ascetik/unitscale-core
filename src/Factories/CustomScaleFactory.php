<?php

namespace Ascetik\UnitscaleCore\Factories;

use Ascetik\UnitscaleCore\Scales\CustomScale;
use Ascetik\UnitscaleCore\Types\ScaleFactory;

class CustomScaleFactory implements ScaleFactory
{
    public function base(): CustomScale
    {
        return new CustomScale(1, '');
    }
}
