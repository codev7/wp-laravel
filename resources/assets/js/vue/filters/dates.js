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

    return datetime.format('D/M/YYYY');
});