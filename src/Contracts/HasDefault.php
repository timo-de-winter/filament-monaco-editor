<?php

namespace TimoDeWinter\FilamentMonacoEditor\Contracts;

interface HasDefault
{
    public function default(mixed $state = true): static;

    public function getDefaultState(): mixed;
}
