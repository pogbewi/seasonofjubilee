@component('mail::message')
<h1>Hello Beloved!, From {{ setting('church_name') }}</h1>

<p>New Event Titled: {{ $title }}</p>
<p>It starts From: {{ $from }} - To :{{ $to }}</p>
{{ $body }}

@component('mail::button', ['url' => $url])
read more
@endcomponent

@component('mail::subcopy')
<a href="{{ route('get-unsubscribe') }}" class="link">Click to unsubscribe from this Mailing List.</a>
@endcomponent
@endcomponent
