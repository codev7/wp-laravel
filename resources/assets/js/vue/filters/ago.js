Vue.filter('ago', function (datetime) {
    return moment(datetime).fromNow(true);
});