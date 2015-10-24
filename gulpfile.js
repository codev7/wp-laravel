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
    mix.less('cmv-app.less','public/css/cmv-app.css')
        .less('cmv-marketing.less','public/css/codemyviews.css')
        .browserify('codemyviews.js','public/js/cmv-js.js')
        .scripts([
            'plugins/modernizr.js',
            'plugins/jquery.ui.core.js',
            'plugins/moment.js',
            'plugins/jquery.waypoints.js',
            'plugins/jquery.validate.js',
            'plugins',
            'custom/cmv-helpers.js',
            'custom/validation.js',
            'custom',
            'Vue'
        ], 'public/js/cmv-marketing.js')
        .version([
            'public/css/codemyviews.css',
            'public/js/cmv-marketing.js',
            'public/js/cmv-js.js',
            'public/css/cmv-app.css'

        ]);

});
