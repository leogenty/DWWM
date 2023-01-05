const Encore = require('@symfony/webpack-encore');

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
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app_components_navbar', './assets/javascripts/components/_navbar.js')

    .addEntry('app_pages_lessons', './assets/javascripts/app/pages/lessons/index.js')
    .addEntry('app_pages_lessons_single', './assets/javascripts/app/pages/lessons/single.js')
    .addEntry('app_pages_online_lessons', './assets/javascripts/app/pages/online-lessons/index.js')
    .addEntry('app_pages_profile', './assets/javascripts/app/pages/profile/index.js')

    .addEntry('front_pages_home', './assets/javascripts/front/pages/home/index.js')
    .addEntry('front_pages_matter', './assets/javascripts/front/pages/matter/index.js')
    .addEntry('front_pages_contact', './assets/javascripts/front/pages/contact/index.js')

    .addEntry('security_pages_login', './assets/javascripts/security/pages/login/index.js')
    .addEntry('security_pages_register', './assets/javascripts/security/pages/register/index.js')
    .addEntry('security_pages_reset', './assets/javascripts/security/pages/reset/index.js')

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    // .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning()

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    .copyFiles({
        from: './assets/medias',
        to: 'medias/[path][name].[hash:8].[ext]'
    })

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    .enableIntegrityHashes()

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
