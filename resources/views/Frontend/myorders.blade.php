@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")

    <!-- Start Section My orders -->
    <section class="orders">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    <h3>{{trans('cpanel.My_orders')}}</h3>

                    <table class="table">
                      @foreach($orders as $row)
                         <tr>
                                <td>
                                    <p class="req">{{trans('cpanel.order_number')}} : {{$row->id}}</p>
                                    <span class="date">{{trans('cpanel.with_date')}} : {{$row->date}}</span>
                                </td>
                                <td class="text-left">
                                    <p class="price">{{number_format($row->total_price)}}</p>
                                </td>
                            </tr>
                       @endforeach


                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--  End Section My orders  -->
@stop

