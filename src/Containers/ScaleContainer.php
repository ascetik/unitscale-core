<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   Container
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Containers;

use Ascetik\Storage\Box;
use Ascetik\UnitscaleCore\Utils\NamedScale;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleValue;
use ReflectionClass;

/**
 * Handle a storage of NamedScales
 * to be used as encapsulated pairs of
 * method name / Scale
 *
 * @version 1.0.0
 */
class ScaleContainer
{
    public function __construct(
        private Box $stack
    ) {
    }

    public function has(Scale $scale): bool
    {
        return !is_null($this->find($scale));
    }

    public function find(Scale $scale)
    {
        return $this->stack->find(
            fn (NamedScale $wrapper) => $wrapper->contains($scale)
        );
    }

    public function content()
    {
        return $this->stack;
    }

    public static function buildFrom(ScaleValue $value): self
    {
        $stack = [];
        $selector = $value::selector();
        $reflection = new ReflectionClass($selector);
        foreach ($reflection->getMethods() as $reflectMethod) {
            if (!in_array($reflectMethod->name, $value::EXCLUDE)) {
                /** @var Scale $scale */
                $scale = $reflectMethod->invoke($selector);
                $wrapper = new NamedScale($reflectMethod->name, $scale);
                $stack[$scale->factor()] = $wrapper;
            }
        }

        ksort($stack);
        $box = new Box();
        foreach ($stack as $scale) {
            $box->attach($scale);
        }
        return new self($box);
    }
}
