<?php

namespace Ascetik\UnitscaleCore\Extensions;

use Ascetik\UnitscaleCore\Types\FullValue;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;

class CustomFullValue implements FullValue
{
    public function __construct(
        private CustomScaleValue $value
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->value; // TODO : à changer par le ScaleReference plus tard
    }

    public function raw(): int|float
    {
        return $this->value->raw(); // TODO : à revoir peut-être
    }

    public function getScale(): Scale
    {
        return $this->value->getScale(); // TODO : y revenir, donc
    }

    public function getUnit(): string
    {
        return $this->value->getUnit(); // TODO : je me repete...
    }
}
