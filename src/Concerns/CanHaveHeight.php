<?php

namespace TimoDeWinter\FilamentMonacoEditor\Concerns;

use Closure;

trait CanHaveHeight
{
    public string|Closure $height = '300px';

    public function height(Closure|string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): string
    {
        return $this->evaluate($this->height);
    }
}
