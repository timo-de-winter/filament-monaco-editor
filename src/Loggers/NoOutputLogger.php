<?php

namespace TimoDeWinter\FilamentMonacoEditor\Loggers;

use ScssPhp\ScssPhp\Deprecation;
use ScssPhp\ScssPhp\Logger\LoggerInterface;
use ScssPhp\ScssPhp\StackTrace\Trace;
use SourceSpan\FileSpan;
use SourceSpan\SourceSpan;

class NoOutputLogger implements LoggerInterface
{
    public function warn(string $message, ?Deprecation $deprecation = null, ?FileSpan $span = null, ?Trace $trace = null): void {}

    /**
     * Emits a debugging message associated with the given span.
     */
    public function debug(string $message, SourceSpan $span): void {}
}
