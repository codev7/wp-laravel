export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    components: {
        'brief-checklist': require('./supplementary/brief-checklist'),
        'design-proofs': require('./supplementary/brief-design-proofs'),
        'uploadcare': require('./supplementary/brief-uploadcare')
    },

    data() {
        return {
            briefFiles: [],
            projectFiles: [],
            blanks: require('./supplementary/brief-data-blanks'),
            templates: {
                wordpress: require('./supplementary/brief-data-wordpress'),
                frontend: require('./supplementary/brief-data-frontend'),
                other: require('./supplementary/brief-data-other')
            },

            brief: {
                brief_type: 'frontend',
                summary: ''
            },

            briefMeta: {},

            briefs: [],

            supplementary: {
                files: [],
                briefs: []
            },

            lodash: _,

            creatingBrief: false,
            savingAsDraft: false,
            sendingBrief: false
        }
    },

    ready() {

        if (this.state.brief_id) {
            this.$http.get(`/api/projects/${this.state.project_id}/briefs`, {}, (res) => {
                var briefs = res.data;
                var brief = _.findWhere(briefs, {id: this.state.brief_id});
                this.brief = brief.text;
                this.briefMeta = _.clone(brief, false);
                this.briefs = _.reject(briefs, (brief) => {
                    return brief.id == this.state.brief_id
                });
            });

            this.$http.get(`/api/files`, {reference_type: 'project', reference_id: this.state.project_id}, (res) => {
                this.projectFiles = res.data;
            });

            this.$http.get(`/api/files`, {reference_type: 'project_brief', reference_id: this.state.brief_id}, (res) => {
                this.briefFiles = res.data;
            });
        } else {
            this.brief = this.templates.frontend;
            this.brief.brief_type = 'frontend';
        }
    },

    computed: {
        otherBriefs() {
            return _.reduce(this.briefs, (res, brief) => {
                if (brief.id != this.state.brief_id) res.push(brief);
                return res;
            }, []);
        },
        frontendViews() {
            var brief,
                views = [{value: '', text: 'No association'}];

            _.each(this.brief.related_to_brief, (briefId) => {
                brief = _.findWhere(this.briefs, {id: briefId});

                if (brief && brief.text.brief_type == 'frontend' && brief.text.views.length) {
                    _.each(brief.text.views, (view) => {
                        views.push({text: view.name, value: view._id});
                    });
                }
            });

            return views;
        }
    },

    methods: {
        createBrief() {
            this.creatingBrief = true;
            this.$http.post(`/api/projects/${this.state.project_id}/briefs`, {brief: this.brief}, (res) => {
                window.location = `/project/${res.data.project.slug}/briefs/${res.data.id}/edit`;
            }).always(() => {
                this.creatingBrief = false;
            });
        },
        saveAsDraft() {
            this.savingAsDraft = true;
            this.$http.put(`/api/projects/${this.state.project_id}/briefs/${this.state.brief_id}`, {brief: this.brief}, (res) => {
                this.brief = res.data.text;
            }).always(() => {
                this.savingAsDraft = false;
            });
        },
        sendBrief() {
            this.sendingBrief = true;
            this.$http.post(`/api/projects/${this.state.project_id}/briefs/${this.state.brief_id}/send-to-client`, {}, (res) => {
                this.briefMeta = _.clone(res.data, false);
            }).always(() => {
                this.sendingBrief = false;
            });
        },
        handleBriefTypeChange() {
            var type = this.brief.brief_type;
            this.brief = this.templates[this.brief.brief_type];
            this.brief.brief_type = type;
        },
        addListItem(path) {
            var parts, blank, clone;

            parts = path.split('.');
            blank = _.cloneDeep(this.blanks[_.last(parts) + '_item']);

            _.get(this[parts[0]], _.tail(parts).join('.')).push(blank);
        },
        removeListItem(path, index) {
            var parts, withoutIndex;

            parts = path.split('.');

            withoutIndex = _.reduce(
                _.get(this[parts[0]], _.tail(parts).join('.')),
                function(res, value, key) {
                    if (key != index) res.push(value);
                    return res;
                },
                []
            );

            _.set(this[parts[0]], _.tail(parts).join('.'), withoutIndex);
        }
    }

});