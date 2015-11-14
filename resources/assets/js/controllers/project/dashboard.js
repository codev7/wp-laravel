export default Vue.extend({

    props: {
        props: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            message: ''
        }
    },

    computed() {
        console.log(this.props);
    },

    ready() {
        console.log('project-dashboard c-r initialized')
    }

});