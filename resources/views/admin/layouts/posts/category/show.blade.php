<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 14:49
 */
?>
@extends('admin.templates.default')
@section('page_title', 'View'. $category->name.'post Category')
@section('header')
    <link rel="stylesheet" href="/admin/css/show.css">
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
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12 col-xs-offset-0 toppad" >

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">View {{ $category->name }} category info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class=" col-md-12">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>{{ $category->name }}</td>
                                            </tr>
                                            <tr>
                                                <td> Parent Category</td>
                                                <td>{{ $category->parent['name'] }}</td>
                                            </tr>
                                            <td>Order:</td>
                                            <td>{{ $category->order }}</td>
                                            </tr>
                                            <td> Seo name:</td>
                                            <td>{{ $category->slug }}</td>
                                            <tr>
                                                <td> Date Created</td>
                                                <td>{{ prettyDate($category->created_at) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                    <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-post-category-controller'))
                                            <a href="{{ route('admin.categories.edit', $category->slug) }}" data-original-title="Edit category info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                        @endif
                                    </span>
                                    <span class="pull-right">
                                        <a href="{{ URL::previous() }}" data-original-title="Back To Previous Page" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                    </span>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')
        @include('admin.partials.control-sidebar')
    </div>
    <!-- ./wrapper -->
@endsection