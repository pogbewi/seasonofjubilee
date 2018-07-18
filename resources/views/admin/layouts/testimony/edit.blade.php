@extends('admin.templates.default')
@section('page_title', 'Edit Testimony')
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
                            {!! Form::model($testimony, [
                                 'method' => 'PATCH',
                                 'route' => ['admin.testimony.update', $testimony->slug],
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
                                            <span class="panel-desc"> Subject of The Testimony</span>
                                        </h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        {{ Form::hidden('slug', $testimony->slug ,['class'=>'form-control', 'id'=>'slug', 'placeholder'=>'Slug']) }}
                                        {{ Form::text('subject', old('subject'),['class'=>'form-control', 'id'=>'subject', 'placeholder'=>'Subject']) }}
                                    </div>
                                </div>

                                <!-- ### CONTENT ### -->
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-book"></i> Testimony Body</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    {{ Form::textarea('body', old('body'),['class'=>'form-control richTextBox', 'id'=>'richTextBox', 'placeholder'=>'Body','style'=>'border:0px;']) }}
                                </div><!-- .panel -->

                                <div class="panel panel-bordered panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-search"></i> SEO Content</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            {{ Form::textarea('meta_description', old('meta_description'),['class'=>'form-control', 'id'=>'meta_description', 'placeholder'=>'Meta Description']) }}
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            {{ Form::text('meta_keywords', old('meta_keywords'),['class'=>'form-control', 'id'=>'meta_keywords', 'placeholder'=>"Meta Keywords"]) }}
                                            </div>
                                        </div>

                                        {{--<div class="form-group">
                                            <label for="seo_title">Seo Tile</label>
                                            <input type="text" class="form-control" name="seo_title" id="seo_title" data-role="tagsinput">
                                        </div>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 sidebar_wrapper">
                                <div class="panel panel panel-bordered panel-warning">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-clipboard"></i> Testimony Info</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="name">Testifier's Name</label>
                                            {{ Form::text('name', old('name'),['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="tag_names">Tags (Enter comma separated tags)</label>
                                            {{ Form::text('tag_names', old('tag_names'),['class'=>'form-control', 'id'=>'tag_names','data-role'=>"tagsinput", 'placeholder'=>'Tag Names']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Testimony Status</label>
                                            {{ Form::select('status', ['PUBLISHED'=>'published','PENDING'=>'pending'], old('status'),['class'=>'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="allow_comments">Disable Comments ?</label>
                                            <input type="checkbox" name="allow_comments" id="allow_comments">
                                        </div>

                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="scheduled_to_picker">
                                                <label for="published_at">Published At</label>
                                                {{ Form::text('published_at', old('published_at'),['class'=>'form-control scheduled_to_input', 'id'=>'published_at', 'placeholder'=>'Published At']) }}
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-bordered panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="icon wb-image"></i> Testifier's photo Image</h3>
                                            <div class="panel-actions">
                                                <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="inform" style="padding: 7px"><img src="/storage/uploads/testimonies/images/thumbnails/{{ $testimony->photo }}" width="100%"></div>
                                            {{ Form::hidden('photo', old('photo'),['id'=>'photo']) }}
                                            {{ Form::file('image',['id'=>'image', 'data-url'=>route('admin.testimony.upload')]) }}
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                    <i class="icon wb-plus-circle"></i> Add New sermon
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
            $("#published_at").on("dp.change", function (e) {
                $("#published_at").data("DateTimePicker").maxDate(e.date);
            });
        });

        $('#allow_comments').on('change',function(){
            this.value = this.checked ? 1:0;
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

