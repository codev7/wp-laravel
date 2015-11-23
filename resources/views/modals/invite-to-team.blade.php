<div class="modal" id="modal-invite-to-team">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title">Send Invitation</h2>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" role="form" v-on:submit.prevent="sendInvite">
                    <div class="form-group">
                        <label class="col-md-3 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" required
                                   v-model="form.email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary" v-submit="sendingInvite">
                                    <span>
                                        <i class="fa fa-btn fa-envelope"></i> Send
                                    </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>