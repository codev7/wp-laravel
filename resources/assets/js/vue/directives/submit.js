/**
 * Disables the button/input[submit] and replaces content with a spinner based on the provided model.
 * @example <button type="submit" v-submit="submitting">Submit!</button>
 *          'Submit!' will be replaced with a spinner if `loading` and otherwise if `!loading`
 */
Vue.directive('submit', {
    initialHTML: '',
    bind: function () {
        this.initialHTML = this.el.innerHTML;
    },
    update(value) {
        if (value) {
            this.el.innerHTML = "<i class='fa fa-refresh fa-spin'></i>";
            this.el.disabled = true;
        } else {
            this.el.innerHTML = this.initialHTML;
            this.el.disabled = false;
        }
    }
});