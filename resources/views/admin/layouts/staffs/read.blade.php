@extends('admin.templates.default')
@section('page_title', $staff->name .' info')
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
                                <h3 class="panel-title">View {{ $staff->name }} info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4" align="center">
                                        <img src="{{ asset('storage/uploads/staffs/photos/thumbnails/'.$staff->avatar) }}" class="img-responsive blogpost">
                                    </div>
                                    <div class=" col-md-8">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>{{ $staff->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>position:</td>
                                                <td>{{ $staff->position }}</td>
                                            </tr>
                                            <tr>
                                                <td>Bio:</td>
                                                <td>
                                                    {{ $staff->bio }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> Date added</td>
                                                <td>{{ prettyDate($staff->created_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Social Media Handles:</td>
                                                <td>{{ $handle->facebook }}, {{ $handle->twitter }},
                                                    {{ $handle->instagram }}, {{ $handle->youtube }},
                                                    {{ $handle->google_plus }}
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                   <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-staff-controller'))
                                           <a href="{{ route('admin.staffs.edit', $staff->slug) }}" data-original-title="Edit Staff info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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