var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // define the assets of the project
    // .addEntry('app', './assets/js/app.js')
    .addEntry('datetimepicker', './assets/js/datetimepicker.js')
    .addEntry('highcharts', './assets/js/highcharts.js')
    .addEntry('noty', './assets/js/noty.js')
    .addEntry('fullcalendar', './assets/js/fullcalendar.js')
    .addEntry('app', './assets/js/app.js')

    // allow sass/scss files to be processed
    // .enableSassLoader()

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    .enableSourceMaps(!Encore.isProduction())

    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
