@extends('admin.templates.default')
@section('page_title', 'Projects')
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
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-stack" style="color: #005384"></i> Projects</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <h4><i class="icon fa fa-check"></i> Hey {{ Auth::guard('admin')->user()->name }}!</h4>
                                    Manager All Projects Here
                                </div>
                                <hr class="admin-hr">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h4 class="info-color-dark white-text text-center">
                                            @if(Auth::guard('admin')->user()->can('create-admin-project-controller'))
                                                <span class="new-button" style="float:left;">
                                                    <i class="fa fa-admin-plus" style="color: #005983"></i>&nbsp;
                                                <a href="{{ route('admin.projects.create') }}" class="btn btn-info btn-sm"><span class="fa fa-plus"></span>
                                                    &nbsp;Add New Projects
                                                </a>
                                            </span>
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <div class="table table-responsive">
                                            <table id="project" class="table table-bordered table-condense table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="masters"></th>
                                                    {{--<th>No</th>--}}
                                                    <th>Photo</th>
                                                    <th class="col-md-4">Title</th>
                                                    <th>Completion Date</th>
                                                    <th>Created At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($projects as $index => $project)
                                                    <tr>
                                                        <td> <input type="checkbox" class="sub_chk" data-id="{{$project->id}}"></td>
                                                        {{--<td> {{ ++$index }}</td>--}}
                                                        <td class="col-md-4">
                                                            <img src="{{ asset('storage/uploads/projectss/images/thumbnails/'.$project->photo) }}" alt="{{ $project->title }}" class="thumbnail" width="100%"/>
                                                        </td>
                                                        <td>{{  $project->title }}</td>
                                                        <td>
                                                            {{ Carbon\Carbon::parse($project->created_at)->diffForHumans() }}
                                                        </td>
                                                        <td>{{ prettyDate($project->created_at) }}</td>
                                                        <td class="col-md-4">
                                                            <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> view</a>
                                                            @if(Auth::guard('admin')->user()->can('update-admin-project-controller'))
                                                                <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                                            @endif
                                                            @if(Auth::guard('admin')->user()->can('delete-admin-project-controller'))
                                                                <button type="button" class="btn btn-danger btn-xs delete" data-url="{{ route('admin.projects.destroy', $project->id) }}" data-id="{{ $project->id }}"><i class="fa fa-trash-o"></i> Delete</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" id="masters"></th>
                                                    {{--<th>No</th>--}}
                                                    <th>Photo</th>
                                                    <th class="col-md-4">Title</th>
                                                    <th>Completion Date</th>
                                                    <th>Created At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            @if(count($projects) > 0)
                                                <span class="pull-left">
                                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ url('/admin/projects/') }}">Delete Selected</button>
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
        $('#project').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "order" : [['4', "desc"]]
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

 /*   $('.comment').on('change',function($){
        this.value = this.checked ? true:false;
    });*/

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
