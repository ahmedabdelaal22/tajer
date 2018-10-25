<script>
    var ides = [];
    function inArray(target, array)
            {

            /* Caching array.length doesn't increase the performance of the for loop on V8 (and probably on most of other major engines) */

            for (var i = 0; i < array.length; i++)
            {
            if (array[i] === target)
            {
            return false;
            }
            }

            return true;
            }
</script>


<?php
$i = $data['items']->firstItem();
//echo $i;
?>
@foreach($data['items'] as $row)


<li class="product list-view list-view-small">
    <div class="media">
        <div class="media-left">
            <a href="{{lang_url('dashboard/items/'.$row->id)}}" rel="prettyPhoto[ajax]">
                <img rel="prettyPhoto[ajax]" class="wp-post-image " src="{{ asset($row->thumbnail_image)}}" alt="{{$row->title}}" style="height: 135px">
            </a>
        </div>

        <div class="media-body media-middle">
            <div class="row">

                <div class="col-lg-5 col-xs-12 m-top">
                    <a href="{{lang_url('dashboard/items/'.$row->id)}}">
                        <h3>{{$row->title}}  </h3>
                    </a>

                    <span class="loop-product-categories">
                        <?php
                        if ($row->sub_categories) {
                            $lang_title = $data['locale_title'];
                            ?>
                            <a rel="tag" href="{{lang_url('dashboard/items/'.$row->id)}}">{{$row->sub_categories->$lang_title}}</a>
                        <?php } ?>
                    </span>


                    <div class="product-rating">




                        <div class="city">
                            <?php
                            $local = $data['locale_name'];
                            echo $row->cities->country->$local . '-' . $row->cities->$local;
                            ?>
                        </div>

                    </div>

                </div>
                <div class="col-lg-7 col-xs-12 m-top">

                    <div class="row">

                        <div class="col-md-3 no-padding">

                            <div class="price-add-to-cart">
                                
                          
                                         @if($row->type==1)
                                                     <p>  {{ trans('cpanel.Daily') }}</p>
                                                     @elseif($row->type==2)
                                                       <p> {{ trans('cpanel.Weekly') }}</p>
                                                     @else
                                                       <p> {{ trans('cpanel.Monthly') }}</p>
                                                     @endif



                            </div>

                        </div>

                        

                        <div class="col-md-9 no-padd">
                           
                          

                            <div class="product-rating">

                              
                                <div class="bids_number">
                      {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}

                                </div>
   
                            </div>

                           
      

                        </div>


                    </div>

                </div>


            </div>
        </div>
    </div>
</li>



<?php $i++; ?>



@endforeach

