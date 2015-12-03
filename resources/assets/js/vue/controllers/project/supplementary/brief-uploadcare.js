export default Vue.extend({

    props: {
        allFiles: {
            type: Array,
            //required: true,
            default: []
        },
        bindFiles: {
            type: Array,
            required: true
        }
    },

    data() {
        return {}
    },

    template: `
        <div>
            <ul class="m-a-0">
                <li v-for="fileId in bindFiles" v-if="file(fileId) !== undefined">
                    <a :href="file(fileId).path" target="_blank">{{ file(fileId).path }}</a>
                </li>
            </ul>

            <input role="uploadcare-uploader" type="hidden" data-multiple/>
        </div>
    `,
    //<a href="#" class="btn btn-block btn-xs m-t"><i class="fa fa-upload"></i> Add Screenshots</a>

    ready() {
        this.$el.id = _.randomStr();
        var widgets = uploadcare.initialize(`#${this.$el.id}`);
        var widget = widgets[0];
        widget.onChange((res) => {
            if (res) {
                $.when.apply(null, res.files()).done((...files) => {
                    _.each(files, (file, i) => {
                        this.persist(file)
                            .success((res) => {
                                this.allFiles.push(res.data);
                                this.bindFiles.push(res.data.id);
                            });
                    });

                    widget.value(null);
                });
            }
        })
    },

    methods: {
        persist(file) {
            file.reference_type = 'project_brief';
            file.reference_id = this.$root.state.brief_id;

            return this.$http.post(`/api/files`, file);
        },

        file(id) {
            return _.findWhere(this.allFiles, {id: id});
        }
    }

});