<div class="row">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation"
                v-for="view in brief.views">
                <a data-toggle="tab"
                   role="tab"
                   href="#@{{ 'view-tab-' + $index }}"
                   aria-controls="@{{ 'view-tab-' + $index }}">@{{ view.name }}</a>
            </li>
        </ul>

        <div class="text-center m-t">
            <a href="#" class="btn btn-xs btn-success"
               v-on:click.prevent="addListItem('brief.views')">
                <i class="fa fa-plus"></i> Add View
            </a>
        </div>
    </div><!--col-->

    <div class="tab-content">
        <div role="tabpanel" class="col-sm-9 tab-pane" id="@{{ 'view-tab-'+viewIndex }}"
             v-for="(viewIndex, view) in brief.views">

            <small class="pull-right">
                <a href="#" class="text-danger"
                   v-on:click.prevent="removeListItem('brief.views', viewIndex)"><i class="fa fa-trash"></i> Delete View</a>
            </small>

            <div class="form-group">
                <label>View Name</label>
                <input type="text" class="form-control" placeholder="the unique name of the view"
                       v-model="view.name" />
            </div>

            <div class="form-group">
                <label>Design File</label>

                <select class="custom-select form-control">
                    <option>name-of-file.psd</option>
                    <option>name-of-file.psd</option>
                    <option>name-of-file.psd</option>
                    <option>name-of-file.psd</option>
                </select>
            </div>

            <div class="form-group">
                <label>Quick View Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the page."
                              v-model="view.summary"></textarea>
            </div>

            <design-proofs v-if="view.design_proofs"
                           :path="'brief.views['+viewIndex+'].design_proofs'"
                           :design_proofs.sync="view.design_proofs">
            </design-proofs>

            <div class="clearfix"></div>

            <brief-checklist v-if="view.checklist"
                             :path="'brief.views['+viewIndex+'].checklist'"
                             :checklist.sync="view.checklist">
            </brief-checklist>

        </div>
    </div>
</div>
