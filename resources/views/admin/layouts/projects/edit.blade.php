@extends('admin.templates.default')
@section('page_title', 'Edit Project')
@section('header')

    <link rel="stylesheet" href="/admin/css/custom.css">
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
            <section class="content">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-sticky-note-o" style="color: #005384"></i> Testimony</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                    Fill the form below to edit Testimony.
                                </div>
                                <hr class="admin-hr">

                            </div>
                        </div>
                        <div class="row">
                            {!! Form::model($project, [
                                 'method' => 'PATCH',
                                 'route' => ['admin.projects.update', $project->slug],
                                 'role' => 'form'
                             ]) !!}

                            <div class="col-md-8">
                                <div class="panel">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li style="list-style: none">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <span class="panel-desc"> Project's Title</span>
                                        </h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        {{ Form::hidden('slug', $project->slug ,['class'=>'form-control', 'id'=>'slug', 'placeholder'=>'Slug']) }}
                                        {{ Form::text('title', null,['class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title']) }}
                                    </div>
                                </div>

                                <!-- ### CONTENT ### -->
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-book"></i> Project's Description</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    {{ Form::textarea('description', null,['class'=>'form-control richTextBox', 'id'=>'richTextBox', 'placeholder'=>'Description','style'=>'border:0px;']) }}
                                </div><!-- .panel -->

                                <div class="panel panel-bordered panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-search"></i> SEO Content</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel-body">
                                            <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            {{ Form::text('meta_keywords', old('meta_keywords'),['class'=>'form-control', 'id'=>'meta_keywords', 'placeholder'=>"Meta Keywords"]) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 sidebar_wrapper">
                                <div class="panel panel panel-bordered panel-warning">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-clipboard"></i> Project Info</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="name">Project Status</label>
                                            {{ Form::select('status', ['PUBLISHED'=>'published','PENDING'=>'pending'], old('status'),['class'=>'form-control']) }}
                                        </div>

                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="input-group date scheduled_to_picker">
                                                <label for="published_at">Published At</label>
                                                {{ Form::text('published_at', old('published_at'),['class'=>'form-control scheduled_to_input', 'id'=>'published_at', 'placeholder'=>'Published At']) }}
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group scheduled">
                                            <div id="completion_date_picker" class="input-group date completion_date_picker">
                                                <label for="completion_date">Completion date</label>
                                                {{ Form::text('completion_date', old('completion_date'),['class'=>'form-control completion_date_input', 'id'=>'completion_date', 'placeholder'=>'Completion Date']) }}
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-bordered panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="icon wb-image"></i> Project's Image</h3>
                                            <div class="panel-actions">
                                                <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="inform" style="padding: 7px"><img src="/storage/uploads/projects/images/thumbnails/{{ $project->photo }}" width="100%"></div>
                                            {{ Form::hidden('photo', old('photo'),['id'=>'photo']) }}
                                            {{ Form::file('image',['id'=>'image', 'data-url'=>route('admin.projects.upload')]) }}
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                    <i class="icon wb-plus-circle"></i> Edit Project
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!---contents here-->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')
        @include('admin.partials.control-sidebar')
    </div>
    <!-- ./wrapper -->
@endsection
@push('scripts')
<script>
    $(function () {
        $(function () {
            $('#published_at').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'MM/DD/YYYY HH:mm'
            });

            $('#completion_date').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'MM/DD/YYYY HH:mm'
            });

            $("#published_at").on("dp.change", function (e) {
                $("#published_at").data("DateTimePicker").minDate(e.date);
            });
        });

        $('select[name="status"]').on('change',function(e){
            var option = e.target.value;
            if(option == 'PENDING'){
                $('.scheduled').removeAttr('style');
            }
        });
    });

</script>
@endpush

