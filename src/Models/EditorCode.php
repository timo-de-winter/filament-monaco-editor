<?php

namespace TimoDeWinter\FilamentMonacoEditor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Cache;
use TimoDeWinter\FilamentMonacoEditor\Facades\FilamentMonacoEditor;

class EditorCode extends Model
{
    public function getTable(): string
    {
        return config('filament-monaco-editor.table');
    }

    protected $fillable = [
        'code',
        'collection',
    ];

    protected static function booted(): void
    {
        static::saved(function (self $editorCode) {
            if ($editorCode->collection === 'scss') {
                $css = FilamentMonacoEditor::compileScssToCss($editorCode->code);

                Cache::forever($editorCode->cacheKey('cached-css'), $css);
            }
        });
    }

    public function cacheKey(string $key): string
    {
        return $this->getKey().'.'.$key;
    }

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function getCompiledCss(): string
    {
        return Cache::get($this->cacheKey('cached-css'), function () {
            $css = FilamentMonacoEditor::compileScssToCss($this->code);

            Cache::forever($this->cacheKey('cached-css'), $css);

            return $css;
        });
    }
}
