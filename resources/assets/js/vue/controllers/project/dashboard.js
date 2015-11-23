var notify = require('./../../../misc/notify');

export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            loaded: false,
            posting: false,
            data: [],
            message: '',
            tickTrigger: false,
            intervals: {
            }
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
        // @todo make the view rerender if any canDelete is changed :/
        recalcPermissions() {
            var canDelete;

            _.each(this.data, (thread, index) => {
                var firstMsg = thread.messages[0];
                canDelete = CObj.team.pivot.role == 'owner'
                    || (firstMsg.user_id == CObj.user_id && moment().diff(moment(firstMsg.created_at), 'seconds') <= 280);

                if (thread.canDelete != canDelete) this.data.$set(index, thread);
            });
        },
        getThreads() {
            this.$http.get(`/api/threads`, this.state, (data) => {
                this.data = data.data;
                this.loaded = true;
            });
        },
        postMessage(e) {
            this.posting = true;

            this.$http.post(`/api/threads`, _.extend(this.state, {content: this.message}), (data) => {
                this.message = '';
                data.data.canDelete = true;
                this.data.unshift(data.data);
            }).always(() => {
                this.posting = false;
            });
        },
        deleteThreadConfirm(thread) {
            notify.confirm('Are you sure you want to delete this thread?', '', () => {
                this.data = _.removeById(thread.id, this.data.data);
                this.$http.delete(`/api/threads/${thread.id}`);
            });
        }
    }

});