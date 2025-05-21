<?php

namespace TimoDeWinter\FilamentMonacoEditor\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasMonacoEditor
{
    public function editorCodes(): MorphMany;
}
