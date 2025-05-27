<?php

namespace TimoDeWinter\FilamentMonacoEditor\Concerns;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Exception\SassException;

trait CanCompileScss
{
    /**
     * @throws SassException
     */
    public function compileScssToCss(?string $scss): ?string
    {
        if (is_null($scss)) {
            return null;
        }

        return (new Compiler)->compileString($scss)->getCss();
    }
}
