<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }} }">
        <div
            x-load
            x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('monaco-editor-css', package: 'timo-de-winter/filament-monaco-editor'))]"
            x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('monaco-editor', package: 'timo-de-winter/filament-monaco-editor') }}"
            x-data="monacoEditor({
                state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
                updateUsing: (newState) => {
                    state = newState;
                },
                language: @js($getLanguage())
            })"
            wire:ignore
        >
            <div id="monaco-editor" style="min-height: {{ $getHeight() }}"></div>
        </div>
    </div>

</x-dynamic-component>
