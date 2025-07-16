<?php

namespace TimoDeWinter\FilamentMonacoEditor\Concerns;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Exception\SassException;
use ScssPhp\ScssPhp\OutputStyle;
use TimoDeWinter\FilamentMonacoEditor\Loggers\NoOutputLogger;

trait CanCompileScss
{
    /**
     * @throws SassException
     */
    public function compileScssToCss(?string $scss, OutputStyle $outputStyle = OutputStyle::COMPRESSED): ?string
    {
        if (is_null($scss)) {
            return null;
        }

        $compiler = new Compiler;
        $compiler->setLogger(new NoOutputLogger);
        $compiler->setOutputStyle($outputStyle);

        return $compiler
            ->compileString($scss)
            ->getCss();
    }
}
