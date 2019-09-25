<?php

use PHPUnit\Framework\TestCase;
use Rav\ImageCrypt\Image\Image;
use Rav\ImageCrypt\Exception\ImageCryptException;
use Rav\ImageCrypt\Image\Rgb;

class ImageTest extends TestCase {

    public function testImagePng() {
        $image = new Image(dirname(__FILE__), 'testPng.png');

        $image->load();
        $this->assertInstanceOf(Image::class, $image);

        $image->save('testSavePng.png');
        $this->assertInstanceOf(Image::class, $image);
    }

    public function testImageLoadBmp() {
        $image = new Image(dirname(__FILE__), 'testBmp.bmp');

        $image->load();
        $this->assertInstanceOf(Image::class, $image);

        $image->save('testSaveBmp.bmp');
        $this->assertInstanceOf(Image::class, $image);
    }

    public function testImageLoadError() {
        $this->expectException(ImageCryptException::class);
        $image = new Image(dirname(__FILE__), 'testJpeg.jpeg');
        $image->load();
    }

    public function testImageSaveError() {
        $this->expectException(ImageCryptException::class);
        $image = new Image(dirname(__FILE__), 'testJpeg.jpeg');
        $image->save('testSaveJpeg.jpeg');
    }

    public function testImageTrueColor() {
        $this->expectException(ImageCryptException::class);
        $image = new Image(dirname(__FILE__), 'testTrueColor.png');
        $image->load();
    }

    public function testImage() {
        $image = new Image(dirname(__FILE__), 'test.png');
        $image->load();

        $this->assertIsInt($image->getWidth());
        $this->assertEquals(100, $image->getWidth());
        $this->assertEquals(100, $image->getHeight());
        $this->assertEquals(3, $image->getType());
        $this->assertEquals('width="100" height="100"', $image->getAttr());

        $red = $image->get(10, 10);
        $this->assertInstanceOf(Rgb::class, $red);
        $this->assertEquals(0, $red->getAlpha());
        $this->assertEquals(255, $red->getRed());
        $this->assertEquals(0, $red->getGreen());
        $this->assertEquals(0, $red->getBlue());

        $this->assertEquals(16711680, $image->getHex(10, 10));

        $image->set(10, 10, new Rgb(0, 0, 255, 0));
        $green = $image->get(10, 10);
        $this->assertInstanceOf(Rgb::class, $green);
        $this->assertEquals(0, $green->getAlpha());
        $this->assertEquals(0, $green->getRed());
        $this->assertEquals(255, $green->getGreen());
        $this->assertEquals(0, $green->getBlue());
    }



    public function setUp() :void {
        $this->create();
        $this->createTrueColor();
        $this->createPng();
        $this->createBmp();
        $this->createJpeg();
    }

    public function tearDown() :void {
        if (file_exists(dirname(__FILE__) . '/test.png')) {
            unlink(dirname(__FILE__) . '/test.png');
        }

        if (file_exists(dirname(__FILE__) . '/testTrueColor.png')) {
            unlink(dirname(__FILE__) . '/testTrueColor.png');
        }


        if (file_exists(dirname(__FILE__) . '/testPng.png')) {
            unlink(dirname(__FILE__) . '/testPng.png');
        }

        if (file_exists(dirname(__FILE__) . '/testBmp.bmp')) {
            unlink(dirname(__FILE__) . '/testBmp.bmp');
        }

        if (file_exists(dirname(__FILE__) . '/testJpeg.jpeg')) {
            unlink(dirname(__FILE__) . '/testJpeg.jpeg');
        }


        if (file_exists(dirname(__FILE__) . '/testSave.png')) {
            unlink(dirname(__FILE__) . '/testSave.png');
        }

        if (file_exists(dirname(__FILE__) . '/testSavePng.png')) {
            unlink(dirname(__FILE__) . '/testSavePng.png');
        }

        if (file_exists(dirname(__FILE__) . '/testSaveBmp.bmp')) {
            unlink(dirname(__FILE__) . '/testSaveBmp.bmp');
        }
    }



    protected function create() {
        var_dump(dirname(__FILE__));

        if (file_exists(dirname(__FILE__) . '/test.png')) {
            try {
                unlink(dirname(__FILE__) . '/test.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to delete files in this directory:' . $e);
            }

        } else {
            $image = imagecreatetruecolor(100, 100);
            $red = imagecolorallocate($image, 255, 0, 0);
            imagefill($image, 0, 0, $red);

            try {
                imagepng($image, dirname(__FILE__) . '/test.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to create files in this directory:' . $e);
            }
        }
    }

    protected function createTrueColor() {
        var_dump(dirname(__FILE__));

        if (file_exists(dirname(__FILE__) . '/testTrueColor.png')) {
            try {
                unlink(dirname(__FILE__) . '/testTrueColor.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to delete files in this directory:' . $e);
            }

        } else {
            $image = imagecreate(100, 100);
            $red = imagecolorallocate($image, 255, 0, 0);
            imagefill($image, 0, 0, $red);

            try {
                imagepng($image, dirname(__FILE__) . '/testTrueColor.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to create files in this directory:' . $e);
            }
        }
    }

    protected function createPng() {
        var_dump(dirname(__FILE__));

        if (file_exists(dirname(__FILE__) . '/testPng.png')) {
            try {
                unlink(dirname(__FILE__) . '/testPng.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to delete files in this directory:' . $e);
            }

        } else {
            $image = imagecreatetruecolor(100, 100);
            $red = imagecolorallocate($image, 255, 0, 0);
            imagefill($image, 0, 0, $red);

            try {
                imagepng($image, dirname(__FILE__) . '/testPng.png');
            } catch (Exception $e) {
                throw new Exception('You have no permission to create files in this directory:' . $e);
            }
        }
    }

    protected function createBmp() {
        if (file_exists(dirname(__FILE__) . '/testBmp.bmp')) {
            try {
                unlink(dirname(__FILE__) . '/testBmp.bmp');
            } catch (Exception $e) {
                throw new Exception('You have no permission to delete files in this directory:' . $e);
            }

        } else {
            $image = imagecreatetruecolor(100, 100);
            $red = imagecolorallocate($image, 255, 0, 0);
            imagefill($image, 0, 0, $red);

            try {
                imagebmp($image, dirname(__FILE__) . '/testBmp.bmp');
            } catch (Exception $e) {
                throw new Exception('You have no permission to create files in this directory:' . $e);
            }
        }
    }

    protected function createJpeg() {
        if (file_exists(dirname(__FILE__) . '/testJpeg.jpeg')) {
            try {
                unlink(dirname(__FILE__) . '/testJpeg.jpeg');
            } catch (Exception $e) {
                throw new Exception('You have no permission to delete files in this directory:' . $e);
            }

        } else {
            $image = imagecreatetruecolor(100, 100);
            $red = imagecolorallocate($image, 255, 0, 0);
            imagefill($image, 0, 0, $red);

            try {
                imagejpeg($image, dirname(__FILE__) . '/testJpeg.jpeg');
            } catch (Exception $e) {
                throw new Exception('You have no permission to create files in this directory:' . $e);
            }
        }
    }
}