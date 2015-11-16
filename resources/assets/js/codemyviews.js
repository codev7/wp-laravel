var init = require('./init');

init.libraries();
init.pjax();
init.vue();

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