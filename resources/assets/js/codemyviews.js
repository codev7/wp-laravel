
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

require('laravel-spark/core/dependencies');

if ($('#spark-app').length > 0) {
	require('./spark/components')

	new Vue(require('laravel-spark'));
}



require('./plugins/tablesorter');
require('./custom/chartjs-data-api');
require('./plugins/datepicker');


if($('#modal-nda').length > 0) {

    $('#modal-nda').modal('show');

    $('.toggle-nda').on('click', function(e)
    {

        e.preventDefault();
        $('#full-nda').toggle();
        $('#nda-cliff-notes').toggle();

    });

}