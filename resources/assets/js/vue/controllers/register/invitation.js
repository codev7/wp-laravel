export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            form: {
                email: '',
                name: '',
                password: '',
                password_confirmation: '',
                token: ''
            },
            isRegistering: false
        }
    },

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        this.form.email = this.state.email;
        this.form.token = this.state.token;
    },

    methods: {

        registerWithInvitation() {
            this.isRegistering = true;

            this.$http.post(`/invitation/${this.form.token}/register`, this.form, () => {
                window.location = '/home';
            }).always(() => {
                this.isRegistering = false;
            });
        }

    }

});