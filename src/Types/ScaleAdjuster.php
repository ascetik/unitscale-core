<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   Reducer
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Types;

/**
 * Contract to handle Scale adjustment
 *
 * @version 1.0.0
 */
interface ScaleAdjuster
{
    public function adjust(): FullValue;
}
