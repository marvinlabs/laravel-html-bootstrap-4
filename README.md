# Bootstrap 4 fluent HTML builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marvinlabs/laravel-html-bootstrap-4.svg?style=flat-square)](https://packagist.org/packages/marvinlabs/laravel-html-bootstrap-4)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/marvinlabs/laravel-html-bootstrap-4.svg?style=flat-square)](https://packagist.org/packages/marvinlabs/laravel-html-bootstrap-4)

## About

This package is an extension on top of [Spatie laravel-html](https://github.com/spatie/laravel-html) package to easily 
produce Bootstrap 4 markup.

## Installation

You can install the package via composer:

``` bash
composer require marvinlabs/laravel-html-bootstrap-4
```

If you are using Laravel 5.5, the service provider and facade will automatically be discovered. 

On earlier versions, you need to do that manually. You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    MarvinLabs\Html\Bootstrap\BootstrapServiceProvider::class,
    Appstract\BladeDirectives\BladeDirectivesServiceProvider::class, // Required if not already there
];
```

And optionally register an alias for the facade.

```php
// config/app.php
'aliases' => [
    ...
    'BS' => MarvinLabs\Html\Bootstrap\Facades\Bootstrap::class,
];
```

## Usage

Depending on the component, you will either need to call some methods or use Blade components.

### Blade components

Components based on Blade can fully be overridden. You will need to publish the package views to 
`resources/views/vendor/bs` with the command:

```bash
php artisan vendor:publish --provider="MarvinLabs\Html\Bootstrap\BootstrapServiceProvider" --tag="views"
``` 

- [Alerts](https://github.com/marvinlabs/laravel-workbench/blob/master/resources/views/laravel-html-bootstrap-4/alert.blade.php)
- [Jumbotron](https://github.com/marvinlabs/laravel-workbench/blob/master/resources/views/laravel-html-bootstrap-4/jumbotron.blade.php)

### Programmatic calls

- [Badges](https://github.com/marvinlabs/laravel-workbench/blob/master/resources/views/laravel-html-bootstrap-4/badge.blade.php)
- [Buttons](https://github.com/marvinlabs/laravel-workbench/blob/master/resources/views/laravel-html-bootstrap-4/button.blade.php)
- [Forms](https://github.com/marvinlabs/laravel-workbench/blob/master/resources/views/laravel-html-bootstrap-4/form.blade.php)

## Translations

Translations can fully be overridden. You will need to publish the package language files to 
`resources/lang/vendor/bs` with the command:

```bash
php artisan vendor:publish --provider="MarvinLabs\Html\Bootstrap\BootstrapServiceProvider" --tag="lang"
``` 
      
## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email bonjour@vincentprat.info instead of using the issue tracker.

## Credits

- [Adam Wathan](https://github.com/adamwathan) for the bootforms package which has been very helpful until it got dropped
- [Spatie agency](https://github.com/spatie) for the laravel-html package
- [Appstract team](https://github.com/appstract) for the laravel-blade-directives package and some BS4 blade components

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.