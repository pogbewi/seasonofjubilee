@extends('admin.templates.default')
@section('page_title', 'Add Staff')
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
                                    Fill the form below to add a new Staff.
                                </div>
                                <hr class="admin-hr">

                            </div>
                        </div>
                        <div class="row">
                            {!! Form::open(['route'=>('admin.staffs.store'), 'role' => 'form']) !!}

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
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name')  }}">
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
                                    <textarea class="form-control richTextBox" id="richtextbody" name="bio" style="border:0px;">{{ old('bio') }}</textarea>
                                </div><!-- .panel -->

                                <div class="panel panel-bordered panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-book"></i> Staff Position</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}">
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
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Select</option>
                                            <option value="PUBLISHED">published</option>
                                            <option value="PENDING">pending</option>
                                        </select>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group scheduled" style="display: none">
                                            <div id="scheduled_to_picker" class="scheduled_to_picker">
                                                <label for="published_at">Published At</label>
                                                <input type="text" name="published_at" id="published_at" value="{{ old('published_at') }}" class="form-control scheduled_to_input">
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
                                            <label for="position">Facebook Profile url</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook"
                                                   placeholder="facebook Profile url"
                                                   value="{{ old('facebook') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter">Twitter Profile url</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter"
                                                   placeholder="Twitter Profile url"
                                                   value="{{ old('twitter') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="linkedin">Google Plus Profile url</label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin"
                                                   placeholder="LinkedIn"
                                                   value="{{ old('linkedin') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="instagram">Instagram Profile url</label>
                                            <input type="text" class="form-control" id="instagram" name="instagram"
                                                   placeholder="Instagram Profile url"
                                                   value="{{ old('instagram') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="youtube">LinkedIn Profile url</label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin"
                                                   placeholder="LinkedIn Profile Profile url"
                                                   value="{{ old('linkedin') }}">
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
                                            <div class="inform"></div>
                                            <input type="hidden" name="photo" id="photo" >
                                            <input type="file" name="image" id="image" data-url="{{ route('admin.staffs.upload') }}">
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

