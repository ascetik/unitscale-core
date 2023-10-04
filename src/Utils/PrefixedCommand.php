<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   Value object
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

 declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Utils;

/**
 * Encapsulate a command name and its prefix
 * Used by ScaleCommandParser
 *
 * @version 1.0.0
 */
readonly class PrefixedCommand
{
    public function __construct(public string $prefix, public string $name)
    {

    }
}
