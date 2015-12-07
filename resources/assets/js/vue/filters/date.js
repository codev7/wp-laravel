Vue.filter('date', function (datetime) {
    var offset = moment().utcOffset();
    var datetime = moment(datetime).add(offset, 'minutes');

    return datetime.format('MMMM, Do');
});