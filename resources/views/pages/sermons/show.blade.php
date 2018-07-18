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
                    <span class="captial fontsize20 lineheight50">Sermon</span><br/>
                </h1>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<div class="video">
    <div class="container">
        <div class="height50"></div>
        <div class="col-md-8">
            <div class="blogbg">
                <div  class="single_sermonicon absolute top10">
                    <ul>
                        @if(isset($sermon->media->last()->url))
                            <li><a href="{{ $sermon->media->last()->url }}" class="bla-2"><i class="lnr lnr-camera-video"></i></a></li>
                        @endif
                        @if($sermon->media->whereIn('type', ['audio/mpeg'])->last() != '')
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#sermon27"><i class="lnr lnr-music-note"></i></a></li>
                        @endif
                        @if($sermon->media->whereIn('type', ['application/pdf'])->last() != '')
                                <li><a href="{{ route('sermons.viewPDF',$sermon->media->where('type', 'application/pdf')->last()->filename) }}" target="_blank"><i class="lnr lnr-file-empty"></i></a></li>
                                <li><a href="{{ route('sermons.download',$sermon->media->where('type', 'application/pdf')->last()->filename) }}" download><i class="lnr lnr-download"></i></a></li>
                        @endif
                    </ul>
                </div>
                <div class="">
                    @if($sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last() != '')
                        <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last()->filename)  }}" alt="{{ $sermon->title }}" class="img-responsive blogpost">
                    @elseif($sermon->media->whereIn('type', ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'video/mpeg'])->last() != '')
                    <video controls poster="{{ asset($sermon->media->where('type', 'video/mp4')->last()->video_thumb) }}" style="width: 100%;padding: 0.5rem 0 0 0.5rem" class="img-responsive margintop20">
                        <source src="{{ asset('storage/media/upload/sermon/video/'.$sermon->media->where('type', 'video/mp4')->last()->filename) }}" type="video/mp4">
                        Your browser does not support video tag
                    </video>
                    @endif
                </div>
                <div class="modal fade" id="sermon27" tabindex="-1" role="dialog" aria-labelledby="sermon27" aria-hidden="true">
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
                                <input type="button" class="avg_small_border_button" data-dismiss="modal" value="Schließen">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blogbody">
                    <div class="h3 black">{{ $sermon->title }}</div>
                    <div class="clear height10"></div>
                    <div class="para black bold">Pastor : <a href="../../staff/46/herman-owens.html" class="gold">{{ $sermon->preacher }}</a></div>
                    <div class="clear height10"></div>
                    <div class="para black col-md-12 editor">{{ $sermon->body }}</div>
                    <div class="clear height30"></div>
                    <div class="share-items text-center" data-title="{{ $sermon->title }}" data-hash="{{ $sermon->title }}" data-url="{{ route('sermons.show',$sermon->slug) }}">
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
                                    <span>Gesamt</span>
                                    <span class="total-count"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear height50"></div>
                    <div class="text-left">
                        <span class="bold black"><i class="lnr lnr-tag bold"></i> Sermon Tags :</span>
                    <span>
                        @if(count($sermon->tags) > 0)
                            @foreach($sermon->tags as $tag)
                                <a href="{{ route('sermons.tags', $tag->normalized) }}" class="white goldbg">{{ $tag->name }}</a>
                            @endforeach
                        @endif
                    </span>
                    </div>
                    <div class="comments-wrapper text-center">
                            <div class="h4 black">Comment(s)</div>
                            @component('pages.partials.comment', [
                              'comments' => $sermon->comments,
                              'model' => $sermon,
                              'url' => 'comments.sermons.store'
                             ])
                            @endcomponent
                    </div>
                </div>
            </div>
            <div class="clear height50"></div>
            <div class="clear height30"></div>
        </div>
        <div class="col-md-4">
            <div class="borderbottom">
                <h3 class="h4 heading topoff">
                    Latest Sermon
                </h3>
            </div>
            <div class="clear height20"></div>
            @foreach($latest as $new)
                <div>
                    <div class="col-md-4 paddingoff">
                        <a href="{{ route('sermons.show', $new->slug) }}" title="{{ $new->title }}">
                            @if($new->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last() != '')
                                <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$new->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last()->filename)  }}" alt="{{ $new->title }}"  class="img-responsive blogpost">
                            @elseif($new->media->whereIn('type', ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'video/mpeg'])->last() != ''))
                            <video controls poster="{{ asset($new->media->where('type', 'video/mp4')->last()->video_thumb) }}" style="width: 100%;padding: 0.5rem 0 0 0.5rem" class="img-responsive margintop20">
                                <source src="{{ asset('storage/media/upload/sermon/video/'.$new->media->where('type', 'video/mp4')->last()->filename) }}" type="video/mp4">
                                Your browser does not support video tag
                            </video>
                            @endif
                        </a>
                    </div>
                    <div class="col-md-8 paddingleft10rightoff">
                        <div class="black para poptitle ellipsis"><a href="{{ route('sermons.show',$new->slug) }}" title="{{ $new->title }}" class="black decorationoff hoveroff">{{ $new->title }}</a></div>
                        <div class="ash fontsize12">{{ \Carbon\Carbon::parse($new->scheduled_on)->diffForHumans() }}</div>
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
                    <a href="{{ route('sermons.show', $viewed->slug) }}" title="{{ $viewed->title }}">
                        @if($viewed->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last() != '')
                            <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$viewed->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last()->filename)  }}" alt="{{ $viewed->title }}"  class="img-responsive blogpost">
                        @elseif($viewed->media->whereIn('type', ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'video/mpeg'])->last() != '')
                        <video controls poster="{{ asset($viewed->media->where('type', 'video/mp4')->last()->video_thumb) }}" style="width: 100%;padding: 0.5rem 0 0 0.5rem" class="img-responsive margintop20">
                            <source src="{{ asset('storage/media/upload/sermon/video/'.$viewed->media->where('type', 'video/mp4')->last()->filename) }}" type="video/mp4">
                            Your browser does not support video tag
                        </video>
                        @endif
                    </a>
                </div>
                <div class="col-md-8 paddingleft10rightoff">
                    <div class="black para poptitle ellipsis"><a href="{{ route('sermons.show', $viewed->slug) }}" title="{{ $viewed->title }}" class="black decorationoff hoveroff">{{ $viewed->title }}</a></div>
                    <div class="ash fontsize12">{{ \Carbon\Carbon::parse($viewed->scheduled_on)->diffForHumans() }}</div>
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