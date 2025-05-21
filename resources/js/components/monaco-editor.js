import * as monaco from 'monaco-editor';
import ClassWatcher from "../helpers/ClassWatcher.js";

const richFeatureLanguages = [
    'json',
    'css', 'less', 'scss',
    'html', 'handlebars', 'razor',
    'typescript', 'javascript',
];

const basicLanguageImportPaths = {
    'abap': () => import('monaco-editor/esm/vs/basic-languages/abap/abap.js'),
    'apex': () => import('monaco-editor/esm/vs/basic-languages/apex/apex.js'),
    'azcli': () => import('monaco-editor/esm/vs/basic-languages/azcli/azcli.js'),
    'bat': () => import('monaco-editor/esm/vs/basic-languages/bat/bat.js'),
    'bicep': () => import('monaco-editor/esm/vs/basic-languages/bicep/bicep.js'),
    'cameligo': () => import('monaco-editor/esm/vs/basic-languages/cameligo/cameligo.js'),
    'clojure': () => import('monaco-editor/esm/vs/basic-languages/clojure/clojure.js'),
    'coffee': () => import('monaco-editor/esm/vs/basic-languages/coffee/coffee.js'),
    'cpp': () => import('monaco-editor/esm/vs/basic-languages/cpp/cpp.js'),
    'csharp': () => import('monaco-editor/esm/vs/basic-languages/csharp/csharp.js'),
    'csp': () => import('monaco-editor/esm/vs/basic-languages/csp/csp.js'),
    'cypher': () => import('monaco-editor/esm/vs/basic-languages/cypher/cypher.js'),
    'dart': () => import('monaco-editor/esm/vs/basic-languages/dart/dart.js'),
    'dockerfile': () => import('monaco-editor/esm/vs/basic-languages/dockerfile/dockerfile.js'),
    'ecl': () => import('monaco-editor/esm/vs/basic-languages/ecl/ecl.js'),
    'elixir': () => import('monaco-editor/esm/vs/basic-languages/elixir/elixir.js'),
    'flow9': () => import('monaco-editor/esm/vs/basic-languages/flow9/flow9.js'),
    'freemarker2': () => import('monaco-editor/esm/vs/basic-languages/freemarker2/freemarker2.js'),
    'fsharp': () => import('monaco-editor/esm/vs/basic-languages/fsharp/fsharp.js'),
    'go': () => import('monaco-editor/esm/vs/basic-languages/go/go.js'),
    'graphql': () => import('monaco-editor/esm/vs/basic-languages/graphql/graphql.js'),
    'hcl': () => import('monaco-editor/esm/vs/basic-languages/hcl/hcl.js'),
    'ini': () => import('monaco-editor/esm/vs/basic-languages/ini/ini.js'),
    'java': () => import('monaco-editor/esm/vs/basic-languages/java/java.js'),
    'julia': () => import('monaco-editor/esm/vs/basic-languages/julia/julia.js'),
    'kotlin': () => import('monaco-editor/esm/vs/basic-languages/kotlin/kotlin.js'),
    'lexon': () => import('monaco-editor/esm/vs/basic-languages/lexon/lexon.js'),
    'liquid': () => import('monaco-editor/esm/vs/basic-languages/liquid/liquid.js'),
    'lua': () => import('monaco-editor/esm/vs/basic-languages/lua/lua.js'),
    'm3': () => import('monaco-editor/esm/vs/basic-languages/m3/m3.js'),
    'markdown': () => import('monaco-editor/esm/vs/basic-languages/markdown/markdown.js'),
    'mdx': () => import('monaco-editor/esm/vs/basic-languages/mdx/mdx.js'),
    'mips': () => import('monaco-editor/esm/vs/basic-languages/mips/mips.js'),
    'msdax': () => import('monaco-editor/esm/vs/basic-languages/msdax/msdax.js'),
    'mysql': () => import('monaco-editor/esm/vs/basic-languages/mysql/mysql.js'),
    'objective-c': () => import('monaco-editor/esm/vs/basic-languages/objective-c/objective-c.js'),
    'pascal': () => import('monaco-editor/esm/vs/basic-languages/pascal/pascal.js'),
    'pascaligo': () => import('monaco-editor/esm/vs/basic-languages/pascaligo/pascaligo.js'),
    'perl': () => import('monaco-editor/esm/vs/basic-languages/perl/perl.js'),
    'pgsql': () => import('monaco-editor/esm/vs/basic-languages/pgsql/pgsql.js'),
    'php': () => import('monaco-editor/esm/vs/basic-languages/php/php.js'),
    'pla': () => import('monaco-editor/esm/vs/basic-languages/pla/pla.js'),
    'postiats': () => import('monaco-editor/esm/vs/basic-languages/postiats/postiats.js'),
    'powerquery': () => import('monaco-editor/esm/vs/basic-languages/powerquery/powerquery.js'),
    'powershell': () => import('monaco-editor/esm/vs/basic-languages/powershell/powershell.js'),
    'protobuf': () => import('monaco-editor/esm/vs/basic-languages/protobuf/protobuf.js'),
    'pug': () => import('monaco-editor/esm/vs/basic-languages/pug/pug.js'),
    'python': () => import('monaco-editor/esm/vs/basic-languages/python/python.js'),
    'qsharp': () => import('monaco-editor/esm/vs/basic-languages/qsharp/qsharp.js'),
    'r': () => import('monaco-editor/esm/vs/basic-languages/r/r.js'),
    'redis': () => import('monaco-editor/esm/vs/basic-languages/redis/redis.js'),
    'redshift': () => import('monaco-editor/esm/vs/basic-languages/redshift/redshift.js'),
    'restructuredtext': () => import('monaco-editor/esm/vs/basic-languages/restructuredtext/restructuredtext.js'),
    'ruby': () => import('monaco-editor/esm/vs/basic-languages/ruby/ruby.js'),
    'rust': () => import('monaco-editor/esm/vs/basic-languages/rust/rust.js'),
    'sb': () => import('monaco-editor/esm/vs/basic-languages/sb/sb.js'),
    'scala': () => import('monaco-editor/esm/vs/basic-languages/scala/scala.js'),
    'scheme': () => import('monaco-editor/esm/vs/basic-languages/scheme/scheme.js'),
    'shell': () => import('monaco-editor/esm/vs/basic-languages/shell/shell.js'),
    'solidity': () => import('monaco-editor/esm/vs/basic-languages/solidity/solidity.js'),
    'sophia': () => import('monaco-editor/esm/vs/basic-languages/sophia/sophia.js'),
    'sparql': () => import('monaco-editor/esm/vs/basic-languages/sparql/sparql.js'),
    'sql': () => import('monaco-editor/esm/vs/basic-languages/sql/sql.js'),
    'st': () => import('monaco-editor/esm/vs/basic-languages/st/st.js'),
    'swift': () => import('monaco-editor/esm/vs/basic-languages/swift/swift.js'),
    'systemverilog': () => import('monaco-editor/esm/vs/basic-languages/systemverilog/systemverilog.js'),
    'tcl': () => import('monaco-editor/esm/vs/basic-languages/tcl/tcl.js'),
    'twig': () => import('monaco-editor/esm/vs/basic-languages/twig/twig.js'),
    'typespec': () => import('monaco-editor/esm/vs/basic-languages/typespec/typespec.js'),
    'vb': () => import('monaco-editor/esm/vs/basic-languages/vb/vb.js'),
    'wgsl': () => import('monaco-editor/esm/vs/basic-languages/wgsl/wgsl.js'),
    'xml': () => import('monaco-editor/esm/vs/basic-languages/xml/xml.js'),
    'yaml': () => import('monaco-editor/esm/vs/basic-languages/yaml/yaml.js'),
};

