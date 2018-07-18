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
                <img src="{{ setting('contact_page_photo') ? asset('/storage/'.setting('contact_page_photo')) : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="captial fontsize20 lineheight50">Contact Us</span><br/>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="pagetitle animated fadeInUp slow" align="center">

    </div>

    <div class="container">
        <div class="height50"></div>
        <div class="container">
            <div class="col-md-6 animated fadeInLeft">
                <div class="mbottom">
                    <h3 class="white text-center ">
                        <span class="captial fontsize20 lineheight50 black">Welcome To {{ setting('site_title') }}</span><br/>
                    </h3>
                    <div class="para black">
                        <div class="contact_left wow">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                                    <strong>{{ $message }}</strong>

                                </div>
                            @endif
                            {!! Form::open(['route'=>'post-contact', 'role' => 'form']) !!}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <input type="text" name="name" class="form-control wpcf7-text" placeholder="Your name">
                            </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                    <input type="text" name="phone" class="form-control wpcf7-phone" placeholder="Phone Number">
                                </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <input type="text" name="email" class="form-control wpcf7-email" placeholder="Email address">
                            </div>
                            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                                <input type="text" name="subject" class="form-control wpcf7-text" placeholder="Subject">
                            </div>
                            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                                <textarea name="message" class="form-control wpcf7-textarea" cols="30" rows="10" placeholder="What would you like to tell us"></textarea>
                            </div>
                            <input type="submit" name="submit" value="Submit" class="btn btn-danger wpcf7-submit photo-submit">
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 paddingRight animated fadeInRight">
                <div class="borderbottom">
                    <h3 class="fontsize16 heading topoff">Our</h3>
                    <h3 class="fontsize16 heading topoff">Church Locations</h3>
                </div>
                <div class="clear height20"></div>
                <div class="black">
                    <div class="h4 bold black m-center">Head Quarter Church</div>
                    <span class="bold fontsize16">Name : </span>&nbsp;<span class="fontsize14"><strong>{{ setting('church_name') }}</strong></span>    <div class="clear height10"></div>
                    <span class="bold fontsize16">Address : </span>&nbsp;<span class="fontsize14">{{ setting('address') }}</span> <div class="clear height10"></div>
                    <span class="bold fontsize16">Service Days : </span><br/><span class="fontsize14">
                       {{-- <p><strong>Sunday Service:</strong> Celebration Service by 8:00am</p>
                        <p><strong>Tuesday Service:</strong> Victory Service by 5:00pm</p>
                        <p><strong>Thursday Service:</strong> Bible Study Service by 5:00pm</p>--}}
                        {!! html_entity_decode(setting('church_service_days')) !!}
                    </span> <div class="clear height10"></div>
                    <span class="bold fontsize16">Telephone : </span><span class="fontsize14">
                    {{--    <p><strong>+2348033059184</strong></p>
                        <p><strong> +2348073737950</strong></p>
                        <p><strong> +2348033351804</strong></p>--}}
                        {!! html_entity_decode(setting('phone')) !!}
                    </span>
                    <div class="clear height10"></div>
                    <span class="bold fontsize16">Email : </span><span class="fontsize14"><a href="mailto:{{ setting('email_address') }}" class="black">{{ setting('email_address') }}</a></span>
                    <div class="clear height10"></div>
                </div>
            </div>

            <div class="clear height20"></div>
            <div class="clear height20"></div>
            <div class="col-md-12 paddingRight animated fadeInRight">
                <div class="borderbottom text-center">
                    <h3 class="fontsize16 heading topoff">Our</h3>
                    <h3 class="fontsize16 heading topoff">Branch Locations</h3>
                </div>
                <div class="clear height20"></div>
                <div class="col-md-8 col-md-offset-2 black">
                    <div class="h4 bold black m-center">Church Branches</div>
                    <div class="para black">
                        {!! html_entity_decode(setting('church_branches')) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12 animated fadeInUp slow">
                <div class="clear height30"></div>
                <div class="h3 black text-center">Locate Us On The Map</div>
                <div class="clear height30"></div>
                    <div class="para black">
                            <!-- Start Google map -->
                       {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1983.088100814283!2d5.627509233703744!3d6.240493791453726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s6.240227%2C+5.627976!5e0!3m2!1sen!2sng!4v1517822075678" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
                            <div id="map_canvas"></div>
                    </div>
            </div>
            <div class="clear height20"></div>




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