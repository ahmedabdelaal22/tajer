@extends(FEI.'.master')
@section('content')

<?php

use Carbon\Carbon;

$locale = App::getLocale();
?>

<?php
$url_segment = \Request::segment(1);
if ($url_segment == 'ar' || $url_segment == 'en') {
    App::setLocale($url_segment);
    $locale = App::getLocale();
} else {
    App::setLocale('ar');
    $locale = App::getLocale();
}

session(['sess_locale' => $locale]);
$sess_locale = session('sess_locale');
//  if(auth()->user()){
$sess_user_id = session('user_id');
?>

<div id="content" class="site-content" tabindex="-1">
    <div class="container-fluid">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">


                <div class="row">

                    <form method="get" action="{{lang_url('filter')}}">
                        <input type="hidden" name="sub_cat_id" value="{{$data['sub_cat_id']}}">
                        <div class="col-lg-2 col-xs-12 col-md-offset-1 m_top">

                            <aside class="widget widget_electro_products_filter">
                                <h3 class="widget-title">{{trans('cpanel.Filters')}}</h3>

                                <aside class="widget woocommerce widget_layered_nav">
                                    <h3 class="widget-title">{{trans('cpanel.Countries')}}</h3>
                                    <ul>
                                        @foreach($data['all_countries'] as $row)
                                        <li style="">
                                            <!--                                        <a href="#"> -->
                                            <input type="checkbox" name="countries[]" value="{{$row->id}}">
                                            {{$row->name}}
                                            <!--                                            </a> -->
                                        </li>
                                        @endforeach

                                    </ul>
    <!--                                <p class="maxlist-more"><a href="#">+ Show more</a></p>-->
                                </aside>


                                <aside class="widget woocommerce widget_layered_nav">
                                    <h3 class="widget-title">{{trans('cpanel.Brands')}}</h3>
                                    <ul>
                                        @foreach($data['all_brands'] as $row)
                                        <li style="">
                                            <input type="checkbox" name="brands[]" value="{{$row->id}}">{{$row->title}}
                                        </li>
                                        @endforeach
                                    </ul>
    <!--                                <p class="maxlist-more"><a href="#">+ Show more</a></p>-->
                                </aside>


                                <aside class="widget woocommerce widget_layered_nav">
                                    <h3 class="widget-title">{{trans('cpanel.Status')}}</h3>
                                    <ul>
                                        @foreach($data['all_status'] as $row)
                                        <li style="">
                                            <input type="checkbox" name="status[]"value="{{$row->id}}">
                                            {{$row->title}}
                                        </li>
                                        @endforeach
                                    </ul>
    <!--                                <p class="maxlist-more"><a href="#">+ Show more</a></p>-->
                                </aside>


                                <aside class="widget woocommerce widget_layered_nav">
                                    <h3 class="widget-title">{{trans('cpanel.type_price')}}</h3>

                                    <ul>

                                        <li style="">
                                            <input type="radio" checked="checked" name="type_price"value="2">
                                            {{trans('cpanel.Fixed_Price')}}
                                        </li>
                                        <li style="">
                                            <input type="radio" name="type_price"value="1">
                                            {{trans('cpanel.bid_Price')}}

                                        </li>

                                    </ul>




                                </aside>


                                <input type="hidden" id="endprice" value="{{$maxprice}}"  >

                                <aside class="widget woocommerce widget_price_filter">

                                    <p>
                                        <label  for="amount"> {{trans('cpanel.Price')}}:</label>
                                        <input type="text" id="amount" name="amount"  style="border:0; color:#f6931f; font-weight:bold;"value="">
                                        <input type="hidden" id="maxprice" value="{{$minprice}},{{$maxprice}}"  >

                                    </p>

                                    <div id="slider-range"></div>

                                    <div class="price_slider_amount">
                                        <button type="submit"class="button">{{trans('cpanel.Filter')}}</button>
                                        <!--                    <a href="#" class="button">Filter</a>-->
                                                            <!-- <div style="" class="price_label">Price: <span class="from">$428</span> — <span class="to">$3485</span></div> -->
                                        <div class="clear"></div>
                                    </div>


                                </aside>


                        </div>
                    </form>
                    <div class="col-lg-6 col-xs-12">

                        <!--
                                   <nav class="woocommerce-breadcrumb" ><a href="home.html">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>
                                        Categories</nav>
                        -->

                        <header class="page-header">
                            <h1 class="page-title">{{$data['all_sub_cat_row']->title}}</h1>
                            <!--<p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>-->
                        </header>

                        <div class="shop-control-bar">

                            <form class="woocommerce-ordering form-electro-wc-ppp" method="get">
                                <select name="orderby" class="orderby" id="filter_sub_type">
                                    <option value="menu_all"  selected='selected'>{{trans('cpanel.Default_Sorting')}}</option>

                                    <option value="end_date_asc" >{{trans('cpanel.End_date:_Asc')}}</option>
                                    <option value="end_date_desc">{{trans('cpanel.End_date:_Dec')}}</option>

                                    <option value="start_date_asc" >{{trans('cpanel.Start_date:_Asc')}}</option>
                                    <option value="start_date_desc" >{{trans('cpanel.Start_date:_Dec')}}</option>

                                    <option value="price_asc" >{{trans('cpanel.Price:Asc')}}</option>
                                    <option value="price_desc" > {{trans('cpanel.Price:_Dec')}}</option>


                                </select>
                            </form>



