<div class="modal" id="create-to-do">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Create New To-Do Task</h5>
      </div>
      <div class="modal-body">

            <form>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control input-lg" name="name" required autofocus
                                   v-model="newTodo.title" />

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="url">Type</label>
                                    <select class="form-control input-lg" v-model="newTodo.type">
                                        <option value="">Select the to-do type</option>
                                        <option value="bug">Bug</option>
                                        <option value="feature">Feature</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="url">Category</label>
                                    <select class="form-control input-lg" v-model="newTodo.category">
                                        <option value="">Select the to-do type</option>
                                        <option value="frontend">front-end</option>
                                        <option value="wordpress">wordpress</option>
                                        <option value="other">other</option>
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