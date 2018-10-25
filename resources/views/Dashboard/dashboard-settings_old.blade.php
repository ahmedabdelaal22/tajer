@extends(DSHI.'.master')
@section('content')


<div class="dashboard-content">
    <!-- HEADLINE -->
    <div class="headline buttons primary sp_color">
        <h4>{{trans('cpanel.Account_Settings')}}</h4>
        <button form="profile-info-form" class="button mid-short primary">{{trans('cpanel.Save_Changes')}}</button>
    </div>
    <!-- /HEADLINE -->

    <!-- FORM BOX ITEMS -->
    <div class="form-box-items">
        <!-- FORM BOX ITEM -->
        <div class="form-box-item">
            <h4>{{trans('cpanel.Profile_Information')}}</h4>
            <hr class="line-separator">

            {!! Form::model($admin_data,['method'=>'post','files'=>true,'url'=>'/update-profile/'.$admin_data->id,'id'=>'profile-info-form']) !!}
            <div class="profile-image">
                <div class="profile-image-data">
                    <figure class="user-avatar medium">

                        @if($admin_data->image !='')
                        <img  id="blah" src="{{ asset('public/uploads/user_img')}}/{{$admin_data->image}}" class="img-responsive img-circle" alt="{{$admin_data->name}}" />
                        @else
                        <img id="blah" src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}" alt="profile-default-image">
                        @endif


                    </figure>
                    <p class="text-header">{{trans('cpanel.Profile_Photo')}} </p>
                    <p class="upload-details">{{trans('cpanel.Minimum_size')}} 70x70 px </p>
                </div>
                {!! Form::file('image',array('onchange'=>'readURL(this);','id'=>'imgInp','class'=>'input-file')) !!}
                <!--<a href="#" class="button mid-short dark-light">Upload Image...</a>-->
                <label tabindex="0" for="imgInp"class="button mid-short dark-light"> {{trans('cpanel.Upload_Image')}}...</label>
            </div>


            <div class="input-container">
                <label for="acc_name" class="rl-label required">{{trans('cpanel.Account_Name')}}</label>

                {!! Form::text('name',old('name'), array('id'=>'acc_name', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.enter_your_account_name_here').'...')) !!}
            </div>


            <div class="input-container">
                <label for="phone" class="rl-label required">{{trans('cpanel.Mobile_Number')}}</label>

                {!! Form::tel('phone',old('phone'), array('id'=>'phone', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.enter_your_mobile_number_here').'...'  )) !!}
            </div>


            <div class="input-container">

                <div class="row">


                    <div class="col-md-6 col-xs-12">

                        <div class="input-container">

                            <label for="new_pwd" class="rl-label">{{trans('cpanel.New_Password')}}</label>
                            {!! Form::password('password', array('id'=>'new_pwd', 'class'=>'form-control','placeholder'=>trans('cpanel.enter_your_password_here').'...' )) !!}
                        </div>

                    </div>


                    <div class="col-md-6 col-xs-12">

                        <div class="input-container">

                            <label for="new_pwd2" class="rl-label">{{trans('cpanel.Repeat_Password')}}</label>

                            {!! Form::password('password_confirmation', array('id'=>'new_pwd2', 'class'=>'form-control','placeholder'=>trans('cpanel.repeat_your_password_here').'...')) !!}

                        </div>

                    </div>

                </div>

            </div>


            <div class="input-container">
                <label for="new_email" class="rl-label">{{trans('cpanel.email')}}</label>

                {!! Form::email('email',old('email'), array('id'=>'new_email', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.enter_your_email_address_here').'...')) !!}
            </div>


            <div class="input-container">
                <div class="row">

                    <div class="col-md-6">

                        <div class="input-container">

                            <label for="country1" class="rl-label required">{{trans('cpanel.Country')}}</label>
                            <label for="country1" class="select-block">

                                {!! Form::select('country', get_countries_cities()['countries'],$user_country_id, ['id'=>'country1','class' => '','required'=>'required']) !!}

                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="input-container">

                            <label for="city" class="rl-label required">{{trans('cpanel.City')}}</label>

                            <label for="city" class="select-block">

                                {!! Form::select('city', $states,old('cities_id'), ['id'=>'city','class' => '','required'=>'required']) !!}


                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>

                        </div>
                    </div>
                </div>

            </div>


            <div class="input-container">
                <label for="about" class="rl-label">{{trans('cpanel.About')}}</label>
                {!! Form::text('about',old('about'), array('id'=>'about', 'class'=>'form-control','placeholder'=>trans('cpanel.This_will_appear_bellow_your_avatar...(max_140_char)'))) !!}

            </div>


        </div>


        <div class="form-box-item spaced">
            <h4>{{trans('cpanel.Social_Media')}}</h4>
            <hr class="line-separator">

            <!-- INPUT CONTAINER -->
            <div class="input-container">
                <ul class="share-links">
                    <li><a href="#" class="fb"></a></li>
                </ul>

                <!--                {!! Form::url('facebook_profile',old('facebook_profile'), array('id'=>'social_fb_link', 'class'=>'','placeholder'=>trans('cpanel.Enter_your_social_link_here').'...')) !!}-->


                <input form="profile-info-form" type="text" id="social_fb_link" name="social_fb_link" value="www.facebook.com/jhonnyfischershop" placeholder="{{trans('cpanel.Enter_your_social_link_here')}}...">

            </div>
            <!-- /INPUT CONTAINER -->


            <!-- INPUT CONTAINER -->
            <div class="input-container">
                <ul class="share-links">
                    <li><a href="#" class="gplus"></a></li>
                </ul>

                <!--                {!! Form::url('google_profile',old('google_profile'), array('id'=>'social_gplus_link', 'class'=>'','placeholder'=>trans('cpanel.Enter_your_social_link_here').'...')) !!}-->

                <input form="profile-info-form" type="text" id="social_gplus_link" name="social_gplus_link" placeholder="{{trans('cpanel.Enter_your_social_link_here')}}...">

            </div>
            <!-- /INPUT CONTAINER -->


            <div class="input-container">
                <ul class="share-links">
                    <li><a href="#" class="twt"></a></li>
                </ul>


                <!--                {!! Form::url('twitter_profile',old('twitter_profile'), array('id'=>'social_twt_link', 'class'=>'','placeholder'=>trans('cpanel.Enter_your_social_link_here').'...')) !!}-->

                <input form="profile-info-form" type="text" id="social_twt_link" name="social_twt_link" placeholder="{{trans('cpanel.Enter_your_social_link_here')}}...">


            </div>


        </div>


        {!! Form::close() !!}
    </div>

</div>


@stop