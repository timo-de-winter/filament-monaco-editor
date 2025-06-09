<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;
use ScssPhp\ScssPhp\Exception\SimpleSassFormatException;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanCompileScss;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveHeight;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveLanguage;

class MonacoEditor extends Field
{
    use CanHaveHeight;
    use CanHaveLanguage;
    use CanCompileScss;

    // @phpstan-ignore-next-line
    protected string $view = 'filament-monaco-editor::filament.forms.components.monaco-editor';

    public static function make(string $name): static
    {
        $static = app(static::class, ['name' => $name]);
        $static->configure();

        return $static
            // SCSS rule
            ->rule(fn (): Closure => function (string $attribute, $value, Closure $fail) use ($static) {
               if ($static->getLanguage() !== 'scss') {
                   return;
               }

                try {
                    $static->compileScssToCss($value);
                } catch (SimpleSassFormatException) {
                   $fail(__('filament-monaco-editor::monaco-editor.notifications.scss_failed_to_parse'));
                }
            });
    }
}
