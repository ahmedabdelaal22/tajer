

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TAJER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('public/assets/'.FE .'/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/'.FE .'/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/'.FE .'/css/style.css')}}" />



</head>

<body>
    <!-- Start Headr -->
    <header>
   
        <nav class="navbar navbar2 navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand d-lg-none " href="{{lang_url('/')}}">
                    <img src="{{ asset('public/assets/'.FE .'/Images/Icons/logo_white.png')}}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto ">
                        <li class="nav-item lest-menu d-none d-lg-block">
                            <a class="nav-link " href="#">
                                <i class="fa fa-bars "></i>
                                <span>{{ trans("cpanel.menu") }}</span>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item lest-menu d-lg-none d-sm-block">
                            <a class="nav-link " href="#">

                                <span>{{ trans("cpanel.menu") }}</span>
                                <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item li-logo d-none d-lg-block">
                            <img src="{{ asset('public/assets/'.FE .'/Images/Icons/logo_white.png')}}">
                        </li>
                        <a class="navbar-brand d-md-none " href="{{lang_url('/')}}">

                        </a>
                    
             
                         @if (!auth()->check())
                         <li class="nav-item">
                         <a class="nav-link" href="{{ lang_url("login") }}" >{{ trans("cpanel.login") }}</a>
                        </li>
                         @else
                         <li class="nav-item">
                         <a class="nav-link" href="{{lang_url('dashboard/settings')}}" > {{ auth()->user()->name }}</a>
                        </li>
                         <li class="nav-item">
                         <a class="nav-link" href="{{ lang_url('logout') }}"> {{ trans("cpanel.log_out") }} </a>
                        </li>
                         @endif
                   


                </div>
            </div>

            <div class="list text-center">
                <ul class="list-unstyled">
                    <i class="fa fa-close fa-2x"></i>
                    <p>{{trans('cpanel.home')}}</p>
                    <li>
                        <a href="{{lang_url('categories')}}">{{trans('cpanel.Categories')}}</a>
                    </li>
                    <li>
                        <a href="{{lang_url('Brands')}}">{{trans('cpanel.Brands')}}</a> </li>
                    <li>
                        <a href="{{lang_url('Wishlist')}}">{{trans('cpanel.My_wishlist')}}</a> </li>
                    <li>
                        <a href="{{lang_url('About-us')}}">{{trans('cpanel.About')}}</a> </li>
                    <li>
                        <a href="{{lang_url('contact-us')}}">{{trans('cpanel.Contact_us')}}</a> </li>


                </ul>
            </div>
        </nav>
        <!--  -->
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade " data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('public/assets/'.FE .'/Images/silder.jpg')}}" alt="First slide">


                    <div class="carousel-caption">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="float-left">{{trans('cpanel.The_best_products_you_will_find_here')}}
                                    <br>
                                    <span class="mr-5">{{trans('cpanel.with_tajer')}}</span>
                                </h5>

                            </div>
                            <div class="col-lg-10 mx-auto">
                                <h4 class="float-left">{{trans('cpanel.You_will_find_everything_you_want')}}</h4>

                            </div>
                            <div class="col-lg-12 ">
                                <div class="row">
                       @if (!auth()->check())
                       <div class="col-lg-3">
                            <a href="{{lang_url('register_view')}}">
                            <button class="btn">{{trans('cpanel.register')}}</button></a>
                        </div>      

                       @else
                       <div class="col-lg-3">
                            <a href="{{lang_url('categories')}}">
                            <button class="btn">{{trans('cpanel.Shop_now')}}</button></a>
                        </div>
                      @endif
                 </div>
                            </div>


                        </div>
                    </div>

                    <!-- </div> 
                  <div class="carousel-item">
                    <img class="d-block w-100" src="Images/silder.jpg" alt="Second slide">
                  </div> -->

                </div>

            </div>
    </header>
    <!-- End Header -->

   



