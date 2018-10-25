@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />

<section class="choise">
        <div class="container">


    
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 mx-auto text-center">
                                <div class="uplode">
                                    <div class="file-upload ">
                                        <label for="upload" class="file-upload__label">
                                            <img src="{{ asset("public/assets/".DSH."/Images/AddFiles.png") }}" alt="">
                                        </label>
                                        {{ Form::file('image_gallery[]', ['class' => 'image_gallery file-upload__input','id'=>'image_gallery','required'=>'required', 'style'=>'width :500px']) }}
                                      
                                    </div>
                                               <div class="container">
    
                    <div class="row">
                        @if(!empty($admin_data)) @if(!empty($admin_data->items_images))
                        <?php
    $i = 1;
    foreach ($admin_data->items_images as $row_gallery) {
        ?>
    
                            <div class="col-md-4 imagelocation<?php echo $row_gallery->id ?>">
                                <div class="thumbnail">
                                    <a href="/w3images/lights.jpg" target="_blank">
                                        <img src="{{ asset($row_gallery->image) }}" alt="Lights" style="width:100%">
    
                                    </a>
                                    <span onclick="javascript:deleteimage(<?php echo $row_gallery->id ?>)">{{trans('cpanel.Remove')}}</span>
                                </div>
                            </div>
                            <?php
        $i++;
    }
    ?>
                                @endif @endif
                    </div>
                </div>
                                    {!! Form::open(['method'=>'put','files'=>true,'class'=>'dropzone','id'=>'myImageDropzone','url'=>'imageupload','role'=>'form','
                                    accept-charset'=>'UTF-8']) !!} {!! Form::close() !!}
                                </div>
                                <p>{{trans('cpanel.Upload_your_product_images_with_minimum_four_images')}} </p>
                            </div>
                        </div>
                    </div>

                @if(!empty($admin_data))
                {!! Form::model($admin_data,['method'=>'PATCH','files'=>true,'url'=>$locale.'/dashboard/items/'.$admin_data->id, 'id'=>'upload_form','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                @else
                {!! Form::open(['method'=>'POST','files'=>true,'id'=>'upload_form','url'=>$locale.'/dashboard/items','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                @endif
            <div class="row">
                <div class="col-12">
                     
                    <div class="row">
                        <div class="col-3">
                            <button class="btn btn-block btn1" type="submit">أضف</button>
                            <button class="btn btn-block btn2"onclick="location='{{lang_url('myproducts')}}'">رجوع</button>  
                        </div>
                        <div class="col-8">
                      
                                <div class="row">
                                    <div class="col-12">
                                        {{-- <label class="fileContainer">               
                                            <input type="file" />                                   
                                            <div class="iteminput text-center">
                                                <img src="Images/Icons/file.png">
                                                <p>لوريم ايبسوم لوريم ايبسوم</p>
                                            </div>
                                        </label> --}}

                                        @if(!empty($admin_data))
                                        {!! Form::file('image', ['class' => 'image','id'=>'image']) !!}
                                        <img src="{{ asset($admin_data->thumbnail_image) }}" style="width: 200px;" />
                                        @else
                                        {!! Form::file('image', ['class' => 'image','id'=>'image','required'=>'required']) !!}
                                        @endif
                    
                                        @if($errors->has('image'))
                                        <span class="help-block text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                    
                                        
                                    </div>
                      
                                    <div class="col-6">
                        {!! Form::text('title',old('title'), array('required'=>'required','placeholder'=>trans('cpanel.enter_item_name_here').'..')) !!}

                                        {{-- <input type="name" name="file" placeholder="الاسم"> --}}
                                    </div>
                                    <div class="col-6">  
                                        {{-- <select>
                                            <option value="volvo">الماركة</option>
                                        </select> --}}

                                        {!! Form::select('brands_id', $brand_ids,old('brands_id'), array('id'=>'vr') ) !!}
                                        @if($errors->has('brand_id'))
                                        <span class="help-block text-danger">{{ $errors->first('brand_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        {{-- <textarea class="btn-block "placeholder="الوصف"></textarea> --}}
                                        {!! Form::textarea('desc',old('desc'), array('id'=>'item_description', 'class'=>'btn-block','required'=>'required','placeholder'=>trans('cpanel.enter_item_description_here').'..')) !!}

                                    </div>
                                    <div class="col-6">
                                        {{-- <input type="name" name="file" placeholder="السعر"> --}}
                                        {!! Form::text('fixed_price',old('fixed_price'), array('id'=>'fixed_price2', 'class'=>'','required'=>'required','placeholder'=>trans('cpanel.enter_fixed_price_here').'..')) !!}
                                        @if($errors->has('fixed_price'))
                                        <span class="help-block text-danger">{{ $errors->first('fixed_price') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        {{-- <input type="name" name="file" placeholder="الخصم"> --}}
                                        {!! Form::text('ratio',old('ratio'), array('id'=>'ratio', 'class'=>'','placeholder'=>trans('cpanel.ratio').'..')) !!}
                                        @if($errors->has('ratio'))
                                        <span class="help-block text-danger">{{ $errors->first('ratio') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                            {{-- <input type="name" name="file" placeholder="الخصم"> --}}
                                            {!! Form::text('discount_price',old('discount_price'), array('id'=>'discount_price', 'class'=>'','readonly','placeholder'=>trans('cpanel.discount_price').'..')) !!}
                        @if($errors->has('ratio'))
                        <span class="help-block text-danger">{{ $errors->first('discount_price') }}</span>
                        @endif
                                        </div>
                                    <div class="col-6">
                                    
                                                {!! Form::select('country', get_countries_cities()['countries'],$item_country_id, ['id'=>'country1','class' => '','required'=>'required']) !!}
                                 
                                   
                                    </div>
                                    <div class="col-6">
                                     
                                                {!! Form::select('cities_id', $states,old('cities_id'), ['id'=>'city','class' => '','required'=>'required']) !!}

                                       
                                    </div>
                                    <div class="col-6">
                                            {!! Form::select('category_id', $category_ids,$item_category_id, array('id'=>'category_id') ) !!}
                                            @if($errors->has('category_id'))
                                            <span class="help-block text-danger">{{ $errors->first('category_id') }}</span>
                                            @endif
                                    </div>
                                    <div class="col-6">
                                            {!! Form::select('sub_categories_id', $sub_categories_ids,old('sub_categories_id'), array('id'=>'sub_categories') ) !!}
                                            @if($errors->has('sub_categories_id'))
                                            <span class="help-block text-danger">{{ $errors->first('sub_categories_id') }}</span>
                                            @endif
                                    </div>

                                    <div class="col-6">
                                            {!! Form::select('status_id', $status_ids,old('status_id'), array('id'=>'status') ) !!}

                                        </div>
                                        <div class="col-6">
                                                <label for="feature" class="rl-label">{{trans('cpanel.feature')}}</label>

                                                {!! Form::checkbox('feature',1, old('feature'), array('id' => 'feature') ) !!}
{{-- 
                                            <select>
                                                <option value="volvo">اضف لون</option>
                                            </select> --}}
                                        </div>

                                        <div class="col-6">
                                        <label for="multi_color" class="rl-label">{{trans('cpanel.select_colors')}}</label>
                                        @if(!empty($all_colors))
                                        @foreach($all_colors as $row_colors)
                                        <div class="col-md-3">
                    
                                            <div class="cloros-list">
                                                <span style="border:1px solid {{$row_colors->color}};width: 20px;height: 20px;display: block;background: {{$row_colors->color}}"></span>
                                                <span class="color-name">{{$row_colors->$locale_name}}</span>
                    
                                                @if(in_array($row_colors->id, $my_items_colors))
                                                {!! Form::checkbox('multi_color[]',$row_colors->id, $row_colors->id, array('id' => 'multi_color') ) !!}
                                                @else
                    
                                                {!! Form::checkbox('multi_color[]',$row_colors->id,'' , array('id' => 'multi_color') ) !!}
                                                @endif
                    
                    
                                            </div>
                    
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="col-6">
                                            <div class="col-sm-10">

                                                    <div class="input_multi_size_fields_wrap">
                                                        <button type="button" class="add_multi_sizes_button">{{trans('cpanel.Click_Here_To_Add_sizes')}}</button>
                                                        @if(!empty($admin_data))
                                                        @if(!empty($admin_data->items_sizes))
                                                        <?php foreach ($admin_data->items_sizes as $row_size) { ?>
                                                            <div class="sizelocation<?php echo $row_size->id ?>">
                                                                <input class="multi_sizes form-control" name="multi_size[]" type="text" value="<?php echo $row_size->size ?>">
                                                                <span onclick="javascript:deletesize(<?php echo $row_size->id ?>)">{{trans('cpanel.Remove')}}</span>
                                                            </div>
                                                        <?php } ?>
                                                        @endif
                                                        @endif
                        
                                                        <div>
                                                                {!!  Form::text('multi_size[]','', array('id'=>'multi_sizes', 'class'=>'form-control multi_sizes','placeholder'=>'multi size'))!!}
                                                        </div>
                                                    </div>
                        
                                                    @if($errors->has('multi_size'))
                                                    <span class="help-block text-danger">{{ $errors->first('multi_size') }}</span>
                                                    @endif
                        
                                                </div>
                                        </div>
                                </div>    
                    
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    
        
              
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
         
         
                 $('#category_id').on('change', function () {
                     // $("body").on('change', '#country', function() {
                     var category_id = this.value;
                     var req_url = "{!! lang_url('ajax_get_sub_category') !!}" + '/' + category_id;
         
                     $.ajax({
                         type: "Get",
                         url: req_url,
                         data: {category_id: category_id},
                         dataType: 'json', // Define data type will be JSON
                         success: function (result) {
         
                             var cities_data = result.sub_categories_data;
                             var $el = $("#sub_categories");
                             $el.empty(); // remove old options
                             cities_data.forEach(function (entry) {
                                 $el.append('<option value="' + entry.id + '">' + entry.title + '</option>');
                             });
         
                         },
                         error: function (error) {
                             $("#ajaxResponse").append("<div>" + error + "</div>");
                         }
                     }); //end ajax
                 }); //end on change country
         
                 $(document).ready(function () {
                                                    var ratio = $('#ratio').val();
                                                    var fixed_price = $("#fixed_price2").val();
                                                    var discount = (fixed_price * ratio) / 100;
//                                                    $("#discount_price").val(fixed_price - discount);

                                                    $('#fixed_price2').on('keyup', function () {
                                                        fixed_price = this.value;
                                                        ratio = $('#ratio').val();
                                                        discount = (fixed_price * ratio) / 100;
                                                        $("#discount_price").val(fixed_price - discount);

                                                    });

                                                    $('#ratio').on('keyup', function () {
                                                        ratio = this.value;
                                                        discount = (fixed_price * ratio) / 100;
                                                        $("#discount_price").val(fixed_price - discount);

                                                    });
                                                    //ratio
                                                });

                                                    $(document).ready(function () {
        //   alert('1');
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click

            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input class="image_gallery "  name="image_gallery[]" type="file"><a href="#" class="remove_field">{{trans("cpanel.Remove")}}</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })


        var max_multi_size_fields = 10; //maximum input boxes allowed
        var wrapper_multi_size = $(".input_multi_size_fields_wrap"); //Fields wrapper_multi_size
        var add_multi_size_button = $(".add_multi_sizes_button"); //Add button ID

        var x_multi_size = 1; //initlal text box count
        $(add_multi_size_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x_multi_size < max_multi_size_fields) { //max input box allowed
                x_multi_size++; //text box increment
                $(wrapper_multi_size).append('<div><input class="multi_sizes form-control"  name="multi_size[]" type="text"><a href="#" class="remove_multi_size_field">Remove</a></div>'); //add input box
            }
        });
        $(wrapper_multi_size).on("click", ".remove_multi_size_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x_multi_size--;
        })

        /*
         var max_multi_color_fields = 10; //maximum input boxes allowed
         var wrapper_multi_color = $(".input_multi_color_fields_wrap"); //Fields wrapper_multi_color
         var add_multi_color_button = $(".add_multi_colors_button"); //Add button ID

         var x_multi_color = 1; //initlal text box count
         $(add_multi_color_button).click(function (e) { //on add input button click
         e.preventDefault();
         if (x_multi_color < max_multi_color_fields) { //max input box allowed
         x_multi_color++; //text box increment
         $(wrapper_multi_color).append('<div><input class="multi_colors form-control"  name="multi_color[]" type="color"><a href="#" class="remove_multi_color_field">Remove</a></div>'); //add input box
         }
         });
         $(wrapper_multi_color).on("click", ".remove_multi_color_field", function (e) { //user click on remove text
         e.preventDefault();
         $(this).parent('div').remove();
         x_multi_color--;
         })*/
    });
    function deleteimage(image_id)
    {
        var answer = confirm("Are you sure you want to delete from this post?");
        if (answer)
        {

            $(".imagelocation" + image_id).hide();
            $.ajax({
                type: "Get",
                url: "<?php echo url('admin/delete_gallery_ajax'); ?>",
                data: {id: image_id},
                dataType: 'json', // Define data type will be JSON
                success: function (response) {

                    if (response > 0) {
                        $(".imagelocation" + image_id).remove(".imagelocation" + image_id);

                    }

                },
                error: function (err) {
                    console.log(err.error);
                }
            });
        }
    }
    function deletesize(size_id)
    {

        var answer = confirm("Are you sure you want to delete from this post?");
        if (answer)
        {
            $.ajax({
                type: "Get",
                url: "<?php echo url('admin/delete_size_ajax'); ?>",
                data: {id: size_id},
                dataType: 'json', // Define data type will be JSON
                success: function (response) {
                    if (response > 0) {
                        $(".sizelocation" + size_id).remove(".sizelocation" + size_id);
                    }


                },
                error: function (err) {
                    console.log(err.error);
                }
            });
        }
    }
         
         </script>

@stop