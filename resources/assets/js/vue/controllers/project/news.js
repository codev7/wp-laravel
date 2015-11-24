export default Vue.extend({

    data() {
        return {
            news: {}
        }
    },

    mixins: [require('./../../mixins/hasState')],

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        if (this.state.length) {
            this.news = this.state[0];
        }
    },

    methods: {
        markViewed(id) {
            this.$http.post(`/api/news/${id}/view`);
            $(this.$els.container).fadeOut();
        }
    }

});