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

        <nav class="woocommerce-breadcrumb">
            <a href="home.php">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            My Account
        </nav><!-- .woocommerce-breadcrumb -->

        <div id="primary" class="content-area">
            <main id="main" class="site-main">
            
                <article id="post-8" class="hentry">

                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="customer-login-form">

                                <div class="col2-set" id="customer_login loginpage">

                                    <div class="col-1">


                                        <h2>Login</h2>

                                       
                        {!! Form::open(['method'=>'POST', 'class'=>'register','id'=>'register-nav','url'=>$sess_locale.'/login','role'=>'form',' accept-charset'=>'UTF-8']) !!}


                                                     <p class="form-row form-row-wide">
                                            <label for="reg_email">{{trans('cpanel.email_address')}}
                                                <span class="required">*****</span></label>

                                            <?php $error_class = ''; ?>
                                            @if($errors->has('email'))
                                            <?php $error_class = 'error'; ?>
                                            <span class="tooltiptext">{{ $errors->first('email') }}</span>
                                            @endif
                                            {!! Form::email('email','', array('id'=>'reg_email', 'class'=>'input-text '.$error_class,'required'=>'required','placeholder'=>trans('cpanel.email_address'))) !!}

                                        </p>
                                            
                                         
                                        <p class="form-row form-row-wide">
                                            <label for="reg_pass">{{trans('cpanel.password')}}
                                                <span class="required">*</span></label>
                                            <?php $error_class = ''; ?>
                                            @if($errors->has('password'))
                                            <?php $error_class = 'error'; ?>
                                            <span class="tooltiptext">{{ $errors->first('password') }}</span>
                                            @endif
                                            {!! Form::password('password', array('id'=>'reg_pass', 'class'=>'input-text '.$error_class,'placeholder'=>trans('cpanel.enter_password'))) !!}
                                        </p>


                                        


                                               <p class="form-row">
                                            <input type="submit" class="button" name="login" value=" {{ trans('cpanel.login') }}" />
                                                 <label for="rememberme" class="inline">
                                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember me
                                                </label>
                                        </p>



                                        {!! Form::close() !!}


                                            <p class="lost_password">
                                                <a href="login-and-register.php">Lost your password?</a>
                                            </p>
                                            
                                            
                                            <p class="before-login-text">
                                              or sign in with
                                             </p>
                                            
                                            <p class="form-row">
                               
                                                   <a href="{{ lang_url('auth/facebook') }}" class="fb half">{{trans('cpanel.Facebook')}}</a>
                                            <a href="{{ lang_url('auth/twitter') }}" class="  tw half">{{trans('cpanel.Twitter')}}</a>
                                            <a href="{{ lang_url('auth/google') }}" class="  go half">{{trans('cpanel.Google')}}</a>
                                            </p>

                                  


                                    </div><!-- .col-1 -->

                        

                                </div><!-- .col2-set -->

                            </div><!-- /.customer-login-form -->
                        </div><!-- .woocommerce -->
                    </div><!-- .entry-content -->

                </article><!-- #post-## -->

            </main><!-- #main -->
        </div><!-- #primary -->


    </div><!-- .col-full -->
</div>  
     
@stop
