@extends('templates.default')
@section('page_title', "Admin Login")
@section('description', "Admin login Page")
@section('keyword', "Admin,Login,season of jubilee ")
@section('body-class', 'body main-page body-login index')

@section('content')
        <div class="container" id="Login-Register-Container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center animated fadeInUp slow">
                    <div class="login-box">
                        <div class="login-logo">
                            <h2><b>Season Of Jubilee</b> - Admin</h2>
                        </div>
                        <!-- /.login-logo -->
                        <div class="login-box-body">
                            <p class="login-box-msg">Sign in to start your session</p>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{route('admin.postLogin')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <!-- /.social-auth-links -->
                            <a href="{{ route('admin.password.forgotform') }}">I forgot my password</a><br>
                        </div>
                        <!-- /.login-box-body -->
                    </div>
                </div>
            </div>
        </div>
    <!-- /.login-box -->
@endsection
