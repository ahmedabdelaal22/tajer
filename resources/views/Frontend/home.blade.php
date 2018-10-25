@extends(FEI.'.master2')
@section('content')

<?php

use Carbon\Carbon;

$locale = App::getLocale();
?>

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


 <!-- Start Sec1  -->
    <section class="sec1 text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="">{{trans('cpanel.the_latest_products_to_the_year')}} <span>{{trans('cpanel.2018')}}</span></h2>
                </div>
                <div class="col-md-4">


                            @foreach($all_latest3 as $row)

                    <div class="box-sec1">
                        <img src="{{ asset($row->thumbnail_image)}}">
                        <span></span>
                        <div class="box-sec1-info">
                            <h3>{{$row->CategoryName}}</h3>
                            <p>{{$row->title}}</p>
                            <p class="price"> 
                                            @if($row->ratio == 0 )
                                            {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}
                                            @else
                                            {{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}
                                            @endif</p>
                          <a href="{{lang_url('dashboard/items/'.$row->id)}}">  <button class="btn">{{trans('cpanel.buy_now')}}</button></a>
                        </div>
                    </div>
                  @endforeach
                </div>


                <div class="col-md-4"><!--center -->
                    @foreach($all_latest as $row)
                    <div class="box-sec1 box-sec2">
                        <img src="{{ asset($row->thumbnail_image)}}">
                        <span></span>
                        <div class="box-sec1-info">
                            <h3>{{$row->CategoryName}}</h3>
                            <p>{{$row->title}}</p>
                            <p class="price"> 
                                           @if($row->ratio == 0 )
                                            {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}
                                            @else
                                            {{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}
                                            @endif</p>
                           <a href="{{lang_url('dashboard/items/'.$row->id)}}">  <button class="btn">{{trans('cpanel.buy_now')}}</button></a>
                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="col-md-4">
                   @foreach($all_latest2 as $row)

                    <div class="box-sec1">
                        <img src="{{ asset($row->thumbnail_image)}}">
                        <span></span>
                        <div class="box-sec1-info">
                            <h3>{{$row->CategoryName}}</h3>
                            <p>{{$row->title}}</p>
                            <p class="price"> 
                                            @if($row->ratio == 0 )
                                            {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}
                                            @else
                                            {{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}
                                            @endif</p>
                                    <a href="{{lang_url('dashboard/items/'.$row->id)}}">  <button class="btn">{{trans('cpanel.buy_now')}}</button></a>
                        </div>
                    </div>
                  @endforeach

                </div>

            </div>
        </div>
    </section>
    <!-- End Sec1 -->
    <!-- Start Sec2 -->
    <section class="sec2">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>{{trans('cpanel.Discounts')}}</h2>
                    <h3>{{trans('cpanel.for_more_than')}}</h3>
                    <h4>{{trans('cpanel.40')}} %</h4>
                    <h5>{{trans('cpanel.on_womens_products')}}</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Sec3 -->
    <section class="sec3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">{{trans('cpanel.the_best_products_to_the_year')}} <span>{{trans('cpanel.2018')}}</span></h2>
                </div>
                <div class="col-lg-4">


                    <div class="box-sec3">
                        <img src="{{ asset($all_feature1[1]->thumbnail_image)}}">
                        <span>{{$all_feature1[1]->CategoryName}}</span>
                        <div class="ovralay">
                            <div class="box-sec3-content">
                                <div class="row">
                                    <div class="col-12">
                                        <p>{{$all_feature1[1]->title}}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="price">  
                                                @if($all_feature1[1]->ratio == 0 )
                                            {{number_format($all_feature1[1]->fixed_price)}} {{trans('cpanel.R_S')}}
                                            @else
                                            {{number_format($all_feature1[1]->discount_price)}} {{trans('cpanel.R_S')}}
                                            @endif</p>
                                    </div>
                                    <div class="col-lg-6">
                                                <a href="{{lang_url('dashboard/items/'.$all_feature1[1]->id)}}">  <button class="btn">{{trans('cpanel.buy_now')}}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4">
             @foreach($all_feature2 as $row)
                     <div class="box-sec3 box-sec4 ">
                        <img src="{{ asset($row->thumbnail_image)}}">
                        <span>{{$row->CategoryName}}</span>
                        <div class="ovralay">
                            <div class="box-sec3-content">
                                <div class="row">
                                    <div class="col-12">
                                        <p>{{$row->title}}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="price">
                                             @if($row->ratio == 0 )
                                            {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}
                                            @else
                                            {{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}
                                            @endif</p></p>
                                    </div>
                                    <div class="col-lg-6">
                                                <a href="{{lang_url('dashboard/items/'.$row->id)}}">  <button class="btn">{{trans('cpanel.buy_now')}}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

                </div>



                <div class="col-lg-4">


                    <div class="box-sec3">
                        <img src="{{ asset($all_feature1[0]->thumbnail_image)}}">
                        <span>{{$all_feature1[0]->CategoryName}}</span>
                        <div class="ovralay">
                            <div class="box-sec3-content">
                                <div class="row">
                                    <div class="col-12">
                                        <p>{{$all_feature1[0]->title}}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="price">  
                                                @if($all_feature1[0]->ratio == 0 )
                                            {{number_format($all_feature1[0]->fixed_price)}} {{trans('cpanel.R_S')}}
                                            @else
                                            {{number_format($all_feature1[0]->discount_price)}} {{trans('cpanel.R_S')}}
                                            @endif</p>
                                    </div>
                                    <div class="col-lg-6">
                                                 <a href="{{lang_url('dashboard/items/'.$all_feature1[0]->id)}}">  <button class="btn">{{trans('cpanel.buy_now')}}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
    <!-- Start Sec3 -->

    <!-- Start Sec4 -->
    <form class="sec4 sub">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2>{{trans('cpanel.Subscribe_to_our_Newsletter')}}</h2>
                </div>
            
                <div class="col-lg-4">
                    <input class="btn-block" type="text" id="email_susqribe" placeholder="{{trans('cpanel.Enter_your_email_address')}}">
                </div>
                <div class="col-lg-4">
                    <button onclick="subscribe()" type="button" class="btn btn-block">{{trans('cpanel.subscribe')}}</button>
                </div>
              
            </div>
        </div>
    </form>





@stop
