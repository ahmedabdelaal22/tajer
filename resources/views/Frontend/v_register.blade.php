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
    <section class="signup">
        <div class="container">
            <div class="row">
                    <div class="col-lg-6 pl-0">
                        <div class="form">
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{trans('cpanel.sign_up')}}</h2>


                                   
                        {!! Form::open(['method'=>'POST', 'class'=>'register','id'=>'register-nav','url'=>$sess_locale.'/register','role'=>'form',' accept-charset'=>'UTF-8']) !!}

                            <div class="row">
                                            <div class="col-6">
                                                <label class="lbl-signup">
                                                    <input type="radio" name="type"value="3" checked>
                                                    <span>{{trans('cpanel.Client')}}</span>
                                                </label>
                                            </div>
                                            <div class="col-6">
                                             <label class="lbl-signup">
                                                    <input type="radio"  name="type"value="2">
                                                    <span>{{trans('cpanel.Trader')}}</span>
                                                </label>
                                            </div>
                                        </div>
                                  

                                           <?php $error_class = ''; ?>
                                            @if($errors->has('name'))
                                            <?php $error_class = 'error'; ?>
                                            <span class="tooltiptext">{{ $errors->first('name') }}</span>
                                            @endif
                                            {!! Form::text('name','', array('id'=>'reg_name', 'class'=>'btn-block '.$error_class,'required'=>'required','placeholder'=>trans('cpanel.name'))) !!}




                                            <?php $error_class = ''; ?>
                                            @if($errors->has('phone'))
                                            <?php $error_class = 'error'; ?>
                                            <span class="tooltiptext">{{ $errors->first('phone') }}</span>
                                            @endif
                                            {!! Form::text('phone','', array('id'=>'reg_phone', 'class'=>'btn-block '.$error_class,'required'=>'required','placeholder'=>trans('cpanel.phone'))) !!}




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
                                            {!! Form::password('password', array('id'=>'reg_pass', 'class'=>'btn-block '.$error_class,'placeholder'=>trans('cpanel.password'))) !!}
                                  




                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{lang_url('login')}}">{{ trans('cpanel.do_you_have_an_account_already') }}</a>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-block" type="submit" >{{ trans('cpanel.register') }}</button>
                                        </div>
                                    </div>


                                  {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                        </div>
                <div class="col-lg-6 pr-0 d-lg-block d-sm-none">
                    <img src="{{ asset('public/assets/'.FE .'/Images/singup_s.png')}}">
                </div>
            
            </div>
        </div>
    </section>
    <!-- End Section Login -->
@stop
