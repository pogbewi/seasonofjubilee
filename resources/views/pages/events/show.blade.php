@extends('templates.default')
@section('page_title', $page_title)
@section('description', $page_description)
@section('keyword', $page_keywords)
@section('body-class', 'body main-page index')

@section('header')
    <style type="text/css">
        #map_canvas {
            height: 100%;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    @include('partials.header')
<section id="banner">
    <div id="pagebaner">
        <div>
            <img src="{{ setting('event_page_photo') ? '/storage/'.setting('event_page_photo') : '' }}" class="img-responsive bannerheight">
            <div  id="gallery-overlays">
                <h1 class="white text-center animated fadeInUp slow">
                    <span class="captial fontsize20 lineheight50">Event</span><br/>
                </h1>
            </div>
        </div>
    </div>
</section>
    <div class="clearfix"></div>
<div class="container">
    <div class="height30"></div>
    <h1 class="white text-center animated fadeInUp slow">
        <span class="fcaptial thisfont thislineheight black">{{ $event->name }}</span>
    </h1>
    <div class="height30"></div>
        <div class="col-md-8">
            <div class="mbottom">
                @if($event->filename == null)
                    <img src="/local/images/post/1516162227.jpg" class="img-responsive blogpost">
                @else
                    @if(in_array($event->type, ['image/jpeg', 'image/gif', 'image/png', 'image/jpg']))
                        <img src="{{ asset('/storage/uploads/events/images/'.$event->filename)  }}" alt="{{ $event->name }}" class="thumbnail img-responsive blogpost" width="100%"/>
                    @elseif(in_array($event->type, ['video/3gp','video/m3u8', 'flv','video/webm','video/3gpp', 'video/mp4', 'mpeg']))
                        <video controls poster="{{ asset($event->video_thumb) }}" style="width: 100%">
                            <source src="{{ asset('/storage/uploads/events/files/'.$event->filename) }}" type="video/mp4">
                            Your browser does not support video tag
                        </video>
                    @endif
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="borderbottom">
                <h3 class="fontsize20 heading topoff">Event</h3>
                <h3 class="fontsize20 heading topoff">Details</h3>
            </div>
            <div class="clear height20"></div>
            <div class="black">
                <span class="bold fontsize16">Start Date : </span><br/><span class="fontsize13">{{ \Carbon\Carbon::parse($event->start_date)->format('M d Y @ h:i a') }}</span>    <div class="clear height10"></div>
                <span class="bold fontsize16">End Date : </span><br/><span class="fontsize13">{{ \Carbon\Carbon::parse($event->end_date)->format('M d Y @ h:i:s a ') }}</span>    <div class="clear height10"></div>
                <span class="bold fontsize16">Event Address : </span><br/><span class="fontsize13">{{ $event->address }}</span>    <div class="clear height10"></div>
                <span class="bold fontsize16">Telephone : </span><span class="fontsize13">{{ $event->phone ? : '-' }}</span>    <div class="clear height10"></div>
                <span class="bold fontsize16">Webseite : </span><span class="fontsize13"><a href="{{ $event->website ? : 'javascript:void(0)' }}" target="_blank" class="black">{{ $event->website ? : '-' }}</a></span>     <div class="clear height10"></div>
                <span class="bold fontsize16">Email : </span><span class="fontsize13"><a href="mailto:{{ $event->email ? : '-' }}" class="black">{{ $event->email ? : '-' }}</a></span>
            </div>
        </div>
        <div class="clear height20"></div>
        <div class="col-md-12">
            <div class="para black">
                {{ $event->description }}
            </div>
        </div>
        <div class="clear height20"></div>
        <div class="col-md-12 text-right"><a href="javascript:void(0)" class="avg_big_button" data-toggle="modal" data-target="#booking">Register For This Event...</a></div>
        <div class="clear height20"></div>
        <div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="booking" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="POST" action="{{ route('events.register.store') }}" id="formID" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="lnr lnr-cross gold bold"></span></button>
                            <h4 class="modal-title h4 black" id="myModalLabel">Registration</h4>
                        </div>
                        <div class="modal-body">
                            <div class="notify text-center"></div>
                            @if ($message = Session::get('reg-success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                                    <strong>{{ $message }}</strong>

                                </div>
                            @endif
                            <div class="form-group" id="name-div">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                        <span class="help-block">
                                            <strong id="name-error"></strong>
                                        </span>
                                </div>
                            </div>
                            <div class="form-group" id="email-div">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        <span class="help-block">
                                              <strong id="email-error"></strong>
                                        </span>
                                </div>
                            </div>
                            <div class="form-group" id="phone-div">
                                <label for="phone" class="col-md-4 control-label">Phone Number</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
                                        <span class="help-block">
                                            <strong id="phone-error"></strong>
                                        </span>
                                </div>
                            </div>
                            <div class="form-group" id="gender-div">
                                <label for="gender" class="col-md-4 control-label">Gender:</label>
                                <div class="col-md-6">
                                    <select id="gender" class="form-control" name="gender">
                                        <option value="" selected="selected" >Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                        <span class="help-block">
                                        <strong id="gender-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group" style="float: none">
                                    <label for="attend" style="float: none">Will You Attend ?</label>
                                    <input type="checkbox" name="attend" id="attend" class="wpcf7-text" placeholder="Will You Attend ?">
                                </div>
                            </div>
                            <div class="form-group" id="seat-div">
                                <label for="seat" class="col-md-4 control-label">No of Seat</label>

                                <div class="col-md-6">
                                    <input id="seat" type="number" class="form-control" name="seat" value="{{ old('seat') }}" autofocus>
                                        <span class="help-block">
                                                    <strong id="seat-error"></strong>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="clear height30"></div>
                        <div class="modal-footer">
                            <input type="button" class="avg_small_border_button" data-dismiss="modal" value="Close">
                            <input type="submit" id="event_registration" class="avg_very_small_button" data-url="{{ route('events.register.store') }}" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear height30"></div>
        <div class="col-md-12">
            <div id="map_canvas" style="width:100%;height:400px;background:yellow"></div>
        </div>
        <div class="clear height50"></div>
        <div class="col-md-12">
            <div class="col-md-6 paddingoff">
            </div>

            <div class="col-md-6 paddingoff">
                <div class="text-right page_previous">
                    <a href="{{ URL::previous() }}" class="avg_very_small_button fontbtn">Previous Event Page<i class="lnr lnr-arrow-right"></i></a></div>
            </div>
        </div>
        <div class="clear height50"></div>
        <div class="col-md-12">
            <div class="topbottom_bar">
                <div class="clear height30"></div>

                <div class="h3 black text-center">Follow Us or Share on The Follow Platforms:</div>
                <div class="clear height30"></div>

                <div class="share-items text-center" data-title="Auf dem richtigen Weg gehen" data-hash="Auf dem richtigen Weg gehen"
                     data-url="../82/walking-on-the-right-way.html">

                    <div class="socialshare text-center">
                        <ul class="share-links">
                            <li>
                                <a class="twitterBtn" data-dir="left" href="#" >
                                    <span>Twitter</span>
                                    <span class="twitter-count"></span>
                                </a>
                            </li>
                            <li>
                                <a class="facebookBtn" href="#">
                                    <span>Facebook</span>
                                    <span class="facebook-count"></span>
                                </a>
                            </li>
                            <li>
                                <a class="linkedinBtn" href="#">
                                    <span>LinkedIn</span>
                                    <span class="linkedin-count"></span>
                                </a>
                            </li>
                            <li>
                                <a class="googleBtn" href="#">
                                    <span>Google</span>
                                    <span class="google-count"></span>
                                </a>
                            </li>
                            <li>
                                <span>Count</span>
                                <span class="total-count"></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clear height50"></div>
            </div>
        </div>
        <div class="clear height50"></div>
        <div class="text-left">
            <span class="bold black"><i class="lnr lnr-tag bold"></i> Event Tags :</span>
                    <span>
                        @if(count($event->tags) > 0)
                            @foreach($event->tags as $tag)
                                <a href="{{ route('events.tags', $tag->normalized) }}" class="white goldbg">{{ $tag->name }}</a>
                            @endforeach
                        @endif
                    </span>
        </div>
    <div class="height100"></div>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
    @include('partials.footer')
@endsection
@push('scripts')
<script async defer
        src="http://maps.google.com/maps/api/js?key=AIzaSyBOqMmSwNP3Iz0F4P5BL1KLeB4StVJAWL0">
</script>

<script type="text/javascript">
$(function(){
    var geocoder;
    var map;
    var address = "{{ $event->address }}";

    function myMap()  {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var myOptions = {
            zoom: 8,
            center: latlng,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            navigationControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        if (geocoder) {
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                        map.setCenter(results[0].geometry.location);

                        var infowindow = new google.maps.InfoWindow({
                            content: '<b>' + address + '</b>',
                            size: new google.maps.Size(150, 50)
                        });

                        var marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            title: address
                        });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map, marker);
                        });

                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    }
    window.onload = myMap;
            //google.maps.event.addDomListener(window, 'load', initialize)

});
    $(function(){
        $('#attend').on('change',function(){
            this.value = this.checked ? true:false;
        });
    })
</script>
@endpush