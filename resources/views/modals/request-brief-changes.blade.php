<div class="modal fade" id="request-brief-changes">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h5 class="modal-title">Request Changes to Front End Brief</h5>
      </div>
      <div class="modal-body">

            <form method="post" v-on:submit.prevent="requestChanges()">
                {!! Form::token() !!}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Enter Your Changes:</label>
                            <textarea class="form-control" rows="8" v-trix v-model="changes"></textarea>
                        </div>
 
                        <button class="btn btn-success btn-lg btn-block" type="submit"
                                v-bind:disabled="!changes.length"
                                v-submit="requestingChanges">Send Brief Edits</button>
                    </div>
                </div>
            </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->