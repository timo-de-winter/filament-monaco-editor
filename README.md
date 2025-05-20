# A package to implement the monaco editor into a filament project

[![Latest Version on Packagist](https://img.shields.io/packagist/v/timo-de-winter/filament-monaco-editor.svg?style=flat-square)](https://packagist.org/packages/timo-de-winter/filament-monaco-editor)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/timo-de-winter/filament-monaco-editor/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/timo-de-winter/filament-monaco-editor/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/timo-de-winter/filament-monaco-editor/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/timo-de-winter/filament-monaco-editor/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/timo-de-winter/filament-monaco-editor.svg?style=flat-square)](https://packagist.org/packages/timo-de-winter/filament-monaco-editor)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.
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
$filamentMonacoEditor = new TimoDeWinter\FilamentMonacoEditor();
echo $filamentMonacoEditor->echoPhrase('Hello, TimoDeWinter!');
```

## Testing
```bash
composer test
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities
Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits
- [Timo de Winter](https://github.com/timo-de-winter)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
