<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 09:36
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Add Event')
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
                                    <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-sticky-note-o" style="color: #005384"></i> Post</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                        Fill the form below to add a new Event.
                                    </div>
                                    <hr class="admin-hr">

                                </div>
                            </div>
                            <div class="row">
                                    {!! Form::open(['route'=>('admin.events.store'), 'role' => 'form']) !!}

                                    <div class="col-md-6">
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
                                                    <span class="panel-desc"> The name for this Event</span>
                                                </h3>
                                                <div class="panel-actions">
                                                    <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name')  }}">
                                            </div>
                                        </div>

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    <span class="panel-desc"> The Address for this Event</span>
                                                </h3>
                                                <div class="panel-actions">
                                                    <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address')  }}">
                                            </div>
                                        </div>

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    <span class="panel-desc"> The Email Address for this Event</span>
                                                </h3>
                                                <div class="panel-actions">
                                                    <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email')  }}">
                                            </div>
                                        </div>

                                        <!-- ### EXCERPT ### -->
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Excerpt <small>Small description of this Event</small></h3>
                                                <div class="panel-actions">
                                                    <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description">{{ old('description')  }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 sidebar_wrapper">
                                        <div class="panel panel panel-bordered panel-warning">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="icon wb-clipboard"></i> Event Info</h3>
                                                <div class="panel-actions">
                                                    <a class="panel-action savysoft-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="name">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                           placeholder="Phone"
                                                           value="{{ old('phone') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Website</label>
                                                    <input type="text" class="form-control" id="website" name="website"
                                                           placeholder="Website"
                                                           value="{{ old('website') }}">
                                                </div>

                                                <div class="form-group">
                                                    <div id="start_date_picker" class="start_date_picker">
                                                    <label for="start_date">Start Date</label>
                                                    <input type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control start_date_input">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div id="end_date_picker" class="input-group date end_date_picker">
                                                        <label for="end_date">End Date</label>
                                                        <input type="text" name="end_date" class="form-control" id="end_date" value="{{ old('end_date') }}">
                                                          <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tag_names">Tags (Enter comma separated tags)</label>
                                                    <input type="text" class="form-control" id="tag_names" name="tag_names"
                                                           placeholder="Tag Names ( e.g salvation, healing, offering)"
                                                           value="{{ old('tag_names') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="registrable">Enable Event Registration ?</label>
                                                    <input type="checkbox" name="registrable" id="registrable">
                                                </div>

                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px">
                                            <i class="icon wb-plus-circle"></i> Add New Event
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
            $('#start_date').datetimepicker({
                format: 'MM/DD/YYYY HH:mm'
            });
            $('#end_date').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'MM/DD/YYYY HH:mm'
            });
            $("#start_date").on("dp.change", function (e) {
                $('#end_date').data("DateTimePicker").minDate(e.date);
            });
        });

        $('#registrable').on('change',function(){
            this.value = this.checked ? 1:0;
        });
    });

</script>
@endpush

