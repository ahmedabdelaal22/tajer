<style type="text/css">
.table tr:nth-child(2n+1){
        background-color: #ededed !important;
    }
</style>
@extends(ADI.'.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customers Reports
            <!--<small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customers Reports</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-xs-12">
            <div class="box" style="padding:0px 20px;">
                <div class="box-header">
                    <div class="box-tools">

                    </div>
                </div>

                <!--<div class="input-group input-group-sm">-->
                <div>
                    {!! Form::open(['method'=>'Get','id'=>'form_sample_3','action'=>'Administrator\ReportsController@brands']) !!}
                    <!--//          Service Date, .-->

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label" style="font-size: 13px;padding-top: 8px;"> From Date</label>
                                <div class="col-sm-10">
                                    {!! Form::date('from_order_date','', array('id'=>'from_order_date', 'class'=>'form-control','From Date')) !!}
                                </div> 
                            </div>  
                        </div>  

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label" style="font-size: 13px;padding-top: 8px;">To Date</label>
                                <div class="col-sm-10">
                                    {!! Form::date('to_order_date','', array('id'=>'to_order_date', 'class'=>'form-control','To Date')) !!}
                                </div>
                            </div> 
                        </div>        

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label" style="font-size: 13px;padding-top: 8px;"> Brands </label>
                                <div class="col-sm-10">
                                    {!! Form::select('brand_id',$all_brands,$brand_id, array('id'=>'brand_id','class'=>'form-control country') ) !!}
                                </div> 
                            </div>  
                        </div> 


                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-10 col-sm-offset-2">
                                    {!! Form::submit('Filter', array('class'=>'btn btn-info btn green','style'=>'
                                    width: 40%;
                                    font-size: 20px;
                                    margin: auto;
                                    display: block;')) !!}
                                </div> 
                            </div>        
                        </div>

                    </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-body table-responsive">


                        <table id="example2" class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Brand Name</th>

                                <th>NO.Orders</th>
                                <th>Total Price</th>

                            </tr>
                            @foreach ($all_users as $row_user)
                            <tr>
                                <td>{{$row_user->id}}</td>
                                <td>{{$row_user->title}}</td>

                                <td>{{$row_user->orders_details->sum('count')}}</td>
                                <td>{{$row_user->orders_details->sum('price')}}</td>

                            </tr>

                            @endforeach


                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@stop