@extends(FEI.'.master')
@section('content')
<?php $title = $lang . '_title' ?>
@include("Frontend.include.subHeader")


  <!-- Star Section categories -->
    <section class="categories">
        <div class="container">
            <div class="row">

        
                <div class="col-lg-3">
                <form class="all-filter" method="get" action="{{lang_url('filter-cat')}}">
                       <input type="hidden" name="cat_id" value="{{$data['cat_id']}}">
                    <div class="filter">
                        <div class="form1">
                            <h2>{{trans('cpanel.Category')}}</h2>
                              <h2>{{trans('cpanel.sub_categories')}}</h2>





                                                @foreach($data['all_sub_cat'] as $row)
                                        <?php
                                        if (in_array($row->id, $data['sub_cat'])) {
                                            $check = 'checked="checked"';
                                        } else {
                                            $check = '';
                                        }
                                        ?>
                              


                                              <label>   
                                <input type="checkbox"  <?= $check ?>name="sub_cat[]" id="" value="{{ $row->id}}">
                                <span class="lbl-text"> {{ $row->title}}</span>
                            </label>
                                        @endforeach

                        </div>
                        <hr>
                        <div class="form2">
                            <h2>{{trans('cpanel.Price')}}</h2>
                            <div class="input-s">
                                <input class="float-left" value="{{$to_price}}" type="text" name="to_price" placeholder="{{trans('cpanel.to')}}">
                                <input class="float-left" value="{{$from_price}}" type="text" name="from_price" placeholder="{{trans('cpanel.from')}}">

                                <span class="float-left text-left"> 1.200.00{{trans('cpanel.R_S')}}</span>
                                <span class="">5 {{trans('cpanel.R_S')}}</span>

                            </div>
                        </div>
                        <hr>
                        @if(count($items_colors))
                            <div class="form3">
                                <h2>{{trans('cpanel.colors')}}</h2>
                                @foreach($items_colors as $items_colors)
                                    <?php
                                    if (in_array($items_colors->id, $data['colors'])) {
                                        $check = 'checked="checked"';
                                    } else {
                                        $check = '';
                                    }
                                    ?>
                                    <label>
                                        <input type="checkbox" {{ $check }} name="colors[]" value="{{ $items_colors->id }}">
                                        <span class="lbl-text">{{ $items_colors->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <hr>
                        @endif

                        @if(count($items_sizes))

                            <div class="form4">
                                <h2>{{trans('cpanel.sizes')}}</h2>
                                @foreach( $items_sizes as $items_size)
                                    <?php
                                    if (in_array($items_colors->id, $data['sizes'])) {
                                        $check = 'checked="checked"';
                                    } else {
                                        $check = '';
                                    }
                                    ?>
                                    <label>
                                        <input type="checkbox" {{ $check }} name="sizes[]" id="" value="{{ $items_size->id }}">
                                        <span class="lbl-text">{{ $items_size->size }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <hr>
                        @endif



                        <div class="form5">
                            <h2>{{trans('cpanel.Brands')}}</h2>
       




                                                @foreach($data['all_brands'] as $row)
                                        <?php
                                        if (in_array($row->id, $data['brand'])) {
                                            $check = 'checked="checked"';
                                        } else {
                                            $check = '';
                                        }
                                        ?>
                              


                                              <label>   
                                <input type="checkbox"  <?= $check ?>name="brands[]" id="" value="{{ $row->id}}">
                                <span class="lbl-text"> {{ $row->title}}</span>
                            </label>
                                        @endforeach
                        </div>




                        <hr>
                        <div class="new">
                            <div class="row m-0">


       @foreach(@$latest_product_data as $row)
                                <div class="col-lg-12 col-md-6">
                                    <div class="box-pro">
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="{{ asset($row->thumbnail_image)}}">
                                            </div>
                                            <div class="col-6">
                                                   <p>{!! $row->title !!}</p>
                                                <span>{!! $row->discount_price !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
 @endforeach


                            </div>
                          
                        </div>
                       
                    </div>
                    <div class="price_slider_amount">
                        <button type="submit"class="btn btn-block">{{trans('cpanel.Filter')}}</button>
                    </div>
                </form>
                </div>

            
                <div class="col-lg-9">
                    <div class="prodect">
                            <div class="row">

                            <div class="col-12 text-left">
                                <button class="btn  grid">
                                    <i class="fa fa-th fa-2x "></i>
                                </button>
                                <button class="btn list">
                                    <i class="fa fa-th-list fa-2x active "></i>
                                </button>

                            </div>
                            <div class="col-12">

                      @if(count($data['items'])==0)
                
                                        <h1 class="page-title nomore">{{trans('cpanel.No_data_availble1')}}</h1>
                  
                        @else
                                <div class="row" id="post-data">

                  @include(FE.'.items_by_subcategory_load_more')
<!-- 
                                    <div class="col-lg-12 g-l">
                                            <div class="box-prodect">
                                                    <div class="row">
                                                            <div class="col-lg-4 img-col text-center">
                                                               <a href="itemdetails.html">
                                                                    <img src="Images/Demo/item_image_1.png" alt="">
                                                               </a>
                                                                <span class="sell">50%</span>
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                            <div class="col-lg-8 col-info">
                                                               <div class="info">
                                                                    <p class="text-lg-right text-sm-center">فستان نهاري للخروج بالون الاحمر و من هذا المنط نهاري للخروج بالون</p>
                                                                <span class="price text-lg-right text-sm-center d-lg-inline-block d-sm-block">400.00</span>
                                                                <span class="old-price text-lg-right text-sm-center d-lg-inline-block d-sm-block">400.00</span>
                                                                <a href="itemdetails.html" class="btn btn-info mr-lg-0 ml-lg-0 mr-sm-auto ml-sm-auto">شراء الان</a>
                                                               </div>
                                                            </div>
                                                          </div>
                                                </div>
                                    </div> -->





      

                        <div class="ajax-load text-center" style="display:none">

                            <p><img src="{{ asset('public/assets/' .FE.'/loader.gif')}}">{{trans('cpanel.Loading_More_post')}}</p>
                        </div>



        
                                </div>

                                  @endif 
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </section>
    <!-- End Section categories -->
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

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
        input_wishlist.children('.mylist').html('{{trans("cpanel.Added_success")}}');
        } else {

        input_wishlist.children('.mylist').html('{{trans("cpanel.Add to Wish list")}}');
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

    var message = '{{trans('
            cpanel.You_Must_Login_First_To_Add_Item_To_Wishlist')}}'
            alert(message);
    });
    });</script>



