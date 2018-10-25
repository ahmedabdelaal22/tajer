@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")
<?php

use Carbon\Carbon;

$locale = App::getLocale();
$locale_name = $locale . '_name';
?>

    <!-- Start Scection item Details -->
    <section class="item-details prodect">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{lang_url('/')}}">{{ trans('cpanel.home') }}</a>
                        </li>


                        <li>
                            <i class="fa fa-arrow-left"></i>
                        </li>

                        <li>
                            <a href="{{lang_url('categories/'.$admin_data->sub_categories->categories->id)}}">{{$admin_data->sub_categories->categories->$locale_title}}</a>
                        </li>


                        <li>
                            <i class="fa fa-arrow-left"></i>
                        </li>
                        <li>
                            <a href="#">{{$admin_data->sub_categories->$locale_title}}</a>
                        </li>

                       <li>
                            <i class="fa fa-arrow-left"></i>
                        </li>
                        <li>
                            <a href="#">{{ $admin_data->title }}</a>
                        </li>

                    </ul>







                </div>


                <div class="col-lg-6">
                    <div class="gallery">
                        <div class="row">


                            <div class="col-12">
                                <img class="img-big" src="{{ asset($admin_data->thumbnail_image) }}" alt="">
                            </div>



                          


            @foreach($admin_data->items_images as $row_image)
                                  

                             <div class="col-4">
                                <img class="img-smaill" src="{{ asset($row_image->image) }}" alt="">
                            </div>

                                        @endforeach

               
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="items-info">
                        <div class="col-12">
                            <h1>{{$admin_data->title}}</h1>
                        </div>
                        <div class="col-12">
                            <ul class="list-unstyled">
                                <li>{{$admin_data->brands->$locale_title}}</li>
                               <!--  <li>كود المنتج 215G54AAF</li> -->
                  <!--               <li>
                                    <i class="fa fa-star checkd"></i>
                                    <i class="fa fa-star checkd"></i>
                                    <i class="fa fa-star checkd"></i>
                                    <i class="fa fa-star checkd"></i>
                                    <i class="fa fa-star "></i>
                                </li> -->
                            </ul>
                        </div>
                        <div class="col-12">
                            <p><?php echo strip_tags($admin_data->desc) ;?></p>
                        </div>
                      <form class="variations_form cart" method="post">
                            <table class="table">

                                <tbody>
                                        <tr>
                                                <th class="name" colspan="6">{{ trans('cpanel.The_sellers_name') }}</th>
                                                <td class="text-left text-dark price">{{$admin_data->user->name}}</td>
                                            </tr>
                                    <tr>
                                        
                                        <th class="name" colspan="10">{{ trans('cpanel.Price') }}
                                        
                                        </th>
                                       <!--  <td class="text-left price">{{ $admin_data->discount_price }}</td> -->


                                        @if(@$admin_data->ratio >0)
                                            <td class="text-left price mr-auto"><del><span class="amount">{{ $admin_data->fixed_price }}</span></del></td>

                                               <td class="text-left price" ><ins><span class="amount">{{ $admin_data->discount_price }}</span></ins></td>
                                            @else
                                    <td class="text-left price"><ins><span class="amount">{{ $admin_data->fixed_price }}</span></ins></td>

                                            @endif



                                    </tr>
                                @if(count(@$admin_data->items_colors))
                                    <tr>
                                        <th class="name" colspan="20">{{ trans('cpanel.colors') }}</th>
                                        <td class="text-left">

                                        @foreach($admin_data->items_colors as $row1)
                                            <label class="c-color">
                                                <input type="radio" value="{{$row1->colors->color}}" class="color_id">
                                                <span class="color" style=" background-color:#{{$row1->colors->color}};"></span>
                                            </label>
                                        @endforeach

                                
                                       
                                        </td>
                                    </tr>
                                 @endif
                                  @if(count(@$admin_data->items_sizes))
                                    <tr>
                                        <th class="name" colspan="20">{{ trans('cpanel.sizes') }}</th>
                                        <td class="text-left">
                                          @foreach($admin_data->items_sizes as $row1)
                                            <label class="c-size">
                                                    <input type="radio" value="{{$row1->size}}" name="itemsize" class="size_id">
                                                <span class="size">{{$row1->size}}</span>
                                            </label>
                                          @endforeach
                                  

                                        </td>
                                    </tr>
                                    @endif













                                    <tr>
                                        <th class="name" colspan="20">{{ trans('cpanel.count') }}</th>
                                        <td class="text-left counter">
                                            <button type="button" class="inc">+</button>
                                            <input class="myinput qty text" type="text" name="quantity" readonly disabled value="1" id="qty" title="Qty">
                                            <button type="button" class="dec">-</button>
                                        </td>
                                    </tr>




                                          
                                       





                                </tbody>
                            </table>

                           <!--  <a href="mycart.html" type="submit" class="btn-block btn">شراء الان</a> -->
                                     <button type="button" class="btn-block btn single_add_to_cart_button button alt" onclick="add_cart_done('{{$admin_data->id}}','{{$admin_data->discount_price}}','{{$admin_data->title}}','{{$admin_data->thumbnail_image}}','{{$admin_data->user_id}}')" >{{ trans('cpanel.add_to_cart') }}</button>
                        </form>
                    </div>
                </div>


         @if(count($related_products)>0)
                <div class="col-lg-12">
                    <h2>{{ trans('cpanel.Related_Products') }}</h2>
                </div>


            @foreach($related_products as $row_related)
                <div class="col-lg-3 ">
                        <div class="box-prodect">
                                <div class="row">
                                        <div class="col-lg-12  text-center">
                                           <a href="{{lang_url('dashboard/items/'.$row_related->id)}}">
                                                <img src="{{ asset($row_related->thumbnail_image)}}" alt="">
                                           </a>
                                        
                                         @if($row_related->ratio > 0)
                                         @if(@$row->ratio != "")

                                            <span class="sell">

                                            {{@$row->ratio}}%
                                        </span>
                                         @endif
                                            @endif

                                        @if($row_related->user_wishlist == 1)
                                            <span id='{{$row_related->id}}' onclick="www({{ $row_related->id }})">

                                                <i class="fa fa-heart inWishList"></i>
                                            </span>
                                        @else
                                            <span id='{{$row_related->id}}' onclick="www({{ $row_related->id }})">

                                                <i class="fa fa-heart-o inWishList"></i>
                                            </span>
                                        @endif
                                        </div>
                                        <div class="col-lg-12 col-info">
                                           <div class="info">
                                                <p class="text-center">{!! $row_related->title !!}</p>

                                                    @if($row_related->ratio >0)
                                                   <span class="old-price d-block text-center">{{ $row_related->fixed_price }}</span>

                                                    <span class="price d-block text-center">{{ $row_related->discount_price }}</span>
                                                @else
                                               <span class="price d-block text-center">{{ $row_related->fixed_price }}</span>

                                            @endif
                                          





                                            @foreach($row_related->items_sizes as $row1)
                                            <input type="hidden"  name="sizes[]"class="row{{$row_related->id}}" value="{{$row1->size}}">
                                            @endforeach

                                            @foreach($row_related->items_colors as $row1)
                                          <?php //print_r($row_related->items_colors);  $row1->colors->$local_name?>
                                            <input type="hidden"  name="colors[]"class="color{{$row_related->id}}" value="">
                                            @endforeach


  <a href="{{lang_url('dashboard/items/'.$row_related->id)}}" class="btn btn-info mx-auto">{{trans('cpanel.buy_now')}}</a>
