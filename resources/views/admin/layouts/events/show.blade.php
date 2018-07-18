<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 16/10/2017
 * Time: 14:49
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Add Event')
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
                                <h3 class="panel-title">View {{ $event->name }} Event info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 " align="center">

                                            @if($event->filename == null)
                                                No Image
                                            @else
                                                @if(in_array($event->type, ['image/jpeg', 'gif', 'png', 'jpg']))
                                                    <img src="{{ asset($event->image_url) }}" alt="{{ $event->name }}" class="thumbnail" width="60"/>
                                                @elseif(in_array($event->type, ['video/3gp', 'flv', 'video/mp4', 'mpeg']))
                                                    <video controls poster="{{ asset($event->image_url) }}" style="width: 100%">
                                                        <source src="{{ asset($event->path) }}" type="video/mp4">
                                                        Your browser does not support video tag
                                                    </video>
                                                @endif
                                            @endif

                                    </div>
                                    <div class=" col-md-8 col-lg-8 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>{{ $event->name }}</td>
                                            </tr>

                                            <td>Address:</td>
                                            <td>{{ $event->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Event Status:</td>
                                                <td>
                                                    @if($event->start_date > \Carbon\Carbon::now())
                                                        Upcoming Event
                                                    @elseif($event->end_date >= \Carbon\Carbon::now() && $event->start_date <= \Carbon\Carbon::now())
                                                        Event On Going
                                                    @elseif($event->start_date < \Carbon\Carbon::now())
                                                        Event Past
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <td>Start Date</td>
                                                <td>{{ prettyDate($event->start_date) }}</td>
                                            </tr>
                                            <tr>
                                                <td>End Date</td>
                                                <td>{{ prettyDate($event->end_date) }}</td>
                                            </tr>

                                            <td> Seo name:</td>
                                            <td>{{ $event->slug }}</td>
                                            <tr>
                                                <td> Date Created</td>
                                                <td>{{ prettyDate($event->created_at) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                    <span class="pull-left">
                                        @if(Auth::guard('admin')->user()->can('update-admin-events-controller'))
                                            <a href="{{ route('admin.events.edit', $event->slug) }}" data-original-title="Edit Event info" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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