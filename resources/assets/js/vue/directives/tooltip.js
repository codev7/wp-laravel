/**
 * Initializes a bootstrap tooltip on dynamically rendered element
 * @example
 */
Vue.directive('tooltip', {
    unwatch: () => {},
    bind() {
        var id = _.randomStr();
        this.el.id = id;

        setTimeout(() => {
            $(`#${id}`).tooltip();
        }, 100);
    }
});