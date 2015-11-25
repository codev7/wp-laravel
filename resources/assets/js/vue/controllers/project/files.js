var notify = require('./../../../misc/notify');

export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            files: [],
            filesFetched: false
        }
    },

    ready() {
        this.fetchFiles();

        // copypaste from /controllers/misc/uploadcare.js
        // haven't figure out how to do it smarter yet
        this.$el.id = _.randomStr();
        var widgets = uploadcare.initialize(`#${this.$el.id}`);
        var widget = widgets[0];
        widget.onChange((res) => {
            if (res) {
                $.when.apply(null, res.files()).done((...files) => {
                    _.each(files, (file, i) => {
                        this.persist(file);
                    });

                    widget.value(null);

                    notify.success(_.pluralize(files.length, 'file has been', 'files have been') + ' uploaded');
                });
            }
        })

    },

    methods: {
        persist(file) {
            file.reference_type = this.state.reference_type;
            file.reference_id = this.state.reference_id;

            return this.$http.post(`/api/files`, file, (res) => {
                this.files.unshift(res.data);
            });
        },

        deleteFile(file) {
            notify.confirm('Warning', 'Selected file will be deleted. Proceed?', () => {
                this.$http.delete(`/api/files/${file.id}`, this.state);
                this.files = _.removeById(file.id, this.files);
            });
        },

        fetchFiles() {
            this.$http.get(`/api/files`, this.state, (res) => {
                this.files = res.data;
            }).always(() => {
                this.filesFetched = true;
            });
        }

    }
});