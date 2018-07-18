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
                <img src="{{ setting('other_page_photo') ? '/storage/'.setting('other_page_photo') : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="captial fontsize20 lineheight50">Project</span><br/>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="height50"></div>
    <div class="pagetitle" align="center">
    </div>
    <div class="clearfix"></div>
    <div class="video">
        <div class="container">
            <div class="height50"></div>
            <h1 class="white text-center">
                <span class="fcaptial thisfont thislineheight gold black">{{ $testimony->subject }}</span>
            </h1>
            <div class="height50"></div>
            <div class="col-md-8">
                <div class="blogbg">
                    <div class="">
                        <img src="{{ asset('storage/uploads/projects/images/'.$testimony->photo) }}" alt="{{ $testimony->subject }}" class="img-responsive blogpost">
                    </div>
                    <div class="blogbody">
                        <div class="h3 black">{{ $testimony->subject }}</div>
                        <div class="clear height10"></div>
                        <div class="para black bold">Testifier : <a href="javascript:void(0)" class="gold">{{ $testimony->name }}</a></div>
                        <div class="clear height10"></div>
                        <div class="para black col-md-12 editor">{{ $testimony->body }}</div>
                        <div class="clear height30"></div>
                        <div class="share-items text-center" data-title="{{ $testimony->subject }}" data-hash="{{ $testimony->subject }}" data-url="{{ route('testimony.show',$testimony->slug) }}">
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
                            <span class="bold black"><i class="lnr lnr-tag bold"></i> Testimony Tags :</span>
                    <span>
                        @if(count($testimony->tags) > 0)
                            @foreach($testimony->tags as $tag)
                                <a href="{{ route('testimony.tags', $tag->normalized) }}" class="white goldbg">{{ $tag->name }}</a>
                            @endforeach
                        @endif
                    </span>
                        </div>
                        <div class="clear height30"></div>
                        <div class="comments-wrapper text-center">
                            <div class="h4 black">Comment(s)</div>
                            @component('pages.partials.comment', [
                              'comments' => $testimony->comments,
                              'model' => $testimony,
                              'url' => 'comments.testimonies.store'
                             ])
                            @endcomponent
                        </div>
                    </div>
                </div>
                <div class="clear height30"></div>
            </div>
            <div class="col-md-4">
                <div class="borderbottom">
                    <h3 class="h4 heading topoff">
                        Latest Testimony
                    </h3>
                </div>
                <div class="clear height20"></div>
                @foreach($latest as $new)
                    <div>
                        <div class="col-md-4 paddingoff">
                            <a href="{{ route('testimony.show', $new->slug) }}" title="{{ $new->subject }}">
                                <img src="{{ asset('storage/uploads/testimony/images/thumbnails/'.$new->photo)  }}" alt="{{ $new->title }}"  class="img-responsive blogpost">
                            </a>
                        </div>
                        <div class="col-md-8 paddingleft10rightoff">
                            <div class="black para poptitle ellipsis"><a href="{{ route('testimony.show',$new->slug) }}" title="{{ $new->subject }}" class="black decorationoff hoveroff">{{ $new->subject }}</a></div>
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
                            <a href="{{ route('sermons.show', $viewed->slug) }}" title="{{ $viewed->subject }}">
                                <img src="{{ asset('storage/uploads/testimony/images/thumbnails/'.$viewed->photo)  }}" alt="{{ $viewed->subject }}"  class="img-responsive blogpost">
                            </a>
                        </div>
                        <div class="col-md-8 paddingleft10rightoff">
                            <div class="black para poptitle ellipsis"><a href="{{ route('testimony.show', $viewed->slug) }}" title="{{ $viewed->subject }}" class="black decorationoff hoveroff">{{ $viewed->subject }}</a></div>
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