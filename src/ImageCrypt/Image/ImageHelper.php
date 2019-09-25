<?php

namespace Rav\ImageCrypt\Image;

use Rav\ImageCrypt\Exception\ImageCryptException;

class ImageHelper {

    public static function getRgbFromHex($hex) {
        if ($hex > 0x7FFFFFFF or $hex < 0) {
            throw new ImageCryptException(sprintf('Parameter hex out of range (%s)', $hex));
        }

        $alpha = (($hex & 0xFF000000) >> 24);
        $red = (($hex & 0x00FF0000) >> 16);
        $green = (($hex & 0x0000FF00) >> 8);
        $blue = (($hex & 0x000000FF));

        return new Rgb($alpha, $red, $green, $blue);
    }

    public static function getBinFromHex($hexColor) {
        $numeric = hexdec($hexColor);

        return decbin($numeric);
    }

    public static function getHexFromBin($binColor) {
        $numeric = bindec($binColor);

        return dechex($numeric);
    }
}