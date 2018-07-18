@extends('admin.templates.default')
@section('page_title', 'Edit Staff')
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
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-sticky-note-o" style="color: #005384"></i> Staff</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i> </button>
                                    <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                    Fill the form below to Edit Staff.
                                </div>
                                <hr class="admin-hr">

                            </div>
                        </div>
                        <div class="row">
                            {!! Form::model($staff, [
                              'method' => 'PATCH',
                              'route' => ['admin.staffs.update', $staff->slug],
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
                                            <span class="panel-desc"> name of The Staff</span>
                                        </h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        {{ Form::hidden('slug', $staff->slug ,['class'=>'form-control', 'id'=>'slug', 'placeholder'=>'Slug']) }}
                                        {{ Form::text('name', old('name'),['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name']) }}
                                    </div>
                                </div>

                                <!-- ### CONTENT ### -->
                                <div class="panel panel-bordered panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-book"></i> Staff Bio</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    {{ Form::textarea('bio', old('bio'),['class'=>'form-control richTextBox', 'id'=>'richTextBox', 'placeholder'=>'Bio','style'=>'border:0px;']) }}
                                </div><!-- .panel -->

                                <div class="panel panel-bordered panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-book"></i> Staff Position</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        {{ Form::text('position', old('position'),['class'=>'form-control', 'id'=>'position', 'placeholder'=>'Position']) }}
                                    </div>
                                </div><!-- .panel -->

                                <div class="panel panel-bordered panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-book"></i> Status</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <label for="status">Status</label>
                                        {{ Form::select('status', ['PUBLISHED'=>'published', 'DRAFT'=>'draft','PENDING'=>'pending'], old('status'),['class'=>'form-control']) }}
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="scheduled_to_picker">
                                                <label for="published_at">Published At</label>
                                                {{ Form::text('published_at', old('published_at'),['class'=>'form-control scheduled_to_input', 'id'=>'published_at', 'placeholder'=>'Published At']) }}
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 sidebar_wrapper">
                                <div class="panel panel panel-bordered panel-warning">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-clipboard"></i> Staff Info</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="position">Facebook Handle</label>
                                            {{ Form::text('facebook', isset($social_handle->facebook) ? $social_handle->facebook : "",['class'=>'form-control', 'id'=>'facebook', 'placeholder'=>'Facebook']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            {{ Form::text('twitter', isset($social_handle->twitter) ? $social_handle->twitter : "",['class'=>'form-control', 'id'=>'twitter', 'placeholder'=>'Twitter']) }}
                                        </div>

                                        <div class="form-group">
                                            <label for="linkedin">LinkedIn</label>
                                            {{ Form::text('linkedin', isset($social_handle->linkedin) ? $social_handle->linkedin : "", ['class'=>'form-control', 'id'=>'linkedin', 'placeholder'=>'LinkedIn']) }}
                                        </div>
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            {{ Form::text('instagram', isset($social_handle->instagram)? $social_handle->instagram : "",['class'=>'form-control', 'id'=>'instagram', 'placeholder'=>'Instagram']) }}
                                        </div>

                                    </div>
                                    <div class="panel panel-bordered panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="icon wb-image"></i> staffs's photo </h3>
                                            <div class="panel-actions">
                                                <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="inform" style="padding: 7px"><img src="/storage/uploads/staffs/photos/thumbnails/{{ $staff->avatar }}" width="100%"></div>
                                            {{ Form::hidden('photo', old($staff->avatar),['id'=>'photo']) }}
                                            {{ Form::file('image',['id'=>'image', 'data-url'=>route('admin.staffs.upload')]) }}
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                    <i class="icon wb-plus-circle"></i> Add New staff
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
            $('.scheduled').attr('style="display:hidden');
            option = '';
        });
    });

</script>
@endpush

