<?php

use Ascetik\UnitscaleCore\Scales\CustomScale;
use PHPUnit\Framework\TestCase;

class CustomScaleTest extends TestCase
{
    public function testBaseScale()
    {
        $scale = new CustomScale(3, 'k');

        $this->assertSame(1000, $scale->forward(1));
        $this->assertSame(0.001,$scale->backward(1));
    }
}
