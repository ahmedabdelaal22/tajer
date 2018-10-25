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
            Fixed Items
               <!--<small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Fixed Items</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-body table-responsive">

                        <div class="add-btn">
                            @if(auth()->user()->id == 1 || in_array('add_items', get_user_permissions()))
                            <a href="{{url('items/create')}}" > <button> ADD NEW </button> </a>
                            @endif
                        </div>

                        <table id="example2" class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>owner</th>

                                <th>Category</th>
                                <th>Sub Category</th>




                                <th> Price</th>
                              <!--    <th>Status</th> -->
                                <th>Active</th>

                            </tr>
                            <?php $i = 1; ?>
                            @foreach ($all_data as $row_data)
                            <tr>
                                <td>{{$i}}</td>

                                <td><a href="{{lang_url('dashboard/items/'.$row_data->id)}}">{{$row_data->title}}</a></td>
                                <td>{{$row_data->user->name}}</td>
                                <td>{{$row_data->sub_categories->categories->ar_title}}</td>

                                <td>{{$row_data->sub_categories->ar_title}}</td>



                                <td>{{$row_data->fixed_price}}</td>



                                <!--      <td>
                                    <a class="btn btn-app" href="{{url('items/'.$row_data->id.'/edit/')}}">
                                                 <i class="fa fa-edit"></i>
                                             </a>
                                         </td> -->
                                       <!--   <td>  -->

                                <!--         <button class="cancle" data-target="#update_status{{$row_data->id}}" data-toggle="modal"> -->
                                   <!--      <i class="fa fa-trash-o" aria-hidden="true"></i>-->
                                <!--             @if($row_data->bids_id > 0)
                                            <span class="label label-success"> APPROVED</span>
                                            @else
                                            <span class="label label-danger">Not APPROVED</span>
                                            @endif
                                         </button> -->
                                <td>
                                    @if(auth()->user()->id == 1 || in_array('delete_items', get_user_permissions()))
                                    <!--  <button class="cancle" data-target="#deletrow{{$row_data->id}}" data-toggle="modal">
                                         <i class="fa fa-trash-o" aria-hidden="true"></i>
                                     </button> -->


                                    <button class="cancle" data-target="#update_status{{$row_data->id}}" data-toggle="modal">
                                      <!--      <i class="fa fa-trash-o" aria-hidden="true"></i>-->
                                        @if($row_data->active==0)
                                        <span class="label label-success"> Active</span>
                                        @else
                                        <span class="label label-danger">Not Active</span>
                                        @endif
                                    </button>

                                    @endif
                                </td>

                            </tr>



                            <?php ?>
                            <div class="modal fade" id="update_status{{$row_data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden="true"></i> Delete </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p> Are You Sure To
                                                @if($row_data->active==0)
                                                <b > Active</b>
                                                @else
                                                <b>Not Active</b>
                                                @endif This Item ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <!--              {{--  Form::open(['action' => ['Administrator\ItemsController@destroy', $row_data->id],'method'=>'DELETE','role'=>'form', 'id'=>'Delete_form']) --}}
                                            -->


                                            {!! Form::model($row_data,['method'=>'post','url'=>'admin/update_active_item/'.$row_data->id, 'id'=>'form_sample_3']) !!}

                                            {!! Form::hidden('active',$row_data->active, array('id'=>'active') ) !!}

                                            {!!  Form::submit('Yes', array('class'=>'btn btn-primary ms7')) !!}

                                            <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>

                            @endforeach


                        </table>
                        {{ $all_data->links() }}
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
