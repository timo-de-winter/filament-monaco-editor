<?php

namespace TimoDeWinter\FilamentMonacoEditor\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use TimoDeWinter\FilamentMonacoEditor\Models\EditorCode;

trait InteractsWithMonacoEditor
{
    public function editorCodes(): MorphMany
    {
        return $this->morphMany(EditorCode::class, 'model');
    }
}
