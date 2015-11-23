var notify = require('./../../../misc/notify');

export default Vue.extend({

    data() {
        return {
            sendingInvite: false,
            form: {
                email: ''
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
        var teamId = CObj.team.id;

        this.$http.get(`/spark/api/teams/${teamId}`, {}, (res) => {
            this.team = res;
        });
    },

    methods: {
        openInviteModal() {
            this.form.email = '';
            $("#modal-invite-to-team").modal("show");
        },
        sendInvite() {
            this.sendingInvite = true;

            this.$http.post(`/settings/teams/1/invitations`, {
                email: this.form.email
            }, (res) => {
                this.form.email = '';
                this.team = res;
                $("#modal-invite-to-team").modal("hide");
                notify.success("Invitation has been sent");
            }).always(() => {
                this.sendingInvite = false;
            });
        },
        removeFromTeam(user) {
            this.team.users = _.removeById(user.id, this.team.users);
            this.$http.delete(`/settings/teams/${this.team.id}/members/${user.id}`, {}, () => {

            });
        }
    }

});