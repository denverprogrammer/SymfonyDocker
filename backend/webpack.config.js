/* eslint-disable */
// Require Encore & DotEnv
const Encore = require('@symfony/webpack-encore');
const Dotenv = require('dotenv-webpack');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')

    // public path used by the web server to access the output path
    .setPublicPath('/build')


    .addEntry('app', ['core-js/stable', '../frontend/src/App.tsx'])
    .addPlugin(new Dotenv())

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    // Disabled, as causes issues loading in non-symfony apps.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    // Cleans build dir on build
    .cleanupOutputBeforeBuild()

    // Sets up webpack notifications
    .enableBuildNotifications()

    // hides source maps if on productions
    .enableSourceMaps(!Encore.isProduction())

    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure babel for transpiling
    .configureBabel(
        (babelConfig) => {
            babelConfig.plugins.push('@babel/plugin-proposal-class-properties');
        },
        {
            useBuiltIns: 'usage',
            corejs: 3,
            includeNodeModules: [
                '@babel/preset-env',
                '@babel/preset-typescript',
                '@babel/react'
            ]
        }
    )

    // enables Sass/SCSS support
    .enableSassLoader()

    // enables TS Support
    .enableTypeScriptLoader()

    // optionally enable forked type script for faster builds
    .enableForkedTypeScriptTypesChecking()

    // Enables react preset
    .enableReactPreset();

module.exports = Encore.getWebpackConfig();
