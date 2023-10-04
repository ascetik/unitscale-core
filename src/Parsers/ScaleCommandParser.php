<?php

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Parsers;

class ScaleCommandParser
{
    private readonly array $prefixes;

    public function __construct(string ...$prefixes)
    {
        $this->prefixes = $prefixes;
    }

    public function parse(string $method): string
    {
        foreach($this->prefixes as $prefix)
        {
            if(str_starts_with($method, $prefix))
            {
                return strtolower(substr($method, strlen($prefix)));
            }
        }
        throw new \BadMethodCallException('unknown command');
    }

}
