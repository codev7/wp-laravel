
/*
 |--------------------------------------------------------------------------
 | Laravel Spark - Creating Amazing Experiences.
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Spark which are
 | libraries such as Vue and jQuery. Then, we will load the components
 | which manage the Spark screens such as the user settings screens.
 |
 | Next, we will create the root Vue application for Spark. We'll only do
 | this if a "spark-app" ID exists on the page. Otherwise, we will not
 | attempt to create this Vue application so we can avoid conflicts.
 |
 */
var Vue = require('Vue');
var modernizr = require("modernizr");
require('laravel-spark/core/dependencies');

if ($('#spark-app').length > 0) {
	require('./spark/components')

	new Vue(require('laravel-spark'));
}

)
        require('./plugins/jquery-1.11.1.min.js'),
        require('./plugins/jquery.ui.core.js'),
        require('./plugins/vue-validator.js'),
        require('./plugins/vue-resource.js'),
        require('./plugins/moment.js'),
        require('./plugins/jquery.waypoints.js'),
        require('./plugins/custom-form.js'),
        require('./plugins'),
        require('./custom/cmv-helpers.js'),
        require('./custom/validation.js'),
        require('./custom'),
        'Vue'