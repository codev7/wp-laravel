export default Vue.extend({

    template: `
        <div class="panel-body text-center uploadcare-widget-small">
            <p class="m-b text-muted">
                <small>There are currently
                    <span v-if="uploadedCount !== undefined">{{uploadedString}}</span>
                    <span v-if="uploadedCount === undefined"><i class="fa fa-refresh fa-spin"></i> files</span> uploaded.
                </small>
            </p>

            <input role="uploadcare-uploader" type="hidden" data-multiple/>
        </div>
    `,
// <a class="m-t-0 btn btn-block btn-lg btn-primary-outline" href="#"><i class="fa fa-upload"></i> Upload Files</a>

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            uploadedCount: undefined
        }
    },

    computed: {
        uploadedString() {
            return this.uploadedCount + (this.uploadedCount == 1 ? ' file' : ' files');
        }
    },

    ready() {
        this.retrieveCount();

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

                    this.uploadedCount = this.uploadedCount === undefined ?
                        files.length :
                        (this.uploadedCount + files.length);
                });
            }
        })
    },

    methods: {
        persist(file) {
            file.reference_type = this.state.reference_type;
            file.reference_id = this.state.reference_id;

            return this.$http.post(`/api/files`, file);
        },
        retrieveCount() {
            this.uploadedCount = undefined;

            var payload = {
                reference_type: this.state.reference_type,
                reference_id: this.state.reference_id
            };

            this.$http.get(`/api/files/count`, payload, (res) => {
                this.uploadedCount = res.data.count;
            });
        }
    }

});