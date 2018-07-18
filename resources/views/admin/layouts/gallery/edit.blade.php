<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 09:36
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Edit Gallery Item')
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
                            {!! Form::model($gallery, [
                                  'method' => 'PATCH',
                                  'route' => ['admin.galleries.update', $gallery->slug],
                                  'role' => 'form',
                                  'file' => true,
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
                                            <span class="panel-desc"> Gallery Item Title</span>
                                        </h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        {{ Form::hidden('slug', $gallery->slug ,['class'=>'form-control', 'id'=>'slug', 'placeholder'=>'Slug']) }}
                                        {{ Form::text('title', old('title'),['class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title']) }}
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
                                            {{ Form::textarea('description', old('description'),['class'=>'form-control', 'id'=>'description', 'placeholder'=>'Description']) }}
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
                                            {{ Form::select('gallery_type', ['0'=>'Select','photo'=>'Photo','video'=>'video','audio'=>'Audio','embedded'=>'Youtube or Vimeo Video'], old('gallery_type'),['id'=>'gallery_type','class'=>'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="panel-body photo" style="display: none">
                                        <div class="form-group">
                                            <label for="meta_keywords">Upload Photo</label>
                                            <div class="inform" style="padding: 7px"><img src="{{ file_exists(public_path('/storage/uploads/galleries/photos/thumbnails/'.$gallery->filename))? '/storage/uploads/galleries/photos/thumbnails/'.$gallery->filename: '' }}" width="100%"></div>
                                            {{ Form::hidden('filename', $gallery->filename,['id'=>'filename']) }}
                                            {{ Form::hidden('size', $gallery->size,['id'=>'size']) }}
                                            {{ Form::hidden('type', $gallery->type,['id'=>'type']) }}
                                            {{ Form::file('gallery_image',['id'=>'gallery_image', 'data-url'=>route('admin.galleries.upload-photo'), 'accept'=>"image/*"]) }}
                                        </div>
                                    </div>
                                    <div class="panel-body audio" style="display: none">
                                        <div class="form-group">
                                            <label for="meta_keywords">Upload Audio</label>
                                            <div class="inform" style="padding: 7px"><img src="{{ isset($gallery->audio_thumb)?'/'.$gallery->audio_thumb:"" }}" width="100%"></div>
                                            {{ Form::hidden('filename', $gallery->filename,['id'=>'filename']) }}
                                            {{ Form::hidden('audio_thumb', $gallery->audio_thumb,['id'=>'audio_thumb']) }}
                                            {{ Form::hidden('size', $gallery->size,['id'=>'size']) }}
                                            {{ Form::hidden('type', $gallery->type,['id'=>'type']) }}
                                            {{ Form::file('audio_upload',['id'=>'audio_upload', 'data-url'=>route('admin.galleries.upload-audio'), 'accept'=>"audio/*"]) }}
                                        </div>
                                    </div>

                                    <div class="panel-body video" style="display: none">
                                        <div class="form-group">
                                            <label for="file_upload">Upload Video</label>
                                            <div class="inform" style="padding: 7px"><img src="{{ isset($gallery->video_thumb)?'/'.$gallery->video_thumb:"" }}" width="100%"></div>
                                            {{ Form::hidden('filename', $gallery->filename,['id'=>'filename']) }}
                                            {{ Form::hidden('video_thumb', $gallery->video_thumb,['id'=>'video_thumb']) }}
                                            {{ Form::hidden('size', $gallery->size,['id'=>'size']) }}
                                            {{ Form::hidden('type', isset($gallery->type)?$gallery->type:"",['id'=>'type']) }}
                                            {{ Form::file('file_upload',['id'=>'file_upload', 'data-url'=>route('admin.galleries.upload-video'), 'accept'=>"video/mp4"]) }}
                                        </div>
                                    </div>

                                    <div class="panel-body embed" style="display: none">
                                        <div class="form-group">
                                            <label for="meta_keywords">Embed Youtube or vimeo video</label>
                                            <div class="notify"></div>
                                            <div class="inform wrapp-embed" style="padding-top:4rem">
                                                <div class="embed-responsive embed-responsive-16by9" style="display: none">
                                                    <iframe class="embed-responsive-item" src="{{ isset($gallery->url)?$gallery->url:"" }}" id="video"  frameborder="0" allowscriptaccess="always"></iframe>
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
                                            {{ Form::select('gallery_category_id', $categories, old('gallery_category_id'),['id'=>'gallery_category_id','class'=>'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="tag_names">Tags (Enter comma separated tags)</label>
                                            {{ Form::text('tag_names', old('tag_names'),['class'=>'form-control', 'id'=>'tag_names','data-role'=>"tagsinput", 'placeholder'=>'Tag Names']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="featured">Featured ?</label>
                                            {{ Form::checkbox('featured', old('featured'), ['id'=>'featured']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            {{ Form::select('status', ['PUBLISHED'=>'published','PENDING'=>'pending'], old('status'),['id'=>'status','class'=>'form-control']) }}
                                        </div>

                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="scheduled_to_picker">
                                                <label for="published_at">Published At</label>
                                                {{ Form::text('published_at', old('published_at'),['class'=>'form-control scheduled_to_input', 'id'=>'published_at', 'placeholder'=>'Published At']) }}
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="allow_comments">Disable Comments ?</label>
                                            {{ Form::checkbox('allow_comments', old('allow_comments'), ['id'=>'allow_comments']) }}
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                    <i class="icon wb-plus-circle"></i> Update Gallery Item
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

