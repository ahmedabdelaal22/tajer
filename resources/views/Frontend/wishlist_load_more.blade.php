@foreach($data['items'] as $row)
                <div class="col-lg-3 " id="product_{{ $row->items_id }}">
                        <div class="box-prodect">
                                <div class="row">
                                        <div class="col-lg-12  text-center">
                                           <a href="{{lang_url('dashboard/items/'.$row->id)}}">
                                                <img src="{{ asset($row->thumbnail_image)}}" alt="">
                                           </a>
                                             @if($row->ratio >0)
                                            <span class="sell">

                                            {{$row->ratio}}%
                                        </span>
                                        @endif
                                        <span id='{{$row->items_id}}' onclick="www({{ $row->items_id }})">

                                            <i class="fa fa-heart inWishList"></i>
                                        </span>

                                        </div>
                                        <div class="col-lg-12 col-info">
                                           <div class="info">
                                                <p class="text-center">{{$row->title}}</p>
                                    
                                                    @if($row->ratio >0)
                                                   <span class="old-price d-block text-center">{{ $row->fixed_price }}</span>

                                                    <span class="price d-block text-center">{{ $row->discount_price }}</span>
                                                @else
                                               <span class="price d-block text-center">{{ $row->fixed_price }}</span>

                                            @endif
                                            <a href="{{lang_url('dashboard/items/'.$row->items_id)}}" class="btn btn-info mx-auto">{{trans('cpanel.buy_now')}}</a>
                                           </div>
                                        </div>
                                      </div>
                            </div>
                </div>
   
  
    

   

@endforeach