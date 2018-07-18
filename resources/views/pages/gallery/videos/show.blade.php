@extends('templates.default')
@section('page_title', $gallery->title)
@section('description', str_limit($gallery->description, 50))
@section('keyword', "Welcome To ".setting('sitename', 'Season Of Jubilee'))
@section('body-class', 'body main-page index')


@section('content')
    @include('partials.header')
    <section id="banner">
        <div id="pagebaner">
            <div>
                <img src="{{ setting('media_page_photo') ? '/storage/'.setting('media_page_photo') : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="captial fontsize20 lineheight50">Gallery</span><br/>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="height50"></div>
    <div class="pagetitle" align="center">
        <h2 class="white text-center">
            <span class="fcaptial thisfont thislineheight gold black">{{ $gallery->title }}</span>
        </h2>
    </div>
    <div class="clearfix"></div>
    <div class="video">
        <div class="container">
            <div class="height50"></div>
            <div class="col-md-8">
                <div class="blogbg">
                    <div  class="single_sermonicon absolute top10">
                        <ul>
                            <li><a href="{{ route('galleries.download',$gallery->slug) }}" download><i class="lnr lnr-download"></i></a></li>
                        </ul>
                    </div>
                    <div class="">
                        <video id="gallery" controls poster="{{ asset($gallery->video_thumb) }}" width="100%" class="lumos-link">
                            <source src="{{ asset('storage/uploads/galleries/videos/'.$gallery->filename) }}" type="video/mp4" class="postbg">
                            Your browser does not support video tag
                        </video>
                    </div>
                    <div class="blogbody">
                        <div class="h3 black">{{ $gallery->title }}</div>
                        <div class="clear height10"></div>
                        <div class="h6 black">Category : <a href="../../staff/46/herman-owens.html" class="gold">{{ $gallery->category->name }}</a></div>
                        <div class="clear height10"></div>
                        <div class="para black col-md-12 editor">{{ $gallery->description }}</div>
                        <div class="clear height30"></div>
                        <div class="share-items text-center" data-title="{{ $gallery->title }}" data-hash="{{ $gallery->title }}" data-url="{{ route('galleries.videos.show',$gallery->slug) }}">
                            <div class="socialshare text-center">
                                <ul class="share-links">
                                    <li>
                                        <a class="twitterBtn" data-dir="left" href="#" >
                                            <span>Twitter</span>
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
                                        <span>Count</span>
                                        <span class="total-count"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear height50"></div>
                        <div class="text-left">
                            <span class="bold black"><i class="lnr lnr-tag bold"></i> Gallery Tags :</span>
                    <span>
                        @if(count($gallery->tags) > 0)
                            @foreach($gallery->tags as $tag)
                                <a href="{{ route('sermons.tags', $tag->normalized) }}" class="white goldbg">{{ $tag->name }}</a>
                            @endforeach
                        @endif
                    </span>

                        </div>
                        <div class="clear height30"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="borderbottom">
                    <h3 class="h4 heading topoff">
                        Latest Video
                    </h3>
                </div>
                <div class="clear height20"></div>
                @foreach($latest as $new)
                    <div>
                        <div class="col-md-4 paddingoff">
                            <a href="{{ route('galleries.videos.show',$new->slug) }}" title="{{ $video->title }}">
                                <video id="gallery" controls poster="{{ asset($new->video_thumb) }}" width="100%" class="lumos-link">
                                    <source src="{{ asset('storage/uploads/galleries/videos/'.$new->filename) }}" type="video/mp4" class="postbg">
                                    Your browser does not support video tag
                                </video>
                                <p class="video-text">{{ $new->title }}</p>
                            </a>
                        </div>
                        <div class="col-md-8 paddingleft10rightoff">
                            <div class="black para poptitle ellipsis"><a href="{{ route('galleries.video.show',$new->slug) }}" title="{{ $new->title }}" class="black decorationoff hoveroff">{{ $new->title }}</a></div>
                            <div class="ash fontsize12">{{ \Carbon\Carbon::parse($new->published_at)->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="clear height20"></div>
                @endforeach

                <div class="clear height50"></div>
                <div class="borderbottom">
                    <h3 class="h4 heading topoff">
                        Most Popular
                    </h3>
                </div>
                <div class="clear height20"></div>
                @foreach($popular as $viewed)
                    <div>
                        <div class="col-md-4 paddingoff">
                            <a href="{{ route('galleries.videos.show',$viewed->slug) }}" title="{{ $video->title }}">
                                <video id="gallery" controls poster="{{ asset($viewed->video_thumb) }}" width="100%" class="lumos-link">
                                    <source src="{{ asset('storage/uploads/galleries/videos/'.$viewed->filename) }}" type="video/mp4" class="postbg">
                                    Your browser does not support video tag
                                </video>
                                <p class="video-text">{{ $viewed->title }}</p>
                            </a>
                        </div>
                        <div class="col-md-8 paddingleft10rightoff">
                            <div class="black para poptitle ellipsis"><a href="{{ route('galleries.video.show', $viewed->slug) }}" title="{{ $viewed->title }}" class="black decorationoff hoveroff">{{ $viewed->title }}</a></div>
                            <div class="ash fontsize12">{{ \Carbon\Carbon::parse($viewed->published_at)->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="clear height20"></div>
                @endforeach
            </div>
        </div>
        <div class="height100"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection