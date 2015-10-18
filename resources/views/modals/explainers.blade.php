<div class="modal fade in" id="stage-modal">
    <div class="modal-dialog">
        <form action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Prospect Stages</h4>
                </div>
                <div class="modal-body">
        
                    <div class="alert alert-info">
                        Each rep is responsible for keeping their company prospect stages up to date based off the below criteria.
                    </div>

                    <h2 class="text-primary">Company Types</h2>

                    <h3>Agency</h3>
                    <p>Agency customers are primarily reached out to with the Code My Views brand name with the value prop of being the trusted development partner in the US.</p>

                    <h3>Brand</h3>
                    <p>Brand customers are large brands ($10mil + in annual revenue) who we do direct outreach to usually on the Design Code Launch brand (designcodelaunch.com).  The value prop to the brand is that we can help them with the full lifecycle of launching an app: design --> code --> launch</p> 

                    <hr />
                    <h2 class="text-primary">Company Stages</h2>

                    @foreach(CMV\Company::$statuses as $stage  => $description)
                            <h3 class="m-a-0">{{ $stage }}</h3>
                            <p class="m-b">{{ $description }}</p>

                    @endforeach
            </div>

        </div>
    </form>
</div>
</div>
<div class="modal fade in" id="activity-modal">
    <div class="modal-dialog">
        <form action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Activity Tracking</h4>
                </div>
                <div class="modal-body">
        
                    <div class="alert alert-info">
                        Each rep is responsible for ensuring proper tracking of their activity is set up using the below methods:
                    </div>

                    <h2 class="text-primary">Activity Tracking</h2>

                    <h3>Email Tracking</h3>
                    <p>When setting up your https://sendbloom.co account for outreach, be sure to setup the cc@pipelinedeals.com bcc address.  This will ensure that all of those emails will be counted as activity.</p>

                    <h3>Manual Emails You Send to Prospects</h3>
                    <p>During the sales process, if you are sending one off emails to customers, remember to bcc cc@pipelinedeals.com to track and count this activity towards your quarterly goals.</p> 

                    <h3>Phone Calls</h3>
                    <p>When you complete a phone call with a prospect, visit that "contact" page for that prospect and log it as an activity with the notes from your call.</p>
                    
                    
            </div>

        </div>
    </form>
</div>
</div>