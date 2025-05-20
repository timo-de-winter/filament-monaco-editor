<?php

namespace TimoDeWinter\FilamentMonacoEditor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TimoDeWinter\FilamentMonacoEditor\FilamentMonacoEditor
 */
class FilamentMonacoEditor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \TimoDeWinter\FilamentMonacoEditor\FilamentMonacoEditor::class;
    }
}
