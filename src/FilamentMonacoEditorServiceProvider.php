<?php

namespace TimoDeWinter\FilamentMonacoEditor;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentMonacoEditorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-monaco-editor')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_monaco_editor_tables');
    }
}
