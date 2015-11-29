<div class="modal fade" id="add-team-member">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Add a Team Member</h5>
      </div>
      <div class="modal-body">
            <form method="post" v-on:submit.prevent="sendInvite">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Email Address</label>
                            <input type="text" class="form-control input-lg" name="address" required autofocus
                                   v-model="form.email" />

                        </div>
                        <div class="hr-divider">
                          <h3 class="hr-divider-content hr-divider-heading">
                            User Access
                          </h3>
                        </div>

                        <div class="form-group">

                            <div class="radio custom-control custom-radio">
                              <label class="well">
                                <input type="radio" id="radio1" name="invite_to" value="all" required
                                       v-model="form.inviteTo" >
                                <span class="custom-control-indicator" style="top: 40px; left: 2px;"></span>
                                Add @{{ form.email }} to all of my projects, including this one.
                              </label>
                            </div>

                            <div class="radio custom-control custom-radio">
                              <label class="well">
                                <input type="radio" id="radio2" name="invite_to" value="single" required
                                       v-model="form.inviteTo">
                                <span class="custom-control-indicator" style="top: 40px; left: 2px;"></span>
                                Add @{{ form.email }} to just the {{ $project->name }} project. <small>you can add them to other projects in the future.</small>
                              </label>
                            </div>
                        </div>

                        <button class="btn btn-success btn-lg btn-block" type="submit"
                                v-submit="sendingInvite">Send Invitation</button>
                    </div>
                </div>
            </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->