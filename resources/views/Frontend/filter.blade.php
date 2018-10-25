@extends(FEI.'.master')
@section('content')    
<?php $title = $lang . '_title' ?>
<div id="content" class="site-content" tabindex="-1">
    <div class="container">

        <nav class="woocommerce-breadcrumb" >
            <a href="{{lang_url('/')}}">{{trans('cpanel.Home')}}</a><span class="delimiter">
                <i class="fa fa-angle-right"></i>
            </span><a href="{{lang_url('categories/'.$category->categories->id)}}">{{$category->categories->$title}}</a></nav>

        <div id="primary" class="content-area">
            <main id="main" class="site-main">


                <header class="page-header">
                    <h1 class="page-title">{{$category->$title}}</h1>
<!--					<p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>-->
                </header>

                <div class="shop-control-bar">
                    <ul class="shop-view-switcher nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" title="Grid View"onclick="change('grid')" href="#grid"><i class="fa fa-th"></i></a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" title="Grid Extended View"onclick="change('grid-extended')" href="#grid-extended"><i class="fa fa-align-justify"></i></a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View" onclick="change('list-view')"href="#list-view"><i class="fa fa-list"></i></a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View Small"onclick="change('list-view-smal')" href="#list-view-small"><i class="fa fa-th-list"></i></a></li>
                    </ul>
                    <form class="woocommerce-ordering" method="get">
                        <select name="orderby" class="orderby"id="filteration2_id">
                            <option value="not" selected='selected'>Default sorting</option>
                            <option value="view_counter,DESC" >Sort by popularity</option>
                            <option value="rating" >Sort by average rating</option>
                            <option value="created_at,DESC" >Sort by newness</option>
                            <option value="discount_price,ASC" >Sort by price: low to high</option>
                            <option value="discount_price,DESC" >Sort by price: high to low</option>
                        </select>
                    </form>
                    <form class="form-electro-wc-ppp"><select name="ppp" onchange="this.form.submit()" class="electro-wc-wppp-select c-select"><option value="15"  selected='selected'>Show 15</option><option value="-1" >Show All</option></select></form>


                </div>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">



                        <ul class="products columns-3"  id="post-data">
                            @include(FE.'.items_by_subcategory_load_more')

                        </ul>
                        <div class="ajax-load text-center" style="display:none">
                            <p><img src="{{ asset('public/assets/' .FE.'/loader.gif')}}">{{trans('cpanel.Loading_More_post')}}</p>
                        </div>

                    </div>

                </div>




            </main><!-- #main -->
        </div><!-- #primary -->

        <div id="sidebar" class="sidebar" role="complementary">
            <aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
                <ul class="product-categories category-single">
                    <li class="product_cat">

                        <ul>
                            <li class="cat-item current-cat"><a href="{{lang_url('categories/'.$category->categories->id)}}">{{$category->categories->$title}}</a> <span class="count">({{$category->categories->sub_categories->count()}})</span>
                                <ul class='children'>

                                    @foreach(get_sub_category_filter($category->categories->id) as $row)
                                    <li class="cat-item"><a href="{{lang_url('sub-cat/'.$row->id)}}">{{$row->title}}</a> <span class="count">({{$row->total}})</span></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <form method="get" action="{{lang_url('filter')}}">
                <input type="hidden" name="sub_cat_id"id="sub_cat_id" value="{{$sub_cat_id}}">
                <aside class="widget widget_electro_products_filter">
                    <h3 class="widget-title">{{trans('cpanel.Filters')}}</h3>
                    <aside class="widget woocommerce widget_layered_nav">
                        <h3 class="widget-title">Brands</h3>
                        <ul>
                            @foreach(get_brands($sub_cat_id) as $row)
                            <?php
                            if (in_array($row->id, $brand)) {
                                $check = 'checked="checked"';
                            } else {
                                $check = '';
                            }
                            ?>
                            <li style="">
                                <input type="checkbox" <?= @$check ?> name="brands[]" value="{{$row->id}}">{{$row->title}}
                                <span class="count">({{$row->total}})</span>
                            </li>
                            @endforeach

                        </ul>
                        <p class="maxlist-more"><a href="#">+ Show more</a></p>
                    </aside>
                    <aside class="widget woocommerce widget_layered_nav">
                        <h3 class="widget-title">Color</h3>
                        <ul>
                            @foreach(get_coloers($sub_cat_id) as $row)
                            <?php
                            if (in_array($row->id, $coloers)) {
                                $check = 'checked="checked"';
                            } else {
                                $check = '';
                            }
                            ?>
                            <li style="">
                                <input type="checkbox" <?= @$check ?> name="colors[]" value="{{$row->id}}">{{$row->title}}
                                <span class="count">({{$row->total}})</span>
                            </li>
                            @endforeach
                        </ul>
                        <p class="maxlist-more"><a href="#">+ Show more</a></p>
                    </aside>


                    <aside class="widget woocommerce widget_price_filter">
                        <h3 class="widget-title">Price</h3>

                        <div class="price_slider_wrapper">
                            <input type="hidden" id="endprice" value="{{$maxprice}}"  >
                            <input type="hidden" id="maxprice" value="{{$minprice}},{{$maxprice}}"  >
                            <p>
                                <label for="amount">Price range:</label>
                                <input type="text" id="amount"  name="amount" readonly style="border:0; color:#f6931f; font-weight:bold;padding: 0 0 0 5px;">
                            </p>

                            <div id="slider-range"></div>



                            <div class="price_slider_amount">
                                <button type="submit"class="button">{{trans('cpanel.Filter')}}</button>
          <!--                    <div style="" class="price_label">Price: <span class="from">$428</span> &mdash; <span class="to">$3485</span></div>-->
                                <div class="clear"></div>
                            </div>
                        </div>




                    </aside>




                </aside>
            </form>
            <aside class="widget widget_text">
                <div class="textwidget">
                    <a href="#">
                         <img src="{{ asset('public/assets/'.FE .'/banner/ad-banner-sidebar.jpg')}}" alt="Banner"></a>
                </div>
            </aside>
            <aside class="widget widget_products">
                <h3 class="widget-title">{{trans('cpanel.Latest_Products')}}</h3>
                <ul class="product_list_widget">
                    @foreach($latest_product as $row)
                    <li>
                        <a href="{{lang_url('dashboard/items/'.$row->id)}}" title="{{$row->title}}">
                            <img width="180" height="180" src="{{ asset($row->thumbnail_image)}}" alt="" class="wp-post-image"/><span class="product-title">{{$row->title}}</span>
                        </a>
                          @if($row->ratio > 0 )
                        <span class="electro-price"><ins><span class="amount"> {{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}</span></ins>
                            <del><span class="amount">{{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}</span></del></span>
                            @else
                               <span class="electro-price"><span class="amount">{{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}</span></span>
                               @endif
                    </li>
                    @endforeach

        
                </ul>
            </aside>
        </div>

    </div><!-- .container -->
</div><!-- #content -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">



                        $('#filteration2_id').on('change', function (evt) {
                            $("#post-data").html('');

                            filteration2 = $("#filteration2_id").val();

                            page = 1;
                            loadMoreData(page, filteration2);

                        });
                        var filteration2 = 'not';
                        var page = 1;
                        $(window).scroll(function () {
                            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                                page++;

                                loadMoreData(page, filteration2);
                            }

                        });


                        function loadMoreData(page, filteration2 = 'not') {
                            var sub_cat_id = $('#sub_cat_id').val();
                            var amount = $('#amount').val();


                            var brands = new Array();
                            $.each($("input[name='brands[]']:checked"), function () {
                                brands.push($(this).val());

                            });
                            var colors = new Array();
                            $.each($("input[name='colors[]']:checked"), function () {
                                colors.push($(this).val());

                            });

                       
                            var load_more_url = '{{lang_url("filter")}}' + '?page=' + page + '&amount=' + amount + '&sub_cat_id=' + sub_cat_id + '&filteration2=' + filteration2 + '&colors[]='+ colors.join() +'&brands[]='+ brands.join();

                     

                            $.ajax(
                                    {
                                        url: load_more_url,
                                        type: "get",
                                        asynk: false,
                                        cache: false,

                                        beforeSend: function ()
                                        {
                                            $('.ajax-load').show();
                                        }
                                    })

                                    .done(function (data)
                                    {
                                        if (data.html == "") {
                                            $('.ajax-load').html("{{trans('cpanel.No_more_records_found')}}");
                                            return false;
                                        }
                                        $('.ajax-load').hide();

                                        $("#post-data").append(data.html);
                                        $("#post-data").find("script").each(function () {
                                            eval($(this).text());
                                        });
                                    })
                                    .fail(function (jqXHR, ajaxOptions, thrownError)
                                    {
                                        alert('server not responding...');
                                    });

                        }


                        function change(val) {
                            //alert(val);

                            $(".tab-pane").attr("id", val);
                        }


</script>

@stop