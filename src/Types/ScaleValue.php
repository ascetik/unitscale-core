<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   Abstract Scale value
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

/**
 * Handle general behaviours of a value holding a scale.
 *
 * @version 1.0.0
 */
abstract class ScaleValue
{
    private readonly Scale $scale;

    public function __construct(
        private readonly int|float $value,
        ?Scale $scale = null
    ) {
        $this->scale = $scale ?? static::createScale('base');
    }

    public function __toString()
    {
        return $this->value . $this->getUnit();
    }

    public function raw(): int|float
    {
        return $this->value;
    }

    public function integer(): int
    {
        return (int) $this->value;
    }

    public function isInteger(): bool
    {
        return $this->value == $this->integer();
    }

    public function getUnit(): string
    {
        return $this->scale->unit();
    }

    public function withValue(int|float $value): static
    {
        return new static($value, $this->scale);
    }

    public function withScale(string|Scale $scale): static
    {
        return new static($this->value, $this->getRealScale($scale));
    }

    public function with(int|float $value, Scale $scale): static
    {
        return new static($value, $scale);
    }

    public function convertTo(Scale|string $scale): static
    {
        // if (is_string($scale)) {
        //     $scale = static::createScale($scale);
        // }
        $value = $this->scale->forward($this->value);
        $value = $this->getRealScale($scale)->backward($value);
        return $this->with($value, $scale);
    }

    abstract protected function selector(): ScaleFactory;

    private function getRealScale(string|Scale $scale): Scale
    {
        return is_string($scale)
            ? static::createScale($scale)
            : $scale;
    }
    /**
     * Return the result of method
     * called $name from static class
     *
     * @param  string $name
     *
     * @throws BadMethodCallException on unexisting method
     *
     * @return Scale
     */
    public static function createScale(string $name): Scale
    {
        $name = strtolower($name);
        $data = [static::selector(), $name];
        if (method_exists(...$data)) {
            return call_user_func($data);
        }
        throw new \BadMethodCallException('The method ' . $name . ' does not exist');
    }
}
