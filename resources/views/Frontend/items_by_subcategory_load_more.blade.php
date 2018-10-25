<?php
$i = @$data['items']->firstItem();

$lang_title = $data['locale_title'];
?>

@foreach($data['items'] as $row)


    <div class="col-lg-12 g-l">
        <div class="box-prodect">
            <div class="row">
                <div class="col-lg-4 img-col text-center">
                    <a href="{{lang_url('dashboard/items/'.$row->id)}}">
                        <img src="{{ asset($row->thumbnail_image)}}" alt="">
                    </a>

                    @if($row->ratio > 0)
                        @if(@$row->ratio != "")

                            <span class="sell">

                                            {{@$row->ratio}}%
                                        </span>
                        @endif
                    @endif
                    @if($row->user_wishlist == 1)
                        <span id='{{$row->id}}' onclick="www({{ $row->id }})">
                            <i class="fa fa-heart inWishList"></i>
                        </span>
                    @else
                        <span id='{{$row->id}}' onclick="www({{ $row->id }})">
                            <i class="fa fa-heart-o inWishList"></i>
                        </span>
                    @endif

                </div>
                <div class="col-lg-8 col-info">
                    <div class="info">
                        <p class="text-lg-right text-sm-center">{{$row->title}}</p>


                        @if($row->ratio >0)
                            <span class="price text-lg-right text-sm-center d-lg-inline-block d-sm-block">{{ $row->discount_price }}</span>
                            <span class="old-price text-lg-right text-sm-center d-lg-inline-block d-sm-block">{{ $row->fixed_price }}</span>


                        @else
                            <span class="price text-lg-right text-sm-center d-lg-inline-block d-sm-block">{{ $row->fixed_price }}</span>

                        @endif


                        <a href="{{lang_url('dashboard/items/'.$row->id)}}"
                           class="btn btn-info mr-lg-0 ml-lg-0 mr-sm-auto ml-sm-auto">{{trans('cpanel.buy_now')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <?php $i = $i + 1; ?>

@endforeach





