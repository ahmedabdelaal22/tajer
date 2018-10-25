<?php
$url_segment = \Request::segment(1);
if ($url_segment == 'ar' || $url_segment == 'en') {
    App::setLocale($url_segment);
    $locale = App::getLocale();
} else {
    App::setLocale('ar');
    $locale = App::getLocale();
}

session(['sess_locale' => $locale]);
$sess_locale = session('sess_locale');
//  if(auth()->user()){
$sess_user_id = session('user_id');
?>
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
    <!-- Start Footer2 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-lg-none d-sm-block" href="inedx.html">
                <img src="{{ asset('public/assets/'.FE .'/Images/Icons/logo_dark.png')}}" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="inedx.html">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">الاقسام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ماركات</a>
                    </li>


                </ul>

                <a class="navbar-brand mx-auto d-lg-block d-md-none" href="inedx.html">
                    <img src="{{ asset('public/assets/'.FE .'/Images/Icons/logo_dark.png')}}" alt="logo">
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">من نحن</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="contact.html">تواصل معنا</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            عربي
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>

                        </div>
                    </li>


                </ul>
            </div>

        </div>
    </nav>
    <!-- End Footer2  -->