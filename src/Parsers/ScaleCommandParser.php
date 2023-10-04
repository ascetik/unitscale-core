<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   Command parser
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Parsers;

use Ascetik\UnitscaleCore\Utils\PrefixedCommand;

/**
 * Parse prefixed commands
 *
 * @version 1.0.0
 */
class ScaleCommandParser
{
    /**
     * Available prefixes registry
     *
     * @var array
     */
    private readonly array $prefixes;

    public function __construct(string ...$prefixes)
    {
        $this->prefixes = $prefixes;
    }

    /**
     * Parse given command
     *
     * @param  string $method Method MUST start with any registered prefix, Exception thrown otherwise
     */
    public function parse(string $method): PrefixedCommand
    {
        foreach($this->prefixes as $prefix)
        {
            if(str_starts_with($method, $prefix))
            {
                $name = strtolower(substr($method, strlen($prefix)));
                return new PrefixedCommand($prefix, $name);
            }
        }
        throw new \BadMethodCallException('unknown command');
    }

}
