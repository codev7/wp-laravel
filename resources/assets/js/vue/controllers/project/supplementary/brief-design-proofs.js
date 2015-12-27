export default Vue.extend({
    props: {
        design_proofs: {
            type: Array,
            required: true
        },
        path: {
            type: String,
            required: true
        }
    },
    components: {
        'uploadcare': require('./brief-uploadcare')
    },
    template: `
        <div class="form-group">
            <label>Design Proofs</label>


            <div class="well well-small text-center" v-show=" !design_proofs.length">
                <h4 class="m-a-0">There are no design proofs added yet.</h4>
                <p class="m-a-0">Design proofs are PNG previews of the view/modal.  You should upload one for each viewport (mobile, desktop, tablet) if you have it.</p>
                <br />
                <a href="#" class="btn btn-xs btn-success"
               v-on:click.prevent="$root.addListItem(path)">
                <i class="fa fa-plus"></i> Add Design Proof
            </a>
            </div>

            <table class="table table-bordered table-middle" v-if="design_proofs.length">
                <thead>
                <tr>
                    <th style="width: 70%">Name</th>
                    <th style="width: 20%">Image</th>
                    <th style="width: 10%">&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="(proofIndex, proof) in design_proofs">
                    <td>
                        <input type="text" class="form-control" placeholder="the unique name of the design proof"
                               v-model="proof.name" />
                    </td>
                    <td>
                        <uploadcare
                            :bind-files.sync="proof.screenshots"
                            :all-files.sync="$root.briefFiles"
                            reference_type="project_brief"
                            reference_id="$root.state.brief_id">
                        </uploadcare>
                    </td>

                    <td>
                        <a href="#" class="btn btn-danger-outline"
                           v-on:click.prevent="$root.removeListItem(path, proofIndex)">
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>

            <a href="#" v-show="design_proofs.length" class="btn btn-xs btn-success pull-right"
               v-on:click.prevent="$root.addListItem(path)">
                <i class="fa fa-plus"></i> Add Design Proof
            </a>
        </div>
    `
})