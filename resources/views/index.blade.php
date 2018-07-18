@extends('templates.default')
@section('page_title', "Welcome To ".setting('site_title', 'Season Of Jubilee'))
@section('description', "Welcome To ".setting('site_description', 'Season Of Jubilee'))
@section('keyword', "Welcome To ".setting('site_keywords', 'church,season jubilee'))
@section('body-class', 'body main-page index')


@section('content')
    @include('partials.header')
    @include('partials.carousel')
    <div class="themebg">
        <div class="clear height20"></div>
            <div class="container">
                <div class="col-md-4 text-center animated fadeInUp slow">
                    <div class="clear height20"></div>
                    <div class="white h4 bold"><i class="lnr lnr-calendar-full top5"></i> NEXT UPCOMING EVENT</div>
                    <div class="h5 white">{{ $upcoming_event ? $upcoming_event->name :''}}</div>
                </div>
                <div class="col-md-5 text-center animated fadeInUp slow">
                    <div class="clear height20"></div>
                    <ul class="countdown">
                        <li>
                            <div class="countspace">
                                <span class="days white h1 bold text-center">00</span>
                                <p class="days_ref white timetxt text-center">days</p>
                            </div>
                        </li>
                        <li class="seperator"></li>
                        <li>
                            <div class="countspace">
                                <span class="hours white h1 bold text-center">00</span>
                                <p class="hours_ref white timetxt text-center">hours</p>
                            </div>
                        </li>
                        <li class="seperator"></li>
                        <li>
                            <div class="countspace">
                                <span class="minutes white h1 bold text-center">00</span>
                                <p class="minutes_ref white timetxt text-center">minutes</p>
                            </div>
                        </li>
                        <li class="seperator"></li>
                        <li>
                            <div class="countspace">
                                <span class="seconds white h1 bold text-center">00</span>
                                <p class="seconds_ref white timetxt text-center">seconds</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 text-center animated fadeInUp slow">
                    <div class="clear height30"></div>
                    <a href="{{ route('events.index') }}" class="avg_white_button bold">View Event</a>
                </div>
            </div>
        <div class="clear height40"></div>
    </div>
    <section class="container">
        <div class="clear height50"></div>
        <h1 class="h2 text-center black uppercase bold animated fadeInUp slow">Our Church</h1>
        <div class="h5 ash text-center animated fadeInUp slow">We Come to World for Serving & Sharing</div>
        <div class="clear height40"></div>
        <div class="row">
            <div class="col-md-6 animated fadeInLeft">

                <img src="{{ getThumbs(setting('homepage_about_photo'),500,300, 'fit') }}" class="img-responsive">
            </div>
            <div class="col-md-6 para black animated fadeInRight">
                @if(null !== setting('about'))
                <div>{!! html_entity_decode(str_limit(setting('about'), 160, "...")) !!}....</div>
                <div class="clear height20"></div><a href="{{ route('about') }}" class="avg_button">Read More</a>
                @endif
            </div>
        </div>
        <div class="clear height50"></div>
    </section>
    <section class="sermon">
        <div class="container">
            <div class="clear height30"></div>
            <h1 class="h2 text-center white uppercase bold animated fadeInUp slow">Latest Sermon</h1>
            <div class="h5 white_ash text-center animated fadeInUp slow">Experience God's Presence</div>
            <div class="clear height30"></div>
            @foreach($sermons as $sermon)
                <div class="col-md-12 whitebox paddingoff marginbottom20 animated fadeInUp slow">
                    <div class="col-md-2 paddingoff m-center">
                        <a href="{{ route('sermons.show', $sermon->slug) }}">
                              @if($sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last() != '')
                                    <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last()->filename)  }}" alt="{{ $sermon->title }}" class="img-responsive margintop20">
                              @elseif($sermon->media->whereIn('type', ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'video/mpeg'])->last() != ''))
                                    <video controls poster="{{ asset($sermon->media->where('type', 'video/mp4')->last()->video_thumb) }}" style="width: 100%;padding: 0.5rem 0 0 0.5rem" class="img-responsive margintop20">
                                        <source src="{{ asset('storage/media/upload/sermon/video/'.$sermon->media->where('type', 'video/mp4')->last()->filename) }}" type="video/mp4">
                                        Your browser does not support video tag
                                    </video>
                              @endif
                        </a>
                    </div>
                    <div class="col-md-7 rightborder">
                        <div class="h4 bold black m-center"><a href="{{ route('sermons.show', $sermon->slug) }}" class="black">{{ $sermon->title }}</a></div>
                        <p class="para black">{{ str_limit($sermon->excerpt, 150, "...") }}</p>
                        <p class="height5"></p>
                        <p class="para m-center"><span class="lnr lnr-clock"></span> {{ Carbon\Carbon::parse($sermon->scheduled_on)->diffForHumans() }}</p>
                        <div class="clear height5"></div>
                    </div>
                    <div class="col-md-3 sermonicon text-center">
                        <p class="height30"></p>
                        <ul class="text-center">
                                @if($sermon->media->whereIn('type', ['audio/mpeg'])->last() != '')
                                    <li><a href="javascript:void(0)" title="mp3" data-toggle="modal" data-target="#sermon16"><i class="lnr lnr-music-note"></i></a></li>
                                @endif
                            @if(isset($sermon->media->last()->url))
                                <li><a href="{{ $sermon->media->last()->url }}" title="video" class="bla-2"><i class="lnr lnr-film-play"></i></a></li>
                            @endif
                            @if($sermon->media->whereIn('type', ['application/pdf'])->last() != '')
                                <li><a href="{{ route('sermons.viewPDF',$sermon->media->where('type', 'application/pdf')->last()->filename) }}" title="pdf"  target="_blank"><i class="lnr lnr-book"></i></a></li></ul>
                            @endif
                        <div class="height30"></div>
                        <div class="text-center"><a href="{{ route('sermons.show', $sermon->slug) }}" class="avg_small_border_button marginbm text-center">Read More</a></div>
                    </div>
                </div>
                <div class="modal fade" id="sermon16" tabindex="-1" role="dialog" aria-labelledby="sermon16" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="lnr lnr-cross gold bold"></span></button>
                                <h4 class="modal-title h4 black" id="myModalLabel">{{ $sermon->title }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="mediPlayer text-center">
                                        @if($sermon->media->whereIn('type', ['audio/mpeg'])->last() != '')
                                        <audio class="listen" preload="none" data-size="250" src="{{ asset('storage/media/upload/sermon/audio/'. $sermon->media->whereIn('type', ['audio/mpeg'])->last()->filename) }}"></audio>
                                        @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="avg_small_border_button" data-dismiss="modal" value="Close">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clear height40"></div>
        </div>
    </section>
    <section class="samplegalery container">
        <div class="clear height50"></div>
        <h1 class="h2 text-center black uppercase bold animated fadeInUp slow">Gallery</h1>
        <div class="h5 ash text-center fadeInUp slow">Our Church Photo Galleries</div>
        <div class="clear height50"></div>
        <div class="clear height20"></div>
        <div class="row">
            <div class="m-center gallery">
                <div class="col-md-6 paddingoff animated fadeInLeft">
                    <div class="col-md-12 padding-5 gallerybox gallery-item">
                        @isset($featured_photo)
                            <a href="{{ asset('storage/uploads/galleries/photos/thumbnails/'.$featured_photo->filename) }}" class="lumos-link" data-lumos="demo2">
                                <img src="{{ asset('storage/uploads/galleries/photos/thumbnails/'.$featured_photo->filename) }}" class="img-responsive grow">
                            </a>
                         @endisset
                    </div>
                </div>
                <div class="col-md-6 paddingoff animated fadeInRight">
                    @foreach($photo_galleries as $photo)
                    <div class="col-md-6 padding-5 gallerybox gallery-item">
                        <a href="{{ asset('storage/uploads/galleries/photos/thumbnails/'.$photo->filename) }}" class="lumos-link" data-lumos="demo2">
                            <img src="{{ asset('storage/uploads/galleries/photos/'.$photo->filename) }}" class="img-responsive grow">
                        </a>
                        <div class="gallery_overlay">

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="clear height50"></div>
    </section>
    <section id="carousel" class="testimonials">
        <div class="container">
            <div class="clear height30"></div>
            <h1 class="h2 text-center white uppercase bold animated fadeInUp slow">Testimonial</h1>
            <div class="h5 white_ash text-center animated fadeInUp slow">Experience God's Presence</div>
            <div class="clear height30"></div>
            <div class="row animated fadeInUp slow">
                <div class="col-md-8 col-md-offset-2">
                    <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                        <ol class="carousel-indicators">
                            @if($testimonies != '')
                                @foreach($testimonies as $key=>$testify)
                                    <li data-target="#fade-quote-carousel" data-slide-to="{{ $testimonies->keys() }}" class="{{ $loop->first ? 'active':'' }}"></li>
                                @endforeach
                            @endif
                        </ol>
                        <div class="carousel-inner">
                            @if($testimonies != '')
                                @foreach($testimonies as $testify)
                                    <div class="{{ $loop->first ? 'active':'' }} item">
                                        <blockquote>
                                            <p class="white_ash text_normal para">"{{ str_limit($testify->body, 120, '...') }}"</p>
                                        </blockquote>

                                        <div class="profile-circle">
                                            <a href="{{ route('testimony.show', $testify->slug) }}">
                                                <img src="{{ asset('storage/uploads/testimonies/images/thumbnails/'.$testify->photo) }}" alt="{{ $testify->subject }}" class="img-responsive round">
                                            </a>
                                        </div>
                                            <div class="animated fadeInDown">
                                                <h3 class="text-center text_bold">
                                                    <a href="{{ route('testimony.show', $testify->slug) }}">
                                                        <strong><span class="color" style="color: #0077B5">{{ $testify->subject }}</span></strong>
                                                    </a>
                                                </h3>
                                            </div>
                                        <p class="white text_normal para text-center" style="font-style: italic"> BY - {{ $testify->name }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="clear height50"></div>
            <h1 class="h2 text-center black uppercase bold animated fadeInUp slow">Our Staff</h1>
            <div class="h5 ash text-center animated fadeInUp slow">The churches must learn humility as well as teach it</div>
            <div class="clear height50"></div>
            <div class="clear height20"></div>

            <div id="mixedSlider">
                <div class="MS-content">
                    @isset($staffs)
                    @foreach($staffs as $staff)
                        <div class="item">
                            <div class="imgTitle">
                                <a href="{{ route('staffs.show',$staff->slug) }}">
                                    <img src="{{ asset('storage/uploads/staffs/photos/thumbnails/'.$staff->avatar) }}" class="{{ $staff->name }}">
                                </a>
                            </div>
                            <h2 class="h4 text-center black bold"><a href="{{ route('staffs.show',$staff->slug) }}" class="black">{{ $staff->name }}</a></h2>
                            <p class="text-center gold para bold">{{ $staff->position }}</p>
                            <div class="clear height10"></div>
                            <div class="stafficon text-center">
                                <ul>
                                    <li><a href="{{ isset($handle->facebook) ? $handle->facebook : '' }}" target="_blank" class="btns"><i class="fa fa-facebook move5" aria-hidden="true"></i></a></li>
                                    <li><a href="{{ isset($handle->twitter) ? $handle->twitter : '' }}" target="_blank" class="btns"><i class="fa fa-twitter move5" aria-hidden="true"></i></a></li>
                                    <li><a href="{{ isset($handle->linkedin) ? $handle->linkedin : '' }}" target="_blank" class="btns"><i class="fa fa-linkedin move5" aria-hidden="true"></i></a></li>
                                    <li><a href="{{ isset($handle->instagram) ? $handle->instagram : '' }}" target="_blank" class="btns"><i class="fa fa-instagram move5" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    @endisset
                </div>
                <div class="MS-controls">
                    <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                    <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        <div class="clear height50"></div>
    </section>

    <section class="container">
        <div class="clear height50"></div>
        <h1 class="h2 text-center black uppercase bold animated fadeInUp slow">Blog</h1>
        <div class="h5 ash text-center animated fadeInUp slow">Our Church Blog Post</div>
        <div class="clear height50"></div>
        <div class="clear height20"></div>
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4 animated fadeInUp slow">
                <div class="col-md-12 paddingoff">
                    <div>
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <img src="{{ asset('storage/uploads/posts/photos/thumbnails/'.$post->photo) }}" alt="{{ $post->title }}" class="img-responsive postbg">
                        </a>
                    </div>
                    <div class="postbox blog_min_height">
                        <div class="clear height10"></div>
                        <div class="h5 bold black text-left">{{ $post->title }}</div>
                        <div class="clear height10"></div>
                        <p class="para small"><span class="lnr lnr-clock"></span> {{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</p>
                        <div class="clear height10"></div>
                        <p class="para black">{!! html_entity_decode(str_limit($post->body, 200, "...")) !!}...</p>
                        <div class="clear height20"></div>
                        <div><a href="{{ route('posts.show', $post->slug) }}" class="avg_small_button">Read More</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="clear height50"></div>
    </section>

    <section>
        <div class="container">
            <h1 class="h2 text-center black uppercase bold animated fadeInUp slow">Previous Events</h1>
            <div class="h5 ash text-center animated fadeInUp slow">Church Events</div>
            <div class="clear height50"></div>
            <div class="clear height20"></div>

            <div id="mixedSlider">
                <div class="MS-content">
                    @foreach($past_events as $past_event)
                        <div class="col-md-3 paddingoff">
                            <a href="{{ route('events.show', $past_event->slug) }}" title="{{ $past_event->name }}">
                                @if($past_event->filename == null)
                                    <img src="http://placeit.com" class="img-responsive blogpost">
                                @else
                                    @if(in_array($past_event->type, ['image/jpeg', 'image/gif', 'image/png', 'image/jpg']))
                                        <img src="{{ asset('storage/uploads/events/images/thumbnails/'.$past_event->filename)  }}" alt="{{ $past_event->name }}" class="thumbnail img-responsive blogpost" width="100%"/>
                                    @elseif(in_array($past_event->type, ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'mpeg']))
                                        <video controls poster="{{ asset($past_event->video_thumb) }}" style="width: 100%">
                                            <source src="{{ asset('storage/uploads/events/files/'.$past_event->filename) }}" type="video/mp4">
                                            Your browser does not support video tag
                                        </video>
                                    @endif
                                @endif

                            </a>
                        </div>
                        <div class="col-md-5 mtop10">
                            <div class="fontsize16 bold black ellipsis"><a href="{{ route('events.show', $past_event->slug) }}" title="{{ $past_event->name }}" class="gold decorationoff">{{ $past_event->name }}</a></div>
                            <div class="clear height5"></div>
                            <div class="fontsize12 ash"><span class="lnr lnr-clock ash bold"></span> {{ \Carbon\Carbon::parse($past_event->start_date)->format('M d Y @ h:i a') }} - {{ \Carbon\Carbon::parse($past_event->end_date)->format('M d Y @ h:i:s a ') }}</div>
                            <div class="clear height5"></div>
                            <div class="fontsize14 black"><span class="lnr lnr-map-marker black bold"></span> {{ $past_event->address }}</div>
                        </div>
                        <div class="col-md-2 mtop30">
                            <div><span class="edate fontsize70 gold bold">{{ \Carbon\Carbon::parse($past_event->start_date)->format('d') }}</span><br/><span class="ash fontsize16 text-right mleft10">{{ \Carbon\Carbon::parse($past_event->start_date)->format('M') }}</span></div>
                        </div>
                        @if($past_event->registrable)
                            <div class="col-md-2 mtop30">
                                <a href="{{ route('events.show',$past_event->slug) }}" class="avg_small_button">Register Now</a>
                            </div>
                        @endif
                        <div class="clear height40"></div>
                        <div class="clear borderbottom paddingoff"></div>
                    @endforeach
                </div>
            </div>
        </div>
    <div class="clear height50"></div>
    </section>

    <section class="container">
        <div class="clear height50"></div>
        <h1 class="h2 text-center black uppercase bold animated fadeInUp slow">church Projects</h1>
        <div class="h5 ash text-center animated fadeInUp slow">I Will Build The Church And The Gates OF Hell Shall Not Prevail Againt It Matthew 16:18</div>
        <div class="clear height50"></div>
        <div class="clear height20"></div>
        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-4 animated fadeInUp slow">
                    <div class="col-md-12 paddingoff">
                        <div>
                            <a href="{{ route('project.show', $roject->slug) }}">
                                <img src="{{ asset('storage/uploads/posts/projects/thumbnails/'.$project->photo) }}" alt="{{ $project->title }}" class="img-responsive postbg">
                            </a>
                        </div>
                        <div class="postbox blog_min_height">
                            <div class="clear height10"></div>
                            <div class="h5 bold black text-left">{{ $project->title }}</div>
                            <div class="clear height10"></div>
                            <p class="para small"><span class="lnr lnr-clock"></span> {{ \Carbon\Carbon::parse($project->published_at)->diffForHumans() }}</p>
                            <div class="clear height10"></div>
                            <p class="para black">{!! html_entity_decode(str_limit($project->destription, 200, "...")) !!}...</p>
                            <div class="clear height20"></div>
                            <div><a href="{{ route('roject.show', $project->slug) }}" class="avg_small_button">Read More</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clear height50"></div>
    </section>

    <section>
        <div class="container">
            <h1 class="h2 text-center black uppercase bold animated fadeInUp slow">Special Videos</h1>
            <div class="h5 ash text-center animated fadeInUp slow">The word of God is sharper than any two edge sword... 2 corinthians 3:18</div>
            <div class="clear height50"></div>
            <div class="clear height20"></div>

            <div id="mixedSlider">
                <div class="MS-content">
                    @isset($video_galleries)
                    @foreach($video_galleries as $video_gallery)
                        <div class="item">
                            <div class="imgTitle">
                                <a href="{{ route('galleries.videos.show',$video_gallery->slug) }}">
                                    <img src="{{ asset($video_gallery->video_thumb) }}" class="{{ $video_gallery->title }}">
                                </a>
                            </div>
                            <h2 class="h4 text-center black bold"><a href="{{ route('galleries.videos.show',$video_gallery->slug) }}" class="black">{{ $video_gallery->title }}</a></h2>
                            <p class="text-center gold para bold">{{ $video_gallery->category->name }}</p>
                            <div class="clear height10"></div>
                            <div class="stafficon text-center">
                                <a href="{{ route('galleries.videos.show',$video_gallery->slug) }}" class="avg_small_border_button marginbm text-center">Read More</a>
                            </div>
                        </div>
                    @endforeach
                    @endisset
                </div>
                <div class="MS-controls">
                    <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                    <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        <div class="clear height50"></div>
        <div class="clearfix"></div>
    </section>

@include('partials.footer')
@endsection
@push('scripts')
<script class='source' type="text/javascript" src="/js/timer.js"></script>
<script type="text/javascript">
    $(function(){
        var start_date = '{{ @$start_date }}';
        if(start_date != ''){
            $('.countdown').downCount({
                date: start_date,
                offset: +10
            }, function () {

            });
        }

        var sermon_image_src = '{{ getThumbs(setting('homepage_sermon_photo'),500,300, 'fit') }}';
        $('.sermon').css('background', 'url('+ sermon_image_src +')')
                .css('box-shadow', 'inset 0 0 0 1000px rgba(2,2,2,.70)');


        var testimony_image_src = '{{ getThumbs(setting('homepage_testimony_photo'),1600,300, 'fit') }}';
        $('.testimonials').css('background-image', 'url('+ testimony_image_src +')')
                .css('box-shadow', 'inset 0 0 0 1000px rgba(23, 9, 23, 0.5)');
    })
</script>
@endpush
