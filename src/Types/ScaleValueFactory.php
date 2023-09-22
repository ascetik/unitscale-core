<?php

namespace Ascetik\UnitscaleCore\Types;

interface ScaleValueFactory
{
    public static function calculate(int|float $value, string $unit = ''): ConvertibleDimension;
}
