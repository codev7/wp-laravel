var notify = require('./../../../misc/notify');

export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            requestingChanges: false,
            approving: false,
            changes: '',
            brief: {}
        }
    },

    ready() {
        this.brief = this.state.brief;
    },

    methods: {
        openRequestChangesModal() {
            this.changes = '';
            $("#request-brief-changes").modal('show');
        },

        requestChanges() {
            this.requestingChanges = true;
            this.$http.post(`/api/projects/${this.brief.project_id}/briefs/${this.brief.id}/request-changes`, {text: this.changes}, (res) => {
                this.changes = '';
                $("#request-brief-changes").modal('hide');
                notify.success('Changes have been requested.');
            }).always(() => {
                this.requestingChanges = false;
            });
        },

        approve() {
            this.approving = true;
            this.$http.post(`/api/projects/${this.brief.project_id}/briefs/${this.brief.id}/approve`, {}, (res) => {
                this.brief = res.data;
            }).always(() => {
                this.approving = false;
            });
        }
    }

});