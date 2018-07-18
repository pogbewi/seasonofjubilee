@extends('admin.templates.default')
@section('page_title', $gallery->title .' info')
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
                                <h3 class="panel-title">View {{ $gallery->title }} info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4" align="center">
                                        @if($gallery == null)
                                            No media
                                        @else
                                            @if(in_array($gallery->type, ['image/jpeg', 'image/gif', 'image/png', 'image/jpg']))
                                                <img src="{{ asset('/storage/uploads/galleries/photos/thumbnails/'.$gallery->filename) }}" alt="{{ $gallery->title }}" class="thumbnail" width="100%"/>
                                            @elseif(in_array($gallery->type, ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'mpeg']))
                                                <video controls poster="{{ asset($gallery->video_thumb) }}" style="width: 100%">
                                                    <source src="{{ asset('/storage/uploads/galleries/videos/'.$gallery->filename) }}" type="video/mp4">
                                                    Your browser does not support video tag
                                                </video>

                                            @elseif(in_array($gallery->type, ['audio/mp3','audio/mpeg','audio/acc']))
                                                <audio controls src="{{ asset('/storage/uploads/galleries/audios/'.$gallery->filename) }}"></audio>
                                                <img src="{{ asset($gallery->audio_thumb) }}" alt="{{ $gallery->title }}" class="thumbnail" width="100%"/>
                                            @endif
                                        @endif
                                    </div>
                                    <div class=" col-md-8">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Title:</td>
                                                <td>{{ $gallery->title }}</td>
                                            </tr>
                                            <tr>
                                                <td>Gallery Type:</td>
                                                <td>{{ $gallery->gallery_type }}</td>
                                            </tr>

                                            <tr>
                                                <td> Date Published</td>
                                                <td>{{ prettyDate($gallery->published_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Category:</td>
                                                <td>{{ $gallery->category->name }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>views:</td>
                                                <td>{{ $gallery->views }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>File Size:</td>
                                                <td>
                                                   {{ bcdiv($gallery->size, 1024000, 2) }}MB
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Download (s):</td>
                                                <td>{{ $gallery->download_count }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> Published:</td>
                                                <td>
                                                    {{ $gallery->published}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Last Download Time</td>
                                                <td>{{ prettyDate($gallery->last_download_time) }}</td>
                                            </tr>
                                            <tr>
                                                <td> Description:</td>
                                                <td>
                                                    {{ $gallery->description}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                   <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-gallery-controller'))
                                           <a href="{{ route('admin.galleries.edit', $gallery->slug) }}" data-original-title="Edit Staff info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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