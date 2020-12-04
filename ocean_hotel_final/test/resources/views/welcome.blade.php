<!DOCTYPE html>
<html lang="en">
<head>
    <title>OCEAN HOTEL</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- //for-mobile-apps -->
    <link href="{{asset('Admin/vendor/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{asset('Admin/vendor/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Admin/vendor/css/chocolat.css')}}" type="text/css" media="screen">
    <link href="{{asset('Admin/vendor/css/easy-responsive-tabs.css')}}" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="{{asset('Admin/vendor/css/flexslider.css')}}" type="text/css" media="screen"
          property=""/>
    <link rel="stylesheet" href="{{asset('Admin/vendor/css/jquery-ui.css')}}"/>
    <link href="{{asset('Admin/vendor/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="{{asset('Admin/vendor/js/modernizr-2.6.2.min.js')}}"></script>
    <!--fonts-->
    <link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <!--//fonts-->
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #c0ee19;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
<!-- header -->
<div class="banner-top">
    <div class="social-bnr-agileits">
        <ul class="social-icons3">
            <li><a href="https://www.facebook.com/" class="fa fa-facebook icon-border facebook"> </a></li>
            <li><a href="https://twitter.com/" class="fa fa-twitter icon-border twitter"> </a></li>
            <li><a href="https://plus.google.com/u/0/" class="fa fa-google-plus icon-border googleplus"> </a></li>
        </ul>
    </div>
    <div class="contact-bnr-w3-agile">
        <ul>
            <li><i class="fa fa-envelope" aria-hidden="true"></i><a
                    href="mailto:info@example.com">INFO@OCEANHOTEL.COM</a>
            </li>
            <li><i class="fa fa-phone" aria-hidden="true"></i>+94 961 503 893</li>

        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<div class="w3_navigation">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1><a class="navbar-brand" href="#">OCEAN <span>HOTEL</span>
                        <p class="logo_w3l_agile_caption">Your Dreamy Resort</p></a></h1>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <nav class="menu menu--iris">
                    <ul class="nav navbar-nav menu__list">
                        <li class="menu__item menu__item--current"><a href="#" class="menu__link">Home</a></li>
                        <li class="menu__item"><a href="#about" class="menu__link scroll">About</a></li>
                        <li class="menu__item"><a href="#team" class="menu__link scroll">Team</a></li>
                        <li class="menu__item"><a href="#gallery" class="menu__link scroll">Gallery</a></li>
                        <li class="menu__item"><a href="#rooms" class="menu__link scroll">Rooms</a></li>
                        <li class="menu__item"><a href="#contact" class="menu__link scroll">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </nav>

    </div>
</div>
<!-- //header -->
<!-- banner -->
<div id="home" class="w3ls-banner">
    <!-- banner-text -->
    <div class="slider">
        <div class="callbacks_container">
            <ul class="rslides callbacks callbacks1" id="slider4">
                @foreach($lsSlider as $item)
                    <li>
                        <div class="w3layouts-banner-top"
                             style="background: url({{asset($item->image)}}) no-repeat;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;-moz-background-size: cover">
                            <div class="container">
                                <div class="agileits-banner-info">
                                    <h4>OCEAN HOTEL</h4>
                                    <h3>{{$item->name}}</h3>
                                    <p>{!! $item->description!!}</p>
                                    <div class="agileits_w3layouts_more menu__item">
                                        <a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">Learn
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div>
        <!--banner Slider starts Here-->
    </div>
    <div class="thim-click-to-bottom">
        <a href="#about" class="scroll">
            <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
        </a>
    </div>
</div>
<!-- //banner -->
<!--//Header-->
<!-- //Modal1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <!-- Modal1 -->
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>OCEAN <span>HOTEL</span></h4>
                <img src="{{asset($special_slider[0]->image)}}" alt=" " class="img-responsive">
                <h5>{{$special_slider[0]->name}}</h5>
                <p>{!!$special_slider[0]->description!!}</p>
            </div>
        </div>
    </div>
</div>
<!-- //Modal1 -->
<div id="availability-agileits">
    <div class="col-md-12 book-form-left-w3layouts">
        <a href="{{route('Room_index_frontend2')}}"><h2>ROOM RESERVATION</h2></a>
    </div>

    <div class="clearfix"></div>
