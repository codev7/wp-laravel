export default Vue.extend({

    mixins: [require('./../../../mixins/hasState')],

    data() {
        return {
            templates: {}
        }
    },

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        this.$http.get(`/api/projects/${this.state.project_id}/briefs/templates`, {});
    }

});