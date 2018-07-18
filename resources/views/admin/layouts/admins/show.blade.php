@extends('admin.templates.default')
@section('page_title', $admin->name .' info')
@section('header')
    <link rel="stylesheet" href="/admin/css/show.css">
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
                    <div class="col-xs-12 col-xs-offset-0 toppad" >
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">View {{ $admin->name }} info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4" align="center">
                                        <img src="{{ $admin->avatar }}" class="img-responsive blogpost">
                                    </div>
                                    <div class=" col-md-8">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>{{ $admin->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td>{{ $admin->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email:</td>
                                                <td>
                                                    {{ $admin->email }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Gender:</td>
                                                <td>
                                                    {{ $admin->gender }}
                                                </td>
                                            </tr>

                                           <tr>
                                               <td>Role:</td>
                                               <td>
                                                   @foreach($admin->roles as $role)
                                                       {{ $role->display_name }}
                                                   @endforeach
                                               </td>
                                           </tr>

                                            <tr>
                                                <td> Date Sent</td>
                                                <td>{{ prettyDate($admin->created_at) }}</td>
                                            </tr>
                                            <tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                  <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-admin-controller'))
                                          <a href="{{ route('admin.admins.edit',Auth::guard('admin')->id()) }}" data-original-title="Edit Your Profile" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                      @endif
                                    </span>
                                    <span class="pull-right">
                                        <a href="{{ URL::previous() }}" data-original-title="Back To Previous Page" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                    </span>
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