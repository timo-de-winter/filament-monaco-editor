<?php

namespace TimoDeWinter\FilamentMonacoEditor\Contracts;

use Closure;

interface HasCustomizationProcess
{
    public function process(?Closure $default, array $parameters = []): mixed;
}
