<div class="row">
    <div class="col-sm-3">
        <div class="statcard p-a m-b" style="background-color: #1e6ab4">
          <h3 class="statcard-number" style="color: white">
            {{ $rep->companies->where('type','agency')->count() }}
          </h3>
          <span class="statcard-desc"  style="color: white">Agencies Assigned</span>
        </div>
    </div><!--col-->
    <div class="col-sm-3">
        <div class="statcard p-a m-b" style="background-color: #1e6ab4">
          <h3 class="statcard-number" style="color: white">
            {{ $rep->companies->where('type','agency')->where('status','won')->count() }}
          </h3>
          <span class="statcard-desc"  style="color: white">Agencies Won</span>
        </div>
    </div><!--col-->
    <div class="col-sm-3">
        <div class="statcard p-a m-b" style="background-color: #7caa18">
          <h3 class="statcard-number" style="color: white">
            {{ $rep->companies->where('type','brand')->count() }}
          </h3>
          <span class="statcard-desc"  style="color: white">Brands Assigned</span>
        </div>
    </div><!--col-->
    <div class="col-sm-3">
        <div class="statcard p-a m-b" style="background-color: #7caa18">
          <h3 class="statcard-number" style="color: white">
            {{ $rep->companies->where('type','brand')->where('status','won')->count() }}
          </h3>
          <span class="statcard-desc"  style="color: white">Brands Won</span>
        </div>
    </div><!--col-->
</div><!--row-->
<a href="#" class="m-a-0 btn btn-primary pull-right"><span class="icon icon-install"></span> {{ $rep->name }}'s Prospect CSV</a>

<h4 class="m-b">Agency &amp; Brand Reachout Stats <a href="#stage-modal" data-toggle="modal"><span class="icon icon-help-with-circle"></span></a></h4>
<div class="m-b">
  <canvas
    class="ex-line-graph"
    width="100%" 
    data-chart="bar"
    data-scale-line-color="transparent"
    data-scale-grid-line-color="rgba(255,255,255,.05)"
    data-scale-font-color="#a2a2a2"
    data-labels='{!! CMV\Models\Prospector\Company::getJsonStatuses() !!}'
    data-value="[{ fillColor: '#1e6ab4', label: 'Agency Stats', data: {!! $rep->getStatusCountJson('agency') !!} },{fillColor: '#7caa18', label: 'Brand Stats', data: {!! $rep->getStatusCountJson('brand') !!} }]">
  </canvas>
</div>

<div class="m-b text-center">
    <span class="badge" style="background-color: #1e6ab4">Agencies</span>
    <span class="badge" style="background-color: #7caa18">Brands</span>
</div>
<hr />
<h4 class="m-b m-t-md">Activity Stats, Trailing 28 Days <a href="#activity-modal" data-toggle="modal"><span class="icon icon-help-with-circle"></span></a></h4>
<div>
  <canvas
    class="ex-line-graph"
    data-chart="line"
    data-scale-line-color="transparent"
    data-scale-grid-line-color="rgba(255,255,255,.05)"
    data-scale-font-color="#a2a2a2"
    data-scale-step-width="200"
    data-scale-start-value="0"
    data-labels='{!! $rep->getTrailing28DayActivities(true) !!}'
    data-value="[{fillColor: 'rgba(28,168,221,.03)', data: {!! $rep->getTrailing28DayActivities() !!}}]">
  </canvas>
</div>