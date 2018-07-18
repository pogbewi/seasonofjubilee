@extends('admin.templates.default')
@section('page_title', 'Subscribers')
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
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-inbox" style="color: #005384"></i> Subscribers</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <h4><i class="icon fa fa-check"></i> Hey {{ Auth::guard('admin')->user()->name }}!</h4>
                                    Manager All Sbscribers Here
                                </div>
                                <hr class="admin-hr">
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <div class="table table-responsive">
                                            <table id="events" class="table table-bordered table-condense table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    {{--<th>No</th>--}}
                                                    <th class="col-md-4">Name</th>
                                                    <th class="col-md-4">Email</th>
                                                    <th>Created At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($subscribers as $index => $subscriber)
                                                    <tr>
                                                        <td> <input type="checkbox" class="sub_chk" data-id="{{$subscriber->id}}"></td>
                                                        {{--<td> {{ ++$index }}</td>--}}
                                                        <td class="col-md-4">
                                                            {{ $subscriber->name }}
                                                        </td>
                                                        <td>{{  $subscriber->email }}</td>
                                                        <td>{{ prettyDate($subscriber->created_at) }}</td>
                                                        <td class="col-md-4">
                                                            @if(Auth::guard('admin')->user()->can('delete-admin-contact-controller'))
                                                                <button type="button" class="btn btn-danger btn-xs delete" data-url="{{ route('admin.subscribers.delete', $subscriber->id) }}" data-id="{{ $subscriber->id }}"><i class="fa fa-trash-o"></i> Delete</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    {{--<th>No</th>--}}
                                                    <th class="col-md-4">Name</th>
                                                    <th class="col-md-4">Email</th>
                                                    <th>Created At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            @if(count($subscribers) > 0)
                                                <span class="pull-left">
                                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ url('/admin/subscribers/') }}">Delete Selected</button>
                                            </span>
                                            @endif
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


