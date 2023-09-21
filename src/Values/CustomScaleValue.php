<?php

namespace Ascetik\UnitscaleCore\Values;

use Ascetik\UnitscaleCore\Factories\CustomScaleFactory;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleFactory;
use Ascetik\UnitscaleCore\Types\ScaleValue;

class CustomScaleValue extends ScaleValue
{
    public function __construct(
        int|float $value,
        ?Scale $scale = null,
        private string $unit = ''
    ) {
        parent::__construct($value, $scale);
    }

    public function getUnit(): string
    {
        return parent::getUnit() . $this->unit;
    }

    public function with(int|float $value, Scale $scale): static
    {
        return new self($value, $scale, $this->unit);
    }

    protected static function selector(): ScaleFactory
    {
        return new CustomScaleFactory();
    }
}
