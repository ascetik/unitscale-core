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

use Ascetik\UnitscaleCore\Types\Scale;

/**
 * ScaleContainer item.
 * Carry a Scale attached to a name
 * as identifier
 *
 * @version 1.0.0
 */
class NamedScale
{
    public function __construct(
        public readonly string $name,
        public readonly Scale $scale
    ) {
    }

    public function contains(Scale $scale): bool
    {
        return $scale == $this->scale
            ||
            ($scale->factor() == $this->scale->factor()
                &&
                $scale->unit() == $this->scale->unit()
            );
    }
}