<!--                            <form class="form-electro-wc-ppp"><select name="ppp" onchange="this.form.submit()" class="electro-wc-wppp-select c-select"><option value="15"  selected='selected'>Show 15</option><option value="-1" >Show All</option></select>
                            </form>-->


                            <!--                            <nav class="electro-advanced-pagination">
                                                            <form method="post" class="form-adv-pagination"><input id="goto-page" size="2" min="1" max="2" step="1" type="number" class="form-control" value="1" /></form> of 2<a class="next page-numbers" href="#">&rarr;</a>

                                                        </nav>-->
                        </div>
                        @if(count($data['items'])==0)
                        <div id="content" class="site-content" tabindex="-1">
                            <div class="container-fluid">
                                <div class="col-lg-6 col-xs-12">
                                    <header class="page-header">
                                        <h1 class="page-title nomore">{{trans('cpanel.items_not_found')}}</h1>
                                        <!--<p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>-->
                                    </header>
                                </div>
                            </div>
                        </div>
                        @else

                        <ul class="products columns-3" id="post-data">


                        </ul>
                        @endif
                        <div class="ajax-load text-center" style="display:none">
                            <p><img src="{{ asset('public/assets/' .FE.'/loader.gif')}}">{{trans('cpanel.Loading_More_post')}}</p>
                        </div>


                        <!--                        <div class="shop-control-bar-bottom">
                                                    <form class="form-electro-wc-ppp">
                                                        <select class="electro-wc-wppp-select c-select" onchange="this.form.submit()" name="ppp"><option selected="selected" value="15">Show 15</option><option value="-1">Show All</option></select>
                                                    </form>
                                                    <p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>
                                                    <nav class="woocommerce-pagination">
                                                        <ul class="page-numbers">
                                                            <li><span class="page-numbers current">1</span></li>
                                                            <li><a href="#" class="page-numbers">2</a></li>
                                                            <li><a href="#" class="next page-numbers">→</a></li>
                                                        </ul>
                                                    </nav>
                                                </div>-->

                    </div>

                    <div class="col-lg-2 col-xs-12 m_top">
                        <aside class="widget widget_products">
                            <h3 class="widget-title">{{trans('cpanel.Latest_Products')}}</h3>
                            <ul class="product_list_widget">

                                @foreach($data['end'] as $row)
                                <li>
                                    <a href="{{lang_url('dashboard/items/'.$row->id)}}" title="{{$row->title}}">
                                        <img width="180" height="180" src="{{ asset($row->thumbnail_image)}}" alt="{{$row->title}}" class="wp-post-image">
                                        <span class="product-title">{{$row->title}}</span>
                                    </a>
                                    <span class="electro-price"><ins><span class="amount">
                                                @if($row->type==2)
                                                {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}
                                                @else
                                                @if($row->items_bids->max('price')>0)
                                                {{number_format($row->items_bids->max('price'))}} {{trans('cpanel.R_S')}}
                                                @else
                                                {{number_format($row->start_bid)}} {{trans('cpanel.R_S')}}
                                                @endif
                                                @endif



                                            </span></ins>
                                    </span>
                                </li>

                                @endforeach

                            </ul>
                        </aside>


                        <aside class="widget widget_text">
                            <div class="textwidget">
                                <a href="#">
                                    <img src="{{ asset('public/assets/'.FE.'/images/banner/panner2.jpg')}}" alt="Banner"></a>
                            </div>
                        </aside>


                    </div>

                </div>


            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .container -->
