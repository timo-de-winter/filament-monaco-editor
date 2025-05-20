<?php

namespace TimoDeWinter\FilamentMonacoEditor;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
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

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('monaco-editor-css', __DIR__.'/../resources/js/dist/components/monaco-editor.css')->loadedOnRequest(),
            AlpineComponent::make('monaco-editor', __DIR__.'/../resources/js/dist/components/monaco-editor.js'),
        ], package: 'timo-de-winter/filament-monaco-editor');
    }
}
