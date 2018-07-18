<?php
/**
 * Created by PhpStorm.
 * User: precious
 * Date: 8/18/2017
 * Time: 3:24 PM
 */
?>
        <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keyword')"/>
    <meta name="author" content="{{ setting('pastor_name') }}">

    <title>{{ setting('site_title', 'Season Of Jubilee') }} - @yield('page_title')</title>
    <meta name="copyright" content="Copyright &copy; 2016-{!! date("Y") !!} {{ setting('site_title', 'Season Of Jubilee') }}" />
    <link rel="shortcut icon" href="{{ asset('/storage/'.setting('site_favcon')) }}" type="image/x-icon"/>

    @yield('og')
    <meta property="og:image" content="{{ asset('img/mwf-og-image2.png') }}" />
    <meta property="og:title" content="{{ config('app.name') }} - @yield('page_title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:site_name" content="{{ setting('site_title', 'Season Of Jubilee') }}"/>
    <meta property="og:type" content="website"/>

    <meta name="twitter:card" content="summary" >
    <meta name="twitter:domain" content="{{ config('app.url') }}" >
    <meta name="twitter:site" content="{{ setting('twitter_address','@seasonofjubilee') }}" >
    <meta name="twitter:site:id" content="{{ setting('twitter_address','@seasonofjubilee') }}">
    <meta name="twitter:creator" content="{{ setting('twitter_address','@seasonofjubilee') }}" >

    <!-- frontend css files -->
    <link  rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/animate.css" rel="stylesheet" media="all">
    <link href="/css/bootstrap-touch-slider.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="/css/YouTubePopUp.css">
    <link rel="stylesheet" type="text/css" href="/css/lightbox.css">
    <link rel="stylesheet" href="/css/gallery.css">
    <link rel="stylesheet" href="/css/animations.css" type="text/css">
    <link rel="stylesheet" href="/css/carousel.css">
    <link href="/css/share.css" rel="stylesheet">

    <!-- frontend css files -->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    @yield('css')

    @yield('head')
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics_debug.js','ga');
        window.ga_debug = {trace: true};
        ga('create', 'UA-115215532-1', 'auto');
        ga('send', 'pageview')
    </script>
</head>

<body class="@yield('body-class')">
<div class="loader"></div>
@yield('content')
<a class="totop" href="#"><i class="fa fa-angle-up"></i></a>
<!-- frontend js scripts-->
<script type="text/javascript" src="/js/jquery.dropotron.min.js"></script>
<script type="text/javascript" src="/js/jquery.scrolly.min.js"></script>
<script type="text/javascript" src="/js/jquery.scrollgress.min.js"></script>
<script type="text/javascript" src="/js/skel.min.js"></script>
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/gallery.js"></script>
<script type="text/javascript" src="/js/slider.js"></script>
<!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
<script type="text/javascript" src="/js/bootstrap-touch-slider.js"></script>
<script type="text/javascript" src="/js/lightbox.js"></script>
<script type="text/javascript" src="/js/YouTubePopUp.jquery.js"></script>
<script type="text/javascript" src="/js/mp3.js"></script>

<script type="text/javascript" src='/js/animations.js'></script>
<script type="text/javascript" src='/js/carousel.js'></script>
<script type="text/javascript" src="/js/share.js"></script>
<script type="text/javascript" src="/js/totop.min.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
@stack('scripts')
<script type="text/javascript">
    $('#bootstrap-touch-slider').bsTouchSlider();
</script>

<script type="text/javascript">
    jQuery(function(){
        jQuery("a.bla-1").YouTubePopUp();
        jQuery("a.bla-2").YouTubePopUp( { autoplay: 0 } ); // Disable autoplay
    });
</script>
<script>
    $(document).ready(function () {
        $('.mediPlayer').mediaPlayer();
    });
</script>
<script>
    $('.share-items').customShareCount({
        twitter: true,
        facebook: true,
        linkedin: true,
        google: true,
        twitterUsername: '{{ config('app.name') }}}',
        showCounts: true,
        showTotal: true
    });


    function centerModal() {
        $(this).css('display', 'block');
        var $dialog = $(this).find(".modal-dialog");
        var offset = ($(window).height() - $dialog.height()) / 2;
        // Center modal vertically in window
        $dialog.css("margin-top", offset);
    }

    $('.modal').on('show.bs.modal', centerModal);
    $(window).on("resize", function () {
        $('.modal:visible').each(centerModal);
    });
</script>
<script>
    $('.totop').tottTop({
        scrollTop: 100
    });
</script>

<script type="text/javascript">
        var loader_image_src = '{{ setting('site_loader') ? '/storage/'.setting('site_loader') : '' }}';
        var $img = 'url('+ loader_image_src +') 50% 50% no-repeat rgb(249,249,249)';
        $('.loader').css('background', $img);
        /*background: url('../local/images/settings/1510679886.gif') 50% 50% no-repeat rgb(249,249,249);*/
</script>
</body>
</html>
