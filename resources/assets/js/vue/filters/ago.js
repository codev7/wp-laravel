Vue.filter('ago', function (datetime) {
    var offset = moment().utcOffset();
    var datetime = moment(datetime).add(offset, 'minutes');

    return datetime.fromNow(true);
});