export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            invoices: [],
            invoicesFetched: false
        }
    },

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        this.$http.get(`/api/projects/${this.state.project.id}/invoices`, (res) => {
            this.invoices = res.data;
            this.invoicesFetched = true;
        });
    }

});