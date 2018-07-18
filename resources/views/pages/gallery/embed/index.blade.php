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
                <div  id="gallery-overlays"><h1 class="h1 white text-center animated fadeInUp slow">Channel Gallery</h1></div>
            </div>
        </div>
    </section>
    <div class="pagetitle" align="center">
    </div>
    <div class="video">
        <div class="container">
            <div class="row">
                <div class="container text-center">
                    <div class="toolbar mb2 mt2" style="padding: 2rem;">
                        <button class="btn fil-cat avg_very_small_button radiusoff">Latest Audio Teaching</button>
                    </div>
                    <div id="video-portfolio">
                        <div class="row">
                            @foreach($embedded_galleries as $embedded)
                                <div class="col-xs-12 col-sm-4 col-md-3">
                                    <div class="tile scale-anm ">
                                      {{--  <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{ $embedded->url }}" id="gallery_video"  allowfullscreen frameborder="0" allowscriptaccess="always">
                                            </iframe>
                                        </div>--}}

                                        <div class="embedded-photo" data-url="{{ $embedded->url }}" data-thumb="{{ $embedded->video_thumb }}" data-id="{{ $embedded->embed_id }}" data-type="{{ $embedded->type }}">
                                            <div class="play-button"></div>
                                        </div>
                                        <h2 class="video-text white">{{ $embedded->title }}</h2>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $embedded_galleries->render() }}
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
        var embed_div = document.querySelectorAll('.embedded-photo');
        function setEmbeddedThumbnail(embed_div){
            //alert(embed_div.dataset.url);
            if(embed_div.dataset.type === "vimeo"){
                var x = new XMLHttpRequest();
                x.open("GET","https://vimeo.com/api/v2/video/" + embed_div.dataset.id + ".xml",true);
                x.onreadystatechange = function(){
                    if(x.readyState == 4 && x.status == 200){
                        var doc = x.responseXML;
                       var source = doc.getElementsByTagName("thumbnail_large")[0].innerHTML;
                        var image = new Image();
                        image.src = source;
                        image.style.top = "0%";
                        image.addEventListener("load", function(){
                            embed_div.appendChild(image);
                        });
                    }
                };
                x.send(null);
            }else{
                var image = new Image();
                image.src = embed_div.dataset.thumb;
                image.addEventListener("load", function(){
                    embed_div.appendChild(image);
                });
            }
        }

        function setClickResponse(embed_div){
            var embed_url = embed_div.dataset.url;
            embed_div.addEventListener('click',function(){
                try{
                    if(/Mobi|Table|iPad|iPhone|Android|webOS|IEMobile|symbiam|psp|Tablet|Windows Phone|Palm|maemo|avantgo|blazer|BlackBerry|plucker|midori|iPod|pocket|kindle|ZuneWP7/i.test
                            (navigator.userAgent || navigator.vendor || window.opera)){
                        alert("hey");
                                var iframe = document.createElement("iframe");
                                 iframe.setAttribute("frameborder", 0);
                                 iframe.setAttribute("allowfullscreen", true);
                                 iframe.setIdAttribute("allowscriptaccess", "always");
                                 iframe.setAttribute("src", embed_url);
                                 this.innerHTML = "";
                                 this.appendChild(iframe);
                    }else{
                        $(".video").append('<div class="YouTubePopUp-Wrap YouTubePopUp-animation"  style="padding: 0.5rem"><div class="YouTubePopUp-Content"><span class="YouTubePopUp-Close"></span><h3 class="white">Image title here</h3><div class="embed-responsive embed-responsive-16by9"><iframe src="'+embed_url+'" allowfullscreen frameborder="0" allowscriptaccess="always"></iframe></div></div></div>');
                        if( $('.YouTubePopUp-Wrap').hasClass('YouTubePopUp-animation') ){
                            setTimeout(function() {
                                $('.YouTubePopUp-Wrap').removeClass("YouTubePopUp-animation");
                            }, 600);
                        }
                        $(".YouTubePopUp-Wrap, .YouTubePopUp-Close").click(function(){
                            $(".YouTubePopUp-Wrap").addClass("YouTubePopUp-Hide").delay(515).queue(function() { $(this).remove(); });
                        });
                    }
                } catch(e){
                    console.log("Error in Mobile Detection");
                }
            });

        }

        for(var i = 0; i < embed_div.length; i++){
            setEmbeddedThumbnail(embed_div[i]);
            setClickResponse(embed_div[i]);
        }
    })
</script>
@endpush
