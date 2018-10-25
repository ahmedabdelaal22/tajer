@extends(DSHI.'.master')
@section('content')


<div class="dashboard-content">

    <div class="headline simple primary sp_color">
        <h4 class="special">{{trans('cpanel.Upload_Item')}}</h4>

    </div>



    @if(!empty($admin_data))
    {!! Form::model($admin_data,['method'=>'PATCH','files'=>true,'url'=>$locale.'/dashboard/items/'.$admin_data->id, 'id'=>'upload_form','role'=>'form',' accept-charset'=>'UTF-8']) !!}
    @else
    {!! Form::open(['method'=>'POST','files'=>true,'id'=>'upload_form','url'=>$locale.'/dashboard/items','role'=>'form',' accept-charset'=>'UTF-8']) !!}
    @endif


    <div class="form-box-items wrap-3-1 left">
        <div class="form-box-item full">

            <h4>{{trans('cpanel.Item_Specifications')}}</h4>


            <hr class="line-separator">

            <div class="row">

                <div class="col-md-6">

                    <div class="input-container">

                        <label for="category_id" class="rl-label required">{{trans('cpanel.Select_Categery')}}</label>
                        <label for="category_id" class="select-block">

                            {!! Form::select('category_id', $category_ids,$item_category_id, array('id'=>'category_id') ) !!}
                            @if($errors->has('category_id'))
                            <span class="help-block text-danger">{{ $errors->first('category_id') }}</span>
                            @endif


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

                        <label for="sub_categories" class="rl-label required">{{trans('cpanel.Select_Sub_Categery')}}</label>
                        <label for="sub_categories" class="select-block">
                            {!! Form::select('sub_categories_id', $sub_categories_ids,old('sub_categories_id'), array('id'=>'sub_categories') ) !!}
                            @if($errors->has('sub_categories_id'))
                            <span class="help-block text-danger">{{ $errors->first('sub_categories_id') }}</span>
                            @endif


                            <!-- SVG ARROW -->
                            <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                            </svg>
                            <!-- /SVG ARROW -->
                        </label>
                    </div>
                </div>


            </div>

            <br>


            <div class="row">

                <div class="col-md-6">

                    <div class="input-container">

                        <label for="country1" class="rl-label required">{{trans('cpanel.Country')}}</label>
                        <label for="country1" class="select-block">

                            {!! Form::select('country', get_countries_cities()['countries'],$item_country_id, ['id'=>'country1','class' => '','required'=>'required']) !!}

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
                            {!! Form::select('cities_id', $states,old('cities_id'), ['id'=>'city','class' => '','required'=>'required']) !!}

                            <!-- SVG ARROW -->
                            <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                            </svg>
                            <!-- /SVG ARROW -->
                        </label>
                    </div>

                </div>

            </div>
            <br>

            <div class="row">

                <div class="col-md-6">

                    <div class="input-container">

                        <label for="item_name" class="rl-label required">{{trans('cpanel.Item_Title')}}</label>

                        {!! Form::text('title',old('title'), array('id'=>'item_name', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.enter_item_name_here').'..')) !!}
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="input-container">

                        <label for="vr" class="rl-label required">{{trans('cpanel.Select_Brand')}}</label>
                        <label for="vr" class="select-block">
                            {!! Form::select('brands_id', $brand_ids,old('brands_id'), array('id'=>'vr') ) !!}
                            @if($errors->has('brand_id'))
                            <span class="help-block text-danger">{{ $errors->first('brand_id') }}</span>
                            @endif


                            <!-- SVG ARROW -->
                            <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                            </svg>
                            <!-- /SVG ARROW -->
                        </label>
                    </div>

                </div>

            </div>
            <br>

            <div class="row">


                <div class="col-md-6">

                    <div class="input-container">
                        <label for="status" class="rl-label required">{{trans('cpanel.Select_status')}}</label>
                        <label for="status" class="select-block">
                            {!! Form::select('status_id', $status_ids,old('status_id'), array('id'=>'status') ) !!}

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

                        <label for="feature" class="rl-label">{{trans('cpanel.feature')}}</label>



                        {!! Form::checkbox('feature',1, old('feature'), array('id' => 'feature') ) !!}

                    </div>


                </div>
            </div>

            <br>

            <div class="row"  id="ratio_price">

                <div class="col-md-4">
                    <div class="input-container">

                        <label for="fixed_price" class="rl-label required">{{trans('cpanel.Price')}}</label>
                        {!! Form::text('fixed_price',old('fixed_price'), array('id'=>'fixed_price2', 'class'=>'','required'=>'required','placeholder'=>trans('cpanel.enter_fixed_price_here').'..')) !!}
                        @if($errors->has('fixed_price'))
                        <span class="help-block text-danger">{{ $errors->first('fixed_price') }}</span>
                        @endif
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="input-container">

                        <label for="ratio" class="rl-label required">{{trans('cpanel.ratio')}}</label>
                        {!! Form::text('ratio',old('ratio'), array('id'=>'ratio', 'class'=>'','placeholder'=>trans('cpanel.ratio').'..')) !!}
                        @if($errors->has('ratio'))
                        <span class="help-block text-danger">{{ $errors->first('ratio') }}</span>
                        @endif
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="input-container">

                        <label for="discount_price" class="rl-label required">{{trans('cpanel.discount_price')}}</label>
                        {!! Form::text('discount_price',old('discount_price'), array('id'=>'discount_price', 'class'=>'','placeholder'=>trans('cpanel.discount_price').'..')) !!}
                        @if($errors->has('ratio'))
                        <span class="help-block text-danger">{{ $errors->first('discount_price') }}</span>
                        @endif
                    </div>

                </div>

            </div>

            <br>

            <div class="row">

                <div class="col-md-12">

                    <div class="input-container">

                        <label for="address" class="rl-label required">{{trans('cpanel.Address')}}</label>
                        {!! Form::text('address',old('address'), array('id'=>'address', 'class'=>'','required'=>'required','placeholder'=>trans('cpanel.enter_address_here').'..')) !!}
                    </div>

                </div>

            </div>
            <br>

            <div class="row">

                <div class="col-md-12">
                    <div class="input-container">

                        <label for="item_description" class="rl-label required">{{trans('cpanel.Item_Description')}}</label>

                        {!! Form::textarea('desc',old('desc'), array('id'=>'item_description', 'class'=>'form-control make-text-editor','required'=>'required','placeholder'=>trans('cpanel.enter_item_description_here').'..')) !!}

                    </div>

                </div>

            </div>
            <br>


            <div class="row">


                <div class="input-container">

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

            </div>


            <br>

            <div class="row">


                <div class="col-md-12">
                    <div class="input-container">

                        <label for="multi_sizes" class="rl-label">{{trans('cpanel.Add_sizes')}}</label>

                        <div class="col-sm-10">

                            <div class="input_multi_size_fields_wrap">
                                <button type="button" class="add_multi_sizes_button">{{trans('cpanel.Click_Here_To_Add_sizes')}}</button>
                                @if(!empty($admin_data))
                                @if(!empty($admin_data->items_sizes))
                                <?php foreach ($admin_data->items_sizes as $row_size) { ?>
                                    <div class="sizelocation<?php echo $row_size->id ?>">
                                        <input class="multi_sizes form-control" name="ajax_size" type="text" value="<?php echo $row_size->size ?>">
                                        <span onclick="javascript:deletesize(<?php echo $row_size->id ?>)">{{trans('cpanel.Remove')}}</span>
                                    </div>
                                <?php } ?>
                                @endif
                                @endif

                                <div>
                                    {{--Form::text('multi_size[]','', array('id'=>'multi_sizes', 'class'=>'form-control multi_sizes','placeholder'=>'multi size')) --}}
                                </div>
                            </div>

                            @if($errors->has('multi_size'))
                            <span class="help-block text-danger">{{ $errors->first('multi_size') }}</span>
                            @endif

                        </div>

                    </div>

                </div>

            </div>
            <br>


            <div class="form-group">

                <div class="input-container">

                    <label for="image" class="">{{trans('cpanel.Deafult_Image')}}</label>


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

            </div>


            <div class="row">

                <div class="col-md-12">
                    <label class="rl-label">{{trans('cpanel.upload_item_images')}}</label>
                    <div class="upload-file">
                        <div class="input_fields_wrap">


                            @if(!empty($admin_data))

                            @if(!empty($admin_data->items_images))
                            <?php
                            $i = 1;
                            foreach ($admin_data->items_images as $row_gallery) {
                                ?>
                                <div class="input-container">
                                    <div class="imagelocation<?php echo $row_gallery->id ?>">

                                        <?php
                                        if ($i <= 4) {
                                            ?>

                                            {{ Form::file('image_gallery[]', ['class' => 'image_gallery','id'=>'image_gallery']) }}

                                            <?php
                                        }
                                        ?>
                                        <img src="{{ asset($row_gallery->image) }}" style="vertical-align:middle;" width="80" height="80">
                                        <?php
                                        if ($i > 4) {
                                            ?>
                                            <span onclick="javascript:deleteimage(<?php echo $row_gallery->id ?>)">{{trans('cpanel.Remove')}}</span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                            ?>
                            <button type="button" class="add_field_button">{{trans('cpanel.add_image_gallery')}}</button>
                            @endif
                            @else

                            <div class="input-container">
                                {{ Form::file('image_gallery[]', ['class' => 'image_gallery','id'=>'image_gallery','required'=>'required']) }}
                            </div>
                            <div class="input-container">
                                {{ Form::file('image_gallery[]', ['class' => 'image_gallery','id'=>'image_gallery','required'=>'required']) }}
                            </div>
                            <div class="input-container">
                                {{ Form::file('image_gallery[]', ['class' => 'image_gallery','id'=>'image_gallery','required'=>'required']) }}
                            </div>
                            <div class="input-container">
                                {{ Form::file('image_gallery[]', ['class' => 'image_gallery','id'=>'image_gallery','required'=>'required']) }}
                            </div>
                            <button type="button" class="add_field_button">{{trans('cpanel.add_image_gallery')}}</button>

                            @endif


                        </div>


                    </div>
                </div>
            </div>

            <hr class="line-separator">
            <button class="button big dark">
                {{$submit_button}}
                <span class="primary"></span>
            </button>
        </div>
    </div>


    <div class="form-box-items wrap-1-3 right">
        <div class="form-box-item full">
            <h4>Upload Guidelines</h4>
            <hr class="line-separator">
            <!-- PLAIN TEXT BOX -->
            <div class="plain-text-box">
                <!-- PLAIN TEXT BOX ITEM -->
                <div class="plain-text-box-item">
                    <p class="text-header">File Upload:</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
                <!-- /PLAIN TEXT BOX ITEM -->

                <!-- PLAIN TEXT BOX ITEM -->
                <div class="plain-text-box-item">
                    <p class="text-header">Photos and Images:</p>
                    <p>Lorem ipsum dolor sit amet.<br>Consectetur adipisicing elit, sed do.</p>
                    <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <!-- /PLAIN TEXT BOX ITEM -->

                <!-- PLAIN TEXT BOX ITEM -->
                <div class="plain-text-box-item">
                    <p class="text-header">Guide with Links:</p>
                    <p><a href="#" class="primary">Click here for the link.</a></p>
                </div>
                <!-- /PLAIN TEXT BOX ITEM -->
            </div>
            <!-- /PLAIN TEXT BOX -->
        </div>

    </div>

    {!! Form::close() !!}
    <div class="clearfix"></div>
</div>
<!-- DASHBOARD CONTENT -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script type="text/javascript">

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





</script>
@stop