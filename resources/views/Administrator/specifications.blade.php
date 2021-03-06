<style>
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
            Specifications
             <!--<small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Specifications</li>
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
                            @if(auth()->user()->id == 1 || in_array('add_categories', get_user_permissions()))
                            <a href="{{url('admin/specifications/create?sub_cat_id='.$sub_cat_id)}}" > <button> ADD NEW </button> </a>
                            @endif
                        </div>

                        <table id="example2" class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>AR Title</th>
                                <th>EN Title</th>
                                <th>edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach ($all_data as $row_data)
                            <tr>
                                <td>{{$row_data->id}}</td>
                                <td>{{$row_data->ar_title}}</td>
                                <td>{{$row_data->en_title}}</td>



                                <td>
                                    <a class="btn btn-app" href="{{url('admin/specifications/'.$row_data->id.'/edit/')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                                <td>
                                    @if(auth()->user()->id == 1 || in_array('delete_categories', get_user_permissions()))
                                    <button class="cancle" data-target="#deletrow{{$row_data->id}}" data-toggle="modal">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    @endif
                                </td>

                            </tr>



                            <?php ?>
                            <div class="modal fade" id="deletrow{{$row_data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden="true"></i> Delete </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p> Are You Sure To Delete This Item ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!!  Form::open(['action' => ['Administrator\SpecificationsController@destroy', $row_data->id],'method'=>'DELETE','role'=>'form', 'id'=>'Delete_form']) !!}

                                            {!!  Form::submit('Yes', array('class'=>'btn btn-primary ms7')) !!}

                                            <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php ?>
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
