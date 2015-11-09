var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('cmv-app.less','public/css/cmv-app.css');

    mix.less('cmv-marketing.less','public/css/codemyviews.css');

    mix.scripts([
        //'plugins/modernizr.js',
        'plugins/jquery.js',
        'plugins/jquery.pjax.js',
        'plugins/bugsnag.js',
        'plugins/vue.js',
        'plugins/custom-form.js',
        'plugins/jquery.waypoints.js',
        'plugins/*.js',
        'custom/cmv-helpers.js',
        'custom/validation.js',
        'custom/*.js'
    ], 'public/js/vendor.js');

    //mix.scripts([
    //    'custom/cmv-helpers.js',
    //    'custom/validation.js',
    //    'custom',
    //    'Vue'
    //], 'public/js/cmv-marketing.js');

    mix.browserify('codemyviews.js','public/js/cmv-js.js');

    mix.version([
        'public/css/codemyviews.css',
        'public/js/cmv-js.js',
        'public/js/vendor.js',
        'public/css/cmv-app.css'
    ]);

});
