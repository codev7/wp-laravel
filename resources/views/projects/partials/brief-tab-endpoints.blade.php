<div class="row">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li data-toggle="tab" class="active"><a href="#">Contact Form</a></li>
            <li data-toggle="tab"><a href="#">Case Study Filter</a></li>
        </ul>

        <div class="text-center m-t">
            <a href="#" class="btn btn-xs btn-success"
               v-on:click.prevent="addListItem('brief.endpoints')"><i class="fa fa-plus"></i> Add Endpoint</a>
        </div>
    </div><!--col-->

    <div class="col-sm-9" v-for="(endpointIndex, endpoint) in brief.endpoints">

        <small class="pull-right">
            <a href="#" class="text-danger"
               v-on:click.prevent="removeListItem('brief.endpoints', endpointIndex)">
                <i class="fa fa-trash"></i> Delete Endpoint
            </a>
        </small>

        <div class="form-group">
            <label>Endpoint Name</label>
            <input type="text" class="form-control" placeholder="the name of the endpoint"
                   v-model="endpoint.name"/>
        </div>
        <div class="form-group">
            <label>Quick Endpoint Summary</label>
            <textarea class="form-control" rows="2" cols="4" placeholder="A description of the endpoint functionality."
                    v-model="endpoint.summary"></textarea>

        </div>

        <div class="form-group">
            <label>Expected Inputs</label>
            <textarea class="form-control" rows="5" cols="4" placeholder="A description of what will be submitted to the endpoint (the data)."
                    v-model="endpoint.form_inputs"></textarea>
        </div>

        <div class="form-group">
            <label>Expected Output / Action</label>
            <textarea class="form-control" rows="5" cols="4" placeholder="A description of the what happens after the endpoint is hit, or the form is submitted."
                    v-model="endpoint.expected_output_action"></textarea>
        </div>


    </div>
</div>