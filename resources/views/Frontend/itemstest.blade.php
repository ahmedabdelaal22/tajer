
@extends(FEI.'.master')
@section('content')

<?php

use Carbon\Carbon;

$locale = App::getLocale();
$locale_name=$locale.'_name';
?>

<div id="content" class="site-content" tabindex="-1">
    <div class="container">




        <nav class="woocommerce-breadcrumb">
            <a href="{{lang_url('/')}}">{{ trans('cpanel.home') }}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            <a href="{{lang_url('categories/'.$admin_data->sub_categories->categories->id)}}">{{$admin_data->sub_categories->categories->$locale_title}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            <a href="{{lang_url('sub-cat/'.$admin_data->sub_categories->id)}}">{{$admin_data->sub_categories->$locale_title}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i> </span>{{ $admin_data->title }}
        </nav>



        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="product">
                    <div class="single-product-wrapper">
                        <div class="single-product-wrapper">

                            <div class="product-images-wrapper">

                                <div class="images electro-gallery">

                                    <style>

                                        .zoom {
                                            display:inline-block;
                                            position: relative;
                                        }


                                        .zoom:after {
                                            content:'';
                                            display:block;
                                            width:33px;
                                            height:33px;
                                            position:absolute;
                                            top:0;
                                            right:0;

                                        }

                                        .zoom img {
                                            display: block;
                                        }

                                        .zoom img::selection { background-color: transparent; }

                                    </style>

                                    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>


                                    <script type="text/javascript">
$(document).ready(function () {

    $('#btn_submit_comments').on('click', function () {

        var req_url = "{!! lang_url('store_review') !!}";
        // var data = $('#form_comment').serialize();
        var formData = new FormData($('#form_comment')[0]);

        $.ajax({

            type: "post",
            url: req_url,
            data: formData, // Request data in JSON
            dataType: 'json', // Define data type will be JSON

            async: false,
            processData: false,
            contentType: false,
            success: function (result) {
                // alert(result);
                if (result.msg == 'success') {

                    $('#comment_id').val('');
                    location.reload();
                }
                console.log(result);
            },
            error: function (error) {
                console.log(error);
            }
        }); //end ajax
        //alert('hhh');
        return false;
    }); //end on click on btn_submit_comments
});

                                    </script>

                                    <script src="{{ asset('public/assets/'.FE .'/js/jquery.zoom.js')}}"></script>

                                    <script>
$(document).ready(function () {
    $('.ex1').zoom();
});
                                    </script>





                                    <div class="thumbnails-single owl-carousel" >

                                        <a href="{{ asset($admin_data->thumbnail_image) }}"  class="zoom ex1" title="" data-rel="prettyPhoto[product-gallery]">
                                            <img src="{{ asset($admin_data->thumbnail_image) }}"  width='555' height='320' data-echo="{{ asset($admin_data->thumbnail_image) }}" class="wp-post-image special" alt="">
                                        </a>

                                        @foreach($admin_data->items_images as $row_image)
                                        <a href="{{ asset($row_image->image) }}" class="zoom ex1" title="" data-rel="prettyPhoto[product-gallery]">
                                            <img src="{{ asset($row_image->image) }}"width='555' height='320' data-echo="{{ asset($row_image->image) }}" class="wp-post-image special" alt="">
                                        </a>

                                        @endforeach

                                    </div>

                                    <div class="thumbnails-all columns-5 owl-carousel">
                                        <a href="{{ asset($admin_data->thumbnail_image) }}" class="first " title="">
                                            <img src="{{ asset($admin_data->thumbnail_image) }}" class="wp-post-image" alt="">
                                        </a>

                                        @foreach($admin_data->items_images as $row_image)
                                        <a href="{{ asset($row_image->image) }}" class="" title="">
                                            <img src="{{ asset($row_image->image) }}" data-echo="{{ asset($row_image->image) }}" class="wp-post-image" alt="">
                                        </a>

                                        @endforeach

                                    </div>

                                </div>

                            </div>
                            <div class="summary entry-summary">
                                <span class="loop-product-categories">
                                    <a href="product-category.php" rel="tag">{{$admin_data->sub_categories->$locale_title}}</a>
                                </span><!-- .loop-product-categories -->

                                <h1 itemprop="name" class="product_title entry-title">{{$admin_data->title}}</h1>





                                <div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="../../schema.org/AggregateRating-2.php">
                                    <div class="star-rating" title="Rated 4.33 out of 5">
                                        <span style="width:86.6%">
                                            <strong itemprop="ratingValue" class="rating2">4.33</strong> out of
                                            <span itemprop="bestRating">5</span>                based on
                                            <span itemprop="ratingCount" class="rating2">3</span> customer ratings
                                        </span>
                                    </div>
                                    <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span itemprop="reviewCount" class="count">3</span> customer reviews)</a>
                                </div><!-- .woocommerce-product-rating -->





                                <div class="brand">
                                    <a href="#">{{$admin_data->brands->$locale_title}}</a>
                                </div><!-- .brand -->

                                <div itemprop="description">
                                    <!--   <ul>
                                          <li>4.5 inch HD Touch Screen (1280 x 720)</li>
                                          <li>Android 4.4 KitKat OS</li>
                                          <li>1.4 GHz Quad Core™ Processor</li>
                                          <li>20 MP front and 28 megapixel CMOS rear camera</li>
                                      </ul> -->
                                    <p>  {!! $admin_data->desc !!}</p>
                              <!--       <p><strong>SKU</strong>: FW511948218</p> -->
                                </div><!-- /description -->

                            </div><!-- .summary -->                     <div class="product-actions-wrapper">
                                <div class="product-actions">
                                    <div class="availability in-stock">
                                        Availablity: <span>In stock</span>
                                    </div><!-- /.availability -->

                                    <div itemprop="offers">

                                        <p class="price">
                                            <span class="electro-price">
                                                @if($admin_data->ratio >0)
                                                <del><span class="amount">{{ $admin_data->fixed_price }}</span></del>

                                                <ins><span class="amount">{{ $admin_data->discount_price }}</span></ins></span>
                                            @else
                                            <ins><span class="amount">{{ $admin_data->fixed_price }}</span></ins>

                                            @endif
                                        </p>

                                    </div>

                                    <form class="variations_form cart" method="post">

                                        <table class="variations">
                                      


                                            <tbody>
                                                @if(count($admin_data->items_colors))
                                                <tr>
                                                    <td class="label"><label>Color</label></td>
                                                    <td class="value">
                                                        <select  class="" id="size_id">
                                                            @foreach($admin_data->items_colors as $row1)
                                                            <option value="{{$row1->colors->$locale_name}}">{{$row1->colors->$locale_name}}</option>
                                                            @endforeach

                                                        </select>
                                                    
                                                    </td>
                                                </tr>
                                                @endif
                                                @if(count($admin_data->items_sizes))
                                                <tr>
                                                    <td class="label"><label>sizes</label></td>
                                                    <td class="value">
                                                        <select class="" id="color_id">
                                                            @foreach($admin_data->items_sizes as $row1)
                                                            <option value="{{$row1->size}}">{{$row1->size}}</option>
                                                            @endforeach

                                                        </select>
                                                     
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>


                                        <div class="single_variation_wrap">
                                            <div class="woocommerce-variation single_variation"></div>
                                            <div class="woocommerce-variation-add-to-cart variations_button">
                                                <div class="quantity">
                                                    <label>Quantity:</label>
                                                    <input type="number" name="quantity" value="1"id="qty" title="Qty" class="input-text qty text"/>
                                                </div>
                                                <button type="button" class="single_add_to_cart_button button alt" onclick="add_cart_done('{{$admin_data->id}}','{{$admin_data->discount_price}}','{{$admin_data->title}}','{{$admin_data->thumbnail_image}}')" >Add to cart</button>
                                          
                                            </div>
                                        </div>
                                    </form><!-- /.variations_form -->

                                    <!--         <div class="action-buttons">
                                                <a href="" rel="nofollow" class="add_to_wishlist" > Wishlist</a>
                                     
                                            </div> --><!-- /.action-buttons -->



                                <div class="">

                              


                                        <!--   <a class="add_to_wishlist whishstate addtowishlist" href='javascript:;' data-data='{{$admin_data->id}}'>
                                        {{ trans('cpanel.Wishlist') }} ({{$admin_data->items_wishlist->count()}})
                                        </a> -->

                                        <?php if (auth()->user()) { ?>


                                            <?php if ($wishlists == 1) { ?>


                                            <a class='addtowishlist'  href='javascript:;' data-data='{{$admin_data->id}}'>
                                                <button class="mylist single_add_to_cart_button button alt">{{trans('cpanel.Added_success')}} </button>
                                            </a>

                                                <a class='addtowishlist'  href='javascript:;' data-data='{{$admin_data->id}}'>
                                                    <button class="mylist">{{trans('cpanel.Added_success')}} </button>
                                                </a>




                                            <?php } ?>

                                            <?php if ($wishlists == 0) { ?>


                                            <a class='addtowishlist'  href='javascript:;' data-data='{{$admin_data->id}}'>
                                                <button class="mylist single_add_to_cart_button button alt">{{trans('cpanel.Add to Wish list')}}
                                                 <!-- $admin_data->items_wishlist->count() --></button>
                                            </a>

                                       



                                                <?php
                                            }
                                        }
                                        ?>

                                        <?php if (!auth()->user()) { ?> 




                                        <a class='addtowishlist'  data-toggle="modal" data-target="#exampleModal_houida" href='javascript:;' data-data='{{$admin_data->id}}'>
                                            <button class="mylist single_add_to_cart_button button alt"> {{trans('cpanel.Add to Wish list')}}</button>
                                        </a>



                                        <?php } ?>

                                </div>





                            </div><!-- /.product-actions -->
                        </div><!-- /.product-actions-wrapper -->

                    </div><!-- /.single-product-wrapper -->


                    <div class="electro-tabs electro-tabs-wrapper wc-tabs-wrapper">
                        <div class="electro-tab" id="tab-accessories">
                            <div class="container">
                                <div class="tab-content">
                                    <ul class="ec-tabs">
                                        <li class="accessories_tab active">
                                            <a href="#tab-accessories">Accessories</a>
                                        </li>
                                        <li class="description_tab">
                                            <a href="#tab-description">Description</a>
                                        </li>
                                        <li class="specification_tab">
                                            <a href="#tab-specification">Specification</a>
                                        </li>
                                        <li class="reviews_tab">
                                            <a href="#tab-reviews">Reviews</a>
                                        </li>
                                    </ul><!-- /.ec-tabs -->


                                    <div class="accessories">


                                            <div class="electro-wc-message"></div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 col-left f_right">
                                                    <ul class="products columns-3">

                                        <div class="electro-wc-message"></div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-9 col-left">
                                                <ul class="products columns-3">


                                                    <li class="product first">
                                                        <div class="product-outer">
                                                            <div class="product-inner">
                                                                <span class="loop-product-categories"><a href="product-category.php" rel="tag">Smartphones</a></span>
                                                                <a href="single-product.php">
                                                                    <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                                    <div class="product-thumbnail">

                                                                        <img data-echo="assets/images/products/4.jpg" src="assets/images/blank.gif" alt="">

                                                                    </div>
                                                                </a>

                                                                <div class="price-add-to-cart">
                                                                    <span class="price">
                                                                        <span class="electro-price">
                                                                            <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                            <del><span class="amount">&#036;2,299.00</span></del>
                                                                        </span>
                                                                    </span>
                                                                    <a rel="nofollow" href="single-product.php" class="button add_to_cart_button">Add to cart</a>
                                                                </div><!-- /.price-add-to-cart -->

                                                                <div class="hover-area">
                                                                    <div class="action-buttons">

                                                                        <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                            Wishlist</a>

                                                                        <a href="#" class="add-to-compare-link">Compare</a>
                                                                    </div>
                                                                </div>
                                                            </div><!-- /.product-inner -->
                                                        </div><!-- /.product-outer -->
                                                    </li>
                                                    <li class="product ">
                                                        <div class="product-outer">
                                                            <div class="product-inner">
                                                                <span class="loop-product-categories"><a href="product-category.php" rel="tag">Smartphones</a></span>
                                                                <a href="single-product.php">
                                                                    <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                                    <div class="product-thumbnail">

                                                                        <img data-echo="assets/images/products/3.jpg" src="assets/images/blank.gif" alt="">

                                                                    </div>
                                                                </a>

                                                                <div class="price-add-to-cart">
                                                                    <span class="price">
                                                                        <span class="electro-price">
                                                                            <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                            <del><span class="amount">&#036;2,299.00</span></del>
                                                                        </span>
                                                                    </span>
                                                                    <a rel="nofollow" href="single-product.php" class="button add_to_cart_button">Add to cart</a>
                                                                </div><!-- /.price-add-to-cart -->

                                                                <div class="hover-area">
                                                                    <div class="action-buttons">

                                                                        <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                            Wishlist</a>

                                                                        <a href="#" class="add-to-compare-link">Compare</a>
                                                                    </div>
                                                                </div>
                                                            </div><!-- /.product-inner -->
                                                        </div><!-- /.product-outer -->
                                                    </li>
                                                    <li class="product last">
                                                        <div class="product-outer">
                                                            <div class="product-inner">
                                                                <span class="loop-product-categories"><a href="product-category.php" rel="tag">Smartphones</a></span>
                                                                <a href="single-product.php">
                                                                    <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                                    <div class="product-thumbnail">

                                                                        <img data-echo="assets/images/products/2.jpg" src="assets/images/blank.gif" alt="">

                                                                    </div>
                                                                </a>

                                                                <div class="price-add-to-cart">
                                                                    <span class="price">
                                                                        <span class="electro-price">
                                                                            <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                            <del><span class="amount">&#036;2,299.00</span></del>
                                                                        </span>
                                                                    </span>
                                                                    <a rel="nofollow" href="single-product.php" class="button add_to_cart_button">Add to cart</a>
                                                                </div><!-- /.price-add-to-cart -->

                                                                <div class="hover-area">
                                                                    <div class="action-buttons">

                                                                        <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                            Wishlist</a>

                                                                        <a href="#" class="add-to-compare-link">Compare</a>
                                                                    </div>
                                                                </div>
                                                            </div><!-- /.product-inner -->
                                                        </div><!-- /.product-outer -->
                                                    </li>

                                                </ul><!-- /.products -->

                                                <div class="check-products">
                                                    <div class="checkbox accessory-checkbox">
                                                        <label>
                                                            <input checked disabled type="checkbox" class="product-check">
                                                            <span class="product-title">
                                                                <strong>This product: </strong>Ultra Wireless S50 Headphones S50 with Bluetooth
                                                            </span>
                                                            -
                                                            <span class="accessory-price">
                                                                <span class="amount">&#36;1,215.00</span>
                                                            </span>
                                                        </label>
                                                    </div>

                                                    <div class="checkbox accessory-checkbox">
                                                        <label>
                                                            <input checked type="checkbox" class="product-check">
                                                            <span class="product-title">Universal Headphones Case in Black</span>
                                                            -
                                                            <span class="accessory-price">
                                                                <span class="amount">&#36;159.00</span>
                                                            </span>
                                                        </label>
                                                    </div>

                                                    <div class="checkbox accessory-checkbox">
                                                        <label>
                                                            <input checked type="checkbox" class="product-check">
                                                            <span class="product-title">Headphones USB Wires</span>
                                                            -
                                                            <span class="accessory-price">
                                                                <span class="amount">&#36;50.00</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div><!-- /.check-products -->

                                            </div><!-- /.col -->

                                            <div class="col-xs-12 col-sm-3 col-right">
                                                <div class="total-price">
                                                    <span class="total-price-html">
                                                        <span class="amount">&#036;1,424.00</span>
                                                    </span>
                                                    for <span class="total-products">3</span>
                                                    items
                                                </div><!-- /.total-price -->

                                                <div class="accessories-add-all-to-cart">
                                                    <button type="button" class="button btn btn-primary add-all-to-cart">Add all to cart</button>
                                                </div><!-- /.accessories-add-all-to-cart -->
                                            </div><!-- /.col -->
                                        </div><!-- /.row -->

                                    </div><!-- /.accessories -->
                                </div>
                            </div>
                        </div><!-- /.electro-tab -->

                        <div class="electro-tab" id="tab-description">
                            <div class="container">
                                <div class="tab-content">
                                    <ul class="ec-tabs">
                                        <li class="accessories_tab">
                                            <a href="#tab-accessories">Accessories</a>
                                        </li>
                                        <li class="description_tab active">
                                            <a href="#tab-description">Description</a>
                                        </li>
                                        <li class="specification_tab">
                                            <a href="#tab-specification">Specification</a>
                                        </li>
                                        <li class="reviews_tab">
                                            <a href="#tab-reviews">Reviews</a>
                                        </li>
                                    </ul>

                                    <div class="electro-description">
                                        {!! $admin_data->desc !!}
                                    </div><!-- /.electro-description -->

                                    <div class="product_meta">
                                        <span class="sku_wrapper">SKU: <span class="sku" itemprop="sku">FW511948218</span></span>


                                        <span class="posted_in">Category:
                                            <a href="{{lang_url('categories/'.$admin_data->sub_categories->categories->id)}}" rel="tag">{{$admin_data->sub_categories->categories->$locale_title}}</a>
                                        </span>

                                        <span class="tagged_as">Tags:
                                            <a href="#" rel="tag">Fast</a>,
                                            <a href="#" rel="tag">Gaming</a>, <a href="#" rel="tag">Strong</a>
                                        </span>

                                    </div><!-- /.product_meta -->
                                </div>
                            </div>
                        </div><!-- /.electro-tab -->


                        <div class="electro-tab" id="tab-specification">
                            <div class="container">
                                <div class="tab-content">
                                    <ul class="ec-tabs">
                                        <li class="accessories_tab">
                                            <a href="#tab-accessories">Accessories</a>
                                        </li>
                                        <li class="description_tab">
                                            <a href="#tab-description">Description</a>
                                        </li>
                                        <li class="specification_tab active">
                                            <a href="#tab-specification">Specification</a>
                                        </li>
                                        <li class="reviews_tab">
                                            <a href="#tab-reviews">Reviews</a>
                                        </li>
                                    </ul>

                                    <h3>Technical Specifications</h3>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Brand</td>
                                                <td>{{$admin_data->brands->$locale_title}}</td>
                                            </tr>
                                            @foreach($item_specifications as $value)
                                            <tr>
                                                <td>{{$value->$locale_title}}</td>
                                                <td>{{$value->value}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div><!-- /.electro-tab -->

                            <div class="electro-tab" id="tab-reviews">
                                <div class="container">
                                    <div class="tab-content">
                                        <ul class="ec-tabs">
                                            <li class="accessories_tab">
                                                <a href="#tab-accessories">Accessories</a>
                                            </li>
                                            <li class="description_tab">
                                                <a href="#tab-description">Description</a>
                                            </li>
                                            <li class="specification_tab">
                                                <a href="#tab-specification">Specification</a>
                                            </li>
                                            <li class="reviews_tab active">
                                                <a href="#tab-reviews">Reviews</a>
                                            </li>
                                        </ul>

                                        <div id="reviews" class="electro-advanced-reviews">
                                            <div class="advanced-review row">
                                                <div class="col-xs-12 col-md-6 f_right">
                                                    <h2 class="based-title">Based on 3 reviews</h2>
                                                    <div class="avg-rating">
                                                        <span class="avg-rating-number">4.3</span> overall
                                                    </div>

                            </div>
                        </div><!-- /.electro-tab -->

                        <div class="electro-tab" id="tab-reviews">
                            <div class="container">
                                <div class="tab-content">
                                    <ul class="ec-tabs">
                                        <li class="accessories_tab">
                                            <a href="#tab-accessories">Accessories</a>
                                        </li>
                                        <li class="description_tab">
                                            <a href="#tab-description">Description</a>
                                        </li>
                                        <li class="specification_tab">
                                            <a href="#tab-specification">Specification</a>
                                        </li>
                                        <li class="reviews_tab active">
                                            <a href="#tab-reviews">Reviews</a>
                                        </li>
                                    </ul>

                                    <div id="reviews" class="electro-advanced-reviews">
                                        <div class="advanced-review row">
                                            <div class="col-xs-12 col-md-6">
                                                <h2 class="based-title">Based on 3 reviews</h2>
                                                <div class="avg-rating">
                                                    <span class="avg-rating-number">4.3</span> overall
                                                </div>



                                                <div class="rating-histogram">



                                                    <div class="rating-bar">
                                                        <div class="star-rating" title="Rated {{$reviews_count_5}} out of 5">
                                                            <span style="width:100%"></span>
                                                        </div>
                                                        <div class="rating-percentage-bar">
                                                            <span style="width:{{$reviews_count_5}}%" class="rating-percentage">

                                                            </span>
                                                        </div>
                                                        <div class="rating-count">{{$reviews_count_5}}</div>
                                                    </div>
                                                    <!-- .rating-bar -->



                                                    <div class="rating-bar">
                                                        <div class="star-rating" title="Rated {{$reviews_count_4}} out of 5">
                                                            <span style="width:80%"></span>
                                                        </div>
                                                        <div class="rating-percentage-bar">
                                                            <span style="width:{{$reviews_count_4}}%" class="rating-percentage"></span>
                                                        </div>
                                                        <div class="rating-count">{{$reviews_count_4}}</div>
                                                    </div>
                                                    <!-- .rating-bar -->




                                                    <div class="rating-bar">
                                                        <div class="star-rating" title="Rated {{$reviews_count_3}} out of 5">
                                                            <span style="width:60%"></span>
                                                        </div>
                                                        <div class="rating-percentage-bar">
                                                            <span style="width:{{$reviews_count_3}}%" class="rating-percentage"></span>
                                                        </div>
                                                        <div class="rating-count zero">{{$reviews_count_3}}</div>
                                                    </div>
                                                    <!-- .rating-bar -->



                                                    <div class="rating-bar">
                                                        <div class="star-rating" title="Rated {{$reviews_count_2}} out of 5">
                                                            <span style="width:40%"></span>
                                                        </div>
                                                        <div class="rating-percentage-bar">
                                                            <span style="width:{{$reviews_count_2}}%" class="rating-percentage"></span>
                                                        </div>
                                                        <div class="rating-count zero">{{$reviews_count_2}}</div>
                                                    </div>
                                                    <!-- .rating-bar -->



                                                    <div class="rating-bar">
                                                        <div class="star-rating" title="Rated {{$reviews_count_1}} out of 5">
                                                            <span style="width:20%"></span>
                                                        </div>
                                                        <div class="rating-percentage-bar">
                                                            <span style="width:{{$reviews_count_1}}%" class="rating-percentage"></span>
                                                        </div>
                                                        <div class="rating-count zero">{{$reviews_count_1}}</div>
                                                    </div>
                                                    <!-- .rating-bar -->


                                                </div>
                                            </div><!-- /.col -->

                                            <div class="col-xs-12 col-md-6">
                                                <div id="review_form_wrapper">
                                                    <div id="review_form">
                                                        @if(auth()->user())

                                                        <div id="respond" class="comment-respond">
                                                            <h3 id="reply-title" class="comment-reply-title">{{ trans('cpanel.Add_review') }}
                                                                <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel reply</a>
                                                                </small>
                                                            </h3>



                                                            {!! Form::open(['method'=>'POST','files'=>true,'id'=>'form_comment','class'=>'comment-form','action'=>'Frontend\ReviewsController@store','role'=>'form',' accept-charset'=>'UTF-8']) !!}

                                                            <p class="comment-form-rating">
                                                                <label>{{ trans('cpanel.Your_Rating') }}</label>
                                                            </p>
<!-- <script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/jquery.min.js')}}"></script> -->



                                                            <input type="hidden"  name="rate" id="rating_val_{{$admin_data->id}}" value="0"/>
                                                            <select name="rate" class='rating' id='rating_{{$admin_data->id}}' data-id='rating_{{$admin_data->id}}'>
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>
                                                                <option value="5" >5</option>
                                                            </select>




                                                            <p class="comment-form-comment">
                                                                <label for="comment">{{ trans('cpanel.Your_Review') }}</label>
                                                               <!--  <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea> -->
                                                                {!! Form::textarea('comment','', array('id'=>'comment_id','cols'=>"45",'rows'=>"8",'aria-required'=>"true")) !!}

                                                                {!! Form::hidden('items_id',$admin_data->id, array('id'=>'post_id') ) !!}
                                                            </p>



                                                            <p class="form-submit">

                                                                <input name="submit" type="submit" id="btn_submit_comments" class="submit" value="{{ trans('cpanel.Add_review') }}" />
                                                            </p>


                                                            {!! Form::close() !!}

                                                            <input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment_disabled" value="c7106f1f46" />
                                                            <script>(function () {
                                                                    if (window === window.parent) {
                                                                        document.getElementById('_wp_unfiltered_html_comment_disabled').name = '_wp_unfiltered_html_comment';
                                                                    }
                                                                })();</script>
                                                            </form><!-- form -->
                                                        </div><!-- #respond -->
                                                        @endif
                                                    </div>
                                                </div>

                                            </div><!-- /.col -->
                                        </div><!-- /.row -->

                                        <div id="comments">

                                            <ol class="commentlist">



                                                @foreach($admin_data->items_reviews as $row_review)
                                                <li itemprop="review" class="comment even thread-even depth-1">

                                                    <div id="comment-390" class="comment_container">

                                                        <img alt='' src="{{ asset('public/uploads/user_img')}}/{{$row_review->user->image}}" class='avatar' height='60' width='60' />

                                                        <div class="comment-text">
                                                            <img alt='' src="{{ asset('public/uploads/rate_stars')}}/{{$row_review->rate}}.png" />
                                                            <div itemprop="description" class="description">
                                                                <p>{{$row_review->comment}}</p>
                                                            </div>

                                                            <p class="meta">
                                                                <strong itemprop="author">{{$row_review->user->name}}</strong> &ndash;
                                                                <time itemprop="datePublished" datetime="{{\Carbon\Carbon::createFromTimeStamp(strtotime($row_review->created_at))->format('Y-m-d H:i:s')}}">
                                                                    {{\Carbon\Carbon::createFromTimeStamp(strtotime($row_review->created_at))->format('M d, Y')}}
                                                                </time>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </li><!-- #comment-## -->
                                                <!-- Set rating -->

                                                @endforeach





                                            </ol><!-- /.commentlist -->

                                        </div><!-- /#comments -->

                                        <div class="clear"></div>
                                    </div><!-- /.electro-advanced-reviews -->

                                </div>
                            </div>
                        </div><!-- /.electro-tab -->
                    </div><!-- /.electro-tabs -->




                    @if(count($related_products)>0)
                    <div class="related products">
                        <h2>{{ trans('cpanel.Related_Products') }}</h2>

                        <ul class="products columns-5">

                            @foreach($related_products as $row_related)
                            <li class="product">
                                <div class="product-outer">
                                    <div class="product-inner">
                                        <span class="loop-product-categories"><a href="product-category.php" rel="tag">  {{$admin_data->sub_categories->$locale_title}}</a></span>
                                        <a href="single-product.php">
                                            <h3>{!! $row_related->title !!}</h3>
                                            <div class="product-thumbnail">
                                                <img data-echo="{{ asset($row_related->thumbnail_image)}}" src="assets/images/blank.gif" alt="">
                                            </div>
                                        </a>

                                        <div class="price-add-to-cart">
                                            <span class="price">
                                                <span class="electro-price">
                                                    @if($row_related->ratio >0)
                                                    <del><span class="amount">{{ $row_related->fixed_price }}</span></del>

                                                    <ins><span class="amount">{{ $row_related->discount_price }}</span></ins></span>
                                                @else
                                                <ins><span class="amount">{{ $row_related->fixed_price }}</span></ins></span>

                                            @endif
                                            </span>

                                            @foreach($row_related->items_sizes as $row1)
                                            <input type="hidden"  name="sizes[]"class="row{{$row_related->id}}" value="{{$row1->size}}">
                                            @endforeach

                                            @foreach($row_related->items_colors as $row1)

                                            <input type="hidden"  name="colors[]"class="color{{$row_related->id}}" value="{{$row1->colors->$locale_name}}">
                                            @endforeach

                                            <a rel="nofollow" href="javascript:add_cart('{{$row_related->id}}','{{$row_related->discount_price}}','{{$row_related->title}}','{{$row_related->thumbnail_image}}');" class="button add_to_cart_button"></a>

                                        </div><!-- /.price-add-to-cart -->

                                        <div class="hover-area">
                                            <div class="action-buttons">
                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                <a href="#" class="add-to-compare-link">Compare</a>
                                            </div>
                                        </div>
                                    </div><!-- /.product-inner -->
                                </div><!-- /.product-outer -->
                            </li>

                            @endforeach

                        </ul><!-- /.products -->
                    </div><!-- /.related -->

                    @endif
                </div><!-- /.product -->
            </main><!-- /.site-main -->
        </div><!-- /.content-area -->
    </div><!-- /.container -->
</div><!-- /.site-content -->


<script type="text/javascript">

    $(document).ready(function () {
        $(".addtowishlist").on('click', function (evt) {


            var link_data = $(this).data('data');
            var fun_url3 = "{!! lang_url('wishlist') !!}";
            $.ajax({
                type: "GET",
                url: fun_url3,
                data: ({items_id: link_data}),
                success: function (data) {
// alert(data);
                    if (data == 'added')
                    {
// alert(data);
                        $('.mylist').html('{{trans("cpanel.Added_success")}}');
// setAttribute("fill", "green");

// $('a[data-data="'+link_data+'"] > i.whishstate').css({"path":"green !important"});
                    } else {
// alert(data);

// $('a[data-data="'+link_data+'"] > i.whishstate').css({"path":"red !important"});

                        $('.mylist').html('{{trans("cpanel.Add to Wish list")}}');
                    }
                }
            });
        });
    });</script>


<!-- Set rating -->
<script type='text/javascript'>
    $(document).ready(function () {
        $('#rating_<?php echo $admin_data->id; ?>').barrating('set', '0');
    });</script>


<!-- Start Rate Script -->
<script src="{{ asset('public/assets/' .'rating/jquery-bar-rating-master/dist/jquery.barrating.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
//                                    if ($(".rating").length > 0) {
    $(function () {
        $('.rating').barrating({
            theme: 'fontawesome-stars',
            onSelect: function (value, text, event) {

// Get element id by data-id attribute
                var el = this;
                var el_id = el.$elem.data('id');
// rating was selected by a user
                if (typeof (event) !== 'undefined') {

                    var split_id = el_id.split("_");
                    var postid = split_id[1]; // postid
                    $('#rating_val_' + postid).val(value);
// AJAX Request
                    /*    $.ajax({
                     url: 'rating_ajax.php',
                     type: 'post',
                     data: {postid: postid, rating: value},
                     dataType: 'json',
                     success: function (data) {
                     // Update average
                     var average = data['averageRating'];
                     $('#avgrating_' + postid).text(average);
                     }
                     });*/
                }
            }
        });
    });
    
    
    
        function add_cart_done(id, price,name,image) {
        var name = name;
         var item_id = id;
          var image = image;
           var price = price;

         var qty= $('#qty').val(); 
         var color= $('#color_id').val(); 
            var size= $('#size_id').val(); 

        
  
        var fun_url3 = "{!! url('add_to_cart') !!}";
        
            var data = {

                name: name, item_id: item_id, qty:qty, image: image, price: price, color: color, size: size, _token: '{{csrf_token()}}'

            };
            $.ajax({
                type: "POST",
                url: fun_url3,
                data: data,
                success: function (data) {
                         
                    if (data == 'error')
                    {
                        $('#add-error').modal('show');
                    } else {
                        $('#add_cart-done').modal('show');
                    }
                }

            });
//        
        
    }
//                                    }

</script>

@stop
