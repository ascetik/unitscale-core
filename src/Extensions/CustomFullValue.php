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
use Ascetik\UnitscaleCore\Types\ScaleValue;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;

/**
 * Full value handling adjustment
 * for a CustomScaleValue
 *
 * @method static toTera()
 * @method static toGiga()
 * @method static toMega()
 * @method static toKilo()
 * @method static toHecto()
 * @method static toDeca()
 * @method static toBase()
 * @method static toDeci()
 * @method static toCenti()
 * @method static toMilli()
 * @method static toMicro()
 * @method static toNano()
 * @method static toPico()
 *
 * @version 1.0.0
 */
class CustomFullValue implements FullValue
{
    
    public function __construct(
        private ScaleReference $reference
    ) {
    }

    public function __call($name, $arguments): static
    {
        $parser = ScaleCommandInterpreter::get($name, ScaleCommandPrefix::TO);
        return new self($this->reference->limitTo($parser->action));
    }

    public function __toString(): string
    {
        return (string) $this->reference->highest();
    }

    public function raw(): int|float
    {
        return $this->reference->highest()->raw(); // TODO : à revoir peut-être
    }

    public function getScale(): Scale
    {
        return $this->reference->highest()->getScale(); // TODO : y revenir, donc
    }

    public function getUnit(): string
    {
        return $this->reference->highest()->getUnit(); // TODO : je me repete...
    }

    public static function buildWith(ScaleValue $value)
    {
        $reference = new ScaleReference($value);
        return new self($reference);
    }
}
