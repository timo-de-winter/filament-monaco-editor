<?php

namespace TimoDeWinter\FilamentMonacoEditor\Contracts;

use Closure;

interface HasLanguage
{
    public function language(Closure|string $language): static;

    public function getLanguage(): string;
}
