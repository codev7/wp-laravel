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
    template: `
        <div class="form-group">
            <label>Design Proofs <i class="fa fa-question-circle tooltipper" data-title="Design proofs are screenshots/png files of the view.  For each design brief, the project engineer will need to take screenshots of the raw design file as these screenshots are used during the QA process."></i></label>

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
                        <a href="#">cmvfiles.co/23kzd</a>
                        <a href="#" class="btn btn-block btn-xs"><i class="fa fa-upload"></i> Upload Image</a>
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

            <a href="#" class="btn btn-xs btn-success pull-right"
               v-on:click.prevent="$root.addListItem(path)">
                <i class="fa fa-plus"></i> Add Design Proof
            </a>
        </div>
    `
})