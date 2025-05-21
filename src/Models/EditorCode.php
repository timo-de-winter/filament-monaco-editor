<?php

namespace TimoDeWinter\FilamentMonacoEditor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EditorCode extends Model
{
    public function getTable()
    {
        return config('filament-monaco-editor.table');
    }

    protected $fillable = [
        'code',
        'collection',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
