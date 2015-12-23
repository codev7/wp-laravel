@foreach ($messages as $message)
    <div>
        <div>
            {{ $message->user_name }} on {{ $message->created_at }}
        </div>

        <div>
            {!! $message->content !!}
        </div>
    </div>
@endforeach