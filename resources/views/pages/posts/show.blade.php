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
                        <span class="captial fontsize20 lineheight50">Blog</span><br/>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="pagetitle" align="center">
        <h1 class="white text-center">
            <span class="fcaptial thisfont thislineheight gold black">{{ $post->title }}</span>
        </h1>
    </div>
    <div class="video">
        <div class="container">
            <div class="height50"></div>
            <div class="col-md-8">
                <div class="bloglist">
                    <div class="blogbg">
                        <div class="postdate"><p class="calendar"> {{ \Carbon\Carbon::parse($post->published_at)->format('d') }} <em>{{ \Carbon\Carbon::parse($post->published_at)->format('M') }}</em></p></div>
                        <div class="">
                            <img src="{{ asset('storage/uploads/posts/photos/'.$post->photo) }}" class="img-responsive blogpost" title="{{ $post->title }}">
                        </div>
                        <div>
                        </div>
                        <div class="blogbody">
                            <div class="h3 black ellipsis">{{ $post->title }}</div>
                            <div class="clear height10"></div>
                            <div class="para black">{{ $post->body }}</div>
                            <div class="clear height30"></div>
                            <div class="share-items text-center" data-title="{{ $post->title }}" data-hash="{{ $post->title }}" data-url="{{ route('posts.show',$post->slug) }}">
                                <div class="socialshare text-center">
                                    <ul class="share-links">
                                        <li>
                                            <a class="twitterBtn" data-dir="left" href="#" >
                                                <span>Share On:</span>
                                                <span class="twitter-count"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="facebookBtn" href="#">
                                                <span>Facebook</span>
                                                <span class="facebook-count"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="linkedinBtn" href="#">
                                                <span>LinkedIn</span>
                                                <span class="linkedin-count"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="googleBtn" href="#">
                                                <span>Google</span>
                                                <span class="google-count"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <span>Total</span>
                                            <span class="total-count"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clear height50"></div>
                            <div class="text-left">
                                <span class="bold black"><i class="lnr lnr-tag bold"></i> Post Tags :</span>
                                   <span>
                                       @if(count($post->tags) > 0)
                                           @foreach($post->tags as $tag)
                                               <a href="{{ route('posts.tags', $tag->normalized) }}" class="white goldbg">{{ $tag->name }}</a>
                                           @endforeach
                                       @endif
                                    </span>
                            </div>
                            <div class="clear height30"></div>
                            <div class="comments-wrapper text-center">
                                <div class="h4 black">Comment(s)</div>
                                @component('pages.partials.comment', [
                                  'comments' => $post->comments,
                                  'model' => $post,
                                  'url' => 'comments.posts.store'
                                 ])
                                @endcomponent
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="height50"></div>
            </div>
            <div class="col-md-4 mtop">
                <div class="borderbottom">
                    <h3 class="h4 heading topoff">
                        Popular Post
                    </h3>
                </div>
                @foreach($popular as $viral)
                    <div class="clear height20"></div>
                    <div>
                        <div class="col-md-4 paddingoff">
                            <a href="{{ route('posts.show',$viral->slug) }}" title="{{ $viral->title }}"><img src="{{ asset('storage/uploads/posts/photos/thumbnails/'.$viral->photo) }}" class="img-responsive blogpost"></a>
                        </div>
                        <div class="col-md-8 paddingleft10rightoff">
                            <div class="black para poptitle ellipsis"><a href="{{ route('posts.show',$viral->slug) }}" title="{{ $viral->title }}" class="black decorationoff hoveroff">{{ $viral->title }}</a></div>
                            <div class="ash fontsize12">{{ \Carbon\Carbon::parse($viral->published_at)->format('M d Y @ h:i:s a ') }}</div>
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