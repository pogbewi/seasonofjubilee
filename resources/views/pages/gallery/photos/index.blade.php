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
                <img src="{{ setting('media_page_photo') ? '/storage/'.setting('media_page_photo') : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays"><h1 class="h1 white text-center">Photo Gallery</h1></div>
            </div>
        </div>
    </section>
    <div class="pagetitle" align="center">
    </div>
    <div class="video">
        <div class="container">
            <div class="height50"></div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="toolbar mb2 mt2">
                        <button class="btn fil-cat avg_very_small_button radiusoff mbottom" href="#" data-rel="all">All</button>
                        @foreach($categories as $category)
                            <button class="btn fil-cat avg_very_small_button radiusoff mbottom" data-rel="{{ $category->slug }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                    <div class="height10"></div>
                    <div id="portfolio">
                        @foreach($photo_galleries as $photo)
                        <div class="tile scale-anm {{ $photo->category->slug }} all">
                            <a href="{{ asset('storage/uploads/galleries/photos/thumbnails/'.$photo->filename) }}" class="lumos-link" data-lumos="demo2">
                                <img src="{{ asset('storage/uploads/galleries/photos/'.$photo->filename) }}" alt="{{ $photo->title }}" class="postbg" />
                            </a>

                            <a href="{{ asset('storage/uploads/galleries/photos/thumbnails/'.$photo->filename) }}" class="lumos-link" data-lumos="demo2">
                                <h2 class="video-text white">{{ $photo->title }}</h2>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    {{ $photo_galleries->render() }}
                </div>
            </div>
            <div class="height50"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection
