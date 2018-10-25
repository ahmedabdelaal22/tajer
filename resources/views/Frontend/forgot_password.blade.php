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
<section class="signup forget">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 pl-0">
                <div class="form form3">
                    <div class="row">

                        <div class="col-12">

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


                            <h2> {{trans('cpanel.forget_password')}}</h2>
                            <p>{{trans('cpanel.Welcome_forget_password')}}</p>
                            {!! Form::open(['url'=>$sess_locale.'/sendPassword','id'=>'login-nav','role'=>'form',' accept-charset'=>'UTF-8']) !!}

                            {{--<input class="btn-block" type="email" placeholder="البريد الاكتروني">--}}
                            <?php $error_class = ''; ?>
                            @if($errors->has('email'))
                                <?php $error_class = 'error'; ?>
                                <span class="tooltiptext">{{ $errors->first('email') }}</span>
                            @endif
                            {!! Form::email('email', '', array('id'=>'username','class'=>'btn-block ','required'=>'required','placeholder'=>trans('cpanel.email_address'))) !!}

                                <a class="rem" href="{{ lang_url("login") }}">تذكرت كلمة السر ؟</a>

                            <div class="row">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    {{--<button class="btn btn-block">ارسال</button>--}}
                                    <input class="btn btn-block" type="submit" value="{{trans('cpanel.valdation_from')}}" name="login">

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 pr-0 d-lg-block d-sm-none">
                <img src="{{ asset("public/assets/Frontend/Images/forgetpw_s.png") }}">
            </div>
        </div>
    </div>
</section>
<!-- End Section Login -->

@stop
