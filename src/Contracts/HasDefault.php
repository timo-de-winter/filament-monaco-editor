<?php

namespace TimoDeWinter\FilamentMonacoEditor\Contracts;

use Closure;

interface HasDefault
{
    public function default(mixed $state = true): static;

    public function getDefaultState(): mixed;
}
