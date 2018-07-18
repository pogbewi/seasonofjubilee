@extends('admin.templates.default')
@section('page_title', 'Event Registration')
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
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-inbox" style="color: #005384"></i> Event Registration Details</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <h4><i class="icon fa fa-check"></i> Hey {{ Auth::guard('admin')->user()->name }}!</h4>
                                    Manager All Event Registraion Here
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
                                                    <th>Attend</th>
                                                    <th>Created At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($regs as $index => $reg)
                                                    <tr>
                                                        <td> <input type="checkbox" class="sub_chk" data-id="{{$reg->id}}"></td>
                                                        {{--<td> {{ ++$index }}</td>--}}
                                                        <td class="col-md-4">
                                                            {{ $reg->name }}
                                                        </td>
                                                        <td>{{  $reg->email }}</td>
                                                        <td>
                                                            @if($reg->attend)
                                                                Yes
                                                            @else
                                                                No
                                                            @endif
                                                        </td>
                                                        <td>{{ prettyDate($reg->created_at) }}</td>
                                                        <td class="col-md-4">
                                                            <a href="{{ route('admin.events.reg.read', $reg->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> view</a>
                                                            @if(Auth::guard('admin')->user()->can('delete-admin-events-controller'))
                                                                <button type="button" class="btn btn-danger btn-xs delete" data-url="{{ route('admin.events.reg.delete', $reg->id) }}" data-id="{{ $reg->id }}"><i class="fa fa-trash-o"></i> Delete</button>
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
                                                    <th>Attend</th>
                                                    <th>Created At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            @if(count($regs) > 0)
                                                <span class="pull-left">
                                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ url('/admin/events/registration') }}">Delete Selected</button>
                                            </span>

                                                <span class="pull-right">
                                                    {!! Form::open(['route'=>('admin.events.excel'),'role' => 'form','id'=>'check_lists']) !!}
                                                    {{ Form::hidden('ids[]', '',['class'=>'form-control', 'id'=>'ids']) }}
                                                     <button type="submit" style="margin-bottom: 10px" class="btn btn-danger export_excel">Export To Excel</button>
                                                    {!! Form::close() !!}
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


