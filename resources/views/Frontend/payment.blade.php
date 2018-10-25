@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")



<!-- Start Section my cart -->

<!-- Start Nav3 -->

<!-- End Nav 3 -->
<!-- Start Section payment -->
<section class="payment mycart">

    <div class="container">

                <div class="col-12 table-responsive">
                                    @if(Session::has('success_msg'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success_msg') }}</p>
@endif
        <div class="row">
            <div class="col-lg-9">
                <div class="box-payment">
                    <div class="row">
                        <div class="col-9">
                            <a class="title" href="#"> {{ trans('cpanel.Shipping_data') }}</a>
                        </div>
                        <div class="col-3">
                            <a class="adddress text-left" href="{{lang_url('addresses/create')}}" class="text-left">{{ trans('cpanel.Add_Address') }}</a>
                        </div>
                    </div>
                </div>
                <form action="payment2.html" class="box-content">
                    <div class="row">
                        <div class="col-lg-9 col-sm-6">
                            <h3>  {{ trans('cpanel.Titles') }}</h3>
                        </div>
                        <div class="col-lg-3 col-sm-6">
<!--                            <ul class="list-unstyled text-left">
                                <li><i class="fa fa-trash fa-lg"></i></li>
                                <li><i class="fa fa-pencil fa-lg"></i></li>
                            </ul>-->
                        </div>
                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <td colspan="1">
                                        <label>
                                            <input type="radio" name="address" onclick="select_address('{{@$user->region->id}}','{{@$user->region->shipping_cost}}')">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="addr" colspan="6">
                                        <p>{{$user->address}}</p>
                                        <p>{{@$user->region->ar_name}}</p>
                                        <p>  {{ trans('cpanel.Role_number') }}{{$user->floor_number}}</p>
                                    </td>
                                    <td>
                                        <p> {{ trans('cpanel.City') }}</p>
                                        <p>{{ trans('cpanel.Apartment_number') }}</p>
                                    </td>
                                    <td class="addr">
                                        <p>{{@$user->cities->ar_name}}</p>
                                        <p>{{@$row->unit_number}}</p>
                                    </td>
                                    <td>
                                        {{--<i class="fa fa-trash fa-lg ml-2"></i>--}}
                                        <a href="{{ lang_url("dashboard/settings") }}"><i class="fa fa-pencil fa-lg"></i></a>
                                    </td>
                                </tr>



                                @foreach($address as $row)
                                <tr id="{{$row->id}}">
                                    <td colspan="1">
                                        <label>
                                            <input type="radio" name="address" onclick="select_address('{{$row->id}}','{{@$row->region->id}}','{{@$row->region->shipping_cost}}')">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="addr" colspan="6">
                                        <p>{{$row->address}}</p>
                                        <p>{{@$row->region->ar_name}}</p>
                                        <p>{{ trans('cpanel.Role_number') }} {{@$row->floor_number}}</p>
                                    </td>
                                    <td>
                                        <p> {{ trans('cpanel.City') }}</p>
                                        <p>{{ trans('cpanel.Apartment_number') }}</p>
                                    </td>
                                    <td class="addr">
                                        <p>{{@$row->region->cities->ar_name}}</p>
                                        <p>{{@$row->unit_number}}</p>
                                    </td>
                                    <td>
                                        <span onclick="deleteAddress({{$row->id}})">
                                            <i class="fa fa-trash fa-lg ml-2" ></i>
                                        </span>

                                        <a href="{{ lang_url("addresses/$row->id/edit") }}">
                                            <i class="fa fa-pencil fa-lg" ></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                        <div class="col-4 mr-auto">
                            <button type="button"  disabled="disabled" class="btn btn-block submitbuton" onclick="continueproc()">{{ trans('cpanel.continue') }}</button>
                        </div>
                    </div>
                </form>


                <div class="box-payment mb-2 unactive">
                    <div class="row">
                        <div class="col-9">
                            <a class="title" href="#">{{ trans('cpanel.Choose_payment_method') }}</a>
                        </div>
                    </div>
                </div>



                <div class="box-payment mb-5 unactive">
                    <div class="row">
                        <div class="col-9">
                            <a class="title" href="#">{{ trans('cpanel.Order_status') }}</a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-3">
                <div class='content'>
                    <div class="row">
                        <div class="col-12">
                            <h2>{{trans('cpanel.summary')}}</h2>
                        </div>
                        <table class="table">
                            <tr>
                                <td class="name" colspan="6">{{trans('cpanel.Number_of_products')}}</td>
                                <td class="text-left price" colspan="6">{{count(Cart::content())}}</td>
                            </tr>
                            <tr>
                                <td class="name" colspan="6"> {{trans('cpanel.The_amount_is_net')}}</td>
                                <td class="text-left price" colspan="6">{{Cart::subtotal()}}</td>
                            </tr>
                            <tr>
                                <td class="name" colspan="6">  {{trans('cpanel.Delivery_by_address')}}</td>
                                <td class="text-left price shipping_cost" colspan="6">0.0</td>
                            </tr>
                            <tr>
                                <td class="all" colspan="6">{{trans('cpanel.Total')}} </td>
                                <td class="text-left f-price totalprice" colspan="6" >{{Cart::subtotal()}}</td>
                            </tr>
                        </table>
                        <a href="{{ lang_url('cart') }}" class="btn btn-block mx-auto"> {{trans('cpanel.Return_to_shopping_cart')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- End Section My cart -->

<script>
    
   var  region_id;
     var  address_id;
    function select_address(address,region1_id,shipping_cost){
     region_id=region1_id;
     address_id=address;
     $('.shipping_cost').text(shipping_cost);
     
    var subtotal="<?php echo Cart::subtotal()?>";
    subtotal = subtotal.replace(/[^\d-.]/g, ''); 
    
    var total = parseFloat(subtotal)+parseInt(shipping_cost);
  
    total=(total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    

      $('.totalprice').text(total);
      
      $(".submitbuton").removeAttr("disabled");
    }
    function continueproc(){
  
          window.location="{!! lang_url('payment2') !!}/"+region_id+'/'+address_id; 
    }

    
</script>


{{-- Script for delete an address with ajax--}}
    <script>
        function deleteAddress(id){
          var mes="  {{trans('cpanel.are_you_sure_want_to_delete_this_address_?')}}";

            var r = confirm(mes);

            if( r == true) {
                $.ajax({
                    type: "get",
                    url: "{{ lang_url("Addresses/del") }}/" + id,
                    data: "{{ csrf_token() }}",
                    success: function (data) {
                        if (data.status) {
                            $("#" + id).remove();
                        }
                    }

                });
            }
        }
    </script>
@stop


