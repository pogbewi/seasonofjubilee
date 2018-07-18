@extends('templates.default')
@section('page_title', "Admin Forgot Password")
@section('description', "Admin Forgot Password Page")
@section('keyword', "Admin,forgot password,season of jubilee ")
@section('body-class', 'body main-page body-login index')

<!-- Main Content -->
@section('content')
<div class="container" id="Login-Register-Container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center animated fadeInUp slow">
            <div class="login-box">
                <div class="login-logo">
                    <h2><b>Season Of Jubilee</b> - Admin</h2>
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body">
                    <p class="login-box-msg">Enter Your Email For Password Reset </p>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-3">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
