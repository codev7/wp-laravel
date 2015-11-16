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