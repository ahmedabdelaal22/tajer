@extends(FEI.'.master')
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
<!--*******************************************************-->




<div id="content" class="site-content" tabindex="-1">
    <div class="container">

        <nav class="woocommerce-breadcrumb" >
            <a href="home.html">{{trans('cpanel.home')}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            {{trans('cpanel.My_Account')}}
        </nav><!-- .woocommerce-breadcrumb -->

        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article id="post-8" class="hentry">

                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="customer-login-form">
<!--                                <span class="or-text">{{trans('cpanel.or')}}</span>-->

                                <div class="col2-set" id="customer_login">
@if(Session::has('not_user'))
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            <strong>{{trans('error!')}}</strong> {!!Session::get('not_user')!!}
        </div>
    @endif
    
    
    @if(Session::has('send_email'))
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            <strong>{{trans('send_mssage_to_email!')}}</strong> {!!Session::get('send_email')!!}
        </div>
    @endif
    
                                    <div class="col-1">


                                        <h2>{{trans('cpanel.forget_password')}}
</h2>

                                        {!! Form::open(['url'=>$sess_locale.'/sendPassword', 'class'=>'form','id'=>'login-nav','role'=>'form',' accept-charset'=>'UTF-8']) !!}

                                        <p class="before-login-text">
                                            {{trans('cpanel.Welcome_forget_password')}}


                                        </p>

                                        <p class="form-row form-row-wide">
                                            <label for="username">{{trans('cpanel.plese_enter_email')}}
                                                <span class="required">*</span></label>
                                            <?php $error_class = ''; ?>
                                            @if($errors->has('email'))
                                            <?php $error_class = 'error'; ?>
                                            <span class="tooltiptext">{{ $errors->first('email') }}</span>
                                            @endif
                                            {!! Form::email('email', '', array('id'=>'username','class'=>'input-text '.$error_class,'required'=>'required','placeholder'=>trans('cpanel.email_address'))) !!}

                                        </p>


                                        <p class="form-row">

                                            <input class="button" type="submit" value="{{trans('cpanel.valdation_from')}}" name="login">

                                           
                                            </p>

                                   

                                           
                                    

                               


                                        </form>


                                    </div><!-- .col-1 -->


                                </div><!-- .col2-set -->

                            </div><!-- /.customer-login-form -->
                        </div><!-- .woocommerce -->
                    </div><!-- .entry-content -->

                </article><!-- #post-## -->

            </main><!-- #main -->
        </div><!-- #primary -->


    </div><!-- .col-full -->
</div><!-- #content -->
@stop
