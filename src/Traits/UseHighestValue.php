<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   Adjustment trait
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

 declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Traits;

use Ascetik\UnitscaleCore\DTO\ScaleReference;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleValue;

/**
 * Use a ScaleReference to handle adjustment
 *
 * @version 1.0.0
 */
trait UseHighestValue
{
    /**
     * Highest ScaleValue from
     * reference value
     *
     * @var ScaleValue
     */
    private ScaleValue $highest;

    public function __toString(): string
    {
        return (string) $this->highest;
    }

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
        $this->highest = $reference->highest();
    }
}
