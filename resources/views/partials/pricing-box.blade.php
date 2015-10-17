<div class="panel {{ isset($class) ? $class : null }}">
    <div class="panel-heading">
            <h3 class="text-center">{!! $h3 !!}</h3>
            <h4>{!! $h4 !!}</h4>
    </div>
    <div class="panel-body text-center">
            <span class="starting-at">starting at</span>
            <h5>{!! $pricing !!}</h5>
    </div>
    <ul class="list-group list-group-flush text-center">
            @foreach($list_items as $item)
            <li class="list-group-item">
                    {!! $item !!}
            </li>
            @endforeach
    </ul>
    <div class="panel-footer"> <a class="btn btn-lg btn-block btn-success" href="{{ $link }}">{{ isset($button_text) ? $button_text: 'Get a Quote' }}</a> </div>
</div>