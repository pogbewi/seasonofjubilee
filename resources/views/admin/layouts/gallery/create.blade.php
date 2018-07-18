<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 09:36
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Add Gallery Item')
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
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-sticky-note-o" style="color: #005384"></i> Gallery</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                    Fill the form below to add a new gallery item.
                                </div>
                                <hr class="admin-hr">

                            </div>
                        </div>
                        <div class="row">
                            {!! Form::open(['route'=>('admin.galleries.store'), 'role' => 'form','method'=>'post', 'file'=>true]) !!}

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
                                            <span class="panel-desc"> Gallery Item Title</span>
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
                                        <h3 class="panel-title"><i class="icon wb-book"></i> Item Description</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div><!-- .panel -->

                                <div class="panel panel-bordered panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-search"></i> File Upload</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="gallery_type">Gallery Item Type</label>
                                            <select class="form-control" name="gallery_type" id="gallery_type">
                                                <option value="0">Select</option>
                                                <option value="photo">Photo</option>
                                                <option value="video">Video</option>
                                                <option value="audio">Audio</option>
                                                <option value="embedded">Youtube or Vimeo Video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="panel-body photo" style="display: none">
                                        <div class="form-group">
                                            <label for="meta_keywords">Upload Photo</label>
                                            <div class="inform"></div>
                                            <input type="hidden" name="filename" id="filename">
                                            <input type="hidden" name="size" id="size">
                                            <input type="hidden" name="type" id="type">
                                            <input type="file" name="gallery_image" id="gallery_image" data-url="{{ route('admin.galleries.upload-photo') }}" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="panel-body audio" style="display: none">
                                        <div class="form-group">
                                            <label for="meta_keywords">Upload Audio</label>
                                            <div class="inform"></div>
                                            <input type="hidden" name="filename" id="filename">
                                            <input type="hidden" name="audio_thumb" id="audio_thumb">
                                            <input type="hidden" name="size" id="size">
                                            <input type="hidden" name="type" id="type">
                                            <input type="file" name="audio_upload" id="audio_upload" data-url="{{ route('admin.galleries.upload-audio') }}" accept="audio/*">
                                        </div>
                                    </div>

                                    <div class="panel-body video" style="display: none">
                                        <div class="form-group">
                                            <label for="meta_keywords">Upload Video</label>
                                            <div class="inform"></div>
                                            <input type="hidden" name="filename" id="filename">
                                            <input type="hidden" name="video_thumb" id="video_thumb">
                                            <input type="hidden" name="size" id="size">
                                            <input type="hidden" name="type" id="type">
                                            <input type="file" name="file_upload" id="file_upload" data-url="{{ route('admin.galleries.upload-video') }}" accept="video/mp4">
                                        </div>
                                    </div>

                                    <div class="panel-body embed" style="display: none">
                                        <div class="form-group">
                                            <label for="meta_keywords">Embed Youtube or vimeo video</label>
                                            <div class="notify"></div>
                                            <div class="inform wrapp-embed" style="padding-top:4rem">
                                                <div class="embed-responsive embed-responsive-16by9" style="display: none">
                                                    <iframe class="embed-responsive-item" id="video"  frameborder="0" allowscriptaccess="always"></iframe>
                                                </div>
                                            </div>
                                            <label for="url">Search</label>
                                            <input type="hidden" name="url" id="url">
                                            <input type="hidden" name="embed_id" id="embed_id">
                                            <input type="hidden" name="type" id="type">
                                            <input type="hidden" name="video_thumb" id="video_thumb">
                                            <input type="text" name="embed_url" id="embed_url" class="form-control" placeholder="Enter youtube or vimeo url"><br>
                                            <button type="button" class="btn btn-danger submit-embeded-url">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 sidebar_wrapper">
                                <div class="panel panel panel-bordered panel-warning">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-clipboard"></i> Post Info</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="gallery_category_id">Gallery Category</label>
                                            <select class="form-control" name="gallery_category_id" id="gallery_category_id">
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tag_names">Tags (Enter comma separated tags)</label>
                                            <input type="text" class="form-control" id="tag_names" name="tag_names"
                                                   placeholder="Tag Names ( e.g salvation, healing, offering)"
                                                   value="{{ old('tag_names') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="featured">Featured ?</label>
                                            <input type="checkbox" name="featured" id="featured">
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">Select</option>
                                                <option value="PUBLISHED">publish</option>
                                                <option value="PENDING">pending</option>
                                            </select>
                                        </div>

                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="scheduled_to_picker">
                                                <label for="published_at">Published At</label>
                                                <input type="text" name="published_at" id="published_at" value="{{ old('published_at') }}" class="form-control scheduled_to_input">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="allow_comments">Disable Comments ?</label>
                                            <input type="checkbox" name="allow_comments" id="allow_comments">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                    <i class="icon wb-plus-circle"></i> Add New Gallery
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
            }else{
                $('.scheduled').css('display','none');
            }
        });

        $("select[id=gallery_type]").on('change',function(e){
            var option = e.target.value;
            if(option == 'photo'){
                $('.photo').removeAttr('style');
                $('.video').css('display','none');
                $('.audio').css('display','none');
                $('.embed').css('display','none');
            }else if(option == 'video') {
                $('.video').removeAttr('style');
                $('.photo').css('display','none');
                $('.audio').css('display','none');
                $('.embed').css('display','none');
            }else if(option == 'audio') {
                $('.audio').removeAttr('style');
                $('.video').css('display','none');
                $('.photo').css('display','none');
                $('.embed').css('display','none');
            }else if(option == 'embedded') {
                $('.embed').removeAttr('style');
                $('.video').css('display','none');
                $('.audio').css('display','none');
                $('.photo').css('display','none');
            }
        });

        $('#allow_comments').on('change',function(){
            this.value = this.checked ? 1:0;
        });

        $('#featured').on('change',function(){
            this.value = this.checked ? 1:0;
        });

    });

</script>
@endpush

