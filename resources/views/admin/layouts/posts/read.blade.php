@extends('admin.templates.default')
@section('page_title', $post->title .' info')
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
                                <h3 class="panel-title">View {{ $post->title }} info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4" align="center">
                                        <img src="{{ asset('storage/uploads/posts/photos/thumbnails/'.$post->photo) }}" alt="{{ $post->title }}" class="img-responsive blogpost">
                                    </div>
                                    <div class=" col-md-8">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Title:</td>
                                                <td>{{ $post->title }}</td>
                                            </tr>
                                            <tr>
                                                <td>Author:</td>
                                                <td>{{ $post->author->name }}</td>
                                            </tr>

                                            <tr>
                                                <td> Date Published</td>
                                                <td>{{ prettyDate($post->published_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Category:</td>
                                                <td>{{ $post->category->name }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>views:</td>
                                                <td>{{ $post->views }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Featured:</td>
                                                <td>
                                                    @if($post->featured)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Meta description:</td>
                                                <td>
                                                    {{ $post->meta_description}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                   <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-post-controller'))
                                           <a href="{{ route('admin.posts.edit', $post->slug) }}" data-original-title="Edit Staff info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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