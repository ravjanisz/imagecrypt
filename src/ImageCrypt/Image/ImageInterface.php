<?php

namespace Rav\ImageCrypt\Image;

interface ImageInterface {

    public function load();
    public function save($name);

    public function get($x, $y);
    public function set($x, $y, Rgb $color);
}