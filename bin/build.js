import * as esbuild from 'esbuild'

const isDev = process.argv.includes('--dev')

async function compile(options) {
    const context = await esbuild.context(options)

    if (isDev) {
        await context.watch()
    } else {
        await context.rebuild()
        await context.dispose()
    }
}

const defaultOptions = {
    define: {
        'process.env.NODE_ENV': isDev ? `'development'` : `'production'`,
    },
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'neutral',
    sourcemap: isDev ? 'inline' : false,
    sourcesContent: isDev,
    treeShaking: true,
    target: ['es2020'],
    minify: !isDev,
    loader: {
        '.ttf': 'file',
    },
    plugins: [{
        name: 'watchPlugin',
        setup: function (build) {
            build.onStart(() => {
                console.log(`Build started at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile || build.initialOptions.outdir}`)
            })

            build.onEnd((result) => {
                if (result.errors.length > 0) {
                    console.log(`Build failed at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile || build.initialOptions.outdir}`, result.errors)
                } else {
                    console.log(`Build finished at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile || build.initialOptions.outdir}`)
                }
            })
        }
    }],
}

// Main editor component bundle
compile({
    ...defaultOptions,
    entryPoints: ['./resources/js/components/monaco-editor.js'],
    outfile: './resources/js/dist/components/monaco-editor.js',
})

// Monaco Editor Web Workers bundles
// You'll need to adjust the output directory (`./resources/js/dist/monaco-workers/`)
// to where your web server will serve these files.
const monacoWorkersOutdir = './resources/js/dist/monaco-workers';

compile({
    ...defaultOptions,
    entryPoints: {
        'editor.worker': 'monaco-editor/esm/vs/editor/editor.worker.js',
        'json.worker': 'monaco-editor/esm/vs/language/json/json.worker.js',
        'css.worker': 'monaco-editor/esm/vs/language/css/css.worker.js',
        'html.worker': 'monaco-editor/esm/vs/language/html/html.worker.js',
        'ts.worker': 'monaco-editor/esm/vs/language/typescript/ts.worker.js',
    },
    outdir: monacoWorkersOutdir, // Output all workers to a common directory
})
