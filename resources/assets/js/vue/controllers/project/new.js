export default Vue.extend({

    data() {
        return {
            posting: false,
            form: {
                email: '',
                user_name: '',
                company_name: '',
                project_name: '',
                project_type: '',
                requested_deadline: '',
                message: ''
            }
        }
    },

    ready() {
        $('#modal-nda').modal('show');

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
                    swal({
                        title: "Project has been created!",
                        type: "success",
                        closeOnConfirm: false,
                        allowEscapeKey: false
                    }, function() {
                        window.location = `/project/${data.data.slug}`;
                    });
                });
            } else {
                request = this.$http.post(`/api/projects/create_and_register`, this.form, (data) => {
                    swal({
                        title: "Project has been created!",
                        type: "success",
                        closeOnConfirm: false,
                        allowEscapeKey: false
                    }, function() {
                        window.location = `/project/${data.data.slug}`;
                    });
                });
            }

            request.always(() => {
                this.posting = false;
            });
        }
    }

});