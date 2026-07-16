{{-- Boost guideline for timo-de-winter/filament-monaco-editor. Update when the public API changes. --}}
# Filament Monaco Editor (code editor field)

- Monaco editor field + action for Filament; morphable `EditorCode` model stores code per record/collection.

## Structure

- `TimoDeWinter\FilamentMonacoEditor\Filament\Forms\Components\MonacoEditor` — form field; `language()`, `height()`; `scss` language validates by compiling.
- `TimoDeWinter\FilamentMonacoEditor\Filament\Actions\MonacoAction` — modal action saving into `editorCodes()`; `language()`, `collection()` (defaults to language; keyed array collection => language renders a grid), `default()`.
- `TimoDeWinter\FilamentMonacoEditor\Models\EditorCode` — table `editor_codes`: `model` morph, `collection`, nullable `code`. Saving `scss` collection compiles + caches CSS; read via `getCompiledCss()`.

## Using it

- Attach code to any model: implement `Contracts\HasMonacoEditor`, use `Concerns\InteractsWithMonacoEditor` (adds `editorCodes()`), then add `MonacoAction::make()->language('css')` to actions.
- Compile SCSS anywhere: `FilamentMonacoEditor::compileScssToCss($scss)` facade.
- `Contracts\MutatesCodeBeforeCompilation` on the owning model transforms SCSS pre-compilation.

## Pitfalls

- **Never compile/cache CSS on save yourself** — the `EditorCode` saved hook does (collection `scss`).
- **Keyed arrays only for collections** (collection => language); lists throw.
