
@extends(ADI.'.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
                <div class="box-header with-border">
                  @if(Session::has('message'))
                    <h3 class="box-title">{{ Session::get('error_msg') }}</h3>
                  @endif

                  @if(Session::has('error_msg'))
                    <h3 class="box-title">{{ Session::get('error_msg') }}</h3>
                  @endif


                </div>
                <!-- /.box-header -->
                <!-- form start -->

                     {!! Form::open(['files' => true,'method'=>'POST','id'=>'fileupload','url'=>'admin/import_file']) !!}
                  <div class="box-body">


                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                        {!! Form::file('attendance_file',array('id'=>'exampleInputFile', 'class'=>'')) !!}

                      <p class="help-block">Example block-level help text here.</p>
                    </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('cpanel.save') }}</button>
                  </div>
                {!! Form::close() !!}
              </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@stop
