<?php

namespace Rav\ImageCrypt\String;

class BinaryConverter implements ConverterInterface {

    const BINARY_HEADER_LENGTH = 11 * 3;
    const BINARY_FOOTER_LENGTH = 11 * 2;

    const BINARY_HEADER = '111000111000111000111000111000111';
    const BINARY_FOOTER = '1100110011001100110011';

    public function convert($string) {
        $binary = '';
        $binary .= self::BINARY_HEADER;
        $binary .= $this->body($string);
        $binary .= self::BINARY_FOOTER;

        return $binary;
    }

    protected function body($string) {
        $binary = '';

        $length = mb_strlen($string, 'UTF-8');
        for ($i = 0 ; $i < $length ; $i++) {
            $char = mb_substr($string, $i, 1, 'UTF-8');
            $binary .= StringHelper::charToBin($char);
        }

        return $binary;
    }
}