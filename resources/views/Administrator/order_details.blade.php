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
            Orders
<!--            <small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Orders</li>
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

                        <div class="box-body">
                            <div class="row">
                            <div class="col-md-4 col-sm-6">
                                
                                 <div class="form-group">
                                <label for="user_id" class="col-sm-6 control-label">User Name</label>
                                <div class="col-sm-6">
                                    {{$admin_data->user->name}}
                                </div>
                            </div>
                                
                                </div>
                            
                                <div class="col-md-4 col-sm-6">
                                
                                   <div class="form-group">
                                <label for="city_id" class="col-sm-6 control-label">Country</label>
                                <div class="col-sm-6">
                                    {{$admin_data->city->country->ar_name}}
                                </div>
                            </div>
                                    
                                </div>
                                
                                <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                <label for="city_id" class="col-sm-6 control-label">City</label>
                                <div class="col-md-6 col-sm-6">
                                    {{$admin_data->city->ar_name}}
                                </div>
                            </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-6">
                                
                                  <div class="form-group">
                                <label for="address" class="col-sm-6  control-label">Address</label>
                                <div class="col-sm-6 ">
                                    {{$admin_data->address}}
                                </div>
                            </div>
                                    
                                </div>
                                
                                <div class="col-md-4 col-sm-6">
                                
                                       <div class="form-group">
                                <label for="floor_num" class="col-sm-6 control-label">floor num</label>

                                <div class="col-sm-6">
                                    {{$admin_data->floor_num}}
                                </div>
                            </div>
                                
                                </div>
                                
                                
                                <div class="col-md-4 col-sm-6">
                                
                                     <div class="form-group">
                                <label for="flat_num" class="col-sm-6 control-label">flat number</label>

                                <div class="col-sm-6">
                                    {{$admin_data->flat_num}}
                                </div>
                            </div>
                                
                                </div>
                                <div class="col-md-4 col-sm-6">
                                
                                <div class="form-group">
                                <label for="customer_name" class="col-sm-6 control-label">customer name</label>

                                <div class="col-sm-6">
                                    {{$admin_data->customer_name}}
                                </div>
                            </div>
                                    
                                </div>
                                <div class="col-md-4 col-sm-6">
                                
                                      <div class="form-group">
                                <label for="price" class="col-sm-6 control-label">price</label>

                                <div class="col-sm-6">
                                    {{$admin_data->price}}
                                </div>
                            </div>
                                
                                </div>
                                <div class="col-md-4 col-sm-6">
                                
                                  <div class="form-group">
                                <label for="shipping_fees" class="col-sm-6 control-label">shipping fees</label>

                                <div class="col-sm-6">
                                    {{$admin_data->shipping_fees}}
                                </div>
                            </div>
                                
                                </div>
                                <div class="col-md-4 col-sm-6">
                                
                                   <div class="form-group">
                                <label for="total_price" class="col-sm-6 control-label">total price</label>

                                <div class="col-sm-6">
                                    {{$admin_data->total_price}}
                                </div>
                            </div>
                                
                                </div>
                                
                                
                                <div class="col-md-4 col-sm-6">
                                
                                    <div class="form-group">
                                <label for="payment_method" class="col-sm-6 control-label">payment method</label>

                                <div class="col-sm-6">
                                    {{$admin_data->payment_method}}
                                </div>
                            </div>
                                
                                </div>
                                
                                
                                
                            </div>
                            
                     
                        </div>
                          

                         

                            
                       
                            
                            
  <table id="example2" class="table table-bordered table-hover" style="margin-top:10px;">
    <tr>
      <th scope="col">title</th>
      <th scope="col">count</th>
      <th scope="col">color</th>
      <th scope="col">size</th>
      <th scope="col">price</th>
      <th scope="col">image</th>
    </tr>
      
  <tbody>
       @foreach ($admin_data->order_details as $row_details) 
    <tr>
        
      <td> {{$row_details->title}} </td>
      <td> {{$row_details->count}} </td>
      <td> {{$row_details->color}} </td>
      <td> {{$row_details->size}} </td>
      <td> {{$row_details->price}} </td>
      <td> 
         <img src="{{ asset($row_details->image) }}" style="vertical-align:middle;" width="80" height="80">
        </td>
    </tr>
       @endforeach
  </tbody>
</table>
                            

                           




                        
                     
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
