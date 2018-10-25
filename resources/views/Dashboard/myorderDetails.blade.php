@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")
<section class="top">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div> 
                        <ul>
                            <li>
                                <i class="fa fa-arrow-left"></i>
                            </li>
                            <li>
                                <a href="{{lang_url('myordervendor')}}"> رجوع </a>
                            </li>
                            <li>
                                <i class="fa fa-arrow-left"></i>
                            </li>
                            <li>
                                <a href="#"> طلب رقم <span class="num"> {{$order->order_number}} </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-left">
                        <p>بتاريخ :{{$order->date}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mycart">
        <div class="container">
            <div class="row">
                        <div class="col-lg-8">
                            <div class="row">

                                @foreach ($ordersdetails as $row)
                                    
                              
                                <div class="col-12">
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 d-block text-center">
                                                <img src="{{ asset($row->image)}}" style="width:220px">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-lg-10 col-md-12 text-sm-center">
                                                        <p class="text-lg-right  d-block">{{ $row->title}}</p>
                                                    </div>
                                                    <div class="col-12 ">
                                                        <span class="details">العدد : {{ asset($row->count)}}</span>
                                                    </div>
                                                   @if ($row->size)
                                                    <div class="col-12 ">
                                                            <span  class="details">المقاس :{{$row->size}}</span>
                                                        </div>
                                                    @endif
                                                   @if ($row->color)
                                                   <div class="col-6 ">
                                                   <span  class="details" >اللون : <span  class="color" style="width: 30px;
                                                    height: 25px;
                                                    display: block;
                                                    cursor: pointer;
                                                ;background-color: #{{$row->color}}"></span></span>
                                                    </div>
                                                   @endif
                                                  
                                                    <div class="col-6 ">
                                                        <span class="price d-block text-left">{{$row->price}}</span>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                              
                                @endforeach
                              
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class='content '>
                                <div class="row">
                                    <div class="col-12">
                                        <h2>ملخص</h2>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td class="name" colspan="6">{{trans('cpanel.Number_of_products')}}</td>
                                        <td class="text-left price" colspan="6">{{$order->count}}</td>
                                        </tr>
                                        <tr>
                                            <td class="name" colspan="6">{{trans('cpanel.The_amount_is_net')}}</td>
                                            <td class="text-left price" colspan="6">{{$order->sum}}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="name" colspan="6">خدمة التوصيل</td>
                                            <td class="text-left price" colspan="6">206.00</td>
                                        </tr> --}}
                                        <tr>
                                            <td class="all" colspan="6">{{trans('cpanel.Total')}} </td>
                                            <td class="text-left f-price" colspan="6">{{$order->sum}}</td>
                                        </tr>
                                    </table>
                                  
                                </div>
                             
                            </div>
                        </div>
                    </div>
             
        </div>
    </section>
    
    <section class="clients">
        <div class="container">
            <div class="row">
                
                <div class="col-8 client">
                    <h6 class="py-3">الطلب لصالح السيد : {{$order->name}}</h6>
                    
                    <div class="items">
                        <div class="row">
                            <div class="col-2">
                                <p class="clr">عنوان</p>       
                            </div>
                            <div class="col-10">
                                <p>{{$order->address}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <div class="row">
                            <div class="col-2">
                                <p class="clr">المنطقة</p>          
                            </div>
                            <div class="col-10">
                                <p>{{$order->regonname}}</p>
                            </div> 
                        </div>
                    </div>
                    <div class="items">
                        <div class="row">
                            <div class="col-2">
                                <p class="clr">مدينة</p>          
                            </div>
                            <div class="col-10">
                                <p>{{$order->cityname}}</p>
                            </div> 
                        </div>
                    </div>
                    <div class="items">
                        <div class="row">
                            <div class="col-2">
                                <p class="clr">رقم الدور</p>
                            </div>
                            <div class="col-10">
                                <p>{{$order->floor_number}}</p>
                            </div> 
                        </div>
                    </div>
                    <div class="items">
                        <div class="row">
                            <div class="col-2">
                                <p class="clr">رقم الشقة</p>
                            </div>
                            <div class="col-10">
                                <p>{{$order->unit_number}}</p>
                            </div> 
                        </div>
                    </div>
                </div>
                 <div class="col-8">
                                    <hr>
                                    </div>
            </div><p>
<?php 
    if($order->payment == 1){
        echo 'التحصيل';
    }
     

    ?>                : 
                عند الاستلام</p>
        </div>
    </section>
@stop




