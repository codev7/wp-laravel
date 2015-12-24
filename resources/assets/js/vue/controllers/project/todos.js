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
                content: '',
                files: []
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
                if (todo.status == 'accepted') {
                    res.push(todo);
                }
                return res;
            }, []);
        },
        inProgress() {
            return _.reduce(this.todos, (res, todo) => {
                if (todo.status != 'accepted') {
                    res.push(todo);
                }
                return res;
            }, []);
        },
        isDeveloper() {
            return CObj.developer;
        }
    },

    ready() {
        this.fetchTodos();
        var widgets = uploadcare.initialize(`#create-to-do`);
        this.ucare = widgets[0];

        this.ucare.onChange((res) => {
            if (res) {
                $.when.apply(null, res.files()).done((...files) => {
                    this.newTodo.files = files;
                });
            }
        });
    },

    methods: {
        openCreateModal() {
            $('#create-to-do').modal('show');
            this._resetNewTodo();
        },
        createTodo() {
            this.creatingTodo = true;
            this.$http.post(`/api/todos`, _.merge(this.newTodo, this.state), (res) => {
                this.todos.unshift(res.data);
                this._resetNewTodo();
                $('#create-to-do').modal('hide');
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
        },
        toggleAcceptedStories() {
            this.showAcceptedTodos = ! this.showAcceptedTodos;
        },
        setStatus(todo, status) {
            todo.status = status;
            if (status == 'accepted') {
                todo.accepted_at = moment().format();
            }

            // being positive about the call success
            this.$http.put(`/api/todos/${todo.id}/set-status`, {status: status});
        },
        _resetNewTodo() {
            this.ucare.value(null);
            this.newTodo = {
                title: '',
                type: '',
                category: '',
                content: '',
                files: []
            };
        }
    }
});