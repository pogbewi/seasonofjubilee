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
                <div  id="gallery-overlays"> <h1 class="white text-center animated fadeInUp slow"><span class="h1">Testimonies</span></h1></div>
            </div>
        </div>
    </section>
    <div class="pagetitle" align="center">

    </div>
    <div class="clearfix"></div>
    <div class="video">
        <div class="container">
            <div class="height50"></div>
            <div class="row sermonlist">
                @foreach($testimonies as $testimony)
                    <div class="col-md-4 text-center">
                        <div class="col-md-12 paddingoff text-center">
                            <div>
                                <a href="{{ route('testimony.show', $testimony->slug) }}">
                                    <img src="{{ asset('storage/uploads/testimonies/images/'.$testimony->photo) }}" alt="{{ $testimony->subject }}" class="img-responsive margintop20">
                                </a>
                            </div>
                            <div class="postbox sermon_min_height">
                                <div class="clear height10"></div>
                                <div class="fontsize17 lineheight30 bold black text-center ellipsis"><a href="{{ route('testimony.show', $testimony->slug) }}" class="black">{{ $testimony->subject }}</a></div>
                                <div class="clear height5"></div>
                                <div class="para black bold text-center">Testifier : <a href="javascript:void(0)" class="gold">{{ $testimony->name }}</a></div>
                                <div class="clear height5"></div>
                                <p class="para black">{{ str_limit($testimony->body, 150, "...") }}</p>
                                <div class="clear height20"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagi">{{ $testimonies->render() }}</div>
            <div class="height50"></div>
        </div>
        <div class="height100"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection