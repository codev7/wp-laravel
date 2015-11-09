var init = require('./init');

require('./npm/laravel-spark/core/dependencies');

if ($('#spark-app').length > 0) {
	require('./npm/laravel-spark/core/components')

	new Vue(require('./npm/laravel-spark/spark.js'));
}

init.bugsnag();
init.controllers();
init.pjax();

var placeholder = require('placeholder');

if($('#modal-nda').length > 0) {
    $('#modal-nda').modal('show');

    $('.toggle-nda').on('click', function(e)
    {
        e.preventDefault();
        $('#full-nda').toggle();
        $('#nda-cliff-notes').toggle();
    });
}

