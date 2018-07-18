<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 14:49
 */
?>
@extends('admin.templates.default')
@section('page_title', $reg->name)
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
                                <h3 class="panel-title">View info From {{ $reg->name }}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class=" col-md-12">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>From:</td>
                                                <td>{{ $reg->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td>{{ $reg->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email:</td>
                                                <td>
                                                    {{ $reg->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No. Of Seat</td>
                                                <td>{{ $reg->seat }}</td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td> Gender:</td>
                                                <td>{{ $reg->gender }}</td>
                                            </tr>
                                            <tr>
                                                <td> Attend:</td>
                                                <td>
                                                    @if($reg->attend)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Date Registered</td>
                                                <td>{{ prettyDate($reg->created_at) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
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