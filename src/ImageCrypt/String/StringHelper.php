<?php

namespace Rav\ImageCrypt\String;

class StringHelper {

    const CHAR_BIN_LENGTH = 32;

    public static function charToBin($char) {
        $bin = decbin(mb_ord($char));
        if (strlen($bin) < self::CHAR_BIN_LENGTH) {
            $bin = str_pad($bin, self::CHAR_BIN_LENGTH, '0', STR_PAD_LEFT);
        }

        return $bin;
    }

    public static function binToChar($bin) {
        return mb_chr(bindec($bin));
    }
}