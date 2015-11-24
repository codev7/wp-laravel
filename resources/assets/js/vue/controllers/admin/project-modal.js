export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            initialProject: {},
            project: {},
            states: {
                updatingProject: false,
                creatingBBRepository: false,
                resendingInvoice: false,
                creatingStagingSite: false
            }
        }
    },

    ready() {
        this.initialProject = this.state;
    },

    methods: {
        openModal() {
            this.project = _.clone(this.initialProject);
            $('#admin-project-modal').modal('show');
        },
        updateProject() {
            this.states.updatingProject = true;
            this.$http.put(`/api/projects/${this.project.id}`, this.project, (res) => {
                this.initialProject = res.data;
            }).always(() => {
                this.states.updatingProject = false;
            });
        },
        createBBRepository() {
            this.states.creatingBBRepository = true;
            this.$http.post(`/api/projects/${this.project.id}/create_bb_repository`, this.project, (res) => {
            }).always(() => {
                this.states.creatingBBRepository = false;
            });
        },
        createStagingSite() {
            this.states.creatingStagingSite = true;
            this.$http.post(`/api/projects/${this.project.id}/create_staging_site`, this.project, (res) => {
            }).always(() => {
                this.states.creatingStagingSite = false;
            });
        },
        resendInvoice() {
            this.states.resendingInvoice = true;
            this.$http.post(`/api/projects/${this.project.id}/resend_invoice`, this.project, (res) => {
            }).always(() => {
                this.states.resendingInvoice = false;
            });
        }
    }

});