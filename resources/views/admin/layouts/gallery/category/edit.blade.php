<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 09:36
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Edit Gallery Category')
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
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i> </button>
                                    <h4><i class="icon fa fa-check"></i> Hey Admin!</h4>
                                    Fill the form below to edit Category.
                                </div>
                                <hr class="admin-hr">
                                <div class="box box-success">
                                    <div class="box-header">
                                        <h4 class="info-color-dark white-text text-center">Edit Category</h4>
                                    </div>
                                    <div class="box-body">
                                        <div class="box box-success">
                                            {!! Form::model($category, [
                                             'method' => 'PATCH',
                                             'url' => ['/admin/gallery-categories/'.$category->slug],
                                             'role' => 'form'
                                         ]) !!}

                                            <div class="box-body">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        {{ Form::hidden('slug') }}
                                                        {{ Form::text('name', old('name'),['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Category Name']) }}
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="parent_id">Parent Category</label>
                                                        {{ Form::select('parent_id', $categories, null,['class'=>'form-control']) }}
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Order</label>
                                                        {{ Form::text('order', old('order'),['class'=>'form-control', 'id'=>'order', 'placeholder'=>'Order']) }}
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-sm-offset-1">
                                                    <button type="submit" class="btn btn-primary pull-right">Update Category</button>
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