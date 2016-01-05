<h1>{{ $brief->getTypeName() }}
    <small>
        <span style="top: -5px" data-placement="right" class="pos-r tooltipper text-primary"
              title="{{ $brief->getTypeDescription() }}">
             <i class="fa fa-question-circle"></i>
        </span>
    </small>
    <br/>
    <small class="text-muted">{{ $project->name }} - Prepared on {{ $brief->getFinishedAtString() }}</small>
</h1>

@if (hasRole('admin'))
<p class="m-a-0">
    <small><a data-pjax class="text-danger" href="/project/{{ $project->slug }}/briefs/{{ $brief->id }}/edit"><i class="fa fa-edit"></i> Edit Brief</a></small>
</p>
@endif

<div class="clearfix"></div>

<div class="hr-divider m-b m-t">
    <h3 class="hr-divider-content hr-divider-heading">
        Summary
    </h3>
</div>

<div class="row">
    @foreach ($brief->briefBoxes() as $box)
    <div class="col-sm-4">
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-html="true"
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

                <p>{{ $brief->text['summary'] }}</p>

                <table class="table table-middle m-b-0">

                    <tbody>
                    <tr>
                        <th class="text-center">
                            <h4 class="m-t-0"><i class="fa fa-calendar"></i><br/>
                                <small>Delivery Date</small>
                            </h4>
                        </th>
                        <td>

                            <div><!--v-if invoiceExists-->
                                <p>This project can be completed in as soon as 3 business days - 10 business days, depending
                                    on which speed you pick on the invoice page.</p>

                                <p>All of our projects come with guaranteed delivery dates.</p>
                            </div>

                            <div><!--v-if invoiceDoesNotExist -->
                                <p>The delivery dates have not been added for this brief yet.  Please contact your project engineer.</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th class="text-center">
                            <h4><i class="fa fa-credit-card"></i><br/>
                                <small>Cost</small>
                            </h4>
                        </th>
                        <td>

                            <div><!--v-if invoiceExists-->
                            <p>
                                The guaranteed cost for this project is $1,000 - $3,000, depending on which delivery speed you pick on the invoice page. <a href="#"><strong>View Invoice</strong></a>.
                            </p>
                            </div>

                            <div><!--v-if invoiceDoesNotExist -->
                                <p>An invoice has not been created yet for this development brief.  Please contact your project engineer.</p>
                            </div>
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

                @if (isset($brief->text['global']['menu_items']))
                <div class="row">
                    <h4>Menu Items</h4>

                    <ul class="nav nav-pills" role="tablist">
                        @foreach ($brief->text['global']['menu_items'] as $j => $menuItem)
                        <li role="presentation" class="{{ $j == 0 ? 'active' : '' }}">
                            <a role="tab"
                               data-toggle="tab"
                               href="#menu-item-{{ $j }}">{{ $menuItem['header'] }}</a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="clearfix"></div>

                    <div class="tab-content">
                        @foreach ($brief->text['global']['menu_items'] as $j => $menuItem)
                        <div role="tabpanel" class="col-sm-9 tab-pane{{ $j == 0 ? ' active' : '' }}" id="menu-item-{{ $j }}">
                            <div class="trix-markup">
                                {!! $menuItem['content'] !!}
                            </div>

                            @include('projects.partials.brief-view-checklist', [
                                'brief' => $brief,
                                'checklist' => $menuItem['checklist']
                            ])
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($brief->text['global']['theme_menus']))
                    <div class="row">
                        <h4>Theme Menus</h4>

                        <ul class="nav nav-pills" role="tablist">
                            @foreach ($brief->text['global']['theme_menus'] as $j => $themeMenu)
                                <li role="presentation" class="{{ $j == 0 ? 'active' : '' }}">
                                    <a role="tab"
                                       data-toggle="tab"
                                       href="#theme-menu-{{ $j }}">{{ $themeMenu['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach ($brief->text['global']['theme_menus'] as $j => $themeMenu)
                                <div role="tabpanel" class="col-sm-9 tab-pane{{ $j == 0 ? ' active' : '' }}" id="theme-menu-{{ $j }}">
                                    <p>{{ $themeMenu['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                            <ul class="nav nav-pills" role="tablist">
                                @foreach ($section['sub_sections'] as $j => $sub)
                                <li role="presentation" class="{{ $j == 0 ? 'active' : '' }}">
                                    <a role="tab"
                                       data-toggle="tab"
                                       href="#subsection-tabs-{{$i}}-{{$j}}">{{ $sub['header'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div><!--col-->

                        <div class="tab-content">
                            @foreach ($section['sub_sections'] as $j => $sub)
                            <div role="tabpanel" class="col-sm-9 tab-pane{{ $j == 0 ? ' active' : '' }}" id="subsection-tabs-{{$i}}-{{$j}}">
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
                </div>
                @endforeach
            @endif

            @if(isset($brief->text['templates']))
                @foreach ($brief->normalizeTemplates($brief->text['templates']) as $i => $template)
                <div class="tab-pane" id="templates-tab-{{ $i }}">

                    <h3 class="m-t-0 p-t-0">{{ $template['name'] }}</h3>

                    <p>{{ $template['summary'] }}</p>

                    @include('projects.partials.brief-view-checklist', [
                        'brief' => $brief,
                        'checklist' => $template['checklist'],
                    ])

                    @if (isset($template['design_proofs']))
                        @include('projects.partials.brief-view-design-proofs', [
                            'brief' => $brief,
                            'proofs' => $template['design_proofs']
                        ])
                    @endif
                </div>
                @endforeach
            @endif

            @if(isset($brief->text['post_types']))
                @foreach ($brief->normalizePostTypes($brief->text['post_types']) as $i => $ptype)
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
                            <td>{{ isset($ptype['single_post_view']) ? $ptype['single_post_view']['name'] : '' }}</td>
                        </tr>
                        <tr>
                            <th>Taxonomies</th>
                            <td>
                                <ul class="m-a-0 list-unstyled">
                                    @foreach($ptype['taxonomies'] as $taxonomy)
                                        <li>{{ $taxonomy['name'] }}</li>
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
                            <td>{{ isset($ptype['post_archive_view']) ? $ptype['post_archive_view']['name'] : '' }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Post Data (Meta)</th>
                            <td>
                                <ul class="m-a-0 list-unstyled">
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
                                <ul class="m-a-0 list-unstyled">
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

                    <div class="trix-markup">
                        {!! $endpoint['expected_output_action'] !!}
                    </div>

                </div>
                @endforeach
            @endif

            @if(isset($brief->text['views']))
                @foreach ($brief->normalizeViews($brief->text['views']) as $i => $view)
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

                    @if (isset($view['design_file']))
                        <h4>Design File</h4>
                        <p>This design can be found in the <a href="/project/{{ $project->slug }}/files" target="_blank">{{ $view['design_file']['name'] }}</a> file in the project files section.</p>
                    @endif

                </div>
                @endforeach
            @endif

            @if(isset($brief->text['modals']))
                @foreach ($brief->normalizeModals($brief->text['modals']) as $i => $modal)
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

                        @if (isset($modal['design_file']))
                        <h4>Design File</h4>
                        <p>This design can be found in the <a href="/project/{{ $project->slug }}/files" target="_blank">{{ $modal['design_file']['name'] }}</a> file in the project files section.</p>
                        @endif

                    </div>

                </div>
                @endforeach
            @endif

        </div>
    </div>
</div>