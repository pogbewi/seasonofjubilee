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
            <img src="{{ getThumbs(setting('sermon_page_photo'),1600,1600, 'resize') }}" class="img-responsive bannerheight">
            <div  id="gallery-overlays"><h1 class="white text-center animated fadeInUp slow"><span class="h1">Sermons</span></h1></div>
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
        <div class="row sermonlist">
            @foreach($sermons as $sermon)
                <div class="col-md-4 text-center">
                    <div class="col-md-12 paddingoff text-center">
                        <div>
                         @isset($sermon->media)
                            <a href="{{ route('sermons.show', $sermon->slug) }}">
                                @if(null !== $sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last())
                                    <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last()->filename)  }}" alt="{{ $sermon->title }}" class="img-responsive margintop20">
                                @elseif($sermon->media->whereIn('type', ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'video/mpeg'])->last() != '')
                                    <video controls poster="{{ asset($sermon->media->where('type', 'video/mp4')->last()->video_thumb) }}" style="width: 100%;padding: 0.5rem 0 0 0.5rem" class="img-responsive margintop20">
                                        <source src="{{ asset('storage/media/upload/sermon/video/'.$sermon->media->where('type', 'video/mp4')->last()->filename) }}" type="video/mp4">
                                        Your browser does not support video tag
                                    </video>
                                @endif
                            </a>
                         @endisset
                        </div>
                        <div class="postbox sermon_min_height">
                            <div class="clear height10"></div>
                            <div class="fontsize17 lineheight30 bold black text-center ellipsis"><a href="{{ route('sermons.show', $sermon->slug) }}" class="black">{{ $sermon->title }}</a></div>
                            <div class="clear height5"></div>
                            <div class="para black bold text-center">Pastor : <a href="staff/46/herman-owens.html" class="gold">{{ $sermon->preacher }}</a></div>
                            <div class="clear height5"></div>
                            <p class="para black">{{ str_limit($sermon->excerpt, 150, "...") }}</p>
                            <div class="clear height20"></div>
                            <div  class="sermonicon">
                                <ul>
                                    @if(isset($sermon->media->last()->url))
                                    <li><a href="{{ $sermon->media->last()->url }}" class="bla-2"><i class="lnr lnr-camera-video"></i></a></li>
                                    @endif
                                    @if($sermon->media->whereIn('type', ['audio/mpeg'])->last() != '')
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#sermon8"><i class="lnr lnr-music-note"></i></a></li>
                                    @endif
                                    @if($sermon->media->whereIn('type', ['application/pdf'])->last() != '')
                                    <li><a href="{{ route('sermons.viewPDF',$sermon->media->where('type', 'application/pdf')->last()->filename) }}" target="_blank"><i class="lnr lnr-file-empty"></i></a></li>
                                    <li><a href="{{ route('sermons.download',$sermon->media->where('type', 'application/pdf')->last()->filename) }}" download><i class="lnr lnr-download"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="modal fade" id="sermon8" tabindex="-1" role="dialog" aria-labelledby="sermon8" aria-hidden="true">
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagi"></div>
        <div class="height50"></div>
    </div>
    <div class="height100"></div>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
@include('partials.footer')
@endsection