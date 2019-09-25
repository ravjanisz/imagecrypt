<?php

namespace Rav\ImageCrypt\String;

use Rav\ImageCrypt\Exception\ImageCryptException;

class StringConverter implements ConverterInterface {

    public function convert($binary) {
        $headerBinary = substr($binary, 0, BinaryConverter::BINARY_HEADER_LENGTH);
        if (strlen($headerBinary) != BinaryConverter::BINARY_HEADER_LENGTH or strlen($headerBinary) % 3 !== 0 or
            $headerBinary !== BinaryConverter::BINARY_HEADER) {
            throw new ImageCryptException('Invalid header.');
        }

        $footerBinary = substr($binary, strlen($binary) - BinaryConverter::BINARY_FOOTER_LENGTH);
        if (strlen($footerBinary) != BinaryConverter::BINARY_FOOTER_LENGTH or strlen($footerBinary) % 2 !== 0 or
            $footerBinary !== BinaryConverter::BINARY_FOOTER) {
            throw new ImageCryptException('Invalid footer.');
        }

        $bodyBinary = substr($binary, BinaryConverter::BINARY_HEADER_LENGTH, -1 * BinaryConverter::BINARY_FOOTER_LENGTH);
        if (strlen($bodyBinary) % StringHelper::CHAR_BIN_LENGTH !== 0) {
            throw new ImageCryptException('Invalid body.');
        }

        return $this->body($bodyBinary);
    }

    protected function body($binary) {
        $string = '';

        $binaryCharacters = str_split($binary, StringHelper::CHAR_BIN_LENGTH);
        foreach ($binaryCharacters as $binaryCharacter) {
            $string .= StringHelper::binToChar($binaryCharacter);
        }

        return $string;
    }
}