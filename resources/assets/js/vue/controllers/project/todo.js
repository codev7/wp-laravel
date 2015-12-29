export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            postingMessage: false,
            message: '',
            todo: {},
            lodash: _
        }
    },

    mixins: [require('./../../mixins/hasState')],

    ready() {
        this.todo = this.state.todo;

        var widgets = uploadcare.initialize(`#todo-ucare`);
        var widget = widgets[0];

        if (widget != undefined) {
            widget.onChange((res) => {
                if (res) {
                    $.when.apply(null, res.files()).done((...files) => {
                        _.each(files, (file, i) => {
                            var payload = _.merge(file, {reference_type: 'todo', reference_id: this.todo.id});

                            return this.$http.post(`/api/files`, payload)
                                .success((res) => {
                                    this.todo.files.push(res.data);
                                });
                        });

                        widget.value(null);
                    });
                }
            });
        }
    },

    methods: {
        setStatus(todo, status) {
            todo.status = status;
            if (status == 'accepted') {
                todo.accepted_at = moment().format();
            }

            // being positive about the call success
            this.$http.put(`/api/todos/${todo.id}/set-status`, {status: status});
        },
        postMessage() {
            var thread = this.todo.thread;
            this.postingMessage = true;
            this.$http.post(`/api/threads/${thread.id}/messages`, {content: this.answer}, (data) => {
                thread.messages.push(data.data);
                this.answer = '';
            }).always(() => {
                this.postingMessage = false;
            });

        }
    }
});