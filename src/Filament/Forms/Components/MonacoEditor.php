<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveHeight;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveLanguage;

class MonacoEditor extends Field
{
    use CanHaveLanguage;
    use CanHaveHeight;

    // @phpstan-ignore-next-line
    protected string $view = 'filament-monaco-editor::filament.forms.components.monaco-editor';
}
