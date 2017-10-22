# Bootstrap 4 fluent HTML builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marvinlabs/laravel-html-bootstrap-4.svg?style=flat-square)](https://packagist.org/packages/marvinlabs/laravel-html-bootstrap-4)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/marvinlabs/laravel-html-bootstrap-4.svg?style=flat-square)](https://packagist.org/packages/marvinlabs/laravel-html-bootstrap-4)

## About

This package is an extension on top of [Spatie laravel-html](https://github.com/spatie/laravel-html) package to easily produce font awesome markup.

## Installation

You can install the package via composer:

``` bash
composer require marvinlabs/laravel-html-bootstrap-4
```

If you are using Laravel 5.5, the service provider and facade will automatically be discovered. 

On earlier versions, you need to do that manually.

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    MarvinLabs\Html\Bootstrap\BootstrapServiceProvider::class,
];
```

And optionally register an alias for the facade.

```php
// config/app.php
'aliases' => [
    ...
    'FA' => MarvinLabs\Html\Bootstrap\Facades\Bootstrap::class,
];
```

## Usage

### Icons

Here are two equivalent ways to output the beer icon. The first one allows full auto-completion. While the second one 
uses a little magic to automatically transform the method name into the icon name.

    {!! bs()->icon('beer') !!}
    {!! bs()->beer() !!}
    
When the icon name contains dashes (aka *kebab case*), you should use the *camel case* equivalent (remove dashes, and 
capitalize each word after the first one).      
    
    {!! bs()->icon('window-close') !!}
    {!! bs()->windowClose() !!}

### Modifiers

You can chain methods to affect the icon.

    {!! bs()->icon('repeat')->spin()->size('2x') !!}

### Lists

You can also easily replace the list bullets by custom icons.

    <ul class="fa-ul">
        <li>{!! bs()->checkSquareO()->forList() !!} Item 1</li>
        <li>{!! bs()->squareO()->forList() !!} Item 2</li>
        <li>{!! bs()->checkSquareO()->forList() !!} Item 3</li>
        <li>{!! bs()->checkSquareO()->forList() !!} Item 4</li>
    </ul>
    
### Stacks

You can also produce icon stacks (two icons on top of each other).

The `stack` method should receive an array containing exactly two items. The items can be associative or not.

If you pass simple strings, those are considered to be the icon name.

    {!! bs()->stack([ 'square-o', 'beer', ]) !!}
    
If the item is a `key => value` association, the key is considered to be the icon name, and the value will be the 
CSS classes added to the icon element.
    
    {!! bs()->stack([ 'square', 'beer' => 'fa-inverse', ]) !!}
    
An item can also simply be created as described above by chaining methods.     
    
    {!! bs()->stack([ 'square', bs()->icon('beer')->inverse()->flip(), ]) !!}
    
Finally, you can also add any CSS class to the stack, like the ones for sizing (refer to the Font Awesome documentation).         

    {!! bs()->stack([ 'square-o', 'beer', ])->addClass('fa-5x') !!}
    
Output the latest minified Font Awesome CSS link using the maxCDN URL     
    
    {!! bs()->css() !!}
      
## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email bonjour@vincentprat.info instead of using the issue tracker.

## Credits

- [Spatie agency](https://github.com/spatie) for the base package

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.