export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {}
    },

    ready() {
        this.invitations = this.state.invitations;
        this.showInvitationModal();
    },

    methods: {
        showInvitationModal() {
            setTimeout(() => {
                if (this.invitations.length) {
                    var invitation = this.invitations[0];
                    console.log(invitation);
                    swal({
                        title: "Pending invitation",
                        text: `You have pending invitation to the "${invitation.team.name}" team`,
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Accept",
                        cancelButtonText: "Decline",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, (isConfirm) => {
                        this.invitations = _.removeById(invitation.id, this.invitations);

                        isConfirm ?
                            this.acceptInvitation(invitation) :
                            this.declineInvitation(invitation);
                    });
                }
            }, 200);
        },
        showInfoModal(message) {
            swal({
                title: "Pending Invitation",
                text: message,
                type: "success",
                showCancelButton: false,
                confirmButtonColor: "#8CD4F5",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            }, () => {
                this.showInvitationModal();
            });
        },
        acceptInvitation(invitation) {
            this.$http.post(`/settings/teams/invitations/${invitation.id}/accept`);
            this.showInfoModal(`You've been added to the "${invitation.team.name}" team`);
        },
        declineInvitation(invitation) {
            this.$http.delete(`/settings/teams/invitations/${invitation.id}`);
            this.showInfoModal(`Invatation to the "${invitation.team.name}" team has been declined`);
        }
    }

});