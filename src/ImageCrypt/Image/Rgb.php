<?php

namespace Rav\ImageCrypt\Image;

class Rgb {

    private $alpha;
    private $red;
    private $green;
    private $blue;

    public function __construct($alpha, $red, $green, $blue) {
        $this->alpha = $alpha;
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function setAlpha($alpha) {
        $this->alpha = $alpha;
    }

    public function getAlpha() {
        return $this->alpha;
    }

    public function setRed($red) {
        $this->red = $red;
    }

    public function getRed() {
        return $this->red;
    }

    public function setGreen($green) {
        $this->green = $green;
    }

    public function getGreen() {
        return $this->green;
    }

    public function setBlue($blue) {
        $this->blue = $blue;
    }

    public function getBlue() {
        return $this->blue;
    }

    public function __toString() {
        return 'A: ' . $this->alpha . ' R: ' . $this->red . ' G: ' . $this->green . ' B: ' . $this->blue;
    }
}