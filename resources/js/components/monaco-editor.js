import * as monaco from 'monaco-editor';

if (window.MonacoEnvironment === undefined) {
    window.MonacoEnvironment = {
        getWorkerUrl: function (moduleId, label) {
            switch (label) {
                case 'json':
                    return '/js/timo-de-winter/filament-monaco-editor/monaco-worker-json.js';
                case 'css':
                case 'less':
                case 'scss':
                    return '/js/timo-de-winter/filament-monaco-editor/monaco-worker-css.js';
                case 'html':
                case 'handlebars':
                case 'razor':
                    return '/js/timo-de-winter/filament-monaco-editor/monaco-worker-html.js';
                case 'typescript':
                case 'javascript':
                    return '/js/timo-de-winter/filament-monaco-editor/monaco-worker-ts.js';
                default:
                    // This is the default editor worker, essential for basic editor functionality
                    return '/js/timo-de-winter/filament-monaco-editor/monaco-worker-editor.js';
            }
        }
    };
}

export default function monacoEditor({
    state,
    updateUsing,
    language,
}) {
    return {
        state,

        init: () => {
            const editor = monaco.editor.create(this.$el.querySelector('#monaco-editor'), {
                value: state.initialValue, // Assuming state.initialValue is available
                language: language,
            });

            editor.getModel().onDidChangeContent(event => {
                updateUsing(editor.getModel().getValue());
            });

            this.$watch('state', newState => {
                // Prevent infinite loop if the state update comes from the editor itself
                if (newState !== editor.getModel().getValue()) {
                    editor.getModel().setValue(newState);
                }
            });
        },
    }
}
