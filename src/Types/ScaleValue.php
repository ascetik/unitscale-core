<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   Abstract Scale value
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

use Ascetik\UnitscaleCore\Parsers\ScaleCommandParser;

/**
 * Handle general behaviours of a value holding a scale.
 *
 * @version 1.0.0
 */
abstract class ScaleValue implements ConvertibleDimension
{
    public const EXCLUDE = [];

    protected readonly Scale $scale;

    public function __construct(
        protected readonly int|float $value,
        ?Scale $scale = null
    ) {
        $this->scale = $scale ?? static::createScale('base');
    }

    /**
     * Use commands prefixed by *to*
     *
     * @param  string $method
     * @param  array $arguments
     *
     * @return static
     */
    public function __call($method, $arguments): static
    {
        $checker = new ScaleCommandParser('to');
        $scaleName = $checker->parse($method)->name;
        return $this->convertTo($scaleName);
    }

    public function __toString()
    {
        return $this->value . $this->getUnit();
    }

    public function raw(): int|float
    {
        return $this->round();
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

    public function with(int|float $value, Scale $scale): static
    {
        return new static($value, $scale);
    }

    final public function withValue(int|float $value): static
    {
        return $this->with($value, $this->scale);
    }

    final public function withScale(string|Scale $scale): static
    {
        return $this->with($this->value, self::getRealScale($scale));
    }

    final public function convertTo(Scale|string $scale): static
    {
        $scale = self::getRealScale($scale);
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
        $data = [static::selector(), $name];
        if (method_exists(...$data)) {
            return call_user_func($data);
        }
        throw new \BadMethodCallException('The method ' . $name . ' does not exist');
    }

    private static function getRealScale(string|Scale $scale): Scale
    {
        return is_string($scale)
            ? static::createScale($scale)
            : $scale;
    }

    /**
     * Return the value with correct type
     *
     * @param  int       $precision
     *
     * @return float|int
     */
    protected function round($precision = 12): float|int
    {
        $float = round($this->value, $precision);
        $int = intval($this->value);
        return ($int == $float) ? $int : $float;
    }

    abstract public static function selector(): ScaleFactory;

    public static function createFromScale(int|float $value, string $scale): static
    {
        $realScale = self::createScale($scale);
        return new static($value, $realScale);
    }
}
