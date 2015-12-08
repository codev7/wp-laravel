/**
 * Handles displaying of the Trix widget and data flow between textarea/vue.js model and widget.
 * @example <textarea v-model="message" v-trix></textarea>
 *          Trix widget display value will be changed if "message" is changed and vice versa.
 */
Vue.directive('trix', {
    unwatch: () => {},
    bind: function () {
        setTimeout(() => {
            this.el.id = _.randomStr();
            var $el, vModel, originalVModelUpdate;

            $el = $(this.el);
            $el.hide();

            this.$trix = $(`<trix-editor input="${this.el.id}"></trix-editor>`);
            this.$trix.insertAfter($el);

            this.$trix.on('trix-change', (e) => {
                $el.trigger('change');
            });

            /**
             * hack the v-model directive to track the value done
             * this way b/c the value of v-model directive can be
             * a relative way (for example inside a loop) to the
             * vue component $data and it's tedious to track
             * E.g. `path.to.items[0].value` in the loop becomes `item.value`
             */
            vModel = $el[0].__v_model;
            originalVModelUpdate = vModel.update;
            vModel.update = (value) => {
                if ($el.val() != value) {
                    this.$trix[0].editor.loadHTML(value);
                }

                originalVModelUpdate.call(vModel, value);
            };
        }, 100);
    }
});