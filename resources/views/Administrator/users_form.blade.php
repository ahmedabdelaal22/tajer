
@extends(ADI.'.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
<!--            <small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
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
                        {!! Form::model($admin_data,['method'=>'PATCH','url'=>'/admin/users/'.$admin_data->id, 'id'=>'form_sample_3']) !!}
                        @else
                        {!! Form::open(['method'=>'POST','id'=>'form_sample_3','action'=>'Administrator\UsersController@store']) !!}
                        @endif

                        <div class="box-body">
                                   @if ($errors->has('name'))
                                <div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('name') }}</div>
                                 @endif


                                @if ($errors->has('email'))
                                <div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('email') }}</div>
                                 @endif


                                 @if ($errors->has('password'))
                                <div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('password') }}</div>
                                 @endif


                                 @if ($errors->has('password_confirmation'))
                                <div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('password_confirmation') }}</div>
                                 @endif


                                @if ($errors->has('address'))
                                <div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('address') }}</div>
                                 @endif



                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">

                                    {!! Form::text('name',old('name'), array('id'=>'name', 'class'=>'form-control','placeholder'=>'Name')) !!}
                                                                
                             
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">

                                   
                                    {!! Form::text('email',old('email'), array('id'=>'email', 'class'=>'form-control','placeholder'=>'email')) !!}

                            

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="type" class="col-sm-2 control-label">phone</label>

                                <div class="col-sm-10">


                                    {!! Form::text('phone',old('phone'), array('id'=>'phone', 'class'=>'form-control','placeholder'=>'phone')) !!}

                                </div>
                            </div>


                    


                            <div class="form-group">
                                <label for="Password" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">


                                    {!! Form::text('password','', array('id'=>'password', 'class'=>'form-control','placeholder'=>'password')) !!}

                                </div>

                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>

                                <div class="col-sm-10">


                          {!! Form::text('password_confirmation','', array('id'=>'password_confirmation', 'class'=>'form-control','placeholder'=>'password confirmation')) !!}


                                 
                                </div>
                            </div>

                        <div class="form-group">
                                <label for="Password" class="col-sm-2 control-label">Address</label>

                                <div class="col-sm-10">


                                    {!! Form::text('address',old('address'), array('id'=>'address', 'class'=>'form-control','placeholder'=>'address')) !!}

                                </div>
                            </div>
                  

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <button type="submit" class="btn btn-default">Create</button>
                        
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