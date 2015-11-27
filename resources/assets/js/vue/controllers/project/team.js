var notify = require('./../../../misc/notify');
var hasState = require('./../../mixins/hasState');

export default Vue.extend({

    mixins: [hasState],

    data() {
        return {
            sendingInvite: false,
            form: {
                email: '',
                inviteTo: 'single'
            },
            team: {

            },
            isOwner: false
        }
    },

    computed: {
        isOwner() {
            return this.team.owner_id == CObj.user_id;
        }
    },

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        this.$http.get(`/spark/api/teams/${this.state.team_id}`, {}, (res) => {
            this.team = res;
        });
    },

    methods: {
        openInviteModal() {
            this.form.email = '';
            $("#add-team-member").modal("show");
        },
        sendInvite() {
            this.sendingInvite = true;

            var payload = {
                email: this.form.email,
                projects: (this.form.inviteTo == 'single') ? [this.state.project_id] : ['*']
            }

            this.$http.post(`/settings/teams/${this.state.team_id}/invitations`, payload, (res) => {
                this.form.email = '';
                this.team = res;
                $("#add-team-member").modal("hide");
                notify.success("Invitation has been sent");
            }).always(() => {
                this.sendingInvite = false;
            });
        },
        removeFromTeam(user) {
            this.team.users = _.removeById(user.id, this.team.users);
            this.$http.delete(`/settings/teams/${this.team.id}/members/${user.id}`, {}, () => {});
        }
    }
});