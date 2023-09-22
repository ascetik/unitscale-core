<?php

namespace Ascetik\UnitscaleCore\Tests\Implementations;

use Ascetik\UnitscaleCore\Factories\Scaler;
use PHPUnit\Framework\TestCase;

class CustomScaleAdjusterTest extends TestCase
{
    public function testSimpleAdjustment()
    {
        $value = Scaler::unit(3000,'m');
        $adjusted = $value->adjust();
        $this->assertSame('3km', (string) $adjusted);
    }
}