</div>
<!-- banner-bottom -->
<div class="banner-bottom">
    <div class="container">
        <div class="agileits_banner_bottom">
            <h3><span>Experience a good stay, enjoy fantastic offers</span> Find our friendly welcoming reception</h3>
        </div>
        <div class="w3ls_banner_bottom_grids">
            <ul class="cbp-ig-grid">
                <li>
                    <div class="w3_grid_effect">
                        <span class="cbp-ig-icon w3_road"></span>
                        <h4 class="cbp-ig-title">{{$MASTERBEDROOMS[0]->name}}</h4>
                        <span class="cbp-ig-category">OCEAN HOTEL</span>
                    </div>
                </li>
                <li>
                    <div class="w3_grid_effect">
                        <span class="cbp-ig-icon w3_cube"></span>
                        <h4 class="cbp-ig-title">{{$SEAVIEWBALCONY[0]->name}}</h4>
                        <span class="cbp-ig-category">OCEAN HOTEL</span>
                    </div>
                </li>
                <li>
                    <div class="w3_grid_effect">
                        <span class="cbp-ig-icon w3_users"></span>
                        <h4 class="cbp-ig-title">{{$LARGECAFE[0]->name}}</h4>
                        <span class="cbp-ig-category">OCEAN HOTEL</span>
                    </div>
                </li>
                <li>
                    <div class="w3_grid_effect">
                        <span class="cbp-ig-icon w3_ticket"></span>
                        <h4 class="cbp-ig-title">{{$WIFICOVERAGE[0]->name}}</h4>
                        <span class="cbp-ig-category">OCEAN HOTEL</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- //banner-bottom -->
<!-- /about -->
<div class="about-wthree" id="about">
    <div class="container">
        <div class="ab-w3l-spa">
            <h3 class="title-w3-agileits title-black-wthree">About Our OCEAN HOTEL</h3>
            <p class="about-para-w3ls">Lorem Ipsum is simply dummy text of the printing and typesetting industry.Sed
                tempus vestibulum lacus blandit faucibus. Nunc imperdiet, diam nec rhoncus ullamcorper, nisl nulla
                suscipit ligula, at imperdiet urna</p>
            <img src="{{asset('Admin/vendor/images/about.jpg')}}" class="img-responsive" alt="Hair Salon">
            <div class="w3l-slider-img">
                <img src="{{asset('Admin/vendor/images/a1.jpg')}}" class="img-responsive" alt="Hair Salon">
            </div>
            <div class="w3ls-info-about">
                <h4>You'll love all the amenities we offer!</h4>
                <p>Lorem ipsum dolor sit amet, ut magna aliqua. </p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //about -->
<!--sevices-->
<div class="advantages">
    <div class="container">
        <div class="advantages-main">
            <h3 class="title-w3-agileits">Our Services</h3>
            <div class="advantage-bottom">
                @foreach($lsFacility as $item)
                    <div class="col-md-4 advantage-grid left-w3ls wow bounceInLeft" data-wow-delay="0.3s">
                        <div class="advantage-block ">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <h4>{{$item->name}} </h4>
                            <p>{!! $item->description !!}}</p>
                            <p><i class="fa fa-check"
                                  aria-hidden="true"></i>{{$item->type == 0 ? 'Free' : 'Pay the money'}}</p>
                            <p><i class="fa fa-check" aria-hidden="true"></i>Fee: ${{$item->price}}</p>

                        </div>
                    </div>
                @endforeach

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--//sevices-->
<!-- team -->
<div class="team" id="team">
    <div class="container">
        <h3 class="title-w3-agileits title-black-wthree">Meet Our Team</h3>
        <div id="horizontalTab">
            <ul class="resp-tabs-list">
                @foreach($lsUser as $item)
                    <li>
                        <img src="{{asset($item->avatar)}}" style="width: 150px;height: 150px" alt=" "
                             class="img-responsive"/>
                    </li>
                @endforeach
            </ul>
            <div class="resp-tabs-container">
                @foreach($lsUser as $item)
                    <div class="tab1">
                        <div class="col-md-5" style="min-height: 300px">
                            <img src="{{$item->avatar}}" style="width: 288px;height: 361px">
                        </div>
                        <div class="col-md-6 team-Info-agileits">
                            <h4>{{$item->name}}</h4>
                            @foreach($item->roles as $role)
                                <span>{{$role->name}}</span>
                            @endforeach
                            <p>{{$item->precept}}</p>
                            <div class="social-bnr-agileits footer-icons-agileinfo">
                                <ul class="social-icons3">
                                    <li><a href="https://www.facebook.com/" target="_blank"
                                           class="fa fa-facebook icon-border facebook"> </a></li>
                                    <li><a href="https://twitter.com/?lang=vi" target="_blank"
                                           class="fa fa-twitter icon-border twitter"> </a></li>
                                    <li><a href="https://www.google.com" target="_blank"
                                           class="fa fa-google-plus icon-border googleplus"> </a></li>
                                    <li><a href="https://www.google.com" target="_blank"
                                           class="fa fa-rss icon-border rss"> </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- //team -->
