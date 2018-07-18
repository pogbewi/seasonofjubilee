<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 09:36
 */
?>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                    Fill the form below to add a new Sermon.
                                </div>
                                <hr class="admin-hr">

                            </div>
                        </div>
                        <div class="row">
                            {!! Form::open(['route'=>('admin.sermon.store'), 'role' => 'form']) !!}

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
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title')  }}">
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
                                    <textarea class="form-control richTextBox" id="richtextbody" name="body" style="border:0px;">{{ old('body') }}</textarea>
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
                                        <textarea class="form-control" name="excerpt" id="excerpt">{{ old('excerpt') }}</textarea>
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
                                            <textarea class="form-control" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <input type="text" placeholder="Meta Keywords" class="form-control" name="meta_keywords" id="meta_keywords" data-role="tagsinput" value="{{ old('meta_keywords') }}">
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
                                            <input type="text" class="form-control" id="preacher" name="preacher"
                                                   placeholder="Preacher"
                                                   value="{{ old('preacher') }}">
                                        </div>

                                        <div class="form-group">
                                            <div id="preached_on_picker" class="preached_on_picker">
                                                <label for="preached_on">Preached On</label>
                                                <input type="text" name="preached_on" id="preached_on" value="{{ old('preached_on') }}" class="form-control preached_on_input">
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
                                            <input type="text" class="form-control" id="tag_names" name="tag_names" data-role="tagsinput"
                                                   placeholder="Tag Names ( e.g salvation, healing, offering)"
                                                   value="{{ old('tag_names') }}">
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
                                            <label for="allow_comments">Disable Comment ?</label>
                                            <input type="checkbox" name="allow_comments" id="allow_comments">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Sermon Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select</option>
                                                <option value="PUBLISHED">published</option>
                                                <option value="DRAFT">draft</option>
                                                <option value="PENDING">pending</option>
                                            </select>
                                        </div>

                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="scheduled_to_picker">
                                                <label for="scheduled_on">Schedule To</label>
                                                <input type="text" name="scheduled_on" id="scheduled_on" value="{{ old('scheduled_on') }}" class="form-control scheduled_to_input">
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
                                    <i class="icon wb-plus-circle"></i> Add New Sermon
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

        $('#allow_comments').on('change',function($){
            $('#allow_comments').value = this.checked ? 1:0;
        });

        $('#free').on('change',function($){
            $('#free').value = this.checked ? 1:0;
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

