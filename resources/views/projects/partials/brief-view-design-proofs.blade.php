<div class="row">
    @foreach ($proofs as $i => $proof)
    <div class="col-sm-3 text-center">
        @foreach ($brief->expandScreenshots($proof['screenshots']) as $shot)
        <a class="full-screen-screenshot" href="{{ $shot['path'] }}">
            <img class="w-full" src="/images/screenshot-icon.png" alt="">
        </a>
        @endforeach
        <small>{{ $proof['name'] }}</small>
    </div>
    @endforeach
</div>