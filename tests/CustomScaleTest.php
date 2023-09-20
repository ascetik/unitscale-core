<?php

declare(strict_types=1);

use Ascetik\UnitscaleCore\Scales\CustomScale;
use PHPUnit\Framework\TestCase;

class CustomScaleTest extends TestCase
{
    public function testBaseScaleForward()
    {
        $scale = new CustomScale(3, 'k');

        $this->assertSame(1000, $scale->forward(1));
    }

    public function testBaseScaleBackward()
    {
        $scale = new CustomScale(3, 'k');

        $this->assertSame(0.001,$scale->backward(1));
    }
}
