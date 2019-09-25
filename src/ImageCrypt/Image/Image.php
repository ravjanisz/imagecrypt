<?php

namespace Rav\ImageCrypt\Image;

class Image extends ImageAbstract implements ImageInterface {

    public function load() {
        $name = $this->path . DIRECTORY_SEPARATOR . $this->name;

        //$this->image = imagecreatefromjpeg($name);
        $this->image = imagecreatefrompng($name);
        //$this->image = imagecreatefrombmp($name);
        //$this->image = imagecreatefromgif($name);
        imageAlphaBlending($this->image, false);
        imagesavealpha($this->image, true);

        list($this->width, $this->height, $this->type, $this->attr) = getimagesize($name);
    }

    public function save() {
        //imagejpeg($this->image, $this->path . DIRECTORY_SEPARATOR . 'modified-' . $this->name);
        imagepng($this->image, $this->path . DIRECTORY_SEPARATOR . 'modified-' . $this->name);
        //imagebmp($this->image, $this->path . DIRECTORY_SEPARATOR . 'modified-' . $this->name);
        //imagegif($this->image, $this->path . DIRECTORY_SEPARATOR . 'modified-' . $this->name);
    }
}