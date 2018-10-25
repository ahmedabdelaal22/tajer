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



<!-- Start Section Login -->
<section class="signup signup">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pl-0 d-lg-block d-sm-none">
                <img src="{{ asset("public/assets/Frontend/Images/singup_s.png") }}">
            </div>
            <div class="col-lg-6 pr-0">
                <div class="form2 form">
                    <div class="row">
                        @if( Session::get('error_login'))
                            <div class="alert alert-danger">
                                    <strong>{{ trans("cpanel.error") }}!</strong> {{ Session::get('error_login')}}   
                                  </div>
                      @endif
                   
                        <div class="col-12">
                            <h2> {{ trans("cpanel.login") }}</h2>
                            {!! Form::open(['method'=>'POST', 'class'=>'register','id'=>'register-nav','url'=>$sess_locale.'/login','role'=>'form',' accept-charset'=>'UTF-8']) !!}


                            <?php $error_class = ''; ?>
                            @if($errors->has('email'))
                                <?php $error_class = 'error'; ?>
                                <span class="tooltiptext">{{ $errors->first('email') }}</span>
                            @endif
                            {!! Form::email('email','', array('id'=>'reg_email', 'class'=>'btn-block '.$error_class,'required'=>'required','placeholder'=>trans('cpanel.email_address'))) !!}


                            <?php $error_class = ''; ?>
                            @if($errors->has('password'))
                                <?php $error_class = 'error'; ?>
                                <span class="tooltiptext">{{ $errors->first('password') }}</span>
                            @endif
                            {!! Form::password('password', array('id'=>'reg_pass', 'class'=>'btn-block pass '.$error_class,'placeholder'=>trans('cpanel.enter_password'))) !!}
                       

                            <div class="row">
                            <div class="col-6">
                           <label class="remember">
                           <input name="rememberme" type="checkbox" id="rememberme" value="forever">
                           <span>{{ trans('cpanel.remember') }}</span>
                           </label>
                            </div>
                            <div class="col-6">
                            <a class="rem" href="{{ lang_url("forgotPassword") }}">{{ trans("cpanel.forgot") }}</a>
                            </div>
                               

                         
                                <div class="col-6">
                                    <a class="d-block text-right" href="{{ lang_url("register_view") }}">{{ trans("cpanel.sign_up") }}</a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-block">{{ trans('cpanel.login') }}</button>
                                </div>
                            </div>
                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- End Section Login -->

@stop
