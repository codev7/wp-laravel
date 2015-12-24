export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
        }
    },

    mixins: [require('./../../mixins/hasState')],

    ready() {
        this.todo = this.state.todo;
        console.log('todo controller initted');
        console.log(this.todo);
    },

    methods: {

    }
});