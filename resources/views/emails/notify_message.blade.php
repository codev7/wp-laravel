<div>
    <div>
        {{ $msg->user->name }} on {{ $msg->created_at }}
    </div>

    <div>
        {!! $msg->content !!}
    </div>
</div>