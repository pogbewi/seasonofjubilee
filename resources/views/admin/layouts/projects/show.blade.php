@extends('admin.templates.default')
@section('page_title', $project->title)
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
                                <h3 class="panel-title">View {{ $project->title }} project info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 " align="center">
                                            <img src="{{ asset('storage/uploads/projects/images/'.$project->photo)  }}" alt="{{ $testimony->subject }}" class="img-responsive blogpost">
                                    </div>
                                    <div class=" col-md-8 col-lg-8 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Title:</td>
                                                <td>{{ $project->title }}</td>
                                            </tr>

                                            <tr>
                                                <td>Completion Date</td>
                                                <td>{{ Carbon\Carbon::parse($project->completion_date)->diffForHumans() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date created:</td>
                                                <td>
                                                    {{ prettyDate($project->created_at) }}
                                                </td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <td>Publish At</td>
                                                <td>{{ prettyDate($project->published_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td>View Count</td>
                                                <td>{{$project->views }}</td>
                                            </tr>
                                            <tr>
                                            <td> url slug:</td>
                                            <td>{{ $project->slug }}</td>
                                            </tr>
                                            <tr>
                                            <td> Description:</td>
                                            <td>{{ $project->description }}</td>
                                            </tr>

                                            <tr>
                                                <td> Keywords:</td>
                                                <td>{{ explode(',', $project->meta_keywords) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                    <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-projects-controller'))
                                            <a href="{{ route('admin.projects.edit', $project->slug) }}" data-original-title="Edit Testimony info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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