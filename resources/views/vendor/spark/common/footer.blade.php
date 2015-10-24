<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

@if(isProduction())
    <script src="{{ elixir('js/cmv-js.js') }}"></script>
    <script src="{{ elixir('js/cmv-marketing.js') }}"></script>
@else
    <script src="{{ asset('js/cmv-js.js') }}"></script>
    <script src="{{ asset('js/cmv-marketing.js') }}"></script>
@endif

