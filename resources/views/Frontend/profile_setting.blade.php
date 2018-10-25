@extends(FEI.'.master')
@section('content')


<div class="clientsett-img">
    <p>{{trans('cpanel.Setting')}} </p>
</div>

<section class="seetings">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                @if(Session::has('error_msg'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('error_msg') }}</p>
                @endif
                <div class="tabs-content3">
                    <div class="tab1">
                        {!! Form::model($admin_data,['method'=>'post','files'=>true,'url'=>'/update-profile/'.$sess_user_id]) !!}

                        <div class="profile-cont text-center">
                            @if($admin_data->image !='')
                            <img  id="blah" src="{{ asset('public/uploads/user_img')}}/{{$admin_data->image}}" class="img-responsive img-circle" alt="profile" />
                            @else
                            <img  id="blah"  src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}"  alt="profile"  >
                            @endif
                            <label tabindex="0" for="imgInp" class="input-file-trigger img-label">{{trans('cpanel.upload_your_image')}} </label>

                            {{-- <input class="input-file" id="my-file" type="file"> --}}

                       <!-- <input type='file' onchange="readURL(this);" />-->
                            {!! Form::file('image',array('onchange'=>'readURL(this);','id'=>'imgInp')) !!}


                            @if($errors->has('image'))
                            <span class="help-block text-danger">{{ $errors->first('image') }}</span>
                            @endif



                     </div>







                     <div class="row"                            >
                        <div class="col-md-6"                                >
                                <label for="basic-url" class="mb"> {{trans('cpanel.career')}} </                                label>
                             {!! Form::text('career',old('career'), array('id'=>'career', 'class'=>'form-control'                            )) !!}
                                                    </div>
                        <div class="col-                                md-6">
                                <label for="basic-url" class="mb"> {{trans('cpanel.name')                                }} </label>
                              {!! Form::text('name',old('name'), array('id'=>'name', 'class'=>'form-control','required'=>'requ                                ired')) !!}
                              @if($errors->h                                as('name'))
                                <span class="help-block text-danger">{{ $errors->first('name                                ') }}</span>
                                                   @endif
                                          </div>
               </div>


                     <div                             class="row">
                        <div class=                                "col-md-12">
                                            <label for="basic-url" class="mb">{{trans('cpa                                nel.description')}} </label>

                             {!! Form::textarea('short_description',old('short_description'), array('rows'=>5,'cols'=>10, 'class'=>'form-                            control non-resizable') ) !!}
                         </div>
                     </div>

         <div class="row">



                                                 <div class="col-md-4">
                                                          <div class="form-group">
                                            <label cla                                    ss="mb"> {{trans('cpanel.city')}}  </label>
                              {!! Form::select('city', $states,old('city                                '), ['id'=>'city','class' => 'sl-c                            ou']) !!}
                     </div>
                        </div>

                                   <div class="col-md-4">
                                            <div class="form-group">
                                                                               <label class="mb"> {{trans('cpanel.country')}}  </label>
                              {!! Form::select('country', $countries,$use                                r_country_id, ['id'=>'country','cl                            ass' => 'sl-cou']) !!}

       </div>
                                                      </div>


                        <div class="col-m                                    d-4">
                           <div class="form-group">
                                            <label for="basic-url" class="mb">{{trans('cpanel.birthdate')}} </label>

                              {{ Form::text('birthdate',old('birthdate'), array('id' => 'datepicker','class' => 'form-control')) }}

                            @if($errors->has('birthdate'))
                                            <span class="help-block text-danger">{{ $errors->first('                                            birthdate') }}</span>
                                                         @endif
                                                        </div>
                                                     </div>
      </div>

                                                                 <div class="row">
                        <d                                                    iv class="col-md-6 ">
                                                    <span class="gen mb">{{ tran                                                    s('cpanel.gender')}} </span>
                           <lab                                                        el class="circle-label one">
                           {!! Form::radio(                                                        'gender', 'male','true') !!}
                                                        <span class="place-name" id="male"> {{ trans('cpanel.male') }} </span>
                           </label>
                           <label class="circle-label">
                              {!! Fo                                                                    rm::radio('gender', 'female','true') !!}
                                                                    <span class="place-name" id="fe                                                                    male"> {{ trans('cpanel.female') }}                                                                     </span>
                                                                                          </label>
                        </div>
                                                                          <div class="col-md-6">
                                                                                                                                    <label for="basic-url" class="mb">  {{trans('cpanel.phone_number')}} </label>
                             {!! Form::tel('phone',old('phone'), array('id'=>'phone', 'class'                                                                        =>'form-control','required'=>'required','placeholder'=>t                                                                        rans('cpanel.phone_number'))) !!}
                             @if($errors->has('phone'))
                                                                        <span class="help-block t                                                                        ext-danger">{{ $errors->first('phone                                                                    ') }}</span>
                                                                                      @endif
          </div>
                     </div>

                                                                                @if($admin_data->permissions=                                                                        ='lawyer')
                    <div class="row">
                                                                                  @foreach($specialty as $key=>$value)
                                                                                  <div class="col-md-2 col-xs-4">
                                                                                          <label class="circle-label one">
                                                                                                 @if (in_array($key, $user_specialty))
                              {!! Form::checkbox('spe                                                                                cialty[]',$key, true, array('id' =                                                                                > 'ttt') ) !!}
                            @else
                              {!! Form::checkbox('spe                                                                                cialty[]',$key, null, array('id' =>                                                                                'ttt') ) !!}
                            @endif
                                                                                <span class="place-name spec" id="{{$key}}"> {{$value}}  </span>
                          </label>
                       </div>
                     @endforeach

                    </div>
                    @endif

                   <div class="buttons-save">
                        <button class="done" type="submit">  {{ trans('cpanel.save') }}</button>


                        <a href="{{lang_url('')}}">
                        <button type="button" class="delet">  {{ trans('cpanel.cancel') }} </button></a>

   </div>

              {!! Form::close()!!}


               </div>





               <                                                                                            div class="tab2">
                 @if(Session::has('error_msg'))
                                                                                            <p class="alert {{ S                                                                                            ession::get('alert-class                                                                                            ', 'alert-info') }}">{{ Session::get('error_msg') }}</p>
                 @endif
                 {!! Form::mode                                                                                            l($admin_data,['method'=>'post','url'=>                                                                                                '/change-password/'.$admin_data->id]) !!}
                                                                                                          <div class="row">
                        <div class="col-md-12">
                                                                                                                            <label for="basic-url" class="mb">{{ trans('cpanel.old_passowrd') }} </l                                                                                                    abel>
                        {!! Form::password('current_pass                                                                                                    word', array('id'=>'current_password', 'class'=>'form-control','required'=>'required')) !!}
                        @if($errors->has('current_password'))
                                                                                                    <span class                                                                                                    ="help-block text-danger">{{ $e                                                                                                rrors->first('current_password'                                                                                                ) }}</span>
                        @endif
                                                                                                         </div>
                        <div class="col-md-12">
                                                                                                                                   <label for="basic-url" class="mb">{{ trans('cpanel.new_passowrd') }} </labe                                                                                                    l>
                            {!! Form::password('new_passwor                                                                                                    d', array('id'=>'new_password', 'class'=>'form-control','required'=>'required')) !!}
                            @if($errors->has('new_password'))
                                                                                                    <span class                                                                                                    ="help-block text-danger">{{ $error                                                                                                s->first('new_password') }}</sp                                                                                                an>
                            @endif
                                                                                                             </div>
                        <div class="col-md-12">
                                                                                                                                                <label for="basic-url" class="mb"> {{ trans('cpanel.password_confirmation') }}</label>
                                                                                                                      {!! Form::password('password_confirmation', array('id'=>'pass                                                                                                    word_confirmation', 'class'=>'form-control','required'=>'required')) !!}
                           @if($errors->has('password_confirmation'))
                                                                                                    <span class="help-block text-danger">{{ $errors->first('password_confirmation') }}</span>
                           @endif
                        </div>
                        <div class="col-md-12">
                           <div class="pass-buttons">
                     <button class="saveme" type="submit">{{ trans('cpanel.save') }} </button>

                        <button class="cancelme" type="reset">{{ trans('cpanel.cancel') }} </button>


                           </div>
                        </div>
                     </div>
                 {!! Form::close() !!}
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <ul class="list-tabs3 list-unstyled">
               <li class="selected custom-jss" data-class="tab1">{{ trans('cpanel.basic_information') }} </li>
               <li data-class="tab2">{{ trans('cpanel.pass                                                                                                                word') }}</li>
            </ul>
         </div>
      </div>
   </div>
</section>
                                                                                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                                                                                                                <script>







function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                    .attr('src', e.target.result);
        };

        reader.readAsDat                                                                                                                aURL(input.fil                                                                                                                es[0]);
    }
}

/*$("#imgInp").change(function(){

 readURL(this);

 });*/
    </script>
@stop
