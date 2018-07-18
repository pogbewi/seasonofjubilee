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
                @if(setting('blog_page_photo') != '')
                    <img src="{{ setting('blog_page_photo') ? '/storage/'.setting('blog_page_photo') : '' }}" class="img-responsive bannerheight">
                @endif
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="h1">Posts</span>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <div class="container">
        <div class="clear height50"></div>
        <h1 class="h2 text-center black uppercase">Posts Associted With Tag {{  $slug }}</h1>
        <div class="row eventlist">
            @foreach($posts as $post)
                    <div class="col-sm-6 col-md-3 paddingoff">
                        <a href="{{ route('posts.show', $post->slug) }}" title="{{ $post->title }}">
                            <img src="{{ asset('storage/uploads/posts/photos/thumbnails/'.$post->photo)  }}" alt="{{ $post->title }}"  class="img-responsive blogpost">
                        </a>
                    </div>
                    <div class="col-sm-4 col-md-5 mtop10">
                        <div class="fontsize16 bold gold ellipsis"><a href="{{ route('posts.show', $post->slug) }}" title="{{ $post->title }}" class="gold decorationoff">{{ $post->title }}</a></div>
                        <div class="clear height5"></div>
                        <div class="fontsize12 ash"><span class="lnr lnr-clock ash bold"></span> {{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</div>
                        <div class="clear height5"></div>
                        <div class="fontsize14 black"><span class="lnr lnr-person black bold"></span> Category: {{ $post->category->name }}</div>
                    </div>
                    <div class="col-md-2 mtop30">
                        <div><span class="edate fontsize70 gold bold">{{ \Carbon\Carbon::parse($post->published_at)->format('d') }}</span><br/><span class="ash fontsize16 text-right mleft10">{{ \Carbon\Carbon::parse($post->published_at)->format('M') }}</span></div>
                    </div>
                    <div class="clear height40"></div>
                    <div class="clear borderbottom paddingoff"></div>

            @endforeach
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <!-- start pagination -->
            {{ $posts->render() }}
        </div>
        <div class="clear height30"></div>
        <div class="epagi"></div>
        <div class="height100"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>

    @include('partials.footer')
@endsection