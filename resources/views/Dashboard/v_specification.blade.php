@extends(DSHI.'.master')
@section('content')


<div class="dashboard-content">

    <div class="headline simple primary sp_color">
        <h4 class="special">{{trans('cpanel.Item_Specifications')}}</h4>

    </div>



  {!! Form::open(['method'=>'POST','files'=>true,'id'=>'upload_form','url'=>$locale.'/spcification','role'=>'form',' accept-charset'=>'UTF-8']) !!}

    <div class="form-box-items wrap-3-1 left">
        <div class="form-box-item full">

            <h4>{{trans('cpanel.Item_Specifications')}}</h4>


            <hr class="line-separator">


      

         @foreach($specifications_info as $value)

            <div class="row">

                <div class="col-md-12">

                    <div class="input-container">

                        <label for="item_name" class="rl-label required">{{$value->$locale_title}}</label>

            
                             <input type="text" name="item_specification_{{$value->id}}" value="{{$value->value}}" class="form-control">
                    </div>

                </div>

            </div>
           

        @endforeach      
         <input type="hidden" name="item_id" value="{{$item_id}}" class="form-control">
            <br>

      
            <br>

            <br>




            <br>

 


   


      

            <hr class="line-separator">
            <button class="button big dark" type="submit">
                {{$submit_button}}
                <span class="primary"></span>
            </button>
        </div>
    </div>

    {!! Form::close() !!}
   


    <div class="clearfix"></div>
</div>
<!-- DASHBOARD CONTENT -->





@stop