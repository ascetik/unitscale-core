<?php

namespace Ascetik\UnitscaleCore\Traits;

use Ascetik\UnitscaleCore\DTO\ScaleReference;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleValue;

trait UseScaleReference
{
    private ScaleReference $reference;
    
    /**
     * Highest ScaleValue from
     * reference value
     *
     * @var ScaleValue
     */
    private ScaleValue $highest;

    public function raw(): int|float
    {
        return $this->highest->raw();
    }

    public function getScale(): Scale
    {
        return $this->highest->getScale();
    }

    public function getUnit(): string
    {
        return $this->highest->getUnit();
    }

    protected function setReference(ScaleReference $reference)
    {
        $this->reference = $reference;
        $this->highest = $reference->highest();
    }
}
