/**
 * Handles displaying of the Trix widget and data flow between textarea/vue.js model and widget.
 * @example <textarea v-model="message" v-trix></textarea>
 *          Trix widget display value will be changed if "message" is changed and vice versa.
 */
Vue.directive('trix', {
    unwatch: () => {},
    bind: function () {
        this.el.id = _.randomStr();
        var $el = $(this.el);
        $el.hide();

        var path = _.result(_.findWhere(this.el._vue_directives, {name: 'model'}), 'expression');

        this.$trix = $(`<trix-editor input="${this.el.id}"></trix-editor>`);
        this.$trix.insertAfter($el);

        this.$trix.on('trix-change', (e) => {
            this._updateModel(path, e.currentTarget.innerHTML);
        });

        this.unwatch = this.vm.$watch(path, (value) => {
            value = value == undefined ? '' : value;
            if (this.$trix[0].innerHTML != value) {
                this.$trix[0].editor.loadHTML(value);
            }
        });
    },
    unbind: function () {
        this.unwatch();
    },
    _updateModel(path, value) {
        this.vm.$set(path, value);
    }
});