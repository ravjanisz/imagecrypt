<?php

use PHPUnit\Framework\TestCase;
use Rav\ImageCrypt\String\StringHelper;

class StringHelperTest extends TestCase {

    public function testCharTobin() {
        $bin = StringHelper::charToBin('a');
        $this->assertEquals(strlen($bin), StringHelper::CHAR_BIN_LENGTH);
        $this->assertEquals('00000000000000000000000001100001', $bin);
    }

    public function testbinToChar() {
        $char = StringHelper::binToChar('00000000000000000000000001100001');
        $this->assertEquals(strlen($char), 1);
        $this->assertEquals('a', $char);
    }
}