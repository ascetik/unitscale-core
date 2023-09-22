<?php

namespace Ascetik\UnitscaleCore\Types;

use Ascetik\UnitScale\Types\FullValue;

interface ScaleAdjuster
{
    public function adjust(): FullValue; // TODO : on a besoin des FullValues
    /**
     * Les FullValues sont des ScaleDimensions non convertibles.
     */
}
