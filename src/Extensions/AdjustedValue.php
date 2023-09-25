<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    UnitScale
 * @category   ScaleValue adjustment Extension
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\UnitscaleCore\Extensions;

use Ascetik\UnitscaleCore\DTO\ScaleReference;
use Ascetik\UnitscaleCore\Enums\ScaleCommandPrefix;
use Ascetik\UnitscaleCore\Parsers\ScaleCommandInterpreter;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Types\ScaleDimension;
use Ascetik\UnitscaleCore\Types\ScaleValue;

/**
 * Handle ScaleValue adjustment :
 * The value amount increases while
 * its scale degree decreases
 * Can be inverse depending on initial amount
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
class AdjustedValue implements ScaleDimension
{
    /**
     * Highest ScaleValue from
     * reference value
     *
     * @var ScaleValue
     */
    protected ScaleValue $highest;

    public function __construct(
        private ScaleReference $reference
    ) {
        $this->highest = $this->reference->highest();
    }

    public function __call($name, $arguments): static
    {
        $parser = ScaleCommandInterpreter::get($name, ScaleCommandPrefix::TO);
        return new self($this->reference->limitTo($parser->action));
    }

    public function __toString(): string
    {
        return (string) $this->highest;
    }

    public function raw(): int|float
    {
        return $this->highest->raw();
    }

    public function getScale(): Scale
    {
        return $this->highest->getScale();
    }

    public function getUnit(): string
    {
        return $this->highest->getUnit();
    }

    public static function buildWith(ScaleValue $value): static
    {
        $reference = new ScaleReference($value);
        return new static($reference);
    }
}
