export default Vue.extend({


    data() {
        return {
            showAcceptedTodos: false
        }
    },
    ready() {
        console.log('project-todos c-r initialized')
    },

    methods: {
        toggleDescription(e) {
        
            /* needs to be moved over from misc/scripts.js*/

        },
        toggleAcceptedStories(e) {

            this.showAcceptedTodos = ! this.showAcceptedTodos;

            $('.accepted-task-item').toggle()
        }
    }

});