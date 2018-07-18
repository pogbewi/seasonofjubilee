@extends('admin.templates.default')
@section('page_title', 'User Eevent')
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
                    <a href="{{ route('admin.events.index') }}" class="btn btn-danger">Back</a>
                    <br><br>

                    <div class="col-md-12">

                        <h5 class="text-center">Upload Video or Photo for
                                <p>{{ $event->name }} Event</p>
                        </h5>

                        <br>

                        @if(Auth::guard('admin')->user()->can('update-admin-event-controller'))
                            <h6 class="text-center"><b>Cant upload images as test user</b></h6>
                        @else
                            @if (!$event->filename > 1)
                                <p class="text-center"><b>Cannot upload more than 1 photo or video for one for an event. Delete current photo or video to upload other photo or video.</b></p><br><br>
                            @else
                                @component('admin.layouts.events.dropzone', [
                                     'title' => 'Upload Images',
                                     'params' => ['file'],
                                     'acceptedFiles' => '.jpg,.png,.mp4,.gif',
                                    'event' => $event,
                                    'uploadedFiles' => $events->toArray()
                                 ])
                                @endcomponent
                            @endif
                        @endif


                        <div class="col-md-12 gallery">
                            @foreach ($events->chunk(5) as $set)
                                <div class="row" id="image_row">
                                    @foreach ($set as $media)
                                       @if($media->filename != '')
                                            <div class="col-xs-6 col-sm-3 col-md-3 gallery_image">
                                                <label>{{ $media->name }}</label>
                                                <small>
                                                    {{ $media->human_readable_size }} |
                                                    {{ $media->mime_type }}
                                                </small>
                                                @if (Auth::guard('admin')->user()->hasRole('admin'))
                                                    @if(starts_with($media->mime_type, 'image'))
                                                        <a href="{{ $media->getUrl() }}" data-lity>
                                                            <img src="{{ $media->getPath()  }}" alt="" data-id="{{ $media->id }}">
                                                        </a>
                                                    @endif
                                                @else
                                                    <div class="img-wrap">
                                                        <form method="post" action="{{ route('admin.product.photo.delete', $photo->id ) }}">
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="close">&times;</button>
                                                            <a href="{{ $photo->path }}" data-lity>
                                                                <img src="/../{{ $photo->thumbnail_path }}" alt="" data-id="{{ $photo->id }}">
                                                            </a>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            @endforeach

                            <br><br>

                            @if(Auth::guard('admin')->user()->can('read-admin-event-controller'))

                            @else
                                <button class="btn btn-info btn-sm waves-effect waves-light" onclick="location.reload();">Show</button>
                            @endif

                        </div>

                    </div> <!-- Close col-md-12 -->
                </div>
                    <!-- /.row -->
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