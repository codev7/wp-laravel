<div class="modal fade" id="add-concierge-site">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Add a Concierge Site</h5>
      </div>
      <div class="modal-body">

            <form method="post" action="{{ route('concierge.create') }}">
                {!! Form::token() !!}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Site Name</label>
                            <input 
                                type="text"
                                class="form-control input-lg"
                                name="name"
                                required autofocus 
                            />

                        </div>
                        <div class="form-group">
                            <label for="url">Site URL</label>
                            <input 
                                type="text"
                                class="form-control input-lg"
                                name="url"
                                required autofocus 
                            />

                        </div>
                        <button class="btn btn-success btn-lg btn-block" type="submit">Add Site</button>                       
                    </div>
                </div>
            </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->