@extends('admin.templates.default')
@section('page_title', 'Register An Admin')
@section('header')
@endsection
@section('body-class', 'hold-transition skin-blue sidebar-mini')
@section('content')
    <div class="wrapper">
        @include('admin.partials.nav')
        @include('admin.partials.sidebar')
                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                </h1>
                @include('admin.partials.breadcrum')
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Register</div>
                            <div class="panel-body">
                                {!! Form::model($admin, [
                                                'method' => 'PATCH',
                                                'route' => ['admin.admins.update', $admin->id],
                                                'role' => 'form'
                                            ]) !!}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>

                                        <div class="col-md-6">
                                            {{ Form::hidden('id', $admin->id ,['class'=>'form-control', 'id'=>'slug']) }}
                                            {{ Form::text('name', old('name'),['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name','autofocus'=>true]) }}

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            {{ Form::text('email', $admin->email,['class'=>'form-control', 'id'=>'email','disabled'=>'disabled','autofocus'=>true]) }}

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">Phone Number</label>

                                        <div class="col-md-6">
                                            {{ Form::text('phone', old('phone'),['class'=>'form-control', 'id'=>'phone', 'placeholder'=>'Phone','autofocus'=>true]) }}
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <label for="gender" class="col-md-4 control-label">Gender:</label>
                                        <div class="col-md-6">
                                            {{ Form::select('gender', ['male'=>'Male', 'female'=>'Female'], old('gender'),['class'=>'form-control']) }}
                                            @if ($errors->has('gender'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    @if(Auth::guard('admin')->user()->hasRole('admin'))
                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label for="role" class="col-md-4 control-label">Assign Role:</label>
                                        <div class="col-md-6">
                                            {{ Form::select('role', $roles, old('role'),['id'=>'role','class'=>'form-control']) }}
                                            @if ($errors->has('role'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        <div class="col-md-6">
                                            {{ Form::password('password', ['class'=>'form-control', 'id'=>'password', 'placeholder'=>'Password']) }}
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password_confirmation" class="col-md-4 control-label">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="inform" style="padding: 7px"><img src="{{ $admin->photo }}" width="100%"></div>
                                            {{ Form::hidden('photo', $admin->avatar,['id'=>'photo']) }}
                                            {{ Form::file('image',['id'=>'image', 'data-url'=>route('admin.admins.upload')]) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-6">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')
        @include('admin.partials.control-sidebar')
    </div>
    <!-- ./wrapper -->

@endsection