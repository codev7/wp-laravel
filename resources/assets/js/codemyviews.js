var init = require('./init');

require('laravel-spark/core/dependencies');

if ($('#spark-app').length > 0) {
	require('./spark/components')

	new Vue(require('laravel-spark'));
}

init.bugsnag();
init.controllers();
init.pjax();

//require('./plugins/tablesorter');
//require('./custom/chartjs-data-api');
//require('./plugins/datepicker');


if($('#modal-nda').length > 0) {

    $('#modal-nda').modal('show');

    $('.toggle-nda').on('click', function(e)
    {

        e.preventDefault();
        $('#full-nda').toggle();
        $('#nda-cliff-notes').toggle();

    });

}

