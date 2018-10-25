@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")

<section class="contact">
        <div class="container">
@if(Session::has('success_msg'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success_msg') }}</p>
@endif

 @if(Session::has('error_msg'))
<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error_msg') }}</p>
@endif        	
            <div class="row">


                <div class="col-10 mx-auto">
                    <h2>تواصل معنا</h2>
                    <p>تواصل معنا للحصول علي نتيجة افضل</p>
                </div>

                <div class="col-10 mx-auto">
                            {!! Form::open(['method'=>'POST','url'=>$locale.'/store-contact']) !!}
                        <div class="row">
                            <div class="col-lg-6">

                            @if ($errors->has('name'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                                <input class="btn-block" type="text" name="name" id="" placeholder="الاسم" required>
                            </div>
                            <div class="col-lg-6">
                             @if ($errors->has('phone'))
                            <div class="alert email-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                                    <input class="btn-block" type="text" name="phone" id="" placeholder="رقم الجوال" required>

                            </div>
                            <div class="col-lg-6">

                             @if ($errors->has('email'))
                            <div class="alert email-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                                    <input class="btn-block" type="email" name="email" id="" placeholder="البريد الاكترونى" required>

                            </div>
                            <div class="col-lg-6">

                            @if ($errors->has('subject'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('subject') }}
                            </div>
                            @endif
                                    <input class="btn-block" type="text" name="subject" id="" placeholder="عنوان الرسالة" required>

                            </div>
                            <div class="col-lg-12">
                             @if ($errors->has('message'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('message') }}
                            </div>
                            @endif
                                <textarea class="btn-block" name="message" placeholder="الرسالة" required></textarea>
                            </div>
                            <div class="col-4 mr-auto">
                             <!--    <button class="btn btn-block">ارسال</button> -->

                                   <input class="btn btn-block" type="submit" value="Submit">
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
