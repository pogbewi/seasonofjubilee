@extends('admin.templates.default')
@section('page_title', $testimony->subject)
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
                                <h3 class="panel-title">View {{ $testimony->subject }} testimony info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 " align="center">
                                            <img src="{{ asset('storage/uploads/testimonies/images/'.$testimony->photo)  }}" alt="{{ $testimony->subject }}" class="img-responsive blogpost">
                                    </div>
                                    <div class=" col-md-8 col-lg-8 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Subject:</td>
                                                <td>{{ $testimony->subject }}</td>
                                            </tr>

                                            <td>Testifier:</td>
                                            <td>{{ $testimony->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date created:</td>
                                                <td>
                                                    {{ prettyDate($testimony->created_at) }}
                                                </td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <td>Publish At</td>
                                                <td>{{ prettyDate($testimony->published_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td>View Count</td>
                                                <td>{{$testimony->views }}</td>
                                            </tr>

                                            <td> url slug:</td>
                                            <td>{{ $testimony->slug }}</td>
                                            <tr>
                                            <td> Description:</td>
                                            <td>{{ $testimony->meta_description }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                    <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-testimony-controller'))
                                            <a href="{{ route('admin.testimony.edit', $testimony->slug) }}" data-original-title="Edit Testimony info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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