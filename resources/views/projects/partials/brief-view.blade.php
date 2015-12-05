<h1>Front End Brief
    <small>
        <span style="top: -5px" data-placement="right" class="pos-r tooltipper text-primary"
              title="{{ $brief->getTypeDescription() }}">
             <i class="fa fa-question-circle"></i>
        </span>
    </small>
    <br/>
    <small class="text-muted">{{ $project->name }} - Prepared on {{ $brief->getPreparedAtDate }}</small>
</h1>

<p class="m-a-0">
    <small><a class="text-danger" href="#"><i class="fa fa-edit"></i> Edit Brief</a></small>
</p>

<div class="clearfix"></div>

<div class="hr-divider m-b m-t">
    <h3 class="hr-divider-content hr-divider-heading">
        Summary
    </h3>
</div>

<div class="row">
    @foreach ($brief->briefBoxes() as $box)
    <div class="col-sm-4">
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom"
             data-title="{{ $box['tooltip'] }}">
            <h3 class="statcard-number">
                {!! $box['title'] !!}
            </h3>
            <span class="statcard-desc">{!! $box['description'] !!} <i class="fa fa-question-circle"></i></span>
        </div>
    </div>
    @endforeach
    <!--col-->
</div><!--row-->

<div class="hr-divider">
    <h3 class="hr-divider-content hr-divider-heading">
        Details
    </h3>
</div>

<div class="row m-t-md">
    <div class="col-sm-3">
        <div class="panel panel-default panel-profile brief-panel p-l-0">

            <div class="panel-body p-l-0 p-r-0 p-t-0">
                <ul class="nav nav-bordered nav-stacked m-t">
                    <li class="nav-header">Global</li>

                    <li class="active">
                        <a href="#overview" data-toggle="tab">Overview</a>
                    </li>

                    <li><a href="#global-notes" data-toggle="tab">Global Notes</a></li>

                    <li class="nav-header m-t">Views</li>

                    <li><a href="#view-home" data-toggle="tab">Home</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">About Us</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">Products</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">Product Detail</a></li>

                    <li class="nav-header m-t">Modals</li>

                    <li><a href="#view-other-pages" data-toggle="tab">Contact Us</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">Product Image Gallery</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="tab-content">
            <div class="tab-pane active" id="overview">
                <h3 class="m-t-0 p-t-0">Project Overview</h3>

                <p>{{{ $brief->getValue('global.overview') }}}</p>

                @if ($brief->relatedBriefs())
                <div class="well well-small">
                    <p class="m-a-0 p-a-0"><strong>Note:</strong> This brief has another brief associated with it. All
                        delivery dates and cost estimates include the completion of all associated briefs:</p>

                    <ul class="m-a-0 m-t">
                        @foreach ($brief->relatedBriefs() as $relatedBrief)
                        <li>
                            <a data-pjax href="{{ route('project.brief', ['slug' => $project->slug, 'brief_id' => $relatedBrief->id]) }}">{{ $relatedBrief->text['brief_type'] }} Brief</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <h4>Quick Summary</h4>
                <table class="table table-middle m-b-0">

                    <tbody>
                    <tr>
                        <th class="text-center">
                            <h4 class="m-t-0"><i class="fa fa-calendar"></i><br/>
                                <small>Delivery Date</small>
                            </h4>
                        </th>
                        <td>
                            <p>This project can be completed in as soon as 3 business days - 10 business days, depending
                                on which speed you pick on the invoice page.</p>

                            <p class="text-muted m-b-0">
                                <strong>All of our projects come with a <a href="#">delivery date guarantee</a>.</strong></p>
                        </td>
                    </tr>

                    <tr>
                        <th class="text-center">
                            <h4><i class="fa fa-credit-card"></i><br/>
                                <small>Cost</small>
                            </h4>
                        </th>
                        <td>

                            <p class="m-b-0">
                                The guaranteed cost for this project is $1,000 - $3,000, depending on which delivery speed you pick on the invoice page. <a href="#"><strong>View Invoice</strong></a>.
                            </p>

                        </td>
                    </tr>

                    <tr>
                        <th class="text-center">
                            <h4><i class="fa fa-file-image-o"></i><br/>
                                <small>Files</small>
                            </h4>
                        </th>
                        <td>

                            <p class="m-b-0">
                                There have been 4 files uploaded to this project. <a href="#"><strong>View Files</strong></a>.
                            </p>

                        </td>
                    </tr>
                    </tbody>

                </table>


            </div>
            <!--overview-->
        </div>
    </div>
</div>