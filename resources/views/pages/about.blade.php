@extends('templates.default')
@section('page_title', $page_title)
@section('description', $page_description)
@section('keyword', $page_keywords)
@section('body-class', 'body main-page index')
@section('content')
    @include('partials.header')
    <section id="banner">
        <div id="pagebaner">
            <div>
                <img src="{{ setting('about_page_photo') ? asset('/storage/'.setting('about_page_photo')) : '' }}" class="img-responsive bannerheight">
                <div  id="gallery-overlays">
                    <h1 class="white text-center animated fadeInUp slow">
                        <span class="captial fontsize20 lineheight50">About Us</span><br/>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix height50"></div>
    <div class="container">
        <div class="clear height50"></div>
            <div class="col-md-6 animated fadeInLeft">
                <div class="mbottom">
                    <h3 class="white text-center ">
                        <span class="captial fontsize20 lineheight50 black">{{ setting('church_name') }}</span><br/>
                    </h3>
                    <p class="para black">
                    {!! html_entity_decode(setting('about')) !!}
                </div>
            </div>

            <div class="col-md-6 paddingRight animated fadeInRight">
                <div class="borderbottom">
                    <div class="accordion-option">
                        <h3 class="fontsize18 heading topoff black">Our Four</h3>
                        <h3 class="fontsize18 heading topoff black">Pillars</h3>
                    </div>
                </div>
                <div class="clear height20"></div>
                <div class="black rightborder">

                    <div class="panel-group rightborder" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default animated fadeInLeftBig">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title fontsize16">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        OUR VISION
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    {{ setting('vision') }}
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default animated fadeInRightBig">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        OUR MISSION
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    {{ setting('mission') }}
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default animated fadeInLeftBig">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        OUR PURPOSE
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    {{ setting('purpose') }}
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default animated fadeInRightBig">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        OUR BELIEVE
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    {{ setting('believe') }}
                                </div>
                            </div>
                        </div>
                    </div><!-- panel-group -->
                </div>
            </div>
            <div class="clear height20"></div>
            <div class="col-md-12 animated fadeInUp slow">
                <div class="clear height30"></div>
                <div class="h3 black text-center">About {{ setting('pastor_name') }} - General Overseer</div>
                <div class="clear height30"></div>
                <div class="col-md-8 animated fadeInRight">
                    <div class="para black">
                        {!! html_entity_decode(setting('go')) !!}
                    </div>
                </div>

                <div class="col-md-4 animated fadeInLeft">
                    <img class="alignnone size-medium wp-image-90" src="{{ setting('pastor_photo') ? '/storage/'.setting('pastor_photo') : '' }}" alt="About {{ setting('pastor_name') }}" width="100%"/>
                </div>
            </div>
            <div class="clear height20"></div>




            <div class="clear height50"></div>
            <div class="col-md-12 animated fadeInUp slow">
                <div class="topbottom_bar">
                    <div class="clear height30"></div>

                    <div class="h3 black text-center">Follow Us or Share on The Follow Platforms:</div>
                    <div class="clear height30"></div>

                    <div class="share-items text-center" data-title="Auf dem richtigen Weg gehen" data-hash="Auf dem richtigen Weg gehen"
                         data-url="{{ route('about') }}">

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
                                    <span>Total</span>
                                    <span class="total-count"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear height50"></div>
                </div>
            </div>
            <div class="clear height50"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
@include('partials.footer')
@endsection
@push('scripts')
 <script type="text/javascript">
     $(function(){
         var openAllPanels;
         var closeAllPanels;
         $(".toggle-accordion").on("click",function(e){
             var accordionId = $(this).attr("accordion-id"),
                     numPanelOpen = $(accordionId + '.collapse.in').length;
             $(this).toggleClass("active");
             alert('heay');
             if(numPanelOpen == 0){
                 openAllPanels(accordionId);
             }else{
                 closeAllPanels(accordionId);
             }
         });
         openAllPanels = function(aId){
             $(aId + '.panel-collapse:not(".in")').collapse('show');
         };

         closeAllPanels = function(aId){
             $(aId + '.panel-collapse:not(".in")').collapse('hide');
         };
     });
 </script>
@endpush