<?php

/**
 * This is part of the UnitScale Core package.
 *
 * @package    unitscale-core
 * @category   Interpreter
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Parsers;

use Ascetik\UnitscaleCore\Enums\ScaleCommandPrefix;
use Ascetik\UnitscaleCore\Types\ConvertibleDimension;
use Ascetik\UnitscaleCore\Types\ScaleValue;
use BadMethodCallException;

/**
 * Interpreter in use by classes having
 * magic __call method to handle any scale adaptation.
 *
 * Available methods depend on the ScaleValue in use
 * in order to use the appropriate ScaleFactory
 * but have to start with *from* or *to*.
 *
 * The interpreter defines the ScaleFactory method
 * to use in order to produce a new Scale
 * and the command to use with this new scale
 *
 * @version 1.0.0
 */
class ScaleCommandInterpreter
{
    /**
     * Use *parse()* static function
     * to instanciate the interpreter
     */
    private function __construct(
        public readonly string $action,
        public readonly ScaleCommandPrefix $command
    ) {
    }

    /**
     * Translate the command to
     * convert a ScaleValue to another scale
     *
     * @param  ConvertibleDimension $value
     *
     * @return ScaleValue
     */
    public function transpose(ConvertibleDimension $value): ScaleValue
    {
        return match ($this->command) {
            ScaleCommandPrefix::FROM => $value->withScale($this->action),
            ScaleCommandPrefix::TO => $value->convertTo($this->action),
        };
    }

    /**
     * Return self instance using given available command
     *
     * @param  string             $command
     * @param  ScaleCommandPrefix $useOnly
     *
     * @return self
     */
    public static function get(string $command, ScaleCommandPrefix $useOnly): self
    {
        if (!str_starts_with($command, strtolower($useOnly->name))) {
            self::throw($command);
        }
        $method = substr($command, strlen($useOnly->value));
        return new self($method, $useOnly);
    }

    /**
     * Instanciate interpreter
     * after some availability checks.
     *
     * @param  string $method         MUST start with *from* or *to*
     *
     * @throws BadMethodCallException if called method does not starts with from or to
     *
     * @return self
     */
    public static function parse(string $method): self
    {
        if ($command = ScaleCommandPrefix::get($method)) {
            $method = substr($method, strlen($command->name));
            $action = strtolower($method);
            return new self($action, $command);
        }
        self::throw($method);
    }

    /**
     * @throws BadMethodCallException with $value message
     */
    private static function throw(string $value): void
    {
        throw new \BadMethodCallException('Invalid "' . $value . '" command');
    }
}
