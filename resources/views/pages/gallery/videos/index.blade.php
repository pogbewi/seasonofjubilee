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
                <div  id="gallery-overlays"><h1 class="h1 white text-center animated fadeInUp slow">Video Gallery</h1></div>
            </div>
        </div>
    </section>
{{--    <div class="pagetitle" align="center">
        <h1 class="h1 white text-center gold">Video Gallery</h1>
    </div>--}}
    <div class="video">
        <div class="container">
            <div class="height50"></div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="toolbar mb2 mt2" style="padding: 2rem;">
                        <button class="btn fil-cat avg_very_small_button radiusoff mbottom" href="#" data-rel="all">All</button>
                        @foreach($categories as $category)
                            <button class="btn fil-cat avg_very_small_button radiusoff mbottom" data-rel="{{ $category->slug }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                    <div id="video-portfolio">
                        <div class="row">
                            @foreach($video_galleries as $video)
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="tile scale-anm {{ $video->category->slug }} all">
                                        <a href="{{ route('galleries.videos.show',$video->slug) }}" title="{{ $video->title }}">
                                            <video id="gallery" controls poster="{{ asset($video->video_thumb) }}" width="100%" class="lumos-link">
                                                <source src="{{ asset('storage/uploads/galleries/videos/'.$video->filename) }}" aria-disabled="true" type="video/mp4" class="postbg">
                                                Your browser does not support video tag
                                            </video>
                                            <p class="video-text">{{ $video->title }}</p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $video_galleries->render() }}
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
