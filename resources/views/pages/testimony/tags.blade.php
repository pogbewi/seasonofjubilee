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
                <img src="{{ setting('testimony_page_photo') ? '/storage/'.setting('testimony_page_photo') : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="h1">Sermons</span>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="pagetitle" align="center">

    </div>
    <div class="container">
        <div class="height50"></div>
        <h1 class="h2 text-center black uppercase bold">Testimonies Associted With Tag {{  $slug }}</h1>
        <div class="clear height50"></div>
        <div class="clear height30"></div>
        <div class="row eventlist">

            @foreach($testimonies as $testimony)
                <div class="container">
                    <div class="col-md-3 paddingoff">
                        <a href="{{ route('testimony.show', $testimony->slug) }}" title="{{ $testimony->subject }}">
                            <img src="{{ asset('storage/uploads/testimony/images/thumbnails/'.$testimony->photo)  }}" alt="{{ $testimony->subject }}"  class="img-responsive blogpost">
                        </a>
                    </div>
                    <div class="col-md-5 mtop10">
                        <div class="fontsize16 bold gold ellipsis"><a href="{{ route('testimony.show', $testimony->slug) }}" title="{{ $testimony->subject }}" class="gold decorationoff">{{ $testimony->subject }}</a></div>
                        <div class="clear height5"></div>
                        <div class="fontsize12 ash"><span class="lnr lnr-clock ash bold"></span> {{ \Carbon\Carbon::parse($testimony->published_at)->diffForHumans() }}</div>
                        <div class="clear height5"></div>
                        <div class="fontsize14 black"><span class="lnr lnr-person black bold"></span> Testifier: {{ $testimony->name }}</div>
                    </div>
                    <div class="col-md-2 mtop30">
                        <div><span class="edate fontsize70 gold bold">{{ \Carbon\Carbon::parse($testimony->published_at)->format('d') }}</span><br/><span class="ash fontsize16 text-right mleft10">{{ \Carbon\Carbon::parse($testimony->published_at)->format('M') }}</span></div>
                    </div>
                    <div class="clear height40"></div>
                    <div class="clear borderbottom paddingoff"></div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <!-- start pagination -->
            {{ $testimonies->render() }}
        </div>
        <div class="clear height30"></div>
        <div class="epagi"></div>
        <div class="height100"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>

    @include('partials.footer')
@endsection