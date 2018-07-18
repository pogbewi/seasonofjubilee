<header id="header" class="alt">
    <div class="container">
        <div class="row">
            <div class="4u 12u(avigher) floatnone justright pull-left">
                <a class="" href="{{ route('home') }}"><img src="{{ setting('site_logo') ? asset('/storage/'.setting('site_logo')) : '' }}" border="0" alt="{{ setting('site_title') }}" /></a>

            </div>
            <div class="8u 12u(avigher) hides">
                <nav id="nav" class="pull-right">
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                        <li class="submenu">
                            <a href="">Pages</a>
                            <ul>
                                <li class=""><a href="{{ route('about') }}">About Us</a></li>
                                <li class=""><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li class=""><a href="{{ route('requests.create') }}">Prayer Request</a></li>
                                <li class=""><a href="{{ route('staffs.index') }}">Staff</a></li>
                                <li class=""><a href="{{ route('posts.index') }}">Blog</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="">Media</a>
                            <ul>
                                <li class=""><a href="{{ route('galleries.photos.index') }}">Photo Gallery</a></li>
                                <li class=""><a href="{{ route('galleries.audios.index') }}">Audio Gallery</a></li>
                                <li class=""><a href="{{ route('galleries.videos.index') }}">Video Gallery</a></li>
                                <li class=""><a href="{{ route('galleries.embedded.index') }}">Online Channels</a></li>
                            </ul>
                        </li>

                        <li class=""><a href="{{ route('sermons.index') }}">Sermons</a></li>
                        <li class="submenu">
                            <a href="">Events</a>
                            <ul>
                                <li class=""><a href="{{ route('events.index') }}">Upcoming Events</a></li>
                                <li class=""><a href="{{ route('events.past') }}">Previous Events</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="{{ route('testimony.index') }}">Testimonies</a></li>
                        <li class=""><a href="{{ route('give') }}" class="white_ash donatebtn">Give</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
