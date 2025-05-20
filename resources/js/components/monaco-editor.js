import * as monaco from 'monaco-editor';

// self.MonacoEnvironment = {
//     getWorker: function (workerId, label) {
//         const getWorkerModule = (moduleUrl, label) => {
//             return new Worker(self.MonacoEnvironment.getWorkerUrl(moduleUrl), {
//                 name: label,
//                 type: 'module'
//             });
//         };
//
//         switch (label) {
//             case 'json':
//                 return getWorkerModule('/monaco-editor/esm/vs/language/json/json.worker?worker', label);
//             case 'css':
//             case 'scss':
//             case 'less':
//                 return getWorkerModule('/monaco-editor/esm/vs/language/css/css.worker?worker', label);
//             case 'html':
//             case 'blade':
//             case 'handlebars':
//             case 'razor':
//                 return getWorkerModule('/monaco-editor/esm/vs/language/html/html.worker?worker', label);
//             case 'typescript':
//             case 'javascript':
//                 return getWorkerModule('/monaco-editor/esm/vs/language/typescript/ts.worker?worker', label);
//             default:
//                 return getWorkerModule('/monaco-editor/esm/vs/editor/editor.worker?worker', label);
//         }
//     }
// };

export default function monacoEditor({
    state,
    updateUsing,
    language,
}) {
    return {
        state,

        init: () => {
            const editor = monaco.editor.create(this.$el.querySelector('#monaco-editor'), {
                value: state.initialValue,
                language: language,
            });

            editor.getModel().onDidChangeContent(event => {
                updateUsing(editor.getModel().getValue());
            });

            this.$watch('state', newState => {
                if (newState !== editor.getModel().getValue()) {
                    editor.getModel().setValue(newState);
                }
            });
        },
    }
}





