@extends(DSHI.'.master')
@section('content')
    @include("Frontend.include.subHeader")

    <!-- Start New Addres -->
    <section class="newaddress">
        <div class="container">
            <div class="row">
                {{--<div class="col-10 mx-auto">--}}
                    {{--<div class="uplode">--}}
                        {{--<div class="file-upload ">--}}
                            {{--<label for="upload" class="file-upload__label">--}}
                                {{--<img class="img-fluid" src="{{ asset("public/assets/Frontend/Images/User-Avatar-Big.png") }}" alt="" id="blah">--}}
                            {{--</label>--}}
                            {{--<input id="upload" class="file-upload__input" type="file" name="file-upload"--}}
                                   {{--onChange="readURL(this)">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-10 mx-auto">
                    {!! Form::model($admin_data,['method'=>'post','files'=>true,'url'=>'/update-profile/'.$admin_data->id,'id'=>'profile-info-form']) !!}
                    <div class="uplode">
                        <div class="file-upload ">
                            <label for="upload" class="file-upload__label">
                                @if($admin_data->image !='')
                                    {{--<img  id="blah" src="{{ asset('public/uploads/user_img')}}/{{$admin_data->image}}" class="img-responsive img-circle" alt="{{$admin_data->name}}" />--}}
                                    <img class="img-fluid" src="{{ asset('public/uploads/user_img')}}/{{$admin_data->image}}" alt="" id="blah">
                                @else
{{--                                    <img id="blah" src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}" alt="profile-default-image">--}}
                                    <img class="img-fluid" src="{{ asset("public/assets/Frontend/Images/User-Avatar-Big.png") }}" alt="" id="blah">
                                @endif
                            </label>
                            {{--<input id="upload" class="file-upload__input" type="file" name="file-upload"--}}
                                   {{--onChange="readURL(this)">--}}
                            {!! Form::file('image',array('onchange'=>'readURL(this);','id'=>'upload','class'=>'file-upload__input',"onChange"=>"readURL(this)")) !!}

                        </div>
                    </div>
                        <div class="row">


                            <div class="col-12">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="الاسم">--}}
                                {!! Form::text('name',old('name'), array('id'=>'acc_name', 'class'=>'btn-block','required'=>'required','placeholder'=>trans('cpanel.enter_your_account_name_here').'...')) !!}

                            </div>


                            <div class="col-12">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="رقم الجوال">--}}
                                {!! Form::tel('phone',old('phone'), array('id'=>'phone', 'class'=>'btn-block','required'=>'required','placeholder'=>trans('cpanel.enter_your_mobile_number_here').'...'  )) !!}

                            </div>


                            <div class="col-6">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="رقم الجوال">--}}
                                {!! Form::password('password', array('id'=>'new_pwd', 'class'=>'btn-block','placeholder'=>trans('cpanel.enter_your_password_here').'...' )) !!}

                            </div>


                            <div class="col-6">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="رقم الجوال">--}}
                                {!! Form::password('password_confirmation', array('id'=>'new_pwd2', 'class'=>'btn-block','placeholder'=>trans('cpanel.repeat_your_password_here').'...')) !!}

                            </div>


                            <div class="col-12">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="رقم الجوال">--}}
                                {!! Form::email('email',old('email'), array('id'=>'new_email', 'class'=>'btn-block','required'=>'required','placeholder'=>trans('cpanel.enter_your_email_address_here').'...')) !!}
                            </div>


                            <div class="col-6">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="الدولة">--}}
                                {!! Form::select('country', get_countries_cities()['countries'],$user_country_id, ['id'=>'country1','class' => 'btn-block ','required'=>'required']) !!}
                            </div>


                            <div class="col-6">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="المدينة">--}}
                                {!! Form::select('city', $states,old('cities_id'), ['id'=>'city','class' => 'btn-block' ,'required'=>'required']) !!}
                            </div>

                            <div class="col-12">
                                {!! Form::select('region', $regions,old('region_id'), ['id'=>'region','class' => 'btn-block','required'=>'required']) !!}
                            </div>

                            <div class="col-12">
                                {{--<input class="btn-block" type="text" name="" id="" placeholder="المدينة">--}}
                                {!! Form::text('about',old('about'), array('id'=>'about', 'class'=>'btn-block','placeholder'=>trans('cpanel.This_will_appear_bellow_your_avatar...(max_140_char)'))) !!}
                            </div>


                            <div class="col-12">
                                <input class="btn-block" type="text" name="" id="" placeholder="العنوان">
                            </div>


                            <div class="col-6">
                                <input class="btn-block" type="text" name="" id="" placeholder="رقم الدور">
                            </div>


                            <div class="col-6">
                                <input class="btn-block" type="text" name="" id="" placeholder="رقم الشقة">
                            </div>

                            <div class="col-12">
                                <h4>{{trans('cpanel.Social_Media')}}</h4>
                                <hr class="line-separator">

                                <!-- INPUT CONTAINER -->
                                <div class="col-12">
                                    <ul class="share-links">
                                        <li><a href="#" class="fb"></a></li>
                                    </ul>

                                <!--                {!! Form::url('facebook_profile',old('facebook_profile'), array('id'=>'social_fb_link', 'class'=>'btn-block','placeholder'=>trans('cpanel.Enter_your_social_link_here').'...')) !!}-->


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


                            <div class="col-4 mr-auto">

                                <button class="btn btn-block">
                                    حفظ
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- End New Addres -->
    <script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('#country1').on('change', function () {
                // $("body").on('change', '#country', function() {
                var country_id = this.value;
                var req_url = "{!! lang_url('ajax_cities_country') !!}" + '/' + country_id;

                $.ajax({
                    type: "Get",
                    url: req_url,
                    data: {country_id: country_id},
                    dataType: 'json', // Define data type will be JSON
                    success: function (result) {
                        var cities_data = result.cities_data;
                        var $el = $("#city");
                        $el.empty(); // remove old options
                        cities_data.forEach(function (entry) {
                            $el.append('<option value="' + entry.id + '">' + entry.name + '</option>');
                        });

                    },
                    error: function (error) {
                        $("#ajaxResponse").append("<div>" + error + "</div>");
                    }
                }); //end ajax
            }); //end on change country


            $('#city').on('change', function () {
                // $("body").on('change', '#country', function() {
                var city_id = this.value;
                var req_url = "{!! lang_url('ajax_regions_country') !!}" + '/' + city_id;

                $.ajax({
                    type: "Get",
                    url: req_url,
                    data: {city_id: city_id},
                    dataType: 'json', // Define data type will be JSON
                    success: function (result) {
                        console.log(result) ;
                        var reqions_data = result.cities_data;
                        var $el = $("#region");
                        $el.empty(); // remove old options
                        reqions_data.forEach(function (entry) {
                            $el.append('<option value="' + entry.id + '">' + entry.name + '</option>');
                        });

                    },
                    error: function (error) {
                        $("#ajaxResponse").append("<div>" + error + "</div>");
                    }
                }); //end ajax
            }); //end on change country



        });  //End Document.Ready


    </script>

@stop