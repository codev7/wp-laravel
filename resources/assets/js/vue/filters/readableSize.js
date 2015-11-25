Vue.filter('readableSize', function (size) {
    var units = 'B';

    if(size > (1024 * 1024 * 1024)) {
        size /= 1024 * 1024 * 1024;
        units = 'GB';
    }

    if (size > 1024 * 1024) {
        size /= 1024*1024;
        units = 'MB';
    }

    if (size > 1024) {
        size /= 1024;
        units = 'KB';
    }

    return size.toFixed(2) + ' ' + units;
});