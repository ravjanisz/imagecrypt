# imagecrypt

[![Build Status](https://travis-ci.org/ravjanisz/imagecrypt.svg?branch=master)](https://travis-ci.org/ravjanisz/imagecrypt)
[![codecov](https://codecov.io/gh/ravjanisz/imagecrypt/branch/master/graph/badge.svg)](https://codecov.io/gh/ravjanisz/imagecrypt)

Steganography is the art of hiding information in plain image. This project is PHP implementation of this idea and you can hide / fetch plain text from image in bmp or png format.

## Requirements

* PHP >= 7.1
* A GD extension
* (optional) PHPUnit to run tests.

## Install

Via Composer:

```bash
$ composer require ravjanisz/imagecrypt
```
## Usage

```PHP
// add instance
use Rav\ImageCrypt\ImageCrypt;

// pass directory and filename
$crypt = new ImageCrypt(__DIR__ . '/files', 'glass.png');
//prepare string to crypt in image
$string = 'ImageCrypt';
//crypt string and save to new file
$crypt->crypt($string, 'glassSaved.png');

//decrypt from file
$decrypt = new ImageCrypt(__DIR__ . '/files', 'glassSaved.png');
//get decrypted message or get exception
$string = $decrypt->decrypt();
echo $string;
```

## Documentation

None

## Support the development

**Do you like this project? Support it by donating**

<a href="https://www.buymeacoffee.com/ravjanisz">

![alt Buy me a coffee](https://raw.githubusercontent.com/ravjanisz/imagecrypt/master/docs/assets/bmc.png)

</a>

## License

imagecrypt is licensed under the MIT License - see the LICENSE file for details
