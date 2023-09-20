<?php

namespace Ascetik\UnitscaleCore\Types;

interface ScaleCalculationStrategy
{
    public function calculate(int|float $value, bool $reverse = false): int|float;
}
