<?php
/**
 * This is part of the unitscale-core package.
 *
 * @package    unitscale-core-core
 * @category   Commands Enum
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Enums;

/**
 * Available prefixes for any
 * magic __call() method command
 * starting with *from* or *to*
 *
 * @deprecated
 * @version 1.0.0
 */
enum ScaleCommandPrefix
{
    case FROM;
    case TO;

    public static function get(string $method): ?self
    {
        foreach (self::cases() as $case) {
            if (str_starts_with($method, strtolower($case->name))) {
                return $case;
            }
        }
        return null;
    }
}
