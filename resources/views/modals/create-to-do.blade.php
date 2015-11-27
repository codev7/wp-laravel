<div class="modal" id="create-to-do">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Create New To-Do Task</h5>
      </div>
      <div class="modal-body">

            <form method="post" action="">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input
                                type="text"
                                class="form-control input-lg"
                                name="name"
                                required autofocus 
                            />

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="url">Type</label>
                                    <select class="form-control input-lg">
                                        <option>Select the to-do type</option>
                                        <option>Bug</option>
                                        <option>Feature</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="url">Category</label>
                                    <select class="form-control input-lg">
                                        <option>Select the to-do type</option>
                                        <option>front-end</option>
                                        <option>wordpress</option>
                                        <option>other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        

                        <div class="form-group">
                            <label for="name">Details</label>
                            <textarea 
                                type="text"
                                class="form-control input-lg"
                                name="name"
                                rows="8"
                                placeholder="This should be a trix editor"
                                required
                            ></textarea>

                        </div>
                        <button class="btn btn-success btn-lg btn-block" type="submit">Save To Do Item</button>                       
                    </div>
                </div>
            </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->