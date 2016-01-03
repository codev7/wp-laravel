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

    mix.less('codemyviews.less','public/css/codemyviews.css');

    mix.scripts([
        'plugins/modernizr.js',
        'plugins/jquery.js',
        'plugins/jquery.pjax.js',
        'plugins/vue.js',
        'plugins/bootstrap.js',
        'plugins/bootstrap-tour.js',
        'plugins/*.js',
        'custom/cmv-helpers.js',
        'custom/*.js'
    ], 'public/js/vendor.js');

    mix.browserify('codemyviews.js','public/js/cmv-js.js');

    mix.version([
        'public/css/codemyviews.css',
        'public/js/cmv-js.js',
        'public/js/vendor.js'
    ]);

    //mix.browserSync({ proxy: 'http://cmv.dev' });
});
