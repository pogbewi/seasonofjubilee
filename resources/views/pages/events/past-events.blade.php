@extends('templates.default')
@section('page_title', $page_title)
@section('description', $page_description)
@section('keyword', $page_keywords)
@section('body-class', 'body main-page index')


@section('content')
    @include('partials.header')

    <section id="banner">
        <div id="pagebaner">
            <div>
                <img src="{{ setting('event_page_photo') ? '/storage/'.setting('event_page_photo') : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays"> <h1 class="white text-center animated fadeInUp slow"><span class="h1">Events</span></h1></div>
            </div>
        </div>
    </section>
    <div class="clear height30"></div>
    <div class="container">
        <h1 class="h2 text-center black uppercase">Previous Events</h1>
        <div class="clear height50"></div>
        <div class="row eventlist">

            @foreach($past_events as $event)
                <div class="container">
                    <div class="col-md-3 paddingoff">
                        <a href="{{ route('events.show', $event->slug) }}" title="{{ $event->name }}">
                            @if($event->filename == null)
                                <img src="http://placeit.com" class="img-responsive blogpost">
                            @else
                                @if(in_array($event->type, ['image/jpeg', 'image/gif', 'image/png', 'image/jpg']))
                                    <img src="{{ asset('storage/uploads/events/images/thumbnails/'.$event->filename)  }}" alt="{{ $event->name }}" class="thumbnail img-responsive blogpost" width="100%"/>
                                @elseif(in_array($event->type, ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'mpeg']))
                                    <video controls poster="{{ asset($event->video_thumb) }}" style="width: 100%">
                                        <source src="{{ asset('storage/uploads/events/files/'.$event->filename) }}" type="video/mp4">
                                        Your browser does not support video tag
                                    </video>
                                @endif
                            @endif

                        </a>
                    </div>
                    <div class="col-md-5 mtop10">
                        <div class="fontsize16 bold black ellipsis"><a href="{{ route('events.show', $event->slug) }}" title="{{ $event->name }}" class="gold decorationoff">{{ $event->name }}</a></div>
                        <div class="clear height5"></div>
                        <div class="fontsize12 ash"><span class="lnr lnr-clock ash bold"></span> {{ \Carbon\Carbon::parse($event->start_date)->format('M d Y @ h:i a') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('M d Y @ h:i:s a ') }}</div>
                        <div class="clear height5"></div>
                        <div class="fontsize14 black"><span class="lnr lnr-map-marker black bold"></span> {{ $event->address }}</div>
                    </div>
                    <div class="col-md-2 mtop30">
                        <div><span class="edate fontsize70 gold bold">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span><br/><span class="ash fontsize16 text-right mleft10">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</span></div>
                    </div>
                    @if($event->registrable)
                        <div class="col-md-2 mtop30">
                            <a href="{{ route('events.show',$event->slug) }}" class="avg_small_button">Register Now</a>
                        </div>
                    @endif
                    <div class="clear height40"></div>
                    <div class="clear borderbottom paddingoff"></div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <!-- start pagination -->
            {{ $past_events->render() }}
        </div>
        <div class="clear height30"></div>
        <div class="epagi"></div>
        <div class="height100"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>

    @include('partials.footer')
@endsection