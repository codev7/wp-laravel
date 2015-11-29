var notify = require('./../../../misc/notify');

export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            loaded: false,
            creatingThread: false,
            replyingToThread: false,
            data: [],
            canDelete: [],
            message: '',
            tickTrigger: false,
            intervals: {
            }
        }
    },

    watch: {
        data(oldThreads, newThreads) {
            this.recalcPermissions();

            _.each(newThreads, (newThread, index) => {
                if (newThread.answer == undefined) {
                    newThread.answer = '';
                    this.data.$set(index, _.clone(newThread));
                }
            });
        }
    },

    ready() {
        this.getThreads();

        this.intervals.recalcPermissions = setInterval(() => {
            this.recalcPermissions();
        }, 10000)
    },

    detached() {
        clearInterval(this.intervals.recalcPermissions);
    },

    methods: {
        recalcPermissions() {
            var canDelete, postedAgo, firstMessage;

            _.each(this.data, (thread, index) => {
                firstMessage = thread.messages[0];
                postedAgo = moment().diff(moment(firstMessage.created_at), 'seconds');

                canDelete = CObj.admin
                    || (firstMessage.user_id == CObj.user_id && postedAgo <= 280);

                if (thread.canDelete != canDelete) {
                    var copy = _.clone(thread);
                    copy.canDelete = canDelete;
                    this.data.$set(index, copy);
                }
            });
        },
        getThreads() {
            this.$http.get(`/api/threads`, this.state, (data) => {
                this.data = data.data;
                this.loaded = true;
            });
        },
        createThread() {
            this.creatingThread = true;

            this.$http.post(`/api/threads`, _.extend(this.state, {content: this.message}), (data) => {
                this.message = '';
                data.data.canDelete = true;
                this.data.unshift(data.data);
            }).always(() => {
                this.creatingThread = false;
            });
        },
        replyToThread(thread, index) {
            this.replyingToThread = true;

            this.$http.post(`/api/threads/${thread.id}/messages`, {content: thread.answer}, (data) => {
                thread.messages.push(data.data);
                thread.answer = '';
                this.data.$set(index, _.clone(thread));
            }).always(() => {
                this.replyingToThread = false;
            });
        },
        deleteThreadConfirm(thread) {
            notify.confirm('Are you sure you want to delete this thread?', '', () => {
                this.data = _.removeById(thread.id, this.data);
                this.$http.delete(`/api/threads/${thread.id}`);
            });
        }
    }

});