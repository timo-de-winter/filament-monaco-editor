<?php

namespace TimoDeWinter\FilamentMonacoEditor\Contracts;

interface MutatesCodeBeforeCompilation
{
    public function getMutatedCodeForCompilation(string $language, string $code): string;
}
