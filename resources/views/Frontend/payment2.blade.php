@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")



<!-- Start Section my cart -->

<!-- Start Nav3 -->

<!-- End Nav 3 -->
<!-- Start Section payment -->
<!-- Start Section payment -->
<section class="payment mycart">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="box-payment mb-2">
                    <div class="row">
                        <div class="col-9">
                            <a class="title" href="{{ lang_url('payment') }}">{{ trans('cpanel.Shipping_data') }}</a>
                        </div>
                        <div class="col-3">
                            <img class="done" src="{{ asset('public/assets/'.FE .'/Images/Icons/done.png')}}">
                        </div>
                    </div>
                </div>



                <div class="box-payment">
                    <div class="row">
                        <div class="col-9">
                            <a class="title" href="#"> {{ trans('cpanel.Choose_payment_method') }}</a>
                        </div>
                        <div class="col-3">
                            <a class="adddress text-left" href="addcart.html" class="text-left">{{ trans('cpanel.Add_a_card') }}</a>
                        </div>
                    </div>
                </div>
                <form action="payment3.html" class="box-content">
                    <div class="row">

                        <div class="col-12">
                            <table class="table">
<!--                                <tr>
                                    <td colspan="1">
                                        <label>
                                            <input type="radio" name="address">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td colspan="1">
                                        <img class="img-cart" src="Images/Icons/credit_card.png" alt="">
                                        <p class="p-cart">بطاقة الأئتمان</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1">
                                        <label>
                                            <input type="radio" name="address">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <p class="p-cart m-0 mt-3">
                                            رقم البطاقة : <span>258***********</span>
                                        </p>
                                    </td>
                                    <td class="act">
                                        <i class="fa fa-pencil fa-lg" data-toggle="modal"
                                           data-target="#exampleModalCenter"></i>
                                        <i class="fa fa-trash fa-lg"></i>
                                         Modal 
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content text-center">
                                                    <div class="modal-body">
                                                        <p>من فضلك ادخل كلمة السر الخاصة بك</p>
                                                        <input type="password" class="" >
                                                        <br>
                                                        <a href="editpass.html" class="btn">استمرار</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>-->
                                <tr class="last">

                                    <td colspan="1">
                                        <label>
                                            <input type="radio" name="address"  onclick="select_payment('{{$address_id}}','{{$region_id}}', '1')">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td colspan="1">
                                        <img class="img-cart" src="{{ asset('public/assets/'.FE .'/Images/Icons/cash.png')}}" alt="">
                                        <p class="p-cart"> {{ trans('cpanel.Payment_upon_receipt') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-4 mr-auto">
                            <button type="button"  disabled="disabled" class="btn btn-block submitbuton" onclick="continueproc()">{{ trans('cpanel.save') }}</button>
                        </div>
                    </div>
                </form>


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
                                <td class="name" colspan="6">{{trans('cpanel.The_amount_is_net')}}</td>
                                <td class="text-left price" colspan="6">{{Cart::subtotal()}}</td>
                            </tr>
                            <tr>
                                <td class="name" colspan="6"> {{trans('cpanel.Delivery_by_address')}}</td>
                                <td class="text-left price" colspan="6">{{$region->shipping_cost}}</td>
                            </tr>
                            <tr>
                                <td class="all" colspan="6">{{trans('cpanel.Total')}}  </td>

                                <td class="text-left f-price" colspan="6"><?php 
                               $total=(float) remove_non_numerics(Cart::subtotal())+$region->shipping_cost;
                               echo number_format($total, 2, '.', ',');
                                ?></td>

                            </tr>
                        </table>
                        <a href="{{ lang_url('cart') }}" class="btn btn-block mx-auto">{{trans('cpanel.Return_to_shopping_cart')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Section payment -->
<!-- End Section My cart -->

<script>

    var region_id;
    var type;
    var address;
    
    function select_payment(address_id,region1_id, type1){
    region_id = region1_id;
    type = type1;
    address=address_id;
  
    $(".submitbuton").removeAttr("disabled");
    }

    function continueproc(){

    window.location = "{!! lang_url('payment3') !!}/" + region_id +'/'+type+'/'+address;
    }


</script>
@stop


