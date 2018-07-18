<section class="newsletter">
    <div class="container">
        <div class="col-md-8">
            <h4 class="h4 white text-center">Subscribe to our Newsletter We Do Not Spam! We Respect Your Privacy</h4>
        </div>

        <div class="col-md-4">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                        <strong>{{ $message }}</strong>
                    </div>
                @elseif ($errors->has('email'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                    <strong>{{ $errors->first('email')}}</strong>
                </div>

                @endif
                {!! Form::open(['route'=>'subscriber', 'role' => 'form']) !!}
                    <div class="col-md-8 m-center m-top">
                        <input name="email" class="subscribetxt text-input" id="email" type="email" placeholder="Enter your Email">
                    </div>
                    <div class="col-md-4 m-center m-top paddingoff">
                    <input type="submit" name="submit" class="submit ms-top" value="Subscribe"></div>
              {!! Form::close() !!}
        </div>
    </div>
</section>
<div class="footer">
    <div class="container">
        <div class="col-sm-12 col-md-3 followlist m-bottom">
            <h4 class="h4 white">Follow Us</h4>
            <div class="clear height20"></div>
            <ul>
                <li><a href="{{ setting('facebook_address') }}" target="_blank" class="white_ash"><img src="/local/images/facebook.png" border="0" alt="facebook" /></a></li>
                <li><a href="{{ setting('twitter_address') }}" target="_blank" class="white_ash"><img src="/local/images/twitter.png" border="0" alt="twitter" /></a></li>
                <li><a href="{{ setting('google+_address') }}" target="_blank" class="white_ash"><img src="/local/images/gplus.png" border="0" alt="gplus" /></a></li>
                <li><a href="{{ setting('pinterest_address') }}" target="_blank" class="white_ash"><img src="/local/images/pinterest.png" border="0" alt="pinterest" /></a></li>
                <li><a href="{{ setting('instagram_address') }}" target="_blank" class="white_ash"><img src="/local/images/instagram.png" border="0" alt="instagram" /></a></li>
            </ul>

            <div class="prayer-request">
                <h4 class="h4 white">Prayer Request Hotlines:</h4>
                <div class="clear height20"></div>
                {!! html_entity_decode(setting('prayer_request_phones','phone')) !!}
            </div>
        </div>
        <div class="col-sm-12 col-md-3 list m-bottom">
            <h4 class="h4 white">Quick Links</h4>
            <div class="clear height20"></div>
            <ul>
                <li class="submenu">
                    <a href="">Media</a>
                    <ul>
                        <li class=""><a href="{{ route('galleries.photos.index') }}">Photo Gallery</a></li>
                        <li class=""><a href="{{ route('galleries.audios.index') }}">Audio Gallery</a></li>
                        <li class=""><a href="{{ route('galleries.videos.index') }}">Video Gallery</a></li>
                        <li class=""><a href="{{ route('galleries.embedded.index') }}">Online Channels</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('sermons.index') }}" class="white_ash">Latest Sermon</a></li>
                <li><a href="{{ route('events.index') }}" class="white_ash">Events</a></li>
                <li><a href="{{ route('posts.index') }}" class="white_ash">Blog</a></li>
                <li><a href="{{ route('staffs.index') }}" class="white_ash">Staff</a></li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-3 list m-bottom">
            <h4 class="h4 white">Help</h4>
            <div class="clear height20"></div>
            <ul>
                <li><a href="{{ route('about') }}" class="white_ash">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="white_ash">Contact Us</a></li>
                <li><a href="{{ route('give') }}" class="white_ash">Donate Now</a></li>
                <li><a href="{{ route('requests.create') }}" class="white_ash">Prayer Request</a></li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-3 m-bottom">
            <div>
                <a class="" href="{{ route('home') }}"><img src="{{ setting('site_logo') ? asset('/storage/'.setting('site_logo')) : '' }}" border="0" alt="{{ setting('site_title') }}" /></a>
            </div>
            <div>
                <div class="clear height20"></div>
                <p class="small white_ash"><i class="lnr lnr-map-marker"></i> {{ setting('address') }}</p>
                <div class="clear height10"></div>
                <p class="small white_ash"><i class="lnr lnr-envelope"></i> <a href="mailto:{{ setting('email_address') }}" class="white_ash"> {{ setting('email_address') }}</a></p>
                <div class="clear height10"></div>
                <p class="small white_ash"><i class="lnr lnr-phone-handset"></i> <a href="tel:{!! html_entity_decode(setting('phone') ) !!}" class="white_ash"> {!! html_entity_decode(setting('phone') ) !!}</a></p>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <div class="container">
        <div class="col-md-12 text-center white h6">&copy; 2017 - {{ date('Y') }} {{ setting('church_name') }}. All rights reserved.. Designed by SavySoft </div>
    </div>
</div>