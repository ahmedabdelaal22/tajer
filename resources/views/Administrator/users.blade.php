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
            Users
            <!--<small>Version 2.0</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
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
                        
                            <a href="{{url('admin/users/create')}}" > <button> ADD NEW </button> </a>
                           
                        </div>


                        <table id="example2" class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Type</th>

                                <th>Phone</th>
                                <th>Edit</th>
                                <th>Status</th>
                                <!--<th>edit</th>-->
                                <th>Delete</th>
                            </tr>
                                <?php $i=1;?>
                            @foreach ($all_users as $row_user)


                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row_user->name}}</td>
                                <td>{{$row_user->email}}</td>

              
                                <td>{{$row_user->permissions}}</td>
                                

                                <td>{{$row_user->phone}}</td>
                                     <td>
                                    <a class="btn btn-app" href="{{url('admin/users/'.$row_user->id.'/edit/')}}">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                </td>

                                @if($row_user->active==0)
                                <td><span class="label label-danger">Denied</span></td>
                                @else
                                <td><span class="label label-success">Approved</span></td>
                                @endif

<!--                                <td>
                                    <a class="btn btn-app" href="{{url('users/'.$row_user->id.'/edit/')}}">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                </td>-->

                                <td>

                                    @if($row_user->id !=1 || $row_user->id !=auth()->user()->id)
                                    <button class="cancle" data-target="#update_status{{$row_user->id}}" data-toggle="modal">
<!--                                        <i class="fa fa-trash-o" aria-hidden="true"></i>-->
                                        @if($row_user->active==0)
                                        <span class="label label-success"> Active</span>
                                        @else
                                        <span class="label label-danger">Not Active</span>
                                        @endif
                                    </button>
                                    @endif

                                </td>
                            </tr>

                            <div class="modal fade" id="update_status{{$row_user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden="true"></i> Delete </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p> Are You Sure To  
                                                @if($row_user->active==0)
                                                <b > Active</b>
                                                @else
                                                <b>Not Active</b>
                                                @endif This user ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::model($row_user,['method'=>'post','url'=>'admin/update_active/'.$row_user->id, 'id'=>'form_sample_3']) !!}

                                            {!! Form::hidden('active',$row_user->active, array('id'=>'active') ) !!}


                                            {!!  Form::submit('Yes', array('class'=>'btn btn-primary ms7')) !!}

                                            <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php /* ?>
                              <div class="modal fade" id="deletrow{{$row_user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                              {!!  Form::open(['action' => ['Administrator\UsersController@destroy', $row_user->id],'method'=>'DELETE','role'=>'form', 'id'=>'Delete_form']) !!}

                              {!!  Form::submit('Yes', array('class'=>'btn btn-primary ms7')) !!}

                              <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                              {!! Form::close() !!}
                              </div>
                              </div>
                              </div>
                              </div>
                              <?php */ ?>
                                <?php $i++ ;?>
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
