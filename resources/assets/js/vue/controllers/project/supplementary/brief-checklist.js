export default Vue.extend({
    props: {
        checklist: {
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
            <label>Check List Items</label>

            <table class="table table-bordered table-middle"
                   v-show="checklist.length">
                <thead>
                <tr>
                    <th style="width: 70%">Description</th>
                    <th style="width: 20%">Screenshots</th>
                    <th style="width: 10%">&nbsp;</th>
                </tr>
                </thead>

                <tbody>

                <tr v-for="(itemIndex, item) in checklist">
                    <td>
                        <textarea class="form-control m-a-0" rows="5" placeholder="Enter a description of the item."
                                  v-model="item.description"></textarea>
                    </td>
                    <td>
                        <ul class="m-a-0">
                            <li><a href="#">cmvfiles.co/23kzd</a></li>
                            <li><a href="#">cmvfiles.co/23kzd</a></li>
                            <li><a href="#">cmvfiles.co/23kzd</a></li>
                        </ul>

                        <a href="#" class="btn btn-block btn-xs m-t"><i class="fa fa-upload"></i> Add Screenshots</a>
                    </td>

                    <td>
                        <a href="#" class="btn btn-danger-outline"
                           v-on:click.prevent="$root.removeListItem(path, itemIndex)"><i class="fa fa-times"></i></a>
                    </td>
                </tr>

                </tbody>
            </table>

            <a href="#" class="btn btn-xs btn-success pull-right"
               v-on:click.prevent="$root.addListItem(path)"><i class="fa fa-plus"></i> Add Item</a>
        </div>
    `
});