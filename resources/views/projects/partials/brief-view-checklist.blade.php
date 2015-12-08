@if(count($checklist))
    <h4>Checklist Items
        @if (isset($tooltip))
        <i data-title="{{ $tooltip }}" class="tooltipper fa fa-question-circle" data-original-title="" title=""
           v-tooltip></i>
        @endif
    </h4>

    <?php $checklist = $brief->normalizeChecklist($checklist); ?>

    @if (count($checklist))
        @if (isset($checklist[0]))
            {{--checklist without tabs--}}
            @foreach ($checklist as $item)
                <div class="checkbox custom-control custom-checkbox">
                    <label class="w-full">
                        <input type="checkbox" checked="">
                        <span class="custom-control-indicator"></span>

                        {{ $item['description'] }}

                        @if (isset($item['screenshots']))
                            @foreach ($item['screenshots'] as $shot)
                                &nbsp; <a class="full-screen-screenshot fa fa-file-image-o" href="{{ $shot['path'] }}"></a>
                            @endforeach
                        @endif
                    </label>
                </div>
            @endforeach
        @else
            {{--checklist w tabs--}}
            <?php $tabsId = random_str(); ?>

            <ul class="nav nav-pills">
            @foreach ($checklist as $category => $items)
                <li class="{{ $items === reset($checklist) ? 'active' : '' }}">
                    <a href="#{{$tabsId . str_replace(['/', ' '], '', $category)}}" data-toggle="tab" aria-expanded="false">{{ $category }}</a>
                </li>
            @endforeach
            </ul>

            <div class="tab-content m-t">
            @foreach ($checklist as $category => $items)
                <div class="tab-pane {{ reset($checklist) === $items ? 'active' : '' }}" role="tabpanel" id="{{$tabsId . str_replace(['/', ' '], '', $category)}}">

                @foreach ($items as $item)
                    <div class="checkbox custom-control custom-checkbox">
                        <label class="w-full">
                            <input type="checkbox" checked="">
                            <span class="custom-control-indicator"></span>

                            <p>{{ $item['description'] }}</p>

                            @if (isset($item['screenshots']))
                                @foreach ($item['screenshots'] as $shot)
                                    &nbsp; <a class="full-screen-screenshot fa fa-file-image-o" href="{{ $shot['path'] }}"></a>
                                @endforeach
                            @endif
                        </label>
                    </div>
                @endforeach
                </div>
            @endforeach
            </div><!--tab-content-->
        @endif
    @endif
@endif