@extends('admin.templates.default')
@section('page_title', 'Sermon Media Upload')
@section('header')
    <link rel="stylesheet" href="/admin/css/dropzone.css">
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
                    <a href="{{ route('admin.sermon.index') }}" class="btn btn-danger">Back</a>
                    <br><br>
                    <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box-header with-border text-center">
                                <h3 class="box-title">Embed Youtube or Vimeo Files</h3>
                            </div>
                            <div class="box-body">
                                <div class="col-sm-12 col-md-6 col-md-offset-5">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-embed-media">
                                        Enter Url
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-center">Upload Video or Photo for
                            <p>{{ $sermon->name }} sermon</p>
                        </h5>
                        <br>
                        @if(!Auth::guard('admin')->user()->can('update-admin-sermon-controller'))
                            <h6 class="text-center"><b>Cant upload Media as test user</b></h6>
                        @else
                            @if (!$sermon->filename > 1)
                                <p class="text-center"><b>Cannot upload more than 1 photo or video for one for an sermon. Delete current photo or video to upload other photo or video.</b></p><br><br>
                            @else
                                @component('admin.layouts.sermon.dropzone', [
                                     'title' => 'Upload Images',
                                     'params' => ['file'],
                                     'acceptedFiles' => '.jpg,.png,.mp4,.gif,.mp3,.pdf,.acc',
                                    'sermon' => $sermon,
                                    'uploadedFiles' => $sermons->toArray()
                                 ])
                                @endcomponent
                            @endif
                        @endif
                    </div> <!-- Close col-md-12 -->
                </div>
                <div class="row">
                    <div class="col-xs-12 gallery">
                        <div class="box box-default">
                            <div class="box-header with-border text-center">
                                <h3 class="box-title">Uploaded Media</h3>
                            </div>
                            <div class="box-body">
                                <div class="col-sm-12">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#image_media" aria-controls="home" role="tab" data-toggle="tab">Images</a></li>
                                        <li role="presentation"><a href="#video_media" aria-controls="profile" role="tab" data-toggle="tab">Uploaded Videos</a></li>
                                        <li role="presentation"><a href="#audio_media" aria-controls="profile" role="tab" data-toggle="tab">Audios</a></li>
                                        <li role="presentation"><a href="#pdf_media" aria-controls="profile" role="tab" data-toggle="tab">Pdfs</a></li>
                                        <li role="presentation"><a href="#ynv_video_media" aria-controls="profile" role="tab" data-toggle="tab">Embedded Videos</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="image_media">
                                            <div class="col-md-12 gallery">
                                                @foreach($sermons as $teaching)
                                                    @foreach ($teaching->media->chunk(5) as $set)
                                                        <div class="row" id="image_row">
                                                            @foreach ($set as $media)
                                                                @if($media->filename != '')
                                                                    <div class="col-sm-6 col-md-4 gallery_image media">
                                                                        @if(in_array($media->type, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']))
                                                                            <label>{{ $media->filename}}</label>
                                                                            <small>
                                                                                {{ bcdiv($media->size, 1024000, 3)}}MB |
                                                                                {{ $media->type }}
                                                                            </small>
                                                                            @if (!Auth::guard('admin')->user()->hasRole('admin'))
                                                                                <a href="{{ asset('storage/sermon/images/thumbnails/'.$media->filename)  }}" data-id="{{ $media->id }}" data-lity>
                                                                                    <img src="{{ asset('storage/sermon/images/thumbnails/'.$media->filename)  }}" alt="" data-id="{{ $media->id }}" class="thumbnail" width="100%">
                                                                                </a>
                                                                            @else
                                                                                <div class="img-wrap">
                                                                                    <button type="button" class="close" data-url="{{ route('admin.sermon.delete.uploadedImage', $media->id ) }}" data-id="{{  $media->id }}"><span class="times" style="color:#9F1107">&times;</span></button>
                                                                                        <a href="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$media->filename) }}" data-lity>
                                                                                            <img src="{{ asset('storage/media/upload/sermon/images/thumbnails/'.$media->filename) }}" alt="" data-id="{{ $media->id }}" class="thumbnail" width="100%">
                                                                                        </a>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach

                                                @endforeach
                                                <br><br>
                                                @if(!Auth::guard('admin')->user()->can('read-admin-sermon-controller'))

                                                @else
                                                    <button class="btn btn-info btn-sm waves-effect waves-light" onclick="location.reload();">Show</button>
                                                @endif

                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="video_media">
                                            <div class="col-md-12 gallery">
                                                @foreach($sermons as $teaching)
                                                    @foreach ($teaching->media->chunk(5) as $set)
                                                        <div class="row" id="image_row">
                                                            @foreach ($set as $media)
                                                                @if($media->filename != '')
                                                                    <div class="col-xs-6 col-sm-3 col-md-3 gallery_image media">
                                                                        @if(in_array($media->type, ['video/mp4']))
                                                                            <label>{{ $media->filename}}</label>
                                                                            <small>
                                                                                {{ bcdiv($media->size, 1024000, 3)}}MB |
                                                                                {{ $media->type }}
                                                                            </small>
                                                                            @if (!Auth::guard('admin')->user()->hasRole('admin'))
                                                                                <video controls poster="{{ asset($event->video_thumb) }}" style="width: 100%">
                                                                                    <source src="{{ asset('storage/media/upload/sermon/'.$media->filename) }}" type="video/mp4">
                                                                                    Your browser does not support video tag
                                                                                </video>
                                                                            @else
                                                                                <div class="img-wrap">
                                                                                    <button type="button" class="close" data-url="{{ route('admin.sermon.delete.uploadedImage', $media->id ) }}" data-id="{{  $media->id }}"><span class="times" style="color:#9F1107">&times;</span></button>
                                                                                    <video controls poster="{{ asset($media->video_thumb) }}" style="width: 100%">
                                                                                        <source src="{{ asset('storage/media/upload/sermon/video/'.$media->filename) }}" type="video/mp4">
                                                                                        Your browser does not support video tag
                                                                                    </video>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                                <br><br>
                                                @if(!Auth::guard('admin')->user()->can('read-admin-sermon-controller'))

                                                @else
                                                    <button class="btn btn-info btn-sm waves-effect waves-light" onclick="location.reload();">Show</button>
                                                @endif

                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="audio_media">
                                            <div class="col-md-12 gallery">
                                                @foreach($sermons as $teaching)
                                                    @foreach ($teaching->media->chunk(5) as $set)
                                                        <div class="row" id="image_row">
                                                            @foreach ($set as $media)
                                                                @if($media->filename != '')
                                                                    <div class="col-xs-6 col-sm-3 col-md-3 gallery_image media">
                                                                        @if(in_array($media->type, ['audio/mpeg']))
                                                                            <label>{{ $media->filename}}</label>
                                                                            <small>
                                                                                {{ bcdiv($media->size, 1024000, 3)}}MB |
                                                                                {{ $media->type }}
                                                                            </small>
                                                                            @if (!Auth::guard('admin')->user()->hasRole('admin'))
                                                                                <audio controls style="width: 100%">
                                                                                    <source src="{{ asset('storage/media/upload/sermon/audio/'.$media->filename) }}" type="audio/mpeg">
                                                                                    Your browser does not support video tag
                                                                                </audio>
                                                                            @else
                                                                                <div class="img-wrap">
                                                                                    <button type="button" class="close" data-url="{{ route('admin.sermon.delete.uploadedImage', $media->id ) }}" data-id="{{  $media->id }}"><span class="times" style="color:#9F1107">&times;</span></button>
                                                                                        <audio controls  style="width: 100%">
                                                                                            <source src="{{ asset('storage/media/upload/sermon/audio/'.$media->filename) }}" type="audio/mpeg">
                                                                                            Your browser does not support video tag
                                                                                        </audio>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach

                                                @endforeach
                                                <br><br>
                                                @if(!Auth::guard('admin')->user()->can('read-admin-sermon-controller'))
                                                @else
                                                    <button class="btn btn-info btn-sm waves-effect waves-light" onclick="location.reload();">Show</button>
                                                @endif
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="pdf_media">
                                            <div class="col-md-12 gallery">
                                                @foreach($sermons as $teaching)
                                                    @foreach ($teaching->media->chunk(5) as $set)
                                                        <div class="row" id="image_row">
                                                            @foreach ($set as $media)
                                                                @if($media->filename != '')
                                                                    <div class="col-xs-6 col-sm-3 col-md-3 gallery_image media">
                                                                        @if(in_array($media->type, ['application/pdf']))
                                                                            <label>{{ $media->filename}}</label>
                                                                            <small>
                                                                                {{ bcdiv($media->size, 1024000, 3)}}MB |
                                                                                {{ $media->type }}
                                                                            </small>
                                                                            @if (!Auth::guard('admin')->user()->hasRole('admin'))
                                                                                <a href="{{ asset('storage/sermon/pdf/'.$media->filename) }}"  data-id="{{ $media->id }}" data-lity>{{ $media->filename }}</a>
                                                                            @else
                                                                                <div class="img-wrap">
                                                                                    <button type="button" class="close" data-url="{{ route('admin.sermon.delete.uploadedImage', $media->id ) }}" data-id="{{  $media->id }}"><span class="times" style="color:#9F1107">&times;</span></button>
                                                                                        <a href="{{ asset('storage/sermon/pdf/'.$media->filename) }}" data-lity>{{ $media->filename }}</a>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach

                                                @endforeach
                                                <br><br>
                                                @if(!Auth::guard('admin')->user()->can('read-admin-sermon-controller'))

                                                @else
                                                    <button class="btn btn-info btn-sm waves-effect waves-light" onclick="location.reload();">Show</button>
                                                @endif

                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="ynv_video_media">
                                            <div class="col-md-12 gallery">
                                                @foreach($sermons as $teaching)
                                                    @foreach ($teaching->media->chunk(5) as $set)
                                                        <div class="row" id="image_row">
                                                            @foreach ($set as $media)
                                                                @if($media->url != '')
                                                                    <div class="col-xs-6 col-sm-3 col-md-3 gallery_image media">
                                                                        @if (!Auth::guard('admin')->user()->hasRole('admin'))
                                                                            <a href="{{ $media->video_thumb  }}" alt="" data-id="{{ $media->id }}" data-lity>
                                                                                <img src="{{ $media->video_thumb  }}" alt="" data-id="{{ $media->id }}" class="thumbnail" width="100%">
                                                                            </a>
                                                                        @else
                                                                            <div class="img-wrap">
                                                                                    <button type="button" class="close" data-url="{{ route('admin.sermon.delete.uploadedImage', $media->id ) }}" data-id="{{  $media->id }}"><span class="times" style="color:#9f1107">&times;</span></button>
                                                                                    <a href="{{ $media->video_thumb }}" data-lity>
                                                                                        <img src="{{ $media->video_thumb }}" alt="" data-id="{{ $media->id }}" class="thumbnail" width="100%">
                                                                                    </a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach

                                                @endforeach
                                                <br><br>
                                                @if(!Auth::guard('admin')->user()->can('read-admin-sermon-controller'))

                                                @else
                                                    <button class="btn btn-info btn-sm waves-effect waves-light" onclick="location.reload();">Show</button>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- modal popup here -->
                <!-- Modal -->
                <div class="modal fade" id="modal-embed-media" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-dismiss="modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                   <div class="col-sm-12">
                                           <div class="notify"></div>
                                       <div class="search-wrapper">
                                          <form class="search-form" role="search">
                                              <label for="url">Search</label>
                                                  <input type="text" name="url" id="url" class="form-control" placeholder="Enter youtube or vimeo url">
                                              <button type="button" class="btn btn-danger submit-url">Submit</button>
                                          </form>
                                      </div>
                                   </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 wrapp-embed" style="padding-top:4rem">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="" id="video"  frameborder="0" allowscriptaccess="always">
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" data-url="{{ route('admin.sermon.media.yuv') }}" class="btn btn-primary" id="save-media" data-id="{{ $sermon->id }}">Save</button>
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
@endsection
@push('scripts')


<script>
    if(!$('#image_row').length){
        $('#gallery').hide();
    }
</script>
@endpush