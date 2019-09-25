<?php

namespace Rav\ImageCrypt\Image;

use Rav\ImageCrypt\Exception\ImageCryptException;

class Image extends ImageAbstract implements ImageInterface {

    public function load() {
        $name = $this->path . DIRECTORY_SEPARATOR . $this->name;

        switch (pathinfo($this->name, PATHINFO_EXTENSION)) {
            case 'png':
                $this->image = imagecreatefrompng($name);
                break;
            case 'bmp':
                $this->image = imagecreatefrombmp($name);
                break;
            default:
                throw new ImageCryptException('Invalid file type.');
        }

        if(!imageistruecolor($this->image)) {
            throw new ImageCryptException('Image have to be true color.');
        }

        imageAlphaBlending($this->image, false);
        imagesavealpha($this->image, true);

        list($this->width, $this->height, $this->type, $this->attr) = getimagesize($name);
    }

    public function save($name) {
        switch (pathinfo($this->name, PATHINFO_EXTENSION)) {
            case 'png':
                imagepng($this->image, $this->path . DIRECTORY_SEPARATOR . $name);
                break;
            case 'bmp':
                imagebmp($this->image, $this->path . DIRECTORY_SEPARATOR . $name);
                break;
            default:
                throw new ImageCryptException('Invalid file type.');
        }
    }
}