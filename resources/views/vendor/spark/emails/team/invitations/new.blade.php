Hi!

<br><br>

{{ $invitation->team->owner->name }} has invited you to join their team in the Code My Views platform! If you do not already have an account,
click the following link to get started:

<br><br>

<a href="{{ route('invitation.register',['token' => $invitation->token]) }}">{{ route('invitation.register',['token' => $invitation->token]) }}</a>

<br><br>

See you soon,
<br>
{{ Spark::company() }}
