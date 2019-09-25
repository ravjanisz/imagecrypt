<?php

use PHPUnit\Framework\TestCase;
use Rav\ImageCrypt\String\BinaryConverter;
use Rav\ImageCrypt\String\StringHelper;

class BinaryConverterTest extends TestCase {

    public function testBinaryConverter() {
        $binaryConverter = new BinaryConverter();
        $binaryString = $binaryConverter->convert('a');

        $binStringLength = BinaryConverter::BINARY_HEADER_LENGTH + StringHelper::CHAR_BIN_LENGTH + BinaryConverter::BINARY_FOOTER_LENGTH;
        $this->assertEquals(strlen($binaryString), $binStringLength);

        $binString = BinaryConverter::BINARY_HEADER . '00000000000000000000000001100001' . BinaryConverter::BINARY_FOOTER;
        $this->assertEquals($binString, $binaryString);
    }
}