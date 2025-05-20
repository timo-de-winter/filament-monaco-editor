<?php

namespace TimoDeWinter\FilamentMonacoEditor;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentMonacoEditorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-monaco-editor')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_monaco_editor_table');
    }
}
