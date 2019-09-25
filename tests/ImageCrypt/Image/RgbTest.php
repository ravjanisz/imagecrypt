<?php

use PHPUnit\Framework\TestCase;
use Rav\ImageCrypt\Image\Rgb;

class RgbTest extends TestCase {

    public function testRgb() {
        $rgb = new Rgb(100, 100, 100, 100);
        $this->assertInstanceOf(Rgb::class, $rgb);
        $this->assertIsInt($rgb->getAlpha());
        $this->assertIsInt($rgb->getRed());
        $this->assertIsInt($rgb->getGreen());
        $this->assertIsInt($rgb->getBlue());
        $this->assertEquals(100, $rgb->getAlpha());
        $this->assertEquals(100, $rgb->getRed());
        $this->assertEquals(100, $rgb->getGreen());
        $this->assertEquals(100, $rgb->getBlue());
        $this->assertEquals('A: 100 R: 100 G: 100 B: 100', $rgb->__toString());

        $rgb->setAlpha(101);
        $rgb->setRed(101);
        $rgb->setGreen(101);
        $rgb->setBlue(101);
        $this->assertEquals(101, $rgb->getAlpha());
        $this->assertEquals(101, $rgb->getRed());
        $this->assertEquals(101, $rgb->getGreen());
        $this->assertEquals(101, $rgb->getBlue());
    }
}