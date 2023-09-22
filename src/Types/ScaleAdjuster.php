<?php

namespace Ascetik\UnitscaleCore\Types;

interface ScaleAdjuster
{
    public function adjust(): FullValue; // TODO : on a besoin des FullValues
}
