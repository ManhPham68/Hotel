<!DOCTYPE html>
<html>

<!-- Mirrored from envato.megadrupal.com/html/bookawesome/hotel-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Aug 2015 04:49:31 GMT -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Hotel Detail</title>
    <!-- Font Google -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400%7COpen+Sans:300,400,900,400Italic,600italic,600,700'
          rel='stylesheet' type='text/css'>
    <!-- End Font Google -->
    <!-- Library CSS -->
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('Room_detail/css/library/owl.carousel.css')}}">
    <!-- End Library CSS -->
    <link rel="stylesheet" href="{{asset('Room_detail/css/style.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        #hover:hover .img {
            width: 500px;
            height: 500px;
        }
    </style>

</head>
<body>

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
                <img src="{{asset('Room_image/images/logo-banner.png')}}" alt="">
            </a>
        </div>
        <!-- End Logo -->
    </section>
    <!--End Banner-->

    <!-- Main -->
    <div class="main main-dt">
        <div class="container">
            <div class="main-cn bg-white clearfix">


                <section class="breakcrumb-sc" style="padding: 0px">
                    <ul class="breadcrumb arrow">
                        <li><a class="btn btn-primary" style="color:white;" href="{{route('frontend_index')}}"><i
                                    class="fa fa-home"></i></a></li>
                        <li><a class="btn btn-primary" style="color: white" href="{{route('Room_index_frontend2')}}"
                               title="">Room Reservation</a></li>
                    </ul>
                    <div class="support float-right" style="margin-top: 5px;padding-right: 27px">
                        <small>Got a question?</small> +94 961 503 893
                    </div>
                </section>


                <div class="head-detail">
                    <div class="col-md-12" style="margin-top: 5px">
                        <div class="col-md-7">
                            <h1>{{$room->name}} </h1>
                            <div class="start-address">
                                        <span class="star">
                                            @for($i = 0;$i<$room->rating;$i++)
                                                <i class="glyphicon glyphicon-star"></i>
                                            @endfor
                                        </span>
                                <address class="address">
                                    {{$room->address}}
                                </address>

                            </div>
                        </div>
                        <div class="col-md-5 text-right">
                            <p class="price-book" style="font-size: 15px">
                                From-<span>${{$room->new_price}}</span>/night
                                <a href="{{route('BookRoom',$room->id)}}" title=""
                                   class="awe-btn awe-btn-1 awe-btn-lager">Book Now</a>
                            </p>
                        </div>
                    </div>
                </div>

                <section class="detail-slider">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <?php $num_item = count($room->RoomImage) ?>

                        <ol class="carousel-indicators">

                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            @for($i = 1;$i<=$num_item;$i++)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset($room->feature_image)}}" class="d-block w-100"
                                     style="width: 1110px;height: 625px" alt="...">
                            </div>
                            @foreach($room->RoomImage as $item)
                                <div class="carousel-item">
                                    <img src="{{asset($item->image)}}" style="width: 1110px;height: 625px"
                                         class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </section>

                <section class="hl-features detail-cn" id="hl-features">
                    <div class="row">
                        <div class="col-lg-3 detail-sidebar">
                            <div class="scroll-heading">
                                <h2>Features</h2>
                                <hr class="hr">
                                <a href="#details-policies" title="">Details &amp; Policies</a>
                            </div>
                        </div>
                        <div class="col-lg-9 hl-features-cn">
                            <div class="featured-service">
                                <h3>Facilities</h3>
                                <ul class="service-list" style="font-size: 15px">
                                    @foreach($lsFacility as $item)
                                        <li>
                                            <figure>
                                                <div class="icon-service">
                                                    <?php $i = rand(1, 14); ?>
                                                    <img src="{{asset('Room_detail/images/icon-service-' .$i .'.png')}}"
                                                         alt="">
                                                </div>
                                                <figcaption>{{$item->name}}</figcaption>
                                            </figure>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="featured-service">
                                <h3>Language Spoken</h3>
                                <ul class="service-spoken">
                                    <li><img src="images/icon-check.png" alt="">Arabic</li>
                                    <li><img src="images/icon-check.png" alt="">French</li>
                                    <li><img src="images/icon-check.png" alt="">Russian</li>
                                    <li><img src="images/icon-check.png" alt="">English</li>
                                    <li><img src="images/icon-check.png" alt="">Spanish</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="details-policies detail-cn" id="details-policies">
                    <div class="row">
                        <div class="col-lg-3 detail-sidebar">
                            <div class="scroll-heading">
                                <h2>Details &amp; Policies</h2>
                                <hr class="hr">
                                <a href="#hl-features" title="">Features</a>
                            </div>
                        </div>
                        <div class="col-lg-9 details-policies-cn">
                            @for($i = 0; $i<8; $i++)
                                <div class="policies-item">
                                    <h3>{{$lsFacility[$i]->name}}
                                        - {{$lsFacility[$i]->type == 0 ? 'Free' : 'Pay the money'}}</h3>
                                    <p>
                                        {!! $lsFacility[$i]->description !!}
                                    </p>
                                </div>
                            @endfor
                        </div>
                    </div>
                </section>

                <section class="detail-footer detail-cn">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9 detail-footer-cn">
                            <div class="row">
                                <div class="col-xs-5 ">
                                    <div class="review-more">
                                        <a href="#" title=""><i class="icon"></i> Show more reviews</a>
                                    </div>
                                </div>
                                <div class="col-xs-7 text-right">
                                    <p class="price-book" style="font-size: 15px">
                                        From-<span>${{$room->new_price}}</span>/night
                                        <a href="{{route('BookRoom',$room->id)}}" title=""
                                           class="awe-btn awe-btn-1 awe-btn-lager">Book Now</a>
                                    </p>
                                </div>
                            </div>
                            <!-- End Show More Book -->
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
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
                <div class="col-xs-6 col-sm-3 col-md-2" style="font-size: 15px">
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
                <div class="col-xs-6 col-sm-3 col-md-2" style="font-size: 15px">
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
                    <div class="currency-lang-bottom dropdown-cn float-left" style="font-size: 15px">
                        <div class="dropdown-head">
                            <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                        </div>
                        <div class="dropdown-body" >
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
                    <div class="currency-lang-bottom dropdown-cn float-left" style="font-size: 15px">
                        <div class="dropdown-head">
                            <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                        </div>
                        <div class="dropdown-body" >
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
                    <p class="copyright" style="font-size: 15px">
                        © 2009 – 2014 Bookyourtrip™ All rights reserved.
                    </p>
                    <!--CopyRight-->
                </div>
                <!-- End Footer Currency, Language -->
            </div>
        </div>
    </footer>
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

</body>

<!-- Mirrored from envato.megadrupal.com/html/bookawesome/hotel-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Aug 2015 04:49:40 GMT -->
</html>
