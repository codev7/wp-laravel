/** Lodash mixins. All global level helpers should be put there */
_.mixin({
    /**
     * Removes item from an array of objects.
     * @example _.removeById(5, [{id: 2}, {id: 5}]);
     * @param id
     * @param items
     * @returns {*}
     */
    removeById(id, items) {
        return _.reduce(items, (res, item) => {
            if (item.id != id) res.push(item);
            return res;
        }, []);
    },
    /**
     * Generates random string
     * @example _.randomStr()
     * @param length Default value: 6
     * @returns {string}
     */
    randomStr(length = 6) {
        var text = "e";
        var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

        for( var i=0; i < length-1; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    },
    /**
     * JS analogue for PHP's array_column
     * @example _.column([{name: 'John'}, {name: 'Jack'}], 'name') => ['John', 'Jack']
     * @param items
     * @param column
     * @returns {*}
     */
    column(items, column) {
        return items.map((item) => {
            return item[column];
        })
    }
});