<?php

namespace Ascetik\UnitscaleCore\Types;

interface Scale
{
    public function forward(int|float $value): int|float;
    public function backward(int|float $value): int|float;
    public function unit(): string;
    public function factor(): int|float;
}
