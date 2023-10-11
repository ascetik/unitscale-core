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
use Ascetik\UnitscaleCore\Parsers\ScaleCommandParser;
use Ascetik\UnitscaleCore\Traits\UseHighestValue;
use Ascetik\UnitscaleCore\Types\AdjustableValue;
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
class AdjustedValue implements AdjustableValue
{
    use UseHighestValue;

    public function __construct(
        private ScaleReference $reference
    ) {
        $this->setReference($reference);
    }

    public function __call($name, $arguments): static
    {
        $parser = new ScaleCommandParser('as');
        return new self($this->reference->limitTo($parser->parse($name)->name));
    }

    public static function buildWith(ScaleValue $value): self
    {
        $reference = new ScaleReference($value);
        return new self($reference);
    }
}