<script type="text/javascript">
    var filter_cat_type;
    var page = 1;
    $(document).ready(function () {
    $('#filter_cat_type').on('change', function (evt) {
    $("#post-data").html('');
    filter_cat_type = $("#filter_cat_type").val();
    page = 1;
    loadMoreData(page, filter_cat_type);
    });
    });
//    loadMoreData(page); //initial content load
    $(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
    page++;
    loadMoreData(page, filter_cat_type);
    }
    });
    var load_more_url = '{{lang_url("categories/")."/".$data['cat_id']}}';
//    alert(load_more_url);
    function loadMoreData(page, filter_cat_type = 'menu_all') {
//        alert('sss');
    $.ajax({
    url: load_more_url + '?page=' + page + '&filter_cat_type=' + filter_cat_type,
            type: "get",
            asynk:false,
            cache: false,
            beforeSend: function (){
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
//            alert('server not responding...');
            });
    }

</script>



<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(function() {
    var max = $('#maxprice').val();
    var end = $('#endprice').val();
    var res = max.split(",");
    $("#slider-range").slider({

    range: true,
            min: 0,
            max: end,
            values: [ res[0], res[1] ],
            slide: function(event, ui) {
            $("#amount").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
            }
    });
    $("#amount").val($("#slider-range").slider("values", 0) +
            " - " + $("#slider-range").slider("values", 1));
    });
</script>

@if(auth()->check())
    <script>
        function www(item_id){
            $.ajax({
                type: "GET",
                url: "{!! lang_url('wishlist') !!}",
                data: ({items_id: item_id}),
                success: function (data) {
                    if (data == 'added')
                    {
                        $("#"+item_id).html("<i class=\"fa fa-heart inWishList\"></i>");
                    } else {
                        $("#"+item_id).html("<i class=\"fa fa-heart-o inWishList\"></i>");

                    }
                }
            });
        }
    </script>
@else
    <script>
        function www(item_id){

            alert("you must to login firstly ") ;
        }
    </script>
@endif

@stop
