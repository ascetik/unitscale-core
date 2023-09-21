<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    unitscale-core
 * @category   Interface
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

/**
 * Build Scales
 *
 * @version 1.0.0
 */
interface ScaleFactory
{
    public function base(): Scale;
}
