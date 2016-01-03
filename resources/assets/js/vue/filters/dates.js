Vue.filter('ago', function (datetime) {
    var offset = moment().utcOffset();
    var datetime = moment(datetime).add(offset, 'minutes');

    return datetime.fromNow(true);
});

Vue.filter('date', function (datetime) {
    var offset = moment().utcOffset();
    var datetime = moment(datetime).add(offset, 'minutes');

    return datetime.format('MMMM, Do');
});

Vue.filter('date2', function (datetime) {
    var offset = moment().utcOffset();
    var datetime = moment(datetime).add(offset, 'minutes');

    return datetime.format('M/D/YYYY');
});

Vue.filter('mdYtoMDoY', function(date) {
   return moment(date, 'M/D/YYYY').format('MMMM Do, YYYY');
});

Vue.filter('mdYtoReadable', function(date) {
    var now = moment();
    return moment(date, 'M/D/YYYY').from(now);
});

Vue.filter('dayOfWeek', function(date) {
    var now = moment();
    return moment(date, 'M/D/YYYY').format('dddd, MMMM Do');
})