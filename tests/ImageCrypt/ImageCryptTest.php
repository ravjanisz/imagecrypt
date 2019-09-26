<?php

use PHPUnit\Framework\TestCase;
use Rav\ImageCrypt\ImageCrypt;
use Rav\ImageCrypt\Exception\ImageCryptException;

class ImageCryptTest extends TestCase {

    public function setUp() :void {
        if (file_exists(dirname(__FILE__) . '/testImageCrypt.png')) {
            try {
                unlink(dirname(__FILE__) . '/testImageCrypt.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to delete files in this directory:' . $e);
            }

        } else {
            $image = imagecreatetruecolor(100, 100);
            $red = imagecolorallocate($image, 255, 0, 0);
            imagefill($image, 0, 0, $red);

            try {
                imagepng($image, dirname(__FILE__) . '/testImageCrypt.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to create files in this directory:' . $e);
            }
        }
    }

    public function tearDown() :void {
        if (file_exists(dirname(__FILE__) . '/testImageCrypt.png')) {
            unlink(dirname(__FILE__) . '/testImageCrypt.png');
        }

        if (file_exists(dirname(__FILE__) . '/testImageCryptSave.png')) {
            unlink(dirname(__FILE__) . '/testImageCryptSave.png');
        }
    }

    public function testImageCryptException() {
        $this->expectException(ImageCryptException::class);

        $imageCrypt = new ImageCrypt(dirname(__FILE__), 'testImageCrypt.png');
        $imageCrypt->decrypt();
    }

    public function testImageCrypt() {
        $imageCrypt = new ImageCrypt(dirname(__FILE__), 'testImageCrypt.png');
        $imageCrypt->crypt('Ala ma kota', 'testImageCryptSave.png');

        $imageCrypt = new ImageCrypt(dirname(__FILE__), 'testImageCryptSave.png');
        $this->assertEquals('Ala ma kota', $imageCrypt->decrypt());
    }

    public function testImageCryptLengthException() {
        $this->expectException(ImageCryptException::class);

        $imageCrypt = new ImageCrypt(dirname(__FILE__), 'testImageCrypt.png');

        $stringToCrypt = str_repeat('Ala ma kota', 100);
        $imageCrypt->crypt($stringToCrypt, 'testImageCryptSave.png');
    }
}