<!DOCTYPE html>
<html>

<!-- Mirrored from envato.megadrupal.com/html/bookawesome/hotel-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Aug 2015 04:49:24 GMT -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Hotel List</title>
    <!-- Font Google -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400%7COpen+Sans:300,400,600,700' rel='stylesheet'
          type='text/css'>
    <!-- End Font Google -->
    <!-- Library CSS -->
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/owl.carousel.css')}}">
    <!-- End Library CSS -->
    <link rel="stylesheet" href="{{asset('Room_detail/css/style.css')}}">
</head>
<body class="hotel">
<!-- Preloader -->
<div id="preloader">
    <div class="tb-cell">
        <div id="page-loading">
            <div></div>
            <p>Loading</p>
        </div>
    </div>
</div>
<!-- Wrap -->
<div id="wrap">
    <!-- Header -->
    <!-- End Header -->

    <!--Banner-->
    <section class="sub-banner">
        <!--Background-->
        <div class="bg-parallax bg-1"></div>
        <!--End Background-->
        <!-- Logo -->
        <div class="logo-banner text-center">
            <a href="#" title="">
                <img src="images/logo-banner.png" alt="">
            </a>
        </div>
        <!-- Logo -->
    </section>
    <!--End Banner-->

    <!-- Main -->
    <div class="main">
        <div class="container">
            <div class="main-cn hotel-page bg-white">
                <div class="row">

                    <!-- Hotel Right -->
                    <div class="col-md-9 col-md-push-3">

                        <!-- Breakcrumb -->
                        <section class="breakcrumb-sc">
                            <ul class="breadcrumb arrow">
                                <li><a href="{{route('frontend_index')}}" class="btn btn-primary" style="color:white;"><i class="fa fa-home"></i></a></li>
                                <li><a href="{{route('Room_index_frontend2')}}" class="btn btn-primary" style="color: white" title="">Hotels</a></li>

                            </ul>
                        </section>
                        <!-- End Breakcrumb -->

                        <!-- Hotel List -->
                        <section class="hotel-list">

                            <div class="hotel-grid-cn clearfix">
                                @foreach($lsRoom as $item)
                                    <div class="col-xs-6 col-sm-4 col-md-6 col-lg-4">
                                        <div class="hotel-item">
                                            <figure class="hotel-img">
                                                <a href="{{route('Roome_detail',$item->id)}}" title="">
                                                    <img src="{{asset($item->feature_image)}}"
                                                         style="width: 250px;height: 300px;border-radius: 5%" alt="">
                                                </a>
                                                <figcaption>
                                                    Save <span>20</span>%
                                                </figcaption>
                                            </figure>
                                            <div class="hotel-text">
                                                <div class="hotel-name">
                                                    <a href="hotel-detail.html" title="">{{$item->name}}</a>
                                                </div>
                                                <div class="hotel-places">
                                                    <a title="">Bedding: {{ $item->RoomType->bedding}}</a>
                                                    <p>
                                                        <a title="">Description: {{ strip_tags($item->description) }} </a>

                                                    </p>
                                                </div>
                                                <hr class="hr">
                                                <div class="price-box">
                                                    <span class="price old-price">From</span>
                                                    <span
                                                        class="price special-price">${{$item->new_price}}<small>/night</small></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </section>
                        {{$lsRoom->links()}}
                    </div>


                    <div class="col-md-3 col-md-pull-9">
                        <!-- Sidebar Content -->
                        <div class="sidebar-cn">
                            <!-- Search Result -->
                            <div class="search-result">
                                <p>
                                    We found <br>
                                    <ins>640</ins>
                                    <span>properties availability</span>
                                </p>
                            </div>
                            <!-- End Search Result -->
                            <!-- Search Form Sidebar -->
                            <div class="search-sidebar">
                                <div class="row">
                                    <div class="form-search clearfix">
                                        <form method="get" action="{{route('Room_index_frontend2')}}">
                                            @csrf
                                            <div class="form-field field-date col-md-12">
                                                <p style="font-weight: bold"> Check In </p>
                                                <input class="form-control"
                                                       style="background-color: white;display: inline"
                                                       type="date" placeholder="Room Type"
                                                       name="check_in" value="{{$check_in}}" required>
                                            </div>
                                            <div class="form-field field-date col-md-12">
                                                <p style="font-weight: bold"> Check Out </p>
                                                <input class="form-control"
                                                       style="background-color: white;display: inline"
                                                       type="date" placeholder="Price"
                                                       name="check_out" value="{{$check_out}}" required>
                                            </div>
                                            <div class="form-field field-select col-md-12">
                                                <div class="form-group">
                                                    <p style="font-weight: bold">Bedding</p>
                                                    <select name="bedding" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" {{$bedding == 1 ? 'selected' : ''}}>1</option>
                                                        <option value="2" {{$bedding == 2 ? 'selected' : ''}}>2</option>
                                                        <option value="3" {{$bedding == 3 ? 'selected' : ''}}>3</option>
                                                        <option value="4" {{$bedding == 4 ? 'selected' : ''}}>4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-submit col-md-12">
                                                <button type="submit" class="awe-btn awe-btn-medium awe-search">Search
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-sidebar start-rating-sidebar">
                                <h4 class="title-sidebar">Star rating</h4>
                                <ul class="widget-rate">
                                    <li>
                                        <div class="group-star" style="margin-left: 0px;margin-right: 10px;">
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                        </div>
                                        5 Stars
                                        <?php
                                        $s = 0;
                                        foreach ($lsRoom as $item) {
                                            if ($item->rating == 5) {
                                                $s += 1;
                                            }
                                        }
                                        ?>
                                        <span>{{$s}}</span>
                                    </li>
                                    <li>
                                        <div class="group-star" style="margin-left: 0px;margin-right: 10px;">
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                        </div>
                                        4 Stars
                                        <?php
                                        $s = 0;
                                        foreach ($lsRoom as $item) {
                                            if ($item->rating == 4) {
                                                $s += 1;
                                            }
                                        }
                                        ?>
                                        <span>{{$s}}</span>
                                    </li>
                                    <li>

                                        <div class="group-star" style="margin-left: 0px;margin-right: 10px;">
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                        </div>
                                        3 Stars
                                        <?php
                                        $s = 0;
                                        foreach ($lsRoom as $item) {
                                            if ($item->rating == 3) {
                                                $s += 1;
                                            }
                                        }
                                        ?>
                                        <span>{{$s}}</span>
                                    </li>
                                    <li>
                                        <div class="group-star" style="margin-left: 0px;margin-right: 10px;">
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                        </div>
                                        2 Stars
                                        <?php
                                        $s = 0;
                                        foreach ($lsRoom as $item) {
                                            if ($item->rating == 2) {
                                                $s += 1;
                                            }
                                        }
                                        ?>
                                        <span>{{$s}}</span>
                                    </li>
                                    <li>
                                        <div class="group-star" style="margin-left: 0px;margin-right: 10px;">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </div>
                                        1 Stars
                                        <?php
                                        $s = 0;
                                        foreach ($lsRoom as $item) {
                                            if ($item->rating == 1) {
                                                $s += 1;
                                            }
                                        }
                                        ?>
                                        <span>{{$s}}</span>
                                    </li>
                                    <li>
                                        <div class="group-star" style="margin-left: 0px;margin-right: 10px;">
                                            <i class="glyphicon glyphicon-star-empty"></i>
                                        </div>
                                        Not Rated
                                        <?php
                                        $s = 0;
                                        foreach ($lsRoom as $item) {
                                            if ($item->rating == 0) {
                                                $s += 1;
                                            }
                                        }
                                        ?>
                                        <span>{{$s}}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="widget-sidebar facilities-sidebar">
                                <h4 class="title-sidebar">Hotel facilities</h4>
                                <ul class="widget-ul">
                                    @foreach($lsFacility as $item)
                                        <li>
                                            <div class="radio-checkbox">
                                                <input id="facilities-1" type="checkbox"
                                                       {{$item->type == 0 ? 'checked' : ''}} class="checkbox"/>
                                                <label for="facilities-1">{{$item->name}}</label>
                                            </div>
                                            <span>{{$item->type == 0 ? 'Free' : 'Fee'}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- End Main -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="col-md-4">
                    <div class="logo-foter">
                        <a href="index-2.html" title=""><img src="images/logo-footer.png" alt=""></a>
                    </div>
                </div>
                <!-- End Logo -->
                <!-- Navigation Footer -->
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <div class="ul-ft">
                        <ul>
                            <li><a href="about.html" title="">About</a></li>
                            <li><a href="blog.html" title="">Blog</a></li>
                            <li><a href="fqa.html" title="">FQA</a></li>
                            <li><a href="careers.html" title="">Carrers</a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Navigation Footer -->
                <!-- Navigation Footer -->
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <div class="ul-ft">
                        <ul>
                            <li><a href="contact.html" title="">Contact Us</a></li>
                            <li><a href="#" title="">Privacy Policy</a></li>
                            <li><a href="#" title="">Term of Service</a></li>
                            <li><a href="#" title="">Security</a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Navigation Footer -->
                <!-- Footer Currency, Language -->
                <div class="col-xs-6 col-sm-4 col-md-6 col-lg-4">
                    <!-- Language -->
                    <div class="currency-lang-bottom dropdown-cn float-left">
                        <div class="dropdown-head">
                            <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                        </div>
                        <div class="dropdown-body">
                            <ul>
                                <li class="current"><a href="#" title="">English</a></li>
                                <li><a href="#" title="">Bahasa Melayu</a></li>
                                <li><a href="#" title="">Català</a></li>
                                <li><a href="#" title="">Dansk</a></li>
                                <li><a href="#" title="">Deutsch</a></li>
                                <li><a href="#" title="">Francais</a></li>
                                <li><a href="#" title="">Italiano</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Language -->
                    <!-- Currency -->
                    <div class="currency-lang-bottom dropdown-cn float-left">
                        <div class="dropdown-head">
                            <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                        </div>
                        <div class="dropdown-body">
                            <ul>
                                <li class="current"><a href="#" title="">US</a></li>
                                <li><a href="#" title="">ARS</a></li>
                                <li><a href="#" title="">ADU</a></li>
                                <li><a href="#" title="">CAD</a></li>
                                <li><a href="#" title="">CHF</a></li>
                                <li><a href="#" title="">CNY</a></li>
                                <li><a href="#" title="">CZK</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Currency -->
                    <!--CopyRight-->
                    <p class="copyright">
                        © 2009 – 2014 Bookyourtrip™ All rights reserved.
                    </p>
                    <!--CopyRight-->
                </div>
                <!-- End Footer Currency, Language -->
            </div>
        </div>
    </footer>
    <!-- End Footer -->

</div>

<!-- Library JS -->
<script type="text/javascript" src="{{asset('Room_detail/js/library/jquery-1.11.0.min.js')}}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="{{asset('Room_detail/js/library/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Room_detail/js/library/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Room_detail/js/library/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Room_detail/js/library/parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Room_detail/js/library/jquery.nicescroll.js')}}"></script>
<script type="text/javascript" src="{{asset('Room_detail/js/library/jquery.ui.touch-punch.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Room_detail/js/library/SmoothScroll.js')}}"></script>
<!-- End Library JS -->
<!-- Main Js -->
<script type="text/javascript" src="{{asset('Room_detail/js/script.js')}}"></script>
<!-- End Main Js -->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-20585382-5', 'megadrupal.com');
    ga('send', 'pageview');
</script>
</body>

<!-- Mirrored from envato.megadrupal.com/html/bookawesome/hotel-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Aug 2015 04:49:27 GMT -->
</html>