</div><!-- #content -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script type="text/javascript">
$(document).ready(function () {
    $(".addtowishlist").on('click', function (evt) {

        var input_wishlist = $(this);
        var link_data = input_wishlist.data('data');
// alert(link_data);
        var fun_url3 = "{!! lang_url('wishlist') !!}";
        $.ajax({
            type: "GET",
            url: fun_url3,
            data: ({items_id: link_data}),
            success: function (data) {
                // alert(data);
                if (data == 'added')
                {
                    console.log(evt);
                    input_wishlist.children('svg').addClass('sp_color');
                } else {

                    input_wishlist.children('svg').removeClass('sp_color');
                }
            }
        });
        return false;
    });
});</script>



<script type="text/javascript">
    $(document).on('change', '#product', function () {
        var product_GUID = $('#product').val();
        // alert(product_GUID);
        var fun_url = "{!! lang_url('/') !!}";
        $.ajax({
            type: 'post',
            //  dataType: 'json',
            data: {'product_GUID': product_GUID},
            url: fun_url,
            success: function (respose) {


            }


        });
    });</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".addtowishlist_login").on('click', function (evt) {

            var message = '{{trans("cpanel.You_Must_Login_First_To_Add_Item_To_Wishlist")}}';
            alert(message);
        });
    });</script>



<!--<script type="text/javascript">

    var page = 1;
//    loadMoreData(page); //initial content load
    $(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
    page++;
    loadMoreData(page);
    }
    });
    var load_more_url = '{{lang_url("sub-cat/")."/".$data['sub_cat_id']}}';
//    alert(load_more_url);
    function loadMoreData(page) {
//        alert('sss');
    $.ajax(
    {
    url: load_more_url + '?page=' + page,
            type: "get",
            beforeSend: function ()
            {
            $('.ajax-load').show();
            }
    })

            .done(function (data)
            {
            if (data.html == " ") {
            $('.ajax-load').html("No more records found");
            return;
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

</script>-->

<script type="text/javascript">
    var filter_sub_type;
    var page = 1;
    $(document).ready(function () {
        $('#filter_sub_type').on('change', function (evt) {
            $("#post-data").html('');
            filter_sub_type = $("#filter_sub_type").val();
            page = 1;
            loadMoreData(page, filter_sub_type);
        });


    });

    loadMoreData(page, filter_sub_type);



    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page, filter_sub_type);
        }
    });
    function loadMoreData(page, filter_sub_type = 'menu_all') {

        var load_more_url = '{{lang_url("sub-cat/")."/".$data['sub_cat_id']}}';
        $.ajax(
                {
                    url: load_more_url + '?page=' + page + '&filter_sub_type=' + filter_sub_type,
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

</script>



<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function () {
var max = $('#maxprice').val();

var end = $('#endprice').val();

var res = max.split(",");

$("#slider-range").slider({

range: true,
min: 0,
max: end,
values: [res[0], res[1]],
slide: function (event, ui) {
$("#amount").val( ui.values[ 0 ] + " - " + ui.values[ 1 ]);
}
});
$("#amount").val( $("#slider-range").slider("values", 0) +
" - " + $("#slider-range").slider("values", 1));

});
</script>




@stop
