<?php

namespace TimoDeWinter\FilamentMonacoEditor\Assets;


use Filament\Support\Assets\Js;

class Ttf extends Js
{
    public function getPublicPath(): string
    {
        return public_path($this->getRelativePublicPath());
    }

    public function getRelativePublicPath(): string
    {
        $path = config('filament.assets_path', '');

        return ltrim("{$path}/js/{$this->getPackage()}/{$this->getId()}.ttf", '/');
    }

    public function getSrc(): string
    {
        return asset($this->getRelativePublicPath()) . '?v=' . $this->getVersion();
    }
}
