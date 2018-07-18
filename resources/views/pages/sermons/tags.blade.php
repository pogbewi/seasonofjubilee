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
                <img src="{{ setting('sermon_page_photo') ? '/storage/'.setting('sermon_page_photo') : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="h1">Sermons</span>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="height50"></div>
    <div class="clearfix"></div>
    <div class="container">
        <h1 class="h2 text-center black uppercase">Sermons Associted With Tag {{  $slug }}</h1>
        <div class="clear height50"></div>
        <div class="row eventlist">
            @foreach($sermons as $sermon)
                    <div class="col-sm-4 col-md-3 paddingoff">
                        <a href="{{ route('sermons.show', $sermon->slug) }}" title="{{ $sermon->title }}">
                            @if($sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last() != '')
                                <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last()->filename)  }}" alt="{{ $sermon->title }}"  class="img-responsive blogpost">
                            @elseif($sermon->media->whereIn('type', ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'video/mpeg'])->last() != '')
                                <video controls poster="{{ asset($sermon->media->where('type', 'video/mp4')->last()->video_thumb) }}" style="width: 100%;padding: 0.5rem 0 0 0.5rem" class="img-responsive margintop20">
                                    <source src="{{ asset('storage/media/upload/sermon/video/'.$sermon->media->where('type', 'video/mp4')->last()->filename) }}" type="video/mp4">
                                    Your browser does not support video tag
                                </video>
                            @endif
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-5 mtop10">
                        <div class="fontsize16 bold gold ellipsis"><a href="{{ route('sermons.show', $sermon->slug) }}" title="{{ $sermon->title }}" class="gold decorationoff">{{ $sermon->title }}</a></div>
                        <div class="clear height5"></div>
                        <div class="fontsize12 ash"><span class="lnr lnr-clock ash bold"></span> {{ \Carbon\Carbon::parse($sermon->scheduled_on)->diffForHumans() }}</div>
                        <div class="clear height5"></div>
                        <div class="fontsize14 black"><span class="lnr lnr-map-marker black bold"></span> {{ $sermon->category->name }}</div>
                    </div>
                    <div class="col-sm-2 col-md-2 mtop30">
                        <div><span class="edate fontsize70 gold bold">{{ \Carbon\Carbon::parse($sermon->scheduled_on)->format('d') }}</span><br/><span class="ash fontsize16 text-right mleft10">{{ \Carbon\Carbon::parse($sermon->scheduled_on)->format('M') }}</span></div>
                    </div>
                    <div class="clear height40"></div>
                    <div class="clear borderbottom paddingoff"></div>
            @endforeach
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <!-- start pagination -->
            {{ $sermons->render() }}
        </div>
        <div class="clear height30"></div>
        <div class="epagi"></div>
        <div class="height100"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>

    @include('partials.footer')
@endsection