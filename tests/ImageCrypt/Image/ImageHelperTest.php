<?php

use PHPUnit\Framework\TestCase;
use Rav\ImageCrypt\Image\ImageHelper;
use Rav\ImageCrypt\Image\Rgb;
use Rav\ImageCrypt\Exception\ImageCryptException;

class ImageHelperTest extends TestCase {

    public function testHexToRgb() {
        $rgb = ImageHelper::getRgbFromHex(2130706432);
        $this->assertInstanceOf(Rgb::class, $rgb);
        $this->assertIsInt($rgb->getAlpha());
        $this->assertIsInt($rgb->getRed());
        $this->assertIsInt($rgb->getGreen());
        $this->assertIsInt($rgb->getBlue());
        $this->assertEquals(127, $rgb->getAlpha());
        $this->assertEquals(0, $rgb->getRed());
        $this->assertEquals(0, $rgb->getGreen());
        $this->assertEquals(0, $rgb->getBlue());
        $this->assertEquals('A: 127 R: 0 G: 0 B: 0', $rgb->__toString());
    }

    public function testError() {
        $this->expectException(ImageCryptException::class);
        ImageHelper::getRgbFromHex(12130706432);
    }

    public function testHexToBin() {
        $bin = ImageHelper::getBinFromHex(2130706432);
        $this->assertEquals('10000100110000011100000110010000110010', $bin);
    }

    public function testIsRgbToString() {
        $hex = ImageHelper::getHexFromBin('10000100110000011100000110010000110010');
        $this->assertEquals(2130706432, $hex);
    }
}