<!-- Gallery -->
<section class="portfolio-w3ls" id="gallery">
    <h3 class="title-w3-agileits title-black-wthree">Our Gallery</h3>
    @foreach($lsRoom as $room)
        @foreach($room->RoomImage as $item)
            <div class="col-md-3 gallery-grid gallery1">
                <a href="{{route('Room_index_frontend')}}" {{asset($item->image)}}><img src="{{asset($item->image)}}"
                                                                                        style="width: 476px;height: 333px"
                                                                                        class="img-responsive" alt="/">
                    <div class="textbox">
                        <h4>OCEAN HOTEL</h4>
                        <p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
                    </div>
                </a>
            </div>
        @endforeach
    @endforeach
    <div class="clearfix"></div>
</section>
<!-- //gallery -->
<!-- rooms & rates -->
<div class="plans-section" id="rooms">
    <div class="container">
        <h3 class="title-w3-agileits title-black-wthree">Rooms And Rates</h3>
        <div class="priceing-table-main">
            @foreach($lsRoom as $item)
                <div class="col-md-3 price-grid">
                    <div class="price-block agile">
                        <div class="price-gd-top">
                            <img src="{{asset($item->feature_image)}}" style="width: 255px;height: 255px"
                                 class="img-responsive"/>
                            <h4>{{$item->name}}</h4>
                        </div>
                        <div class="price-gd-bottom">
                            <div class="price-list">
                                <ul>
                                    @for($i = 0;$i<$item->rating;$i++)
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    @endfor
                                    @if($item->rating < 5)
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="price-selet">
                                <h3><span>$</span>{{$item->new_price}}</h3>
                                <a href="{{route('Room_index_frontend')}}">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--// rooms & rates -->
<!-- visitors -->
<div class="w3l-visitors-agile">
    <div class="container">
        <h3 class="title-w3-agileits title-black-wthree">What other visitors experienced</h3>
    </div>
    <div class="w3layouts_work_grids">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    @foreach($lsGuest as $item)
                        <li>
                            <div class="w3layouts_work_grid_left">
                                <img src="{{asset('Admin/vendor/images/5.jpg')}}" alt=" " class="img-responsive"/>
                                <div class="w3layouts_work_grid_left_pos">
                                    <img src="{{asset($item->avatar)}}" alt=" " class="img-responsive"/>
                                </div>
                            </div>
                            <div class="w3layouts_work_grid_right">
                                <h4>
                                    @for($i = 0;$i<$item->rating;$i++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor
                                    Worth to come again
                                </h4>
                                <p>{!! $item->comments !!}</p>
                                <h5>{{$item->name}}</h5>
                                <p style="float: right;color: red;font-weight: bold;margin-top: 0px">{{$item->country}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</div>
<!-- visitors -->
<!-- contact -->
<section class="contact-w3ls" id="contact">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
            <div class="contact-agileits">
                <h4>Contact Us</h4>
                <p class="contact-agile2">Sign Up For Our News Letters</p>
                <form>
                    @csrf
                    <div class="control-group form-group">

                        <label class="contact-p1">Full Name:</label>
                        <input type="text" class="form-control" id="full_name" required>
                        <p class="help-block"></p>

                    </div>
                    <div class="control-group form-group">

                        <label class="contact-p1">Phone Number:</label>
                        <input type="tel" class="form-control" id="phone_number" required>
                        <p class="help-block"></p>

                    </div>
                    <div class="control-group form-group">

                        <label class="contact-p1">Email Address:</label>
                        <input type="email" class="form-control" id="email" required>
                        <p class="help-block"></p>

                    </div>
                    <div class="modal-body">
                        <div class="loader" style="display: none"></div>
                    </div>

                    <div class="modal-body">
                        <div class="sent-message"
                             style="display: none;padding-left: 15px;color: #fff200;font-size: 20px">
                            Your message has been sent !
                        </div>
                    </div>

                    <button id="sendMailNofy" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
            <h4>Connect With Us</h4>
            <p class="contact-agile1"><strong>Phone :</strong>+94 961-503-893</p>
            <p class="contact-agile1"><strong>Email :</strong> <a href="mailto:name@example.com">INFO@OCEANHOTEL.COM</a>
            </p>
            <p class="contact-agile1"><strong>Address :</strong> Pham Van Dong - Cau Giay - Ha Noi</p>

            <div class="social-bnr-agileits footer-icons-agileinfo">
                <ul class="social-icons3">
                    <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                    <li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
                    <li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>

                </ul>
            </div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3074.7905052320443!2d-77.84987248482734!3d39.586871613613056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c9f6a80ccf0661%3A0x7210426c67abc40!2sVirginia+Welcome+Center%2FSafety+Rest+Area!5e0!3m2!1sen!2sin!4v1485760915662"></iframe>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- /contact -->
<div class="copy">
    <p>© 2020 OCEAN HOTEL . All Rights Reserved | Design by <a href="{{route('frontend_index')}}">LE HUY DUC</a></p>
</div>

<script type="text/javascript" src="{{asset('Admin/vendor/js/jquery-2.1.4.min.js')}}"></script>
<!-- contact form -->
<script src="{{asset('Admin/vendor/js/jqBootstrapValidation.js')}}"></script>

<!-- /contact form -->
<!-- Calendar -->
<script src="{{asset('Admin/vendor/js/jquery-ui.js')}}"></script>
<script>
    $(function () {
        $("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
    });
</script>
<!-- //Calendar -->
<!-- gallery popup -->
<!-- //gallery popup -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{asset('Admin/vendor/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('Admin/vendor/js/easing.js')}}"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });
    });
</script>
<!-- start-smoth-scrolling -->
<!-- flexSlider -->
<script defer src="{{asset('Admin/vendor/js/jquery.flexslider.js')}}"></script>
<script type="text/javascript">
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>
<!-- //flexSlider -->
<script src="{{asset('Admin/vendor/js/responsiveslides.min.js')}}"></script>
<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider4").responsiveSlides({
            auto: true,
            pager: true,
            nav: false,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>
<!--search-bar-->
<script src="{{asset('Admin/vendor/js/main.js')}}"></script>
<!--//search-bar-->
<!--tabs-->
<script src="{{asset('Admin/vendor/js/easy-responsive-tabs.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
<!--//tabs-->
<!-- smooth scrolling -->
<script type="text/javascript">
    $(document).ready(function () {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */
        $().UItoTop({easingType: 'easeOutQuart'});
    });
</script>

<div class="arr-w3ls">
    <a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</div>
<!-- //smooth scrolling -->
<script type="text/javascript" src="{{asset('Admin/vendor/js/bootstrap-3.1.1.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sendMailNofy').click(function () {
            $('.loader').show();
            var data = {
                "full_name": $('#full_name').val(),
                "_token": $('#token').val(),
                "email": $('#email').val(),
                "telephone": $('#phone_number').val()
            };
            $.ajax({
                type: "POST",
                url: "api/send-email-frontend",
                data: data,
                success: function (response) {
                    $('.loader').hide();
                    $('.sent-message').show();
                },
                error: function (response) {
                    $('.loader').hide();
                    alert(response.responseText);
                }
            })
        });
    });
</script>
</body>
</html>


