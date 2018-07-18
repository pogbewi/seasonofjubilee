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
                @if(setting('otherpage_photo')) !='')
                    <img src="{{ setting('other_page_photo') ? asset('/storage/'.setting('otherpage_photo')) : '' }}" class="img-responsive bannerheight">
                @endif
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="captial fontsize20 lineheight50">Give</span><br/>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="height50"></div>
    <div class="clearfix"></div>
    <div class="container">
        <div class="height50"></div>
        <div class="container">
            <div class="col-md-12 animated fadeInLeft">
                <div class="mbottom">
                    <h3 class="white text-center ">
                        <span class="captial fontsize20 lineheight50 gold">Bank info </span><br/>
                    </h3>
                    <div class="para black">
                        {{ setting('church_bank_details') }}
                    </div>
                </div>
            </div>


            <div class="clear height50"></div>
            <div class="col-md-12 animated fadeInUp slow">
                <div class="topbottom_bar">
                    <div class="clear height30"></div>

                    <div class="h3 black text-center">Follow Us or Share on The Follow Platforms:</div>
                    <div class="clear height30"></div>

                    <div class="share-items text-center" data-title="{{ setting('site_title') }}" data-hash="{{ setting('site_title') }}"
                         data-url="{{ route('about') }}">

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
                </div>
            </div>
            <div class="clear height50"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection