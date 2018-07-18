@component('mail::message')
<h1>Hello Beloved, From {{ setting('church_name') }}</h1>

<p>Hey! New Sermon Titled: {{ $title }}</p>
![img] <a href="{{ $url }}" class="link" target="_blank"> <img src="{{ asset('storage/uploads/posts/photos/thumbnails/'.$photo) }}" class="img-responsive img-thumbnail"/></a>
{{ $body }}

@component('mail::button', ['url' => $url])
read more
@endcomponent

@component('mail::subcopy')
<a href="{{ route('get-unsubscribe') }}" class="link">Click to unsubscribe from this Mailing List.</a>
@endcomponent
@endcomponent

