@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")

<section>
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-12 ">
    
                    <h1 class="head">{{trans('cpanel.My_orders')}}</h1>
    
                    <div class="row">
                        <div class="col-12">
                                @foreach($orders as $row)
                           
                                <div class="title">
                                <div class="row">
                                    <div class="col-8">
                  <a href="{{lang_url('myorderDetails')}}/{{$row->id}}"class="text-dark">  <p>{{trans('cpanel.He_did')}} <b> {{$row->name}}</b>{{trans('cpanel.Leave_a_request_through_your_store _worth')}}<span class="price"> {{$row->sum}}</span></p>     </a>
                                    </div>
                                    <div class="col-4 text-left">
                                        <span class="date"> {{trans('cpanel.date')}} : {{$row->date}} </span> 
                                    </div>
                                </div>
                            </div>
                       
                            @endforeach
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </section>
@stop




