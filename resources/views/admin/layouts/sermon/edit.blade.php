@extends('admin.templates.default')
@section('page_title', 'Create Sermon')
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
                            <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-sticky-note-o" style="color: #005384"></i> Sermon</h2>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                Fill the form below to Edit this sermon.
                            </div>
                            <hr class="admin-hr">

                        </div>
                    </div>
                    <div class="row">
                        {!! Form::model($sermon, [
                                            'method' => 'PATCH',
                                            'route' => ['admin.sermon.update', $sermon->slug],
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
                                        <span class="panel-desc"> The Title for this Sermon</span>
                                    </h3>
                                    <div class="panel-actions">
                                        <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    {{ Form::hidden('slug', $sermon->slug ,['class'=>'form-control', 'id'=>'slug', 'placeholder'=>'Slug']) }}
                                    {{ Form::text('title', old('title'),['class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title']) }}
                                </div>
                            </div>

                            <!-- ### CONTENT ### -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="icon wb-book"></i> Sermon Body</h3>
                                    <div class="panel-actions">
                                        <a class="panel-action savysoft-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                                    </div>
                                </div>
                                {{ Form::textarea('body', old('body'),['class'=>'form-control richTextBox', 'id'=>'richTextBox', 'placeholder'=>'Body','style'=>"border:0px;"]) }}
                            </div><!-- .panel -->

                            <!-- ### EXCERPT ### -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Excerpt <small>Small description of this post</small></h3>
                                    <div class="panel-actions">
                                        <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    {{ Form::textarea('excerpt', old('excerpt'),['class'=>'form-control', 'id'=>'excerpt', 'placeholder'=>'excerpt','style'=>"border:0px;"]) }}
                                </div>
                            </div>

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
                                        <textarea class="form-control" name="meta_description" id="meta_description"></textarea>
                                        {{ Form::textarea('meta_description', old('meta_description'),['class'=>'form-control', 'id'=>'meta_description', 'placeholder'=>'Meta Description']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        {{ Form::text('meta_keywords', old('meta_keywords'),['class'=>'form-control', 'id'=>'meta_keywords', 'placeholder'=>'Meta Keywords']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 sidebar_wrapper">
                            <div class="panel panel panel-bordered panel-warning">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="icon wb-clipboard"></i> Sermon Details</h3>
                                    <div class="panel-actions">
                                        <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="name">Preacher</label>
                                        {{ Form::text('preacher', old('preacher'),['class'=>'form-control', 'id'=>'preacher', 'placeholder'=>'Preacher']) }}
                                    </div>

                                    <div class="form-group">
                                        <div id="preached_on_picker" class="preached_on_picker">
                                            <label for="preached_on">Preached On</label>
                                            {{ Form::text('preached_on', old('preached_on'),['class'=>'form-control preached_on_input', 'id'=>'preached_on', 'placeholder'=>'Preached On']) }}
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sermon_category_id">Sermon Category</label>
                                        <select class="form-control" name="sermon_category_id" id="sermon_category_id">
                                            <option value="">Select</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag_names">Tags (Enter comma separated tags)</label>
                                        {{ Form::text('tag_names', old('tag_names'),['class'=>'form-control', 'id'=>'tag_names','data-role'=>"tagsinput", 'placeholder'=>'Tag Names']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="service_id">Service Type</label>
                                        <select class="form-control" name="service_id" id="service_id">
                                            <option value="">Select</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="allow_comments">Disable Comments ?</label>
                                        <input type="checkbox" name="allow_comments" id="allow_comments">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Sermon Status</label>
                                        {{ Form::select('status', ['PUBLISHED'=>'published', 'PENDING'=>'pending'], old('status'),['class'=>'form-control']) }}
                                    </div>

                                    <div class="form-group scheduled" style="display: none">
                                        <div id="scheduled_to_picker" class="scheduled_to_picker">
                                            <label for="scheduled_on">Schedule To</label>
                                            {{ Form::text('scheduled_on', old('scheduled_on'),['class'=>'form-control scheduled_to_input', 'id'=>'scheduled_on', 'placeholder'=>'Scheduled On']) }}
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="free">Is this Sermon Free ?</label>
                                        <input type="checkbox" name="free" id="free">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                <i class="icon wb-plus-circle"></i> Update Sermon
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
            $('#preached_on').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#scheduled_on').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'MM/DD/YYYY HH:mm'
            });
            $("#scheduled_on").on("dp.change", function (e) {
                $("#scheduled_on").data("DateTimePicker").maxDate(e.date);
            });
        });

        $('#allow_comments').on('change',function(){
            this.value = this.checked ? 1:0;
        });

        $('#free').on('change',function(){
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