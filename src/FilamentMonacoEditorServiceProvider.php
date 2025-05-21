<?php

namespace TimoDeWinter\FilamentMonacoEditor;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TimoDeWinter\FilamentMonacoEditor\Assets\Ttf;

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
            Css::make('monaco-editor-css', __DIR__.'/../resources/js/dist/monaco-editor.css')->loadedOnRequest(),
            AlpineComponent::make('monaco-editor', __DIR__.'/../resources/js/dist/monaco-editor.js'),

            // Monaco workers
            Js::make('monaco-worker-css', __DIR__.'/../resources/js/dist/monaco-worker-css.js')
                ->loadedOnRequest()
                ->module(),
            Js::make('monaco-worker-editor', __DIR__.'/../resources/js/dist/monaco-worker-editor.js')
                ->loadedOnRequest()
                ->module(),
            Js::make('monaco-worker-html', __DIR__.'/../resources/js/dist/monaco-worker-html.js')
                ->loadedOnRequest()
                ->module(),
            Js::make('monaco-worker-json', __DIR__.'/../resources/js/dist/monaco-worker-json.js')
                ->loadedOnRequest()
                ->module(),
            Js::make('monaco-worker-ts', __DIR__.'/../resources/js/dist/monaco-worker-ts.js')
                ->loadedOnRequest()
                ->module(),
            // We use a custom asset so that filament will publish the font as well
            Ttf::make('codicon', __DIR__.'/../resources/js/dist/codicon.ttf')
                ->loadedOnRequest(),
        ], package: 'timo-de-winter/filament-monaco-editor');
    }
}
