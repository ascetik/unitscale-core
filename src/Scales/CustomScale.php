<?php

namespace Ascetik\UnitscaleCore\Scales;

use Ascetik\UnitscaleCore\Types\Scale;

class CustomScale implements Scale
{
    public function __construct(private int $exponent, private string $prefix)
    {
    }
    
    public function forward(int|float $value): int|float
    {
        return $value * pow(10, $this->exponent);
    }

    public function backward(int|float $value): int|float
    {
        return $value * pow(10, $this->exponent * -1);
    }

    public function unit(): string
    {
        return $this->prefix;
    }

    public function factor(): int|float
    {
        return $this->exponent;
    }
}
