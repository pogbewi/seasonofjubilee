<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 09:36
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Add Testimony')
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
                                    Fill the form below to add a new Testimony.
                                </div>
                                <hr class="admin-hr">

                            </div>
                        </div>
                        <div class="row">
                            {!! Form::open(['route'=>('admin.testimony.store'), 'role' => 'form']) !!}

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
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{ old('subject')  }}">
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
                                    <textarea class="form-control richTextBox" id="richtextbody" name="body" style="border:0px;">{{ old('body') }}</textarea>
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
                                            <textarea class="form-control" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                                        </div>

                                        {{--<div class="form-group">
                                            <label for="seo_title">Seo Tile</label>
                                            <input type="text" class="form-control" name="seo_title" id="seo_title" data-role="tagsinput">
                                        </div>--}}
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords" value="{{ old('meta_keywords')  }}">
                                        </div>
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
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Name"
                                                   value="{{ old('name') }}">
                                        </div>

                                         <div class="form-group">
                                            <label for="tag_names">Tags (Enter comma separated tags)</label>
                                            <input type="text" class="form-control" id="tag_names" name="tag_names"
                                                   placeholder="Tag Names ( e.g salvation, healing, offering)"
                                                   value="{{ old('tag_names') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Testimony Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select</option>
                                                <option value="PUBLISHED">published</option>
                                                <option value="PENDING">pending</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="allow_comments">Disable Comment ?</label>
                                            <input type="checkbox" name="allow_comments" id="allow_comments">
                                        </div>

                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="scheduled_to_picker">
                                                <label for="published_at">Published At</label>
                                                <input type="text" name="published_at" id="published_at" value="{{ old('published_at') }}" class="form-control scheduled_to_input">
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
                                            <div class="inform"></div>
                                            <input type="hidden" name="photo" id="photo">
                                            <input type="file" name="image" id="image" data-url="{{ route('admin.testimony.upload') }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                    <i class="icon wb-plus-circle"></i> Add New Testimony
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

        $('select[name="status"]').on('change',function(e){
            var option = e.target.value;
            if(option == 'PENDING'){
                $('.scheduled').removeAttr('style');
            }
        });

        $('#allow_comments').value = this.checked ? 1:0;
    });

</script>
@endpush

