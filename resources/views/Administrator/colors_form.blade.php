
@extends(ADI.'.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Colors
 <!--            <small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Colors</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <!--                        <h3 class="box-title">Monthly Recap Report</h3>-->

                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <!--                                <h3 class="box-title">Horizontal Form</h3>-->
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        @if(!empty($admin_data))
                        {!! Form::model($admin_data,['method'=>'PATCH','files'=>true,'url'=>'/admin/colors/'.$admin_data->id, 'id'=>'form_sample_3','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                        @else
                        {!! Form::open(['method'=>'POST','files'=>true,'id'=>'form_sample_3','action'=>'Administrator\ColorsController@store','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                        @endif

                        <div class="box-body">

                            <div class="form-group">
                                <label for="ar_name" class="col-sm-2 control-label">AR Color Name</label>

                                <div class="col-sm-10">

                                    {!! Form::text('ar_name',old('ar_name'), array('id'=>'ar_name', 'class'=>'form-control','required'=>'required','placeholder'=>'AR  Color Name')) !!}
                                    @if($errors->has('ar_name'))
                                    <span class="help-block text-danger">{{ $errors->first('ar_name') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="en_name" class="col-sm-2 control-label">EN  Color Name</label>

                                <div class="col-sm-10">

                                    {!! Form::text('en_name',old('en_name'), array('id'=>'en_name', 'class'=>'form-control','required'=>'required','placeholder'=>'AR  Color Name')) !!}
                                    @if($errors->has('en_name'))
                                    <span class="help-block text-danger">{{ $errors->first('en_name') }}</span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>

                                <div class="col-sm-10">

                                    {{Form::color('color',old('color'), array('id'=>'color', 'class'=>'form-control color','placeholder'=>' color')) }}
                                    @if($errors->has('color'))
                                    <span class="help-block text-danger">{{ $errors->first('color') }}</span>
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
