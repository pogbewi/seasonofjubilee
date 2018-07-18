<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 09:36
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Add Sermon Category')
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
            <!-- /.content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-book" style="color: #005384"></i> Category</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                    Fill the form below to add a new Category.
                                </div>
                                <hr class="admin-hr">
                                <div class="box box-success">
                                    <div class="box-header">
                                        <h4 class="info-color-dark white-text text-center">Add Category</h4>
                                    </div>
                                    <div class="box-body">
                                        <div class="box box-success">
                                            {!! Form::open(['url'=>'/admin/category', 'role' => 'form']) !!}

                                            <div class="box-body">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="{{ old('name') }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="parent_id">Parent Category</label>
                                                        <select class="form-control" name="parent_id">
                                                            <option value="">Select</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Order</label>
                                                        <input type="text" class="form-control" id="order" name="order" placeholder="Order" value="{{ old('order') }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-sm-offset-1">
                                                    <button type="submit" class="btn btn-primary pull-right">Save Category</button>
                                                </div>
                                                <!-- /.box-footer -->
                                                    <!-- /.box-body -->
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---contents here-->
            </section>
        </div>
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')
        @include('admin.partials.control-sidebar')
    </div>
    <!-- ./wrapper -->
@endsection
@push('scripts')

@endpush