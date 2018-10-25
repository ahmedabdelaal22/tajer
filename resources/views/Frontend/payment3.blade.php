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



                <div class="box-payment mb-2">
                    <div class="row">
                        <div class="col-9">
                          <a class="title" href="#"> {{ trans('cpanel.Choose_payment_method') }}</a>
</div>
                        <div class="col-3">
                            <img class="done" src="{{ asset('public/assets/'.FE .'/Images/Icons/done.png')}}">
                        </div>
                    </div>
                </div>



                <div class="box-payment">
                    <div class="row">
                        <div class="col-9">
                                <a class="title" href="#">{{ trans('cpanel.Order_status') }}</a>
                        </div>
                    </div>
                </div>
                <div class="box-content mb-5">
                    <div class="row">
                        <div class="col-12">
                            <img class="con-done  mx-auto d-block" src="{{ asset('public/assets/'.FE .'/Images/Icons/done.png')}}" alt="">
                            <h3 class="text-center">{{ trans('cpanel.operation_accomplished_successfully') }}</h3>
                        </div>

                        <div class="col-lg-6">
                            <a class="btn btn1 btn-block" href="{{lang_url('myorders')}}">{{ trans('cpanel.my_orders') }}</a>
                        </div>
                        <div class="col-lg-6">
                            <a class="btn btn2 btn-block" href="categories.html">{{ trans('cpanel.Resume_marketing_process') }}</a>
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
                                    <td class="text-left price" colspan="6">{{$count_cart}}</td>
                            </tr>
                            <tr>
                                    <td class="name" colspan="6">{{trans('cpanel.The_amount_is_net')}}</td>
                                    <td class="text-left price" colspan="6">{{$subtotal}}</td>
                            </tr>
                            <tr>
                                    <td class="name" colspan="6"> {{trans('cpanel.Delivery_by_address')}}</td>
                                    <td class="text-left price" colspan="6">{{$shipping_cost}}</td>
                            </tr>
                            <tr>
                                    <td class="all" colspan="6">{{trans('cpanel.Total')}}  </td>
                                    <td class="text-left f-price" colspan="6">{{number_format($total, 2, '.', ',')}}</td>
                            </tr>
                        </table>
<!--                        <a href="{{ lang_url('cart') }}" class="btn btn-block mx-auto">العودة الي عربة التسوق</a>-->
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
    function select_payment(region1_id, type1) {
        region_id = region1_id;
        type = type1;


        $(".submitbuton").removeAttr("disabled");
    }

    function continueproc() {

        window.location = "{!! lang_url('payment3') !!}/" + region_id + '/' + type;
    }


</script>
@stop


