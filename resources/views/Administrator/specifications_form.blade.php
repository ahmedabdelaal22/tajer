
@extends(ADI.'.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Specifications
 <!--            <small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Specifications</li>
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
                        {!! Form::model($admin_data,['method'=>'PATCH','files'=>true,'url'=>'/admin/specifications/'.$admin_data->id, 'id'=>'form_sample_3','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                        @else
                        {!! Form::open(['method'=>'POST','files'=>true,'id'=>'form_sample_3','action'=>'Administrator\SpecificationsController@store','role'=>'form',' accept-charset'=>'UTF-8']) !!}

                        <?php $sub_categories_id = $_GET['sub_cat_id']; ?>
                        @endif

                        <div class="box-body">

                            <div class="form-group">
                                <label for="ar_title" class="col-sm-2 control-label">AR Title</label>

                                <div class="col-sm-10">

                                    {!! Form::text('ar_title',old('ar_title'), array('id'=>'ar_title', 'class'=>'form-control','required'=>'required','placeholder'=>'AR Title')) !!}
                                    @if($errors->has('ar_title'))
                                    <span class="help-block text-danger">{{ $errors->first('ar_title') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="en_title" class="col-sm-2 control-label">EN Title</label>

                                <div class="col-sm-10">

                                    {!! Form::text('en_title',old('en_title'), array('id'=>'en_title', 'class'=>'form-control','required'=>'required','placeholder'=>'AR Title')) !!}
                                    @if($errors->has('en_title'))
                                    <span class="help-block text-danger">{{ $errors->first('en_title') }}</span>
                                    @endif

                                </div>
                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            {!! Form::hidden('sub_categories_id',$sub_categories_id, array('id'=>'sub_categories_id') ) !!}
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
