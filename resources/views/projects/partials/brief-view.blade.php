<h1>Front End Brief
    <small>
        <span style="top: -5px" data-placement="right" class="pos-r tooltipper text-primary"
              title="{{ $brief->getTypeDescription() }}">
             <i class="fa fa-question-circle"></i>
        </span>
    </small>
    <br/>
    <small class="text-muted">{{ $project->name }} - Prepared on {{ $brief->getFinishedAtString() }}</small>
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

                    <li><a href="#global-tab" data-toggle="tab">Global Notes</a></li>

                    @if(isset($brief->text['sections']))
                        <li class="nav-header m-t">Sections</li>

                        @foreach ($brief->text['sections'] as $i => $section)
                            <li><a href="#sections-tab-{{ $i }}" data-toggle="tab">{{ ucfirst($section['name']) }}</a></li>
                        @endforeach
                    @endif

                    @if(isset($brief->text['templates']))
                        <li class="nav-header m-t">Templates</li>

                        @foreach ($brief->text['templates'] as $i => $template)
                            <li><a href="#templates-tab-{{ $i }}" data-toggle="tab">{{ ucfirst($template['name']) }}</a></li>
                        @endforeach
                    @endif

                    @if(isset($brief->text['post_types']))
                        <li class="nav-header m-t">Endpoints</li>

                        @foreach ($brief->text['post_types'] as $i => $ptype)
                            <li><a href="#post-types-tab-{{ $i }}" data-toggle="tab">{{ ucfirst($ptype['name']) }}</a></li>
                        @endforeach
                    @endif

                    @if(isset($brief->text['endpoints']))
                        <li class="nav-header m-t">Endpoints</li>

                        @foreach ($brief->text['endpoints'] as $i => $endpoint)
                            <li><a href="#endpoints-tab-{{ $i }}" data-toggle="tab">{{ ucfirst($endpoint['name']) }}</a></li>
                        @endforeach
                    @endif

                    @if(isset($brief->text['views']))
                        <li class="nav-header m-t">Views</li>

                        @foreach ($brief->text['views'] as $i => $view)
                            <li><a href="#views-tab-{{ $i }}" data-toggle="tab">{{ ucfirst($view['name']) }}</a></li>
                        @endforeach
                    @endif

                    @if(isset($brief->text['modals']))
                        <li class="nav-header m-t">Modals</li>

                        @foreach ($brief->text['modals'] as $i => $modal)
                        <li><a href="#modals-tab-{{ $i }}" data-toggle="tab">{{ ucfirst($modal['name']) }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="tab-content">
            {{--overview--}}
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
            {{--/overview--}}

            <div class="tab-pane" id="global-tab">
                <h3 class="m-t-0 p-t-0">Global Notes</h3>

                <div class="trix-markup">
                    {!! $brief->text['global']['notes'] !!}
                </div>

                @if (isset($brief->text['global']['checklist']) && count($brief->text['global']['checklist']))
                    @include('projects.partials.brief-view-checklist', [
                        'brief' => $brief,
                        'checklist' => $brief->text['global']['checklist'],
                        'tooltip' => 'The check list items will be used globally across all views.  These items are used during the QA process to verify project success.'
                    ])
                @endif
            </div>

            @if(isset($brief->text['sections']))
                @foreach ($brief->text['sections'] as $i => $section)
                <div class="tab-pane" id="sections-tab-{{ $i }}">
                    <h3 class="m-t-0 p-t-0">{{ $section['name'] }}</h3>


                    <p>{{ $section['summary'] }}</p>

                    @if ($section['sub_sections'])
                    <div class="row">
                        <div class="col-sm-3">
                            <ul class="nav nav-pills nav-stacked" role="tablist">
                                @foreach ($section['sub_sections'] as $j => $sub)
                                <li role="presentation">
                                    <a role="tab"
                                       data-toggle="tab"
                                       href="#subsection-tabs-{{$i}}-{{$j}}">{{ $sub['header'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div><!--col-->

                        <div class="tab-content">
                            @foreach ($section['sub_sections'] as $j => $sub)
                            <div role="tabpanel" class="col-sm-9 tab-pane" id="subsection-tabs-{{$i}}-{{$j}}">
                                <h4>{{ $sub['header'] }}</h4>

                                <div class="trix-markdown">
                                    {!! $sub['content'] !!}
                                </div>

                                @include('projects.partials.brief-view-checklist', [
                                    'brief' => $brief,
                                    'checklist' => $sub['checklist']
                                ])
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @include('projects.partials.brief-view-checklist', [
                        'brief' => $brief,
                        'checklist' => $sub['checklist'],
                    ])
                </div>
                @endforeach
            @endif

            @if(isset($brief->text['templates']))
                @foreach ($brief->text['templates'] as $i => $template)
                <div class="tab-pane" id="templates-tab-{{ $i }}">

                    <h3 class="m-t-0 p-t-0">{{ $template['name'] }}</h3>

                    <p>{{ $template['summary'] }}</p>

                    @include('projects.partials.brief-view-checklist', [
                        'brief' => $brief,
                        'checklist' => $template['checklist'],
                    ])

                    {{--@include('projects.partials.brief-view-design-proofs', [--}}
                        {{--'brief' => $brief,--}}
                        {{--'proofs' => $template['design_proofs']--}}
                    {{--])--}}
                </div>
                @endforeach
            @endif

            @if(isset($brief->text['post_types']))
                @foreach ($brief->text['post_types'] as $i => $ptype)
                <div class="tab-pane" id="post-types-tab-{{ $i }}">

                    <h3 class="m-t-0 p-t-0">{{ $ptype['name'] }} <br /><small class="text-muted">custom post type</small></h3>

                    <p>{{ $ptype['summary'] }}</p>

                    <h4>Post Type Summary</h4>

                    <table class="table table-condensed table-striped table-responsive">
                        <tbody>
                        <tr>
                            <th>Has single post page?</th>
                            <td>{{ yesNo($ptype['has_single_post_page']) }}</td>
                        </tr>
                        <tr>
                            <th>View for single post page:</th>
                            <td>!!! !!! blog-post-single.html</td>
                        </tr>
                        <tr>
                            <th>Taxonomies</th>
                            <td>
                                <ul class="m-a-0">
                                    @foreach($ptype['taxonomies'] as $taxonomy)
                                        <li>{{ $taxonomy }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Include in search results?</th>
                            <td>{{ yesNo($ptype['include_in_search']) }}</td>
                        </tr>
                        <tr>
                            <th>Has an archives page?</th>
                            <td>{{ yesNo($ptype['has_archive']) }}</td>
                        </tr>
                        @if ($ptype['has_archive'])
                        <tr>
                            <th>View for post archives page:</th>
                            <td>!!! !!!!! blog-index.html</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Post Data (Meta)</th>
                            <td>
                                <ul class="m-a-0">
                                    @foreach ($ptype['meta_data'] as $meta)
                                        <li>{{ $meta }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        @if ($ptype['custom_meta_fields'])
                        <tr>
                            <th>Custom Post Data (Meta)</th>
                            <td>
                                <ul class="m-a-0">
                                    @foreach ($ptype['custom_meta_fields'] as $meta)
                                        <li>
                                            {{ $meta['name'] }} ({{$meta['type'] . ($meta['required'] ? ', required': '')}})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                @endforeach
            @endif

            @if(isset($brief->text['endpoints']))
                @foreach ($brief->text['endpoints'] as $i => $endpoint)
                <div class="tab-pane" id="endpoints-tab-{{ $i }}">

                    <h3 class="m-t-0 p-t-0">{{ $endpoint['name'] }}</h3>

                    <p>{{ $endpoint['summary'] }}</p>

                    <h4>Form Inputs</h4>

                    <div class="trix-markup">
                        {!! $endpoint['form_inputs'] !!}
                    </div>

                    <h4>Expected Output / Action</h4>

                    <p>{{ $endpoint['expected_output_action'] }}</p>

                </div>
                @endforeach
            @endif

            @if(isset($brief->text['views']))
                @foreach ($brief->text['views'] as $i => $view)
                <div class="tab-pane" id="views-tab-{{ $i }}">
                    <h3 class="m-t-0 p-t-0">{{ $view['name'] }}</h3>

                    <p>{{ $view['summary'] }}</p>

                    @include('projects.partials.brief-view-checklist', [
                        'brief' => $brief,
                        'checklist' => $view['checklist']
                    ])

                    @include('projects.partials.brief-view-design-proofs', [
                        'brief' => $brief,
                        'proofs' => $view['design_proofs']
                    ])

                    {{-- !!!! DESIGN FILE ID --}}
                    <h4>Design File</h4>
                    <p>This design can be found in the <a href="#">All Files.psd</a> file in the project files section.</p>

                </div>
                @endforeach
            @endif

            @if(isset($brief->text['modals']))
                @foreach ($brief->text['modals'] as $i => $modal)
                <div class="tab-pane" id="modals-tab-{{ $i }}">

                    <div class="tab-pane active" id="views-tab-{{ $i }}">
                        <h3 class="m-t-0 p-t-0">{{ $modal['name'] }}</h3>

                        <p>{{ $modal['summary'] }}</p>

                        @include('projects.partials.brief-view-checklist', [
                            'brief' => $brief,
                            'checklist' => $modal['checklist']
                        ])

                        @include('projects.partials.brief-view-design-proofs', [
                            'brief' => $brief,
                            'proofs' => $modal['design_proofs']
                        ])

                        {{-- !!!! DESIGN FILE ID --}}
                        <h4>Design File</h4>
                        <p>This design can be found in the <a href="#">All Files.psd</a> file in the project files section.</p>

                    </div>

                </div>
                @endforeach
            @endif

        </div>
    </div>
</div>