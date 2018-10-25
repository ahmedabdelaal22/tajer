@extends(DSHI.'.master')
@section('content')



<div class="dashboard-content">


    <div class="headline filter primary sp_color">
        <h4>{{ trans('cpanel.Manage_Items') }} ({{$all_data->count() }})</h4>
        <!--        <form>

                    <select name="orderby" class="orderby">
                        <option value="menu_order" selected="selected">Default Sorting</option>

                        <option value="">End date: Ascending</option>
                        <option value="">End date: Descending</option>

                        <option value="">Start date: Ascending</option>
                        <option value="">Start date: Descending</option>

                        <option value=""> Price: Ascending</option>
                        <option value=""> Price: Descending</option>

                        <option value=""> Nearest: Ascending</option>
                        <option value=""> Nearest: Descending</option>

                        <option value="">Rating: Asc</option>
                        <option value="">Rating: Descending</option>

                    </select>

                </form>-->
    </div>

    <div class="product-list grid column4-wrap">

        <div class="row">

            <div class="col-md-3">
                <div class="product-item upload-new column">
                    <!-- PRODUCT PREVIEW ACTIONS -->
                    <div class="product-preview-actions">
                        <!-- PRODUCT PREVIEW IMAGE -->
                        <figure class="product-preview-image">
                            <a href="{{lang_url('dashboard/items/create')}}">
                                <img src="{{ asset('public/assets/'.DSH .'/images/dashboard/uploadnew-bg.jpg')}}" alt="product-image">
                            </a>
                        </figure>
                        <!-- /PRODUCT PREVIEW IMAGE -->
                    </div>
                    <!-- /PRODUCT PREVIEW ACTIONS -->

                    <!-- PRODUCT INFO -->
                    <div class="product-info">
                        <p class="text-header">  {{ trans('cpanel.Upload_New_Item') }}</p>
                        <!--<p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                    </div>
                    <!-- /PRODUCT INFO -->
                </div>
            </div>


            <div class="col-md-9">

                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <ul class="products columns-3">

                    <!--<li class="product list-view list-view-small" style="margin-top:34px">-->

                    @foreach ($all_data as $row_data)
                    <li class="product list-view list-view-small" style="margin-top:34px" >
                        <div class="media">

                            <div class="media-left">
                                <a href="{{lang_url('dashboard/items/'.$row_data->id)}}">
                                    <img class="wp-post-image" src="{{ asset($row_data->thumbnail_image)}}" alt="{{$row_data->title}}" >
                                </a>
                            </div>

                            <div class="media-body media-middle">
                                <div class="row">

                                    <div class="col-lg-4 col-xs-12 myitem">
                                        <span class="loop-product-categories">
                                            <a href="{{lang_url('dashboard/items/'.$row_data->id)}}">
                                                {{$row_data->title}}
                                            </a>
                                        </span>

                            

                                    </div>

                                    <div class="col-lg-8 col-xs-12 ">

                                        <div class="row">

                                            <div class="col-md-4 no-padding">

                                                <div class="price-add-to-cart">
                                                    <span class="price">
                                                        @if($row_data->type==2)
                                                        {{$row_data->fixed_price}} {{ trans('cpanel.R_S') }}
                                                        @else
                                                        {{$row_data->discount_price}} {{ trans('cpanel.R_S') }}
                                                        @endif

                                                    </span>
                                                </div>


                                          

                                            </div>


                                            <div class="col-md-8">

                                                <div class="btns">

                                                    <a href="{{lang_url('dashboard/items/'.$row_data->id.'/edit/')}}">
                                                        <button>  <span> {{ trans('cpanel.Edit') }}  </span>   </button>
                                                    </a>
                                                    <button type="button" class="cancle" data-target="#deletrow{{$row_data->id}}" data-toggle="modal" data-whatever="@mdo">
                                                        <span>  {{ trans('cpanel.Delete') }} </span>
                                                    </button>

                                                    <!--         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo">Delete</button>
                                                    -->

                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div>
                            </div>







                        </div>
                    </li>

 

                    <div class="modal fade" id="deletrow{{$row_data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog dashboard" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    Are you sure delete this item ?

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{lang_url('delete').'/'.$row_data->id}}">
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>




                    @endforeach

                </ul>


            </div>


        </div>


    </div>


    <div class="clearfix"></div>
</div>

<?php /* ?>

  <!--       <div class="modal fade" id="deletrow{{$row_data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog dashboard" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden="true"></i> Delete </h4>
  </div>
  <div class="modal-body">
  <p> Are You Sure To Delete This Item ?</p>
  </div>
  <div class="modal-footer">


  {!!  Form::open(['action' => ['Administrator\ItemsController@destroy', $row_data->id],'method'=>'DELETE','role'=>'form', 'id'=>'Delete_form']) !!}

  {!!  Form::submit('Yes', array('class'=>'btn btn-primary ms7')) !!}

  <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
  {!! Form::close() !!}
  </div>
  </div>
  </div>
  </div> -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo">Delete</button> -->


  <!-- <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog dashboard" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  Are you sure delete this item ?

  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary">Save changes</button>
  </div>
  </div>
  </div>
  </div> -->
  <?php */ ?>
@stop




