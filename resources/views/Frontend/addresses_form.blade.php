@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")


<!-- Start New Addres -->
<section class="newaddress">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    <h2>{{ trans('cpanel.Add_Address') }}</h2>
                </div>
                <div class="col-10 mx-auto">

                    @if(isset($address))
                        {!! Form::model($address,["url" => lang_url("addresses/$address->id"),'method' => 'put',]) !!}
                    @else
                        {!! Form::open(['method'=>'POST','url'=>$locale.'/addresses/store']) !!}
                    @endif
                        <div class="row">


                   




                          <div class="col-12">
                        
                            @if ($errors->has('name'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                            {!! Form::text('name',old('name'), array('id'=>'name', 'class'=>'form-control', 'required'=>'required','placeholder'=> trans('cpanel.name'))) !!}
                        </div>


                          <div class="col-12">
                        
                            @if ($errors->has('phone'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                            {!! Form::text('phone',old('phone'), array('id'=>'phone', 'class'=>'form-control', 'required'=>'required','placeholder'=> trans('cpanel.phone'))) !!}
                        </div>



 

                          <div class="col-12">
                        
                            @if ($errors->has('address'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('address') }}
                            </div>
                            @endif
                            {!! Form::text('address',old('address'), array('id'=>'address', 'class'=>'form-control', 'required'=>'required','placeholder'=> trans('cpanel.Address'))) !!}
                        </div>



                        <div class="col-6">
                        
                            @if ($errors->has('country'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('country') }}
                            </div>
                            @endif
                  

                              {!! Form::select('country', get_countries_cities()['countries'],@$user_country_id, ['id'=>'country1','class' => 'form-control mb-3','required'=>'required']) !!}
                        </div>

                        <div class="col-6">
                        
                            @if ($errors->has('city'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('city') }}
                            </div>
                            @endif
                           {!! Form::select('city', @$states,old('cities_id'), ['id'=>'city','class' => 'form-control mb-3','required'=>'required']) !!}
                        </div>


                           <div class="col-12">
                        
                            @if ($errors->has('region_id'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('region_id') }}
                            </div>
                            @endif
                                    {!! Form::select('region', @$regions,old('region_id'), ['id'=>'region','class' => 'form-control mb-3','required'=>'required','placeholder'=> trans('cpanel.region')]) !!}
                        </div>


                        <div class="col-6">
                        
                            @if ($errors->has('floor_number'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('floor_number') }}
                            </div>
                            @endif
                            {!! Form::text('floor_number',old('floor_number'), array('id'=>'floor_number', 'class'=>'form-control', 'required'=>'required','placeholder'=> trans('cpanel.floor_number'))) !!}
                        </div>


                        <div class="col-6">
                        
                            @if ($errors->has('unit_number'))
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="icon-exclamation"></i>
                                {{ $errors->first('unit_number') }}
                            </div>
                            @endif
                            {!! Form::text('unit_number',old('unit_number'), array('id'=>'unit_number', 'class'=>'form-control', 'required'=>'required','placeholder'=> trans('cpanel.unit_number'))) !!}
                        </div>



                            <div class="col-4 mr-auto">
                                <button class="btn btn-block">
                                       {{ trans('cpanel.save') }}
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

