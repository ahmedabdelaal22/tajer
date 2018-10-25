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
<html lang="en">

    <!-- Mirrored from odindesign-themes.com/emerald-dragon/dashboard-settings.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Jul 2017 15:49:34 GMT -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
        <link rel="stylesheet" href="{{ asset('public/assets/'.DSH .'/css/vendor/simple-line-icons.css')}}">

        <link  rel="stylesheet"   href="{{ asset('public/assets/'.DSH .'/css/vendor/bootstrap.min.css')}}"/>
        <?php /*
          if ($sess_locale == 'ar') {
          ?>
          <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.DSH .'/css/bootstraprtl.min.css')}}" media="all" />
          <?php } */ ?>
        <link  rel="stylesheet"   href="{{ asset('public/assets/'.DSH .'/css/vendor/tether.min.css')}}"/>


        <link rel="stylesheet" href="{{ asset('public/assets/'.DSH .'/css/style.css')}}">
        <?php
        if ($sess_locale == 'ar') {
            ?>
            <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.DSH .'/css/style_ar.css')}}" media="all" />
        <?php } ?>

        <!-- favicon -->
        <link rel="icon" href="favicon.ico">
        <title>Tajer | Dashboard</title>
    </head>
    <body>

        <!-- SIDE MENU -->
        @include(DSHI.'.menu')
        <!-- /SIDE MENU -->


        <div class="dashboard-body">

            <div class="dashboard-header retracted">
               

                <a href="{{lang_url('/')}}" class="db-close-button">
                    <img src="{{ asset('public/assets/'.DSH .'/images/dashboard/back-icon.png')}}" alt="back-icon">
                </a>
   
               
<!--
                <div class="db-options-button">
                    <img src="{{ asset('public/assets/'.DSH .'/images/dashboard/db-list-right.png')}}" alt="db-list-right">
                    <img src="{{ asset('public/assets/'.DSH .'/images/dashboard/close-icon.png')}}" alt="close-icon">
                </div>
-->

    

                <div class="dashboard-header-item title">
              
                    <div class="db-side-menu-handler">
                        <img src="{{ asset('public/assets/'.DSH .'/images/dashboard/db-list-left.png')}}" alt="db-list-left">
                    </div>
          
<!--                    <h6>Your Dashboard</h6>-->
                </div>
                

                <div class="dashboard-header-item form">
<!--
                    <form class="dashboard-search">
                        <input type="text" name="search" id="search_dashboard" placeholder="Search on dashboard...">
                        <input type="image" src="{{ asset('public/assets/'.DSH .'/images/dashboard/search-icon.png')}}" alt="search-icon">
                    </form>
-->
                </div>

                <div class="dashboard-header-item stats">


                    <div class="stats-meta">
<!--
                        <div class="pie-chart pie-chart1 xmpiechart" style="width: 20px; height: 20px; position: relative;">
                    
-->
<!--
                            <svg class="svg-plus primary">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
                            </svg>
-->
                          
<!--                            <canvas width="20" height="20" style="position: absolute; z-index: 0; top: 0px; left: 0px;"></canvas><canvas class="chartLine" width="20" height="20" style="position: absolute; z-index: 1; top: 0px; left: 0px;"></canvas>-->
                            
<!--                            </div>-->
<!--
                        <h6>64.579</h6>
                        <p>New Original Visits</p>
-->
                    </div>



                </div>

                <div class="dashboard-header-item stats">

                    <div class="stats-meta">
<!--
                        <div class="pie-chart pie-chart2 xmpiechart" style="width: 20px; height: 20px; position: relative;">
              
                            <svg class="svg-minus tertiary">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-minus"></use>
                            </svg>
                       
                            <canvas width="20" height="20" style="position: absolute; z-index: 0; top: 0px; left: 0px;"></canvas><canvas class="chartLine" width="20" height="20" style="position: absolute; z-index: 1; top: 0px; left: 0px;"></canvas></div>
                        <h6>20.8</h6>
                        <p>Less Sales Than Last Month</p>
-->
                    </div>

                </div>

                <div class="dashboard-header-item stats">

                    <div class="stats-meta">
<!--
                        <div class="pie-chart pie-chart3 xmpiechart" style="width: 20px; height: 20px; position: relative;">
                         
                            <svg class="svg-plus primary">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
                            </svg>
                  
                            <canvas width="20" height="20" style="position: absolute; z-index: 0; top: 0px; left: 0px;"></canvas><canvas class="chartLine" width="20" height="20" style="position: absolute; z-index: 1; top: 0px; left: 0px;"></canvas></div>
                        <h6>322k</h6>
                        <p>Total Visits This Month</p>
-->
                    </div>

                </div>

                <div class="dashboard-header-item back-button">
                    <a href="{{lang_url('/')}}" class="button mid dark-light">Back to Homepage</a>
                </div>
                
            </div>


