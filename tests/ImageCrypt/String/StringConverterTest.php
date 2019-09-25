<?php

use PHPUnit\Framework\TestCase;
use Rav\ImageCrypt\String\BinaryConverter;
use Rav\ImageCrypt\String\StringConverter;
use Rav\ImageCrypt\Exception\ImageCryptException;

class StringConverterTest extends TestCase {

    public function testStringConverter() {
        $binString = BinaryConverter::BINARY_HEADER . '00000000000000000000000001100001' . BinaryConverter::BINARY_FOOTER;

        $stringConverter = new StringConverter();
        $string = $stringConverter->convert($binString);

        $this->assertEquals(strlen($string), 1);
        $this->assertEquals($string, 'a');
    }

    public function testStringConverterHeader() {
        $this->expectException(ImageCryptException::class);

        $binString = '1111000111000111000111000111000111' . '00000000000000000000000001100001' . '1100110011001100110011';

        $stringConverter = new StringConverter();
        $stringConverter->convert($binString);
    }

    public function testStringConverterBody() {
        $this->expectException(ImageCryptException::class);

        $binString = '111000111000111000111000111000111' . '0000000000000000000000001100001' . '1100110011001100110011';

        $stringConverter = new StringConverter();
        $stringConverter->convert($binString);
    }

    public function testStringConverterFooter() {
        $this->expectException(ImageCryptException::class);

        $binString = '111000111000111000111000111000111' . '00000000000000000000000001100001' . '11001100110011001100111';

        $stringConverter = new StringConverter();
        $stringConverter->convert($binString);
    }
}