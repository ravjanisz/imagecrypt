<?php

namespace Rav\ImageCrypt;

use Rav\ImageCrypt\Exception\ImageCryptException;
use Rav\ImageCrypt\Image\Image;
use Rav\ImageCrypt\Image\ImageHelper;
use Rav\ImageCrypt\String\BinaryConverter;
use Rav\ImageCrypt\String\StringConverter;
use Rav\ImageCrypt\String\StringHelper;

class ImageCrypt {

    private $image;
    private $availableLength;

    public function __construct($path, $name) {
        $this->image = new Image($path, $name);
        $this->image->load();

        $binarySize = $this->image->getWidth() * $this->image->getHeight();
        $reservedSize = BinaryConverter::BINARY_HEADER_LENGTH + BinaryConverter::BINARY_FOOTER_LENGTH;
        $maxCharacterLength = ($binarySize - $reservedSize) / StringHelper::CHAR_BIN_LENGTH;
        $this->availableLength = (int) $maxCharacterLength;
    }

    public function crypt($string) {
        if (mb_strlen($string) > $this->availableLength) {
            throw new ImageCryptException('Invalid message length - max' . $this->availableLength . '.');
        }

        $binConv = new BinaryConverter();
        $binaryString = $binConv->convert($string);
        $binaryLength = strlen($binaryString) - 1;

        $position = 0;
        for ($i = 0 ; $i < $this->image->getWidth(); $i++) {
            for ($j = 0 ; $j < $this->image->getHeight(); $j++) {
                $hex = $this->image->getHex($i, $j);
                $bin = ImageHelper::getBinFromHex($hex);

                $modBin = substr_replace($bin, $binaryString[$position], -1, 1);
                $modHex = ImageHelper::getHexFromBin($modBin);
                $modRgb = ImageHelper::getRgbFromHex($modHex);

                $this->image->set($i, $j, $modRgb);

                if ($binaryLength === $position) {
                    break 2;
                }

                $position++;
            }
        }

        $this->image->save();
    }

    public function decrypt() {
        $binaryString = '';
        for ($i = 0 ; $i < $this->image->getWidth(); $i++) {
            for ($j = 0; $j < $this->image->getHeight(); $j++) {
                $hex = $this->image->getHex($i, $j);
                $bin = ImageHelper::getBinFromHex($hex);
                $binaryString .= substr($bin, -1);
            }
        }

        $header = substr($binaryString, 0, BinaryConverter::BINARY_HEADER_LENGTH);
        if ($header !== BinaryConverter::BINARY_HEADER) {
            throw new ImageCryptException('Invalid header.');
        }

        $hasFooter = false;

        $binary = substr($binaryString, 0, BinaryConverter::BINARY_HEADER_LENGTH);
        $binaryString = substr($binaryString, BinaryConverter::BINARY_HEADER_LENGTH);
        $binaryArray = str_split($binaryString, StringHelper::CHAR_BIN_LENGTH);
        foreach ($binaryArray as $binaryCharacter) {
            $binaryFooter = substr($binaryCharacter, 0, BinaryConverter::BINARY_FOOTER_LENGTH);
            if ($binaryFooter === BinaryConverter::BINARY_FOOTER) {
                $binary .= $binaryFooter;
                $hasFooter = true;

                break;
            }

            $binary .= $binaryCharacter;
        }

        if (!$hasFooter) {
            throw new ImageCryptException('Invalid footer.');
        }

        $strConv = new StringConverter();
        $string = $strConv->convert($binary);

        return $string;
    }
}