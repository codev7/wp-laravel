require('laravel-spark/core/dependencies');

if ($('#spark-app').length > 0) {
	require('./spark/components')

	new Vue(require('laravel-spark'));
}

/*
* Install Bugsnag for JavaScript exception tracking.
*/
var bugsnag = require('bugsnag');
bugsnag.register('15fde40c387140df4200a97e9dbf3f31', {
    releaseStage: CObj.environment
});

/*
* Install modernizr.
*/
var modernizr = require('modernizr');

var slick = require('slick-carousel');

var placeholder = require('placeholder');

var matchHeight = require('jquery-match-height');

require('./plugins/tablesorter');
require('./custom/chartjs-data-api');


if($('#modal-nda').length > 0) {

    $('#modal-nda').modal('show');

    $('.toggle-nda').on('click', function(e)
    {

        e.preventDefault();
        $('#full-nda').toggle();
        $('#nda-cliff-notes').toggle();

    });

}