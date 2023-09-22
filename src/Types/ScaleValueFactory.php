<?php

namespace Ascetik\UnitscaleCore\Types;

use Ascetik\UnitscaleCore\Values\CustomScaleValue;

interface ScaleValueFactory
{
    public static function convert(int|float $value, string $unit = ''): CustomScaleValue;
}
