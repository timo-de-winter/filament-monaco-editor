<?php

namespace TimoDeWinter\FilamentMonacoEditor\Concerns;

use Closure;
use RuntimeException;

trait CanHaveCollection
{
    public string|array|Closure $collection = 'default';

    public function collection(Closure|string|array $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function getCollection(): string|array
    {
        $collection = $this->evaluate($this->collection);

        if (is_array($collection) && array_is_list($collection)) {
            throw new RuntimeException('When using an array as a collection you have to use both key and value where key is the collection name and value is the language.');
        }

        return $collection;
    }
}
