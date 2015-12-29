<div class="modal" id="create-to-do">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Create New To Do Item</h5>
      </div>
      <div class="modal-body">

            <form>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control input-lg" name="name" required autofocus
                                   v-model="newTodo.title" />

                            <p class="help-text text-muted">Please enter a short title that describes the task.</p>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="url">Type</label>
                                    <br />
                                    <div class="btn-group" id="to-do-type" data-toggle="buttons">
                                        <label for="bug-type" class="btn  btn-primary">
                                            <input v-model="newTodo.type" name="type" type="radio" value="bug" id="bug-type"><i class="fa fa-bug text-danger"></i> Bug
                                        </label>
                                        <label for="feature-type" class="btn  btn-primary">
                                            <input  v-model="newTodo.type" name="type" type="radio" value="feature" id="feature-type" ><i class="fa fa-star text-warning"></i> Feature
                                        </label>
                                    </div>

                                

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="url">Category</label>
                                    <select class="form-control input-lg" v-model="newTodo.category">
                                        <option value="">Select a category</option>
                                        <option value="frontend">Frontend</option>
                                        <option value="wordpress">WordPress / CMS</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Details</label>
                            <textarea type="text" class="form-control input-lg" rows="8" required
                                    v-model="newTodo.content"
                                    v-trix></textarea>
                        </div>

                        <div class="form-group attach-files">

                            <label>Attach Files</label>    
                            <input role="uploadcare-uploader" type="hidden" data-multiple/>

                            
                        
                        </div>

                        <hr />

                        <button class="btn btn-success btn-lg btn-block" type="submit"
                                v-on:click.prevent="createTodo"
                                v-submit="creatingTodo">Save To Do Item</button>
                    </div>
                </div>
            </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->