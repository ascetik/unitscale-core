<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   TimeScaleValue Extension
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Extensions;

use Ascetik\UnitscaleCore\DTO\ScaleReference;
use Ascetik\UnitscaleCore\Enums\ScaleCommandPrefix;
use Ascetik\UnitscaleCore\Parsers\ScaleCommandInterpreter;
use Ascetik\UnitscaleCore\Types\FullValue;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;

/**
 * Full value handling adjustment
 * for a CustomScaleValue
 *
 * @version 1.0.0
 */
class CustomFullValue implements FullValue
{
    private ScaleReference $reference;
    public function __construct(
        CustomScaleValue $value
    ) {
        $this->reference = new ScaleReference($value);
    }

    public function __call($name, $arguments): static
    {
        $parser = ScaleCommandInterpreter::get($name, ScaleCommandPrefix::TO);
        $limit = $this->reference->value::createScale($parser->action);
        $this->reference->limitTo($limit);
        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->reference->highest();
    }

    public function raw(): int|float
    {
        return $this->reference->value->raw(); // TODO : à revoir peut-être
    }

    public function getScale(): Scale
    {
        return $this->reference->value->getScale(); // TODO : y revenir, donc
    }

    public function getUnit(): string
    {
        return $this->reference->value->getUnit(); // TODO : je me repete...
    }
}
