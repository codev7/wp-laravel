export default Vue.extend({

    data() {
        return {
            creatingTodo: false,
            showAcceptedTodos: false,
            todos: [
            ],
            newTodo: {
                title: '',
                type: '',
                category: '',
                content: ''
            },
            meta: {
                'frontend': 'Front End',
                'wordpress': 'WordPress',
                'other': 'other'
            },
            opened: []
        }
    },

    mixins: [require('./../../mixins/hasState')],

    computed: {
        accepted() {
            return _.reduce(this.todos, (res, todo) => {
                if (todo.status == 'closed') {
                    res.push(todo);
                }
                return res;
            }, []);
        },
        inProgress() {
            return _.reduce(this.todos, (res, todo) => {
                if (todo.status != 'closed') {
                    res.push(todo);
                }
                return res;
            }, []);
        }
    },

    ready() {
        this.fetchTodos();
    },

    methods: {
        openCreateModal() {
            $('#create-to-do').modal('show');
        },
        createTodo() {
            this.creatingTodo = true;
            this.$http.post(`/api/todos`, _.merge(this.newTodo, this.state), (res) => {
                this.todos.unshift(res.data);
                this.newTodo = {
                    title: '',
                    type: '',
                    category: '',
                    content: ''
                };
            }).always(() => {
                this.creatingTodo = false;
            });
        },
        fetchTodos() {
            this.$http.get(`/api/todos`, this.state, (res) => {
                this.todos = res.data;
            });
        },
        toggleDescription(id) {
            if (this.opened.indexOf(id) == -1) {
                this.opened.push(id);
            } else {
                this.opened = _.without(this.opened, id);
            }
            //$(this).parents('.media-body').find('.description-row').toggle();
            //$(this).parents('.list-group-item').toggleClass('opened');
        },
        toggleAcceptedStories() {
            this.showAcceptedTodos = ! this.showAcceptedTodos;
        }
    }

});