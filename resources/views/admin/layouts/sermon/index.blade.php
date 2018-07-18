@extends('admin.templates.default')
@section('page_title', 'Manage Sermon')
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
                                <h2 class="panel-title info-color-dark white-text text-left"><i class="fa fa-book" style="color: #005384"></i> Sermon</h2>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <h4><i class="icon fa fa-check"></i> Hey {{ Auth::guard('admin')->user()->name }}!</h4>
                                    Manager All Sermon Here
                                </div>
                                <hr class="admin-hr">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h4 class="info-color-dark white-text text-center">
                                            @if(Auth::guard('admin')->user()->can('create-admin-sermon-controller'))
                                                <span class="new-button" style="float:left;">
                                                    <i class="fa fa-admin-plus" style="color: #005983"></i>&nbsp;
                                                <a href="{{ route('admin.sermon.create') }}" class="btn btn-info btn-sm"><span class="fa fa-plus"></span>
                                                    &nbsp;Create New Sermon
                                                </a>
                                            </span>
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <div class="table table-responsive">
                                            <table id="sermons" class="table table-bordered table-condensed table-responsive table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    {{--<th>No</th>--}}
                                                    <th class="col-md-4">Featured Photo</th>
                                                    <th class="col-md-4">title</th>
                                                    <th>Published</th>
                                                    <th>Close Comment ?</th>
                                                    <th>Views</th>
                                                    <th>Published At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($sermons as $index => $sermon)
                                                    <tr>
                                                        <td> <input type="checkbox" class="sub_chk" data-id="{{$sermon->id}}"></td>
                                                        {{--<td> {{ ++$index }}</td>--}}
                                                        <td class="col-md-4">
                                                            @if($sermon != null)
                                                                No media
                                                            @else
                                                                @foreach($sermon->media as $file)
                                                                    @if(in_array($sermon->type, ['image/jpeg', 'image/gif', 'image/png', 'image/jpg']))
                                                                        <img src="{{ asset('storage/uploads/sermons/images/thumbnails/'.$sermon->filename) }}" alt="{{ $sermon->name }}" class="thumbnail" width="100%"/>
                                                                    @elseif(in_array($sermon->type, ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'mpeg']))
                                                                        <video controls poster="{{ asset($sermon->video_thumb) }}" style="width: 100%">
                                                                            <source src="{{ asset('storage/uploads/sermons/files/'.$sermon->filename) }}" type="video/mp4">
                                                                            Your browser does not support video tag
                                                                        </video>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>{{  $sermon->title }}</td>
                                                        <td>
                                                           {{ $sermon->published }}
                                                        </td>
                                                        <td> <input type="checkbox" value="{{ $sermon->allow_comments ? false : true }}" class="comment" data-url="{{ route('admin.sermon.comments.toggle') }}" data-id="{{$sermon->id}}"></td>
                                                        <td>{{  $sermon->views }}</td>
                                                        <td>{{  prettyDate($sermon->created_at) }}</td>
                                                        <td class="col-md-4">
                                                            <a href="{{ route('admin.sermon.show', $sermon->slug) }}" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> view</a>
                                                            @if(Auth::guard('admin')->user()->can('update-admin-sermon-controller'))
                                                                <a href="{{ route('admin.sermon.get.media', $sermon->slug) }}" class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i> Add media</a>
                                                            @endif
                                                            @if(Auth::guard('admin')->user()->can('update-admin-sermon-controller'))
                                                                <a href="{{ route('admin.sermon.edit', $sermon->slug) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                                            @endif
                                                            @if(Auth::guard('admin')->user()->can('delete-admin-sermon-controller'))
                                                                <button type="button" class="btn btn-danger btn-xs delete" data-url="{{ route('admin.sermon.destroy', $sermon->id) }}" data-id="{{ $sermon->id }}"><i class="fa fa-trash-o"></i> Delete</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    {{--<th>No</th>--}}
                                                    <th class="col-md-4">Featured Photo</th>
                                                    <th class="col-md-4">title</th>
                                                    <th>Published</th>
                                                    <th>Close Comment ?</th>
                                                    <th>Views</th>
                                                    <th>Published At</th>
                                                    <th class="col-md-4">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            @if(count($sermons) > 0)
                                                <span class="pull-left">
                                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ url('/admin/sermons/') }}">Delete Selected</button>
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
        $('#sermons').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "order" : [['6', "desc"]]
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

    $('.comment').on('change',function($){
        this.value = this.checked ? true:false;
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


