import * as esbuild from 'esbuild'
import path from 'path' // Ensure path is imported if you use path.join

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

// Define a SINGLE base output directory for all assets
const baseDistDir = './resources/js/dist'; // All generated files will go here

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
        '.ttf': 'file', // esbuild will copy .ttf files
        '.css': 'css',  // Ensure CSS files are handled (important for Monaco's internal CSS)
    },
    // Set publicPath to the public URL of the baseDistDir
    publicPath: '/js/dist/',
    assetNames: '[name]',
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
    // Use outdir and specify the output filename within that directory
    outdir: baseDistDir,
    entryNames: '[dir]/[name]', // This will create `components/monaco-editor.js` within baseDistDir based on the input path
})

// Monaco Editor Web Workers bundles
compile({
    ...defaultOptions,
    entryPoints: {
        // Renaming the output files for clarity and consistency
        'monaco-worker-editor': 'monaco-editor/esm/vs/editor/editor.worker.js',
        'monaco-worker-json': 'monaco-editor/esm/vs/language/json/json.worker.js',
        'monaco-worker-css': 'monaco-editor/esm/vs/language/css/css.worker.js',
        'monaco-worker-html': 'monaco-editor/esm/vs/language/html/html.worker.js',
        'monaco-worker-ts': 'monaco-editor/esm/vs/language/typescript/ts.worker.js',
    },
    // All workers will also go into the baseDistDir
    outdir: baseDistDir,
})
