  <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">



                        <ul class="products columns-4"  id="post-data">


                                @foreach($admin_data as $value)
                           
             <li class="product">
                <div class="product-outer">
                    <div class="product-inner">
                        <span class="loop-product-categories"><a href="{{lang_url('dashboard/items/'.$value->id)}}" rel="tag">{{$value->sub_categories->$locale_title}}</a></span>
                        <a href="{{lang_url('dashboard/items/'.$value->id)}}">
                            <h3>{{$value->title}}</h3>
                            <div class="product-thumbnail">

                                <img data-echo="{{ asset($value->thumbnail_image)}}" src="{{ asset($value->thumbnail_image)}}" alt="">

                            </div>
                        </a>

                        <div class="price-add-to-cart">
                                 @if($value->ratio > 0)
                                                <span class="price">
                                                    <span class="electro-price">
                                                        <ins><span class="amount">     {{number_format($value->discount_price)}} {{trans('cpanel.R_S')}}</span></ins>
                                                        <del><span class="amount">{{number_format($value->fixed_price)}} {{trans('cpanel.R_S')}}</span></del>
                                                        <span class="amount"> </span>
                                                    </span>
                                                </span>
                                                @else
                                                <span class="price">
                                                    <span class="electro-price">
                                                        <ins><span class="amount"> </span></ins>
                                                        <span class="amount">{{number_format($value->fixed_price)}} {{trans('cpanel.R_S')}}</span>
                                                    </span>
                                                </span>
                                                @endif
                                          @foreach($value->items_sizes as $row1)
                                                    <input type="hidden"  name="sizes[]"class="row{{$value->id}}" value="{{$row1->size}}">
                                                    @endforeach

                                                    @foreach($value->items_colors as $row1)

                                                    <input type="hidden"  name="colors[]"class="color{{$value->id}}" value="{{$row1->colors->ar_name}}">
                                                    @endforeach

                                                    <a rel="nofollow" href="javascript:add_cart('{{$value->id}}','{{$value->discount_price}}','{{$value->title}}','{{$value->thumbnail_image}}');" class="button add_to_cart_button"></a>


                        </div><!-- /.price-add-to-cart -->

                        <div class="hover-area">
                            <div class="action-buttons">

                                <a href="#" rel="nofollow" class="add_to_wishlist">
                                        Wishlist</a>

                        
                            </div>
                        </div>
                    </div><!-- /.product-inner -->
                </div><!-- /.product-outer -->
            </li>
@endforeach

                        </ul>
                    </div>
