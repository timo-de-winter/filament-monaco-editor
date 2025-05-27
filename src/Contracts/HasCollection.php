<?php

namespace TimoDeWinter\FilamentMonacoEditor\Contracts;

use Closure;

interface HasCollection
{
    public function collection(Closure|string $collection): static;

    public function getCollection(): string;
}