<!-- 
                                            <a href="javascript:add_cart('{{$row_related->id}}','{{$row_related->discount_price}}','{{$row_related->title}}','{{$row_related->thumbnail_image}}');"  class="btn btn-info mx-auto button add_to_cart_button">شراء الان</a> -->
                                           </div>
                                        </div>
                                      </div>
                            </div>
                </div>



               @endforeach
   
         @endif


                
            </div>
        </div>
    </section>
    <!-- End Scection item Details -->

 <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>

<script type="text/javascript">
    $(document).ready(function () {

            $(".addtowishlist").on('click', function (evt) {


    var link_data = $(this).attr('id');
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
            $("this .inWishList").html("<i class=\"fa fa-heart inWishList\"></i>");
            $("this .inWishList").removeClass("fa-heart-o");
            $("this .inWishList").addClass("fa-heart");
// setAttribute("fill", "green");

// $('a[data-data="'+link_data+'"] > i.whishstate').css({"path":"green !important"});
            } else {
// alert(data);

// $('a[data-data="'+link_data+'"] > i.whishstate').css({"path":"red !important"});
                $("this .inWishList").removeClass("fa-heart-o");
                $("this .inWishList").addClass("fa-heart");
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
    });
    </script>


<!-- Start Rate Script -->

<script type="text/javascript">

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
//                                    }
    function add_cart_done(id, price, name, image,user_id) {

    var name = name;
    var item_id = id;
    var vendor_id = user_id;
  
    var image = image;
    var price = price;
    var qty = $('#qty').val();
    var color = $('.color_id').val();

    var size = $('.size_id').val();

    var fun_url3 = "{!! url('add_to_cart') !!}";
    var data = {

    name: name, item_id: item_id,vendor_id:vendor_id, qty:qty, image: image, price: price, color: color, size: size, _token: '{{csrf_token()}}'

    };
    console.log(data);
    $.ajax({
            type: "POST",
            url: fun_url3,
            data: data,
            success: function (data) {

  

            if (data == 'error')
            {
//                  alert("error");
            $('#add-error').modal('show');
            } else {
                
                
       window.location="{!! lang_url('cart') !!}"; 

            $('#add_cart-done').modal('show');
            }
            }

    });
      

    }
    
//              var schedule = [];
//    var y;
//    var x;
//    @foreach($admin_data->accessories as $row1)
//
//            x ='{{$row1->items->id}}';
//    y ='{{$row1->items->discount_price}}';
//    schedule.push([x, y]);
//    @endforeach
//    function delte_item_accessories(id,price){
//    $('.row' + id).hide();
//    var found=0;
//    for (var i = 0; i < schedule.length; i++) {
//  if (schedule[i][0] == id) {
//    schedule.splice(i, 1);
//    found=1
//  }
//        }
//        if(found ==0){
//               schedule.push([id, price]);
//                  $('.row' + id).show();
//        }
//        var total=tatalcart();
//        $('#endpriccal').text(total);
//         $('#countlength').text(schedule.length);
//        if(schedule.length==0){
//            $('#end_cart').hide();
//        }else{
//                  $('#end_cart').show();  
//        }
//    console.log(schedule);
//        console.log(total);
//    }
    
       function tatalcart() {
        totalcost = 0;
        for (var i in schedule) {
            totalcost =totalcost + parseInt(schedule[i][1]);
       
        }
        return totalcost;
    }

   function array_to_cart(){
          var fun_url3 = "{!! url('add_to_cart_array') !!}";
          
              var items = new Array();
      
            for (var i in schedule) {
                      items.push(schedule[i][0]);
       
        }
    var data = {

    items: items.join(), _token: '{{csrf_token()}}'

    };
    $.ajax({
    type: "POST",
            url: fun_url3,
            data: data,
            success: function (data) {
            document.getElementById("carthome").innerHTML = data.html;

            if (data == 'error')
            {
            $('#add-error').modal('show');
            } else {
          //  $('#add_cart-done').modal('show');
            }
            }

    });
          $('#add_cart-done').modal('show');
   }
//                                    }
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

