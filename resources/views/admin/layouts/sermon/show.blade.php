@extends('admin.templates.default')
@section('page_title', 'View Sermon')
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
                                <h3 class="panel-title">View {{ $sermon->title }} sermon info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 " align="center">
                                        @if($sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last() != '')
                                            <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$sermon->media->whereIn('type', ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])->last()->filename)  }}" alt="{{ $sermon->title }}" class="img-responsive blogpost">
                                        @elseif($sermon->media->whereIn('type', ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'video/mpeg'])->last() != '')
                                            <video controls poster="{{ asset($sermon->media->where('type', 'video/mp4')->last()->video_thumb) }}" style="width: 100%;padding: 0.5rem 0 0 0.5rem" class="img-responsive margintop20">
                                                <source src="{{ asset('storage/media/upload/sermon/video/'.$sermon->media->where('type', 'video/mp4')->last()->filename) }}" type="video/mp4">
                                                Your browser does not support video tag
                                            </video>
                                        @endif
                                    </div>
                                    <div class=" col-md-8 col-lg-8 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>{{ $sermon->title }}</td>
                                            </tr>

                                            <td>Preacher:</td>
                                            <td>{{ $sermon->preacher }}</td>
                                            </tr>
                                            <tr>
                                                <td>sermon Status:</td>
                                                <td>
                                                    {{ prettyDate($sermon->created_at) }}
                                                </td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <td>Publish At</td>
                                                <td>{{ prettyDate($sermon->scheduled_on) }}</td>
                                            </tr>
                                            <tr>
                                                <td>View Count</td>
                                                <td>{{$sermon->views }}</td>
                                            </tr>

                                            <td> Seo name:</td>
                                            <td>{{ $sermon->slug }}</td>
                                            <tr>
                                                <td> Category</td>
                                                <td>{{ $sermon->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <td> Service</td>
                                                <td>{{ $sermon->service->name }}</td>
                                            </tr>

                                            <tr>
                                                <td> Status</td>
                                                <td>
                                                @if($sermon->free)
                                                    Free
                                                 @else
                                                    Paid
                                                 @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Allowed Comments</td>
                                                <td>
                                                    @if($sermon->allowed_comments)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                    <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-sermons-controller'))
                                            <a href="{{ route('admin.sermons.edit', $sermon->slug) }}" data-original-title="Edit sermon info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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