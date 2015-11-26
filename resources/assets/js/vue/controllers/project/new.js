export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            posting: false,
            ndaing: false,
            form: {
                email: '',
                user_name: '',
                company_name: '',
                project_name: '',
                project_type: '',
                requested_deadline: '',
                message: '',
                agreed_to_nda: false
            }
        }
    },

    ready() {
        if (this.state.team.id && this.state.team.nda_agreed_at) {
            this.form.agreed_to_nda = true;
        }

        if (! this.form.agreed_to_nda) {
            $('#modal-nda').modal('show');
        }

        $('.toggle-nda').on('click', function(e)
        {
            e.preventDefault();
            $('#full-nda').toggle();
            $('#nda-cliff-notes').toggle();
        });
    },

    methods: {
        openStep2(e) {
            e.preventDefault();
            $('[href=#step-2]').click();
        },
        createProject(e) {
            e.preventDefault();

            this.posting = true;

            var request;

            if (CObj.logged_in) {
                request = this.$http.post(`/api/projects`, this.form, (data) => {
                    window.location = `/project/${data.data.slug}`;
                });
            } else {
                request = this.$http.post(`/api/projects/create_and_register`, this.form, (data) => {
                    window.location = `/project/${data.data.slug}`;
                });
            }

            request.always(() => {
                this.posting = false;
            });
        },

        agreeToNDA(e) {
            e.preventDefault();
            this.form.agreed_to_nda = true;
            $('#modal-nda').modal('hide');
        }

    }

});