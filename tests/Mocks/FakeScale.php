<?php

namespace Ascetik\UnitscaleCore\Tests\Mocks;

use Ascetik\UnitscaleCore\Types\Scale;

class FakeScale implements Scale
{
    public function __construct(private int|float $factor, private string $unit)
    {
    }

    public function forward(int|float $value): int|float
    {
        return $value * $this->factor;
    }

    public function backward(int|float $value): int|float
    {
        return $value / $this->factor;
    }

    public function unit(): string
    {
        return $this->unit;
    }

    public function factor(): int|float
    {
        return $this->factor;
    }
}
