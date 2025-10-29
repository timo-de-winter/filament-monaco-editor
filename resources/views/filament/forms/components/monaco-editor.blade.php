@php
    $id = $getId();
    $livewireKey = $getLivewireKey();
    $key = $getKey();
    $statePath = $getStatePath();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div>
        <div
            x-load
            x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('monaco-editor-css', package: 'timo-de-winter/filament-monaco-editor'))]"
            x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('monaco-editor', package: 'timo-de-winter/filament-monaco-editor') }}"
            x-data="monacoEditor({
                key: @js($key),
                isLiveDebounced: @js($isLiveDebounced()),
                isLiveOnBlur: @js($isLiveOnBlur()),
                liveDebounce: @js($getNormalizedLiveDebounce()),
                livewireId: @js($this->getId()),
                state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')", isOptimisticallyLive: false) }},
                statePath: @js($statePath),
                language: @js($getLanguage())
            })"
            wire:ignore
            wire:key="{{ $livewireKey }}"
        >
            <div id="monaco-editor" style="min-height: {{ $getHeight() }}"></div>
        </div>
    </div>

</x-dynamic-component>
