<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    unitscale-core
 * @category   Abstract Scale value
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

use Ascetik\UnitscaleCore\Parsers\ScaleCommandInterpreter;

/**
 * Handle general behaviours of a value holding a scale.
 *
 * @version 1.0.0
 */
abstract class ScaleValue implements ConvertibleDimension
{
    protected readonly Scale $scale;

    public function __construct(
        protected readonly int|float $value,
        ?Scale $scale = null
    ) {
        $this->scale = $scale ?? static::createScale('base');
    }

    public function __call($method, $arguments)
    {
        $interpreter = ScaleCommandInterpreter::parse($method);
        return $interpreter->transpose($this);
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

    public function getScale(): Scale
    {
        return $this->scale;
    }

    public function withValue(int|float $value): static
    {
        return $this->with($value, $this->scale);
    }

    public function withScale(string|Scale $scale): static
    {
        return $this->with($this->value, $this->getRealScale($scale));
    }

    public function with(int|float $value, Scale $scale): static
    {
        return new static($value, $scale);
    }

    public function convertTo(Scale|string $scale): static
    {
        $scale = $this->getRealScale($scale);
        $value = $this->scale->forward($this->value);
        $value = $scale->backward($value);
        return $this->with($value, $scale);
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

    private function getRealScale(string|Scale $scale): Scale
    {
        return is_string($scale)
            ? static::createScale($scale)
            : $scale;
    }

    abstract protected static function selector(): ScaleFactory;

}