// Function to dynamically load and register a basic language
async function loadAndRegisterBasicLanguage(langId) {
    if (!basicLanguageImportPaths[langId]) {
        console.warn(`Monaco Editor: No basic language definition found for "${langId}".`);
        return false; // Language not supported via basic-languages
    }

    // Check if the language is already registered
    // This prevents re-registering and potential errors if editor is created/destroyed multiple times.
    if (monaco.languages.getLanguages().some(lang => lang.id === langId)) {
        return true; // Already registered
    }

    try {
        const module = await basicLanguageImportPaths[langId]();
        monaco.languages.register({ id: langId });
        monaco.languages.setMonarchTokensProvider(langId, module.language);
        monaco.languages.setLanguageConfiguration(langId, module.conf);
        console.log(`Monaco Editor: Successfully loaded and registered basic language "${langId}".`);
        return true;
    } catch (error) {
        console.error(`Monaco Editor: Failed to load basic language "${langId}":`, error);
        return false;
    }
}

if (window.MonacoEnvironment === undefined) {
    window.MonacoEnvironment = {
        getWorkerUrl: function (moduleId, label) {
            const baseUrl = '/js/timo-de-winter/filament-monaco-editor/';

            if (richFeatureLanguages.includes(label)) {
                switch (label) {
                    case 'json':
                        return `${baseUrl}monaco-worker-json.js`;
                    case 'css':
                    case 'less':
                    case 'scss':
                        return `${baseUrl}monaco-worker-css.js`;
                    case 'html':
                    case 'handlebars':
                    case 'razor':
                        return `${baseUrl}monaco-worker-html.js`;
                    case 'typescript':
                    case 'javascript':
                        return `${baseUrl}monaco-worker-ts.js`;
                }
            }

            return `${baseUrl}monaco-worker-editor.js`;
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
        language,
        editorInstance: null,
        classWatcher: null,

        init: async () => {
            if (basicLanguageImportPaths[language]) {
                await loadAndRegisterBasicLanguage(language);
            }

            this.editorInstance = monaco.editor.create(this.$el.querySelector('#monaco-editor'), {
                value: state.initialValue, // Assuming state.initialValue is available
                language: language,
                theme: document.documentElement.classList.contains('dark') ? 'vs-dark' : 'vs',
            });

            // Update the state
            this.editorInstance.getModel().onDidChangeContent(event => {
                updateUsing(this.editorInstance.getModel().getValue());
            });

            // When the state is changed on some other place we set that code in the editor
            this.$watch('state', newState => {
                // Prevent infinite loop if the state update comes from the editor itself
                if (newState !== this.editorInstance.getModel().getValue()) {
                    this.editorInstance.getModel().setValue(newState);
                }
            });

            // Handle language changes after initial creation (e.g., if you have a language switcher)
            this.$watch('language', async newLanguage => {
                if (newLanguage && this.editorInstance.getModel().getLanguageId() !== newLanguage) {
                    if (basicLanguageImportPaths[newLanguage]) {
                        await loadAndRegisterBasicLanguage(newLanguage);
                    }
                    monaco.editor.setModelLanguage(this.editorInstance.getModel(), newLanguage);
                }
            });

            // When dark mode is changed by the user we need to change the editor theme
            this.classWatcher = new ClassWatcher(document.documentElement, () => {
                monaco.editor.setTheme(
                    document.documentElement.classList.contains('dark') ? 'vs-dark' : 'vs'
                );
            });
        },

        destroy: () => {
            // Dispose of the editor instance when the Alpine component is removed
            if (this.editorInstance) {
                this.editorInstance.dispose();
                this.editorInstance = null;
            }

            if (this.classWatcher) {
                this.classWatcher.destroy();
                this.classWatcher = null;
            }
        },
    }
}
