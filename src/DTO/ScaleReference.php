<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   Data Transfer Object
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\DTO;

use Ascetik\UnitscaleCore\Containers\ScaleContainer;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleValue;
use Ascetik\UnitscaleCore\Utils\NamedScale;

/**
 * ScaleValue extension handling Scale adjustment
 *
 * @version 1.0.0
 */
class ScaleReference
{
    /**
     * Contains Scales adapted
     * to the registered value
     *
     * @var ScaleContainer
     */
    public readonly ScaleContainer $scales;

    public function __construct(
        public readonly ScaleValue $value,
        ScaleContainer $scales = null,
        protected ?Scale $highest = null
    ) {
        $this->scales = $scales ?? ScaleContainer::buildFrom($value);
    }

    public function limitTo(string $action): self
    {
        $limit = $this->value::createScale($action);
        return new self($this->value, $this->scales, $limit);
    }

    /**
     * Return a new ScaleValue with the
     * highest scale it can have,
     * dependeing on highestScale if set
     *
     * @return ScaleValue
     */
    public function highest(): ScaleValue
    {
        $value = $this->value;
        /** @var NamedScale $wrapper */
        foreach ($this->scales->content()->toArray() as $wrapper) {
            $newValue = $this->value->convertTo($wrapper->name);
            if (
                $newValue->raw() < 1 ||
                $this->hasHighestScale($wrapper->scale)
            ) {
                break;
            }
            $value = $newValue;
        }
        return $value;
    }

    private function hasHighestScale(Scale $scale): bool
    {
        if ($this->highest === null) {
            return false;
        }
        return  $scale->factor() > $this->highest->factor();
    }
}
