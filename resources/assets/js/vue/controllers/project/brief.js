export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    components: {
        'brief-checklist': require('./supplementary/brief-checklist'),
        'design-proofs': require('./supplementary/brief-design-proofs')
    },

    data() {
        return {
            templates: {},
            brief: {
                brief_type: 'frontend',
                summary: ''
            },
            supplementary: {
                files: [],
                briefs: []
            },

            lodash: _
        }
    },

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        this.$http.get(`/api/projects/${this.state.project_id}/briefs/templates`, {}, (res) => {
            this.templates = res.data;
            if (this.state.brief_id === undefined) {
                this.brief = this.templates.frontend;
                this.brief.brief_type = 'frontend';
            }
        });
    },

    methods: {
        handleBriefTypeChange() {
            var type = this.brief.brief_type;
            this.brief = this.templates[this.brief.brief_type];
            this.brief.brief_type = type;
        },
        addListItem(path) {
            var parts, blank, clone;

            parts = path.split('.');
            blank = _.cloneDeep(this.templates.blanks[_.last(parts) + '_item']);
            clone = _.cloneDeep(this[parts[0]]);

            _.get(clone, _.tail(parts).join('.')).push(blank);

            this[parts[0]] = clone;
        },
        removeListItem(path, index) {
            var parts, clone, withoutIndex;

            parts = path.split('.');
            clone = _.cloneDeep(this[parts[0]]);
            withoutIndex = _.reduce(
                _.get(clone, _.tail(parts).join('.')),
                function(res, value, key) {
                    if (key != index) res.push(value);
                    return res;
                },
                []
            );

            _.set(clone, _.tail(parts).join('.'), withoutIndex);
            this[parts[0]] = clone;
        }
    }

});