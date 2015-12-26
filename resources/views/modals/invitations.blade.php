@if (Auth::user() && Auth::user()->invitations()->count())
    <div data-controller="misc/invitations" state="{{ json_encode(['invitations' => Auth::user()->invitations()->with('team')->get()->toArray()]) }}"></div>
@endif