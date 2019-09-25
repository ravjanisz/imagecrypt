<?php

namespace Rav\ImageCrypt\Image;

abstract class ImageAbstract {

    /*
    1 = GIF
    2 = JPG
    3 = PNG
    4 = SWF
    5 = PSD
    6 = BMP
    7 = TIFF(intel byte order)
    8 = TIFF(motorola byte order)
    9 = JPC
    10 = JP2
    11 = JPX
    12 = JB2
    13 = SWC
    14 = IFF
    15 = WBMP
    16 = XBM
    //*/

    protected $path;
    protected $name;

    protected $image;
    protected $width;
    protected $height;
    protected $type;
    protected $attr;

    public function __construct($path, $name) {
        $this->path = $path;
        $this->name = $name;
    }

    public function getHex($x, $y) {
        return imagecolorat($this->image, $x, $y);
    }

    public function get($x, $y) {
        $hexString = imagecolorat($this->image, $x, $y);

        return ImageHelper::getRgbFromHex($hexString);
    }

    public function set($x, $y, Rgb $color) {
        $imgColor = imagecolorallocatealpha($this->image, $color->getRed(), $color->getGreen(), $color->getBlue(), $color->getAlpha());
        imagesetpixel($this->image, $x, $y, $imgColor);
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getType() {
        return $this->type;
    }

    public function getAttr() {
        return $this->attr;
    }
}