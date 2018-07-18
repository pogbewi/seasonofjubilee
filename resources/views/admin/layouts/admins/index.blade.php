<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 28/09/2017
 * Time: 14:07
 */
?>
@extends('admin.templates.default')
@section('page_title', 'View Admins')
@section('header')
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
                <!--welcome div-->
                <div class="row">
                    <div class="col-lg-12 col-xs-12 text-center">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-inbox" style="color: #005384"></i> Staffs</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i> </button>
                                    <h4><i class="icon fa fa-check"></i> Hey {{ Auth::guard('admin')->user()->name }}!</h4>
                                    Manager All Admins Here
                                </div>
                                <hr class="admin-hr">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h4 class="info-color-dark white-text text-center">
                                            @if(Auth::guard('admin')->user()->can('create-admin-admin-controller'))
                                                <span class="new-button" style="float:left;">
                                                    <i class="fa fa-admin-plus" style="color: #005983"></i>&nbsp;
                                                <a href="{{ route('admin.admins.add') }}" class="btn btn-info btn-sm"><span class="fa fa-plus"></span>
                                                    &nbsp;Add new Admin
                                                </a>
                                            </span>
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <div class="table table-responsive">
                                            <table id="events" class="table table-bordered table-condense table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    {{--<th>No</th>--}}
                                                    <th>Photo</th>
                                                    <th class="col-md-4">Name</th>
                                                    <th class="col-md-4">Role</th>
                                                    <th>Date Added</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($admins as $index => $admin)
                                                    <tr>
                                                        {{--<td> {{ ++$index }}</td>--}}
                                                        <td><img src="{{ $admin->avatar }}" alt="{{ $admin->name }}" class="thumbnail image-responsive" width="100%"> </td>
                                                        <td class="col-md-4">
                                                            {{ $admin->name }}
                                                        </td>
                                                        <td>
                                                            @foreach($admin->roles as $role)
                                                                {{ $role->display_name }}
                                                            @endforeach
                                                        </td>
                                                        <td>{{ prettyDate($admin->created_at) }}</td>
                                                        <td class="col-md-4">
                                                            <a href="{{ route('admin.admins.show', $admin->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> view</a>
                                                            @if(Auth::guard('admin')->user()->can('update-admin-admin-controller'))
                                                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-primary btn-xs" style="display: none"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                                            @endif
                                                            @if(Auth::guard('admin')->user()->can('delete-admin-admin-controller'))
                                                                <button type="button" class="btn btn-danger btn-xs delete" data-url="{{ route('admin.admins.destroy', $admin->id) }}" data-id="{{ $admin->id }}"><i class="fa fa-trash-o"></i> Delete</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    {{--<th>No</th>--}}
                                                    <th>Photo</th>
                                                    <th class="col-md-4">Name</th>
                                                    <th class="col-md-4">Role</th>
                                                    <th>Date Added</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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
<script type="text/javascript">
    $(function () {
        $('#events').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "order" : [['3', "desc"]]
        })
    });
</script>
<script type="text/javascript">
    $(function(){
        $(document).on('click', '#master',function(e) {
            if($(this).is(':checked',true))
            {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked',false);
            }
        });
    });
    $(document).ready(function () {
        $('#masters').on('click', function(e) {
            if($(this).is(':checked',true))
            {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked',false);
            }
        });
    });
</script>
@endpush


