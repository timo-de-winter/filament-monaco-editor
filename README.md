# Filament Monaco Editor

[![Latest Version on Packagist](https://img.shields.io/packagist/v/timo-de-winter/filament-monaco-editor.svg?style=flat-square)](https://packagist.org/packages/timo-de-winter/filament-monaco-editor)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/timo-de-winter/filament-monaco-editor/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/timo-de-winter/filament-monaco-editor/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/timo-de-winter/filament-monaco-editor/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/timo-de-winter/filament-monaco-editor/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/timo-de-winter/filament-monaco-editor.svg?style=flat-square)](https://packagist.org/packages/timo-de-winter/filament-monaco-editor)

A package to implement the monaco editor into a filament project. Including a morphable model to relate code to any model.
Obviously, you can use only the editor without publishing and running the migrations for the morphable model.

## Installation

You can install the package via composer:
```bash
composer require timo-de-winter/filament-monaco-editor
```

You can publish and run the migrations with:
```bash
php artisan vendor:publish --tag="filament-monaco-editor-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="filament-monaco-editor-config"
```

This is the contents of the published config file:
```php
return [
];
```

Optionally, you can publish the views using
```bash
php artisan vendor:publish --tag="filament-monaco-editor-views"
```

## Usage
```php
public static function form(Form $form): Form
{
    return $form->schema([
        \TimoDeWinter\FilamentMonacoEditor\Filament\Forms\Components\MonacoEditor::make('code')
            ->language('php')
            ->height('500px'),
    ]);
}
```

## Testing
```bash
composer test
```

## Credits
- [Timo de Winter](https://github.com/timo-de-winter)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
