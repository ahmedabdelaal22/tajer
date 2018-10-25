
@extends(ADI.'.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Items
<!--            <small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Items</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <!-- <h3 class="box-title">Monthly Recap Report</h3>-->

                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <!--                                <h3 class="box-title">Horizontal Form</h3>-->
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        @if(!empty($admin_data))
                        {!! Form::model($admin_data,['method'=>'PATCH','files'=>true,'url'=>'/items/'.$admin_data->id, 'id'=>'form_sample_3','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                        @else
                        {!! Form::open(['method'=>'POST','files'=>true,'id'=>'form_sample_3','action'=>'Administrator\ItemsController@store','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                        @endif

                        <div class="box-body">

                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">

                                    {!! Form::text('title',old('title'), array('id'=>'title', 'class'=>'form-control','required'=>'required','placeholder'=>'Title')) !!}
                                    @if($errors->has('title'))
                                    <span class="help-block text-danger">{{ $errors->first('title') }}</span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="desc" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">

                                    {!! Form::textarea('desc',old('desc'), array('id'=>'desc', 'class'=>'form-control','required'=>'required','placeholder'=>'Description')) !!}
                                    @if($errors->has('title'))
                                    <span class="help-block text-danger">{{ $errors->first('title') }}</span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="brand_id" class="col-sm-2 control-label">Select Brand</label>

                                <div class="col-sm-10">

                                    {!! Form::select('brand_id', $brand_ids,old('brand_id'), array('id'=>'brand_id') ) !!}
                                    @if($errors->has('brand_id'))
                                    <span class="help-block text-danger">{{ $errors->first('brand_id') }}</span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="brand_id" class="col-sm-2 control-label">Select Category</label>

                                <div class="col-sm-10">
                                    {!! Form::select('category_id', $category_ids,old('category_id'), array('id'=>'category_id') ) !!}
                                    @if($errors->has('category_id'))
                                    <span class="help-block text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender_type" class="col-sm-2 control-label">Select Gender Type</label>

                                <div class="col-sm-10">
                                    {!! Form::select('gender_type', $gender_types,old('gender_type'), array('id'=>'gender_type') ) !!}
                                    @if($errors->has('gender_type'))
                                    <span class="help-block text-danger">{{ $errors->first('gender_type') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="model_num" class="col-sm-2 control-label">Model Number</label>

                                <div class="col-sm-10">

                                    {!! Form::text('model_num',old('model_num'), array('id'=>'model_num', 'class'=>'form-control','required'=>'required','placeholder'=>'Model Number')) !!}
                                    @if($errors->has('model_num'))
                                    <span class="help-block text-danger">{{ $errors->first('model_num') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">Price</label>

                                <div class="col-sm-10">

                                    {!! Form::text('price',old('price'), array('id'=>'price', 'class'=>'form-control','required'=>'required','placeholder'=>'Price')) !!}
                                    @if($errors->has('price'))
                                    <span class="help-block text-danger">{{ $errors->first('price') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="availability" class="col-sm-2 control-label">Availability</label>

                                <div class="col-sm-10">

                                    {!! Form::number('availability',old('availability'), array('id'=>'availability', 'class'=>'form-control','required'=>'required','placeholder'=>'availability')) !!}
                                    @if($errors->has('availability'))
                                    <span class="help-block text-danger">{{ $errors->first('availability') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">color</label>

                                <div class="col-sm-10">

                                    {!! Form::color('color',old('color'), array('id'=>'color', 'class'=>'form-control','required'=>'required','placeholder'=>'color')) !!}
                                    @if($errors->has('color'))
                                    <span class="help-block text-danger">{{ $errors->first('color') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multi_colors" class="col-sm-2 control-label">Add Multi Colors</label>

                                <div class="col-sm-10">

                                    <div class="input_multi_color_fields_wrap">
                                        <button type="button" class="add_multi_colors_button">Add Multi Colors</button>
                                        @if(!empty($admin_data))
                                        @if(!empty($admin_data->items_colors))
                                        <?php foreach ($admin_data->items_colors as $row_color) { ?>
                                            <div class="colorlocation<?php echo $row_color->id ?>">
                                                <input class="multi_colors form-control" name="ajax_color" type="color" value="<?php echo $row_color->color ?>">
                                                <span onclick="javascript:deletecolor(<?php echo $row_color->id ?>)">Remove</span>
                                            </div>
                                        <?php } ?>
                                        @endif
                                        @endif

                                        <div>
                                            {{--Form::text('multi_color[]','', array('id'=>'multi_color', 'class'=>'form-control multi_color','placeholder'=>'multi color')) --}}
                                        </div>
                                    </div>

                                    @if($errors->has('multi_color'))
                                    <span class="help-block text-danger">{{ $errors->first('multi_color') }}</span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="size" class="col-sm-2 control-label">size</label>

                                <div class="col-sm-10">

                                    {!! Form::text('size',old('size'), array('id'=>'size', 'class'=>'form-control','required'=>'required','placeholder'=>'size')) !!}
                                    @if($errors->has('size'))
                                    <span class="help-block text-danger">{{ $errors->first('size') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multi_sizes" class="col-sm-2 control-label">Add Multi size</label>

                                <div class="col-sm-10">

                                    <div class="input_multi_size_fields_wrap">
                                        <button type="button" class="add_multi_sizes_button">Add Multi size</button>
                                        @if(!empty($admin_data))
                                        @if(!empty($admin_data->items_sizes))
                                        <?php foreach ($admin_data->items_sizes as $row_size) { ?>
                                            <div class="sizelocation<?php echo $row_size->id ?>">
                                                <input class="multi_sizes form-control" name="ajax_size" type="text" value="<?php echo $row_size->size ?>">
                                                <span onclick="javascript:deletesize(<?php echo $row_size->id ?>)">Remove</span>
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




                            <div class="form-group">
                                <label for="image" class="col-sm-2 control-label">image</label>

                                <div class="col-sm-10">

                                    {!! Form::file('image', ['class' => 'image','id'=>'image']) !!}
                                    @if(!empty($admin_data))
                                    <img src="{{ asset($admin_data->thumbnail_image) }}" style="width: 200px;" />
                                    @endif
                                    @if($errors->has('image'))
                                    <span class="help-block text-danger">{{ $errors->first('image') }}</span>
                                    @endif

                                </div>


                            </div>


                            <div class="form-group">
                                <label for="image_gallery" class="col-sm-2 control-label">Gallery</label>

                                <div class="col-sm-10">

                                    <div class="input_fields_wrap">
                                        <button type="button" class="add_field_button">Add image Gallery</button>

                                        @if(!empty($admin_data))
                                        @if(!empty($admin_data->items_images))
                                        <?php foreach ($admin_data->items_images as $row_gallery) { ?>
                                            <div class="imagelocation<?php echo $row_gallery->id ?>">

                                                <img src="{{ asset($row_gallery->image) }}" style="vertical-align:middle;" width="80" height="80">
                                                <span onclick="javascript:deleteimage(<?php echo $row_gallery->id ?>)">Remove</span>
                                            </div>
                                        <?php } ?>
                                        @endif
                                        @endif


                                        <div>
                                            {{-- Form::file('image_gallery[]', ['class' => 'image_gallery','id'=>'image_gallery']) --}}
                                        </div>
                                    </div>

                                    @if($errors->has('image_gallery'))
                                    <span class="help-block text-danger">{{ $errors->first('image_gallery') }}</span>
                                    @endif

                                </div>
                            </div>



                            <div class="form-group" >
                                <label for="active" class="col-sm-2 control-label">Active</label>
                                <div class="checkbox col-sm-10"  style="display: inline-block;margin-top: 5px !important;">
                                    {!! Form::checkbox('active','1', old('active'), array('id' => 'active') ) !!}
                                    <label>Active</label>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <button type="reset" class="btn btn-default">Cancel</button>
                            {!! Form::submit('save', array('class'=>'btn btn-info btn green')) !!}
                        </div>
                        <!-- /.box-footer -->
                        {!! Form::close() !!}
                    </div>



                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@stop
