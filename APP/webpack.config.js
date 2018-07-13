var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .enableSourceMaps(!Encore.isProduction())
    
        // will create public/build/app.js and public/build/app.css
    .addEntry('app', './assets/js/app.js')
//    .addEntry('trans-config', './assets/translations/config.js')
//    .addEntry('trans', './assets/translations/messages/pl.js')
    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    //.enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()

    // allow sass/scss files to be processed
    // .enableSassLoader()
    
    
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('style', './assets/css/app.scss')
    //.addStyleEntry('css/app', './assets/css/app.scss')
    // uncomment if you use Sass/SCSS files
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    })
    // uncomment for legacy applications that require $/jQuery as a global variable
     .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
