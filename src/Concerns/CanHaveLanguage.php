<?php

namespace TimoDeWinter\FilamentMonacoEditor\Concerns;

use Closure;

trait CanHaveLanguage
{
    public string|Closure $language = 'text';

    public function language(Closure|string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->evaluate($this->language);
    }
}
