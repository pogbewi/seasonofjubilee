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
                <div  id="gallery-overlays"><h1 class="h1 white text-center animated fadeInUp slow">Audio Gallery</h1></div>
            </div>
        </div>
    </section>
    <div class="pagetitle" align="center">
    </div>
    <div class="video">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="toolbar mb2 mt2" style="padding: 2rem;">
                        <button class="btn fil-cat avg_very_small_button radiusoff">Latest Audio Teaching</button>
                    </div>
                    <div id="audio-portfolio">
                     <div class="row">
                         @foreach($audio_galleries as $audio)
                             <div class="col-xs-12 col-sm-6 col-md-4">
                                 <div class="tile scale-anm ">
                                     <h2 class="audio-title"> {{ $audio->title }}</h2>
                                     <audio id="audio-gallery" controls class="lumos-link">
                                         <source src="{{ asset('storage/uploads/galleries/audios/'.$audio->filename) }}" type="{{ $audio->type }}" class="postbg">
                                         Your browser does not support video tag
                                     </audio>
                                     <img src="{{ asset($audio->audio_thumb) }}" class="img-responsive thumbnail">
                                     <div class="download"><a href="{{ route('galleries.download',$audio->slug) }}"><i class="fa fa-download"> Download </i></a> </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                    </div>
                    {{ $audio_galleries->render() }}
                </div>
            </div>
            <div class="height50"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection
@push('scripts')
<script type="text/javascript">
    $(function(){

    })
</script>
@endpush
