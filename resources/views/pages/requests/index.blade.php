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
                @if(setting('other_page_photo') != '')
                    <img src="{{ setting('other_page_photo') ? asset('/storage/'.setting('other_page_photo')) : '' }}" class="img-responsive bannerheight">
                @endif
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="captial fontsize20 lineheight50">Prayer Request</span><br/>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="pagetitle animated fadeInUp slow" align="center">

    </div>
    <div class="height50"></div>
    <div class="height50"></div>
    <div class="container">
        <div class="height50"></div>
        <div class="container">
            <div class="col-md-6 col-md-offset-1 animated fadeInLeft">
                <div class="mbottom">
                    <h3 class="white text-center ">
                        <span class="captial fontsize20 lineheight50 black">Please Fill The Form To Send Your Prayer Requests</span><br/>
                    </h3>
                    <div class="para black">
                        <div class="contact_left wow">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                                    <strong>{{ $message }}</strong>

                                </div>

                            @endif
                            {!! Form::open(['route'=>'requests.store', 'role' => 'form']) !!}
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
            <div class="col-md-5 paddingRight animated fadeInRight">
                <div class="borderbottom">
                    <h3 class="fontsize16 heading topoff">Our</h3>
                    <h3 class="fontsize16 heading topoff">Prayer Request Hotlines</h3>
                </div>
                <div class="clear height20"></div>
                <div class="black">
                    <div class="h4 bold black m-center"></div>
                    <div class="clear height10"></div>
                    <span class="bold fontsize16">Telephone : </span><span class="fontsize14">
                        {!! html_entity_decode(setting('prayer_request_phones','phone')) !!}
                    </span>
                    <div class="clear height10"></div>
                </div>
            </div>
            <div class="clear height20"></div>
            <div class="clear height50"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection