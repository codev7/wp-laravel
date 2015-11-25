<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

@if(isProduction())
    <script src="{{ elixir('js/vendor.js') }}"></script>
    <script src="{{ elixir('js/cmv-js.js') }}"></script>
@else
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/cmv-js.js') }}"></script>
@endif

@if (Session::has('flash_message'))
    <script>
    @foreach (Session::get('flash_message') as $message)
        swal({title: {{ ucfirst($message['status']) }}, text: '{{ $message['message'] }}', type: '{{ $message['status'] }}' });
    @endforeach
    </script>
@endif