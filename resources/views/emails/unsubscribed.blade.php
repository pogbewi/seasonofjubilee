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
                        <span class="captial fontsize20 lineheight50">Unsubscribe</span><br/>
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
            <div class="col-md-12 animated fadeInLeft">
                <div class="mbottom">
                    <h3 class="white text-center ">
                        <span class="captial fontsize20 lineheight50 gold">Remove Your Email from Our Mailing List</span><br/>
                    </h3>
                    <div class="height50"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="para black">
                                <div class="contact_left wow">
                                    <div class="col-md-4 col-md-offset-4">
                                        @if ($message = Session::get('unsubscriber-success'))
                                            <div class="alert alert-success alert-block">
                                                <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                                                <strong>{{ $message }}</strong>

                                            </div>
                                        @elseif ($message = Session::get('error'))
                                            <div class="alert alert-danger alert-block">
                                                <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif
                                        {!! Form::open(['route'=>'unsubscribe', 'method'=>'DELETE','role' => 'form']) !!}
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                            <input type="text" name="email" class="form-control wpcf7-email" placeholder="Email address">
                                        </div>
                                    <div class="col-md-4 col-md-offset-4">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-danger wpcf7-submit photo-submit">
                                    </div>
                                    {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="height50"></div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    @include('partials.footer')
@endsection