<section id="banner">
    <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="6000" >
        <ol class="carousel-indicators" style="display:none;">
            <li data-target="#bootstrap-touch-slider" data-slide-to="1" class="active"></li>
            <li data-target="#bootstrap-touch-slider" data-slide-to="2" class=""></li>
            <li data-target="#bootstrap-touch-slider" data-slide-to="3" class=""></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ setting('first_slider') ? '/storage/'.setting('first_slider') : '' }}" alt="{{ setting('site_title') }}"  class="slide-image"/>
                <div class="bs-slider-overlay"></div>
                <div class="slide-text slide_style_center">
                    <h1 data-animation="animated flipInX" class="text-center">Your Church Is Your House</h1>
                    <p data-animation="animated lightSpeedIn" class="text-center">We Come To Serving & Believing God's Word And Spirit</p>
                    <a href="{{ route('about') }}" class="avg_button" data-animation="animated fadeInUp slow">Read More</a>
                </div>
            </div>
            <div class="item ">
                <img src="{{ setting('second_slider') ? '/storage/'.setting('second_slider') : '' }}" alt="{{ setting('site_title') }}"  class="slide-image"/>
                <div class="bs-slider-overlay"></div>
                <div class="slide-text slide_style_center">
                    <h1 data-animation="animated flipInX" class="text-center">Love The Lord Your God</h1>
                    <p data-animation="animated lightSpeedIn" class="text-center">We Come To Serving & Believing God's Word and Spirit</p>
                    <a href="{{ route('contact') }}" class="avg_button" data-animation="animated fadeInUp slow">Join With Us</a>
                </div>
            </div>
            <div class="item ">
                <img src="{{ setting('third_slider') ? '/storage/'.setting('third_slider') : '' }}" alt="{{ setting('site_title') }}"  class="slide-image"/>
                <div class="bs-slider-overlay"></div>
                <div class="slide-text slide_style_center">
                    <h1 data-animation="animated flipInX" class="text-center">The Church That Cares</h1>
                    <p data-animation="animated lightSpeedIn" class="text-center">Where times of refreshing always</p>
                    <a href="{{ route('about') }}" class="avg_button" data-animation="animated fadeInUp slow">Read More</a>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>