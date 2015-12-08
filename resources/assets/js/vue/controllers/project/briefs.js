var notify = require('./../../../misc/notify');

export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            briefs: [],
            briefsFetched: false,
            meta: {
                'other': {
                    name: 'Other Brief',
                    description: 'Brief covers all details about the implementation of this project.'
                },
                'frontend': {
                    name: 'Front End Brief',
                    description: 'A front end brief covers all details about the HTML/CSS/JavaScript of this project.'
                },
                'wordpress': {
                    name: 'WordPress Brief',
                    description: 'A WordPress brief covers all details about the WordPress implementation of this project.'
                }
            }
        }
    },

    ready() {
        this.fetchBriefs();
    },

    methods: {

        fetchBriefs() {
            this.$http.get(`/api/projects/${this.state.project_id}/briefs`, {}, (res) => {
                this.briefs = res.data;
            }).always(() => {
                this.briefsFetched = true;
            });
        }

    }
});