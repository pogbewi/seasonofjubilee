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
            <img src="{{ setting('other_pages_photo') ? '/storage/'.setting('other_pages_photo') : '' }}" class="img-responsive bannerheight">
            <div  id="gallery-overlays">
                <h1 class="white text-center animated fadeInUp slow">
                    <span class="captial fontsize20 lineheight50">Staff</span><br/>
                </h1>
            </div>
        </div>
    </div>
</section>
<div class="pagetitle" align="center">
    <h1 class="white text-center">
        <span class="fcaptial thisfont thislineheight gold black">{{ $staff->name }}</span>
    </h1>
</div>
<div class="clearfix"></div>
<div class="video">
    <div class="container">
        <div class="clear height50"></div>
        <div class="col-md-12">
            <div class="blogbg">
                <div align="center">
                    <div class="clear height10"></div>
                    <img src="{{ asset('storage/uploads/staffs/photos/'.$staff->photo) }}" class="img-responsive blogpost round postbg" title="Herman Owens">
                </div>
                <div class="blogbody">
                    <div class="h3 black text-center">{{ $staff->name }}</div>
                    <div class="clear"></div>
                    <div class="para gold bold text-center">{{ $staff->position }}</div>
                    <div class="clear height5"></div>
                    <div class="clear height10"></div>
                    <div  class="stafficon" align="center">
                        <ul>
                            <li><a href="{{ isset($handle->facebook) ? $handle->facebook : '' }}" target="_blank" class="btns"><i class="fa fa-facebook move5" aria-hidden="true"></i></a></li>
                            <li><a href="{{ isset($handle->twitter) ? $handle->twitter : '' }}" target="_blank" class="btns"><i class="fa fa-twitter move5" aria-hidden="true"></i></a></li>
                            <li><a href="{{ isset($handle->linkedin) ? $handle->linkedin : '' }}" target="_blank" class="btns"><i class="fa fa-linkedin move5" aria-hidden="true"></i></a></li>
                            <li><a href="{{ isset($handle->instagram) ? $handle->instagram : '' }}" target="_blank" class="btns"><i class="fa fa-instagram move5" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="clear height10"></div>
                    <div class="para black">{{ $staff->body }}</div>
                    <div class="clear height30"></div>
                    <div class="share-items text-center" data-title="{{ $staff->name }}" data-hash="{{ $staff->name }}" data-url="{{ route('staffs.show', $staff->slug) }}">
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
                                    <span>Share</span>
                                    <span class="total-count"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear height50"></div>
                </div>
            </div>
            <div class="clear height30"></div>
        {{--    <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 paddingoff">
                        <div class="text-left"><a href="../57/garrett-graham.html" class="avg_very_small_button fontbtn"><i class="lnr lnr-arrow-left"></i>  Garrett Graham</a></div>
                    </div>
                    <div class="col-md-6 paddingoff">
                        <div class="text-right"><a href="../61/jackson-west.html" class="avg_very_small_button fontbtn">Jackson Westen  <i class="lnr lnr-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="clear height50"></div>--}}
        </div>
    </div>
    <div class="height100"></div>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>

@include('partials.footer')
@endsection