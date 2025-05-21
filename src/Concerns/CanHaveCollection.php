<?php

namespace TimoDeWinter\FilamentMonacoEditor\Concerns;

use Closure;

trait CanHaveCollection
{
    public string|Closure $collection = 'default';

    public function collection(Closure|string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function getCollection(): string
    {
        return $this->evaluate($this->collection);
    }
}
