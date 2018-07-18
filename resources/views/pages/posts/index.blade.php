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
                <div  id="gallery-overlays"><h1 class="white text-center animated fadeInUp slow"><span class="h1">Blog</span></h1></div>
            </div>
        </div>
    </section>
    <div class="pagetitle" align="center">

    </div>
    <div class="video">
        <div class="container">
            <div class="height50"></div>
            <div class="col-md-8">
                <div class="bloglist">
                    @foreach($posts as $post)
                        <div class="blogbg animated slideInLeft">
                            <div class="postdate"><p class="calendar">{{ \Carbon\Carbon::parse($post->published_at)->format('d') }} <em>{{ \Carbon\Carbon::parse($post->published_at)->format('M') }}</em></p></div>
                            <div class="">
                                <a href="{{ route('posts.show',$post->slug) }}" title="{{ $post->title }}"><img src="{{ asset('storage/uploads/posts/photos/thumbnails/'.$post->photo) }}" class="img-responsive blogpost"></a>
                            </div>
                            <div>
                            </div>
                            <div class="blogbody">
                                <div class="h3 black ellipsis">{{ $post->title }}</div>
                                <div class="clear height10"></div>
                                <div class="para black">{{ str_limit($post->body, 200, '...') }}...</div>
                                <div class="clear height10"></div>
                                <div class="gold h5 text-left"><i class="lnr lnr-bubble bold"></i> {{ $post->comments->count() }} Comment</div>
                                <div class="text-right"><a href="{{ route('posts.show',$post->slug) }}" class="avg_very_small_button">Read More</a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagess"></div>
                <div class="height50"></div>
            </div>
            <div class="col-md-4 mtop animated slideInRight">
                <div class="borderbottom">
                    <h3 class="h4 heading topoff">
                        Popular Post
                    </h3>
                </div>
                @foreach($popular as $viral)
                    <div class="clear height20"></div>
                    <div>
                        <div class="col-md-4 paddingoff">
                            <a href="{{ route('posts.show',$viral->slug) }}" title="{{ $viral->title }}"><img src="{{ asset('storage/uploads/posts/photos/thumbnails'.$viral->photo) }}" class="img-responsive blogpost"></a>
                        </div>
                        <div class="col-md-8 paddingleft10rightoff">
                            <div class="black para poptitle ellipsis"><a href="{{ route('posts.show',$viral->slug) }}" title="{{ $viral->title }}" class="black decorationoff hoveroff">{{ $viral->title }}</a></div>
                            <div class="ash fontsize12">{{ \Carbon\Carbon::parse($viral->published_at)->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach
                <div class="clear height20"></div>
            </div>
            <div class="height50"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection