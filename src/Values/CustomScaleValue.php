<?php

namespace Ascetik\UnitscaleCore\Values;

use Ascetik\UnitscaleCore\Factories\CustomScaleFactory;
use Ascetik\UnitscaleCore\Types\ScaleFactory;
use Ascetik\UnitscaleCore\Types\ScaleValue;

class CustomScaleValue extends ScaleValue
{
    protected function selector(): ScaleFactory
    {
        return new CustomScaleFactory();
    }
}
