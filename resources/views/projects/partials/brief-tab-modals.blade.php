<div class="row">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation"
                v-for="modal in brief.modals" class="@{{ $index == 0 ? 'active' : null }}">
                <a data-toggle="tab"
                   role="tab"
                   href="#@{{ 'modal-tab-' + $index }}"
                   aria-controls="@{{ 'modal-tab-' + $index }}">@{{ modal.name }}</a>
            </li>
        </ul>

        <div class="text-center m-t">
            <a href="#" class="btn btn-xs btn-success"
               v-on:click.prevent="addListItem('brief.modals')">
                <i class="fa fa-plus"></i> Add Modal
            </a>
        </div>
    </div><!--col-->

    <div class="tab-content">
        <div role="tabpanel" class="col-sm-9 tab-pane  @{{ $index == 0 ? 'active' : null }}" id="@{{ 'modal-tab-' + $index }}"
             v-for="(modalIndex, modal) in brief.modals" >

            <small class="pull-right">
                <a href="#" class="text-danger"
                   v-on:click.prevent="removeListItem('brief.modals', modalIndex)">
                    <i class="fa fa-trash"></i> Delete Modal
                </a>
            </small>

            <div class="form-group">
                <label>Modal Name</label>
                <input type="text" class="form-control" placeholder="the unique name of the modal"
                       v-model="modal.name"/>
            </div>

            <div class="form-group">
                <label>Design File</label>

                <select class="custom-select form-control" v-model="modal.design_file_id">
                    <option value="">No Design File Yet</option>
                    <option v-for="file in projectFiles" value="@{{ file.id }}">@{{ file.name }}</option>
                </select>
            </div>

            <div class="form-group">
                <label>Quick Modal Summary</label>
                        <textarea class="form-control" rows="2" cols="4" placeholder="A description of the modal."
                                  v-model="modal.summary">
                        </textarea>
            </div>

            <design-proofs v-if="modal.design_proofs"
                           :path="'brief.modals['+modalIndex+'].design_proofs'"
                           :design_proofs.sync="modal.design_proofs">
            </design-proofs>

            <div class="clearfix"></div>

            <brief-checklist v-if="modal.checklist"
                             :path="'brief.modals['+modalIndex+'].checklist'"
                             :checklist.sync="modal.checklist">
            </brief-checklist>

        </div>

        <div v-if="brief.modals.length == 0" role="tabpanel" class="col-sm-9 tab-pane active">

            <div class="well well-small text-center">
                <h4>No Modals Added. <br /><small class="text-muted">Click the "Add Modal" button to the left to create the first modal.</small></h4>
            </div>
        </div>

    </div>
</div>