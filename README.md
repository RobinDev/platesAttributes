# Plates Extension : Render html tag attributes

[![Quality Score](https://img.shields.io/scrutinizer/g/RobinDev/platesAttributes.svg?style=flat-square)](https://scrutinizer-ci.com/g/RobinDev/platesAttributes)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3d265e22-2c0c-4c50-8260-660ce24dedac/mini.png)](https://insight.sensiolabs.com/projects/3d265e22-2c0c-4c50-8260-660ce24dedac)
[![Build Status](https://travis-ci.org/RobinDev/platesAttributes.svg)](https://travis-ci.org/RobinDev/platesAttributes)

This package is an extension for the template engine [Plates https://github.com/thephpleague/plates].

Two features for the same goal **Manipulate html tag attributes via PHP array** :
* `$this->attr(array $attributes)` transform an array in html tag attributes
* `$this->mergeAttr(array $arr1, array $arr2, [array $arr3, ...])` merge multiple array without loosing values (Eg. : `['class' => 'main']` + `['class' => 'content']` = `['class' => 'main content']`)

##Table of contents
* [Usage](#usage)
* [Installation](#installation)
    * [Packagist](https://packagist.org/packages/ropendev/cache)
* [Requirements](#requirements)
* [Contributors](#contributors)
* [Licence](#licence)

##Usage

```php
/* Template Init */
$templateEngine = new \League\Plates\Engine('app/views');

/* Load this extension */
$templateEngine->loadExtension(new \rOpenDev\PlatesExtension\Attributes());

$this->render('test', ['attributes' => ['class' => 'content']]);
```

In your `test` template file
```php
$defaultAttributes = ['class' => 'main'];
$attributes        = isset($attributes) ? $this->mergeAttr($defaultAttributes, $attributes) : $defaultAttributes;
```

## Installation

```bash
composer require ropendev/platesattributes
```

## Requirements

Stand alone extension.

See `composer.json` file.

## Contributing

See `CONTRIBUTING.md` file.

## Contributors

* Original author [Robin (UX Design)](http://www.robin-d.fr)
* ...

## License

MIT (see the LICENSE file for details)
