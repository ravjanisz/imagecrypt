<?php

namespace Rav\ImageCrypt\Image;

abstract class ImageAbstract {

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