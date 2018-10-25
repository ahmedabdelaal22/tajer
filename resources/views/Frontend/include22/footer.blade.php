
<footer id="colophon" class="site-footer">
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">{{trans('cpanel.Featured_Products')}}</h4>
                            <ul class="product_list_widget">
                                @foreach(feature() as $row)
                                <li>
                                    <a href="{{lang_url('dashboard/items/'.$row->id)}}" title="{{$row->title}}">
                                        <img class="wp-post-image" data-echo="{{ asset($row->thumbnail_image)}}" src="{{ asset('public/assets/'.FE .'/images/blank.gif')}}" alt="assets/images/blank.gif">
                                        <span class="product-title">{{$row->title}}</span>
                                    </a>
                                    <span class="electro-price"><span class="amount">
                                            @if($row->ratio == 0 )
                                            {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}
                                            @else
                                            {{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}
                                            @endif
                                        </span></span>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body"><h4 class="widget-title">{{trans('cpanel.Onsale_Products')}}</h4>
                            <ul class="product_list_widget">
                                @foreach(onsale() as $row)
                                <li>
                                    <a href="{{lang_url('dashboard/items/'.$row->id)}}" title="{{$row->title}}">
                                        <img class="wp-post-image" data-echo="{{ asset($row->thumbnail_image)}}" src="{{ asset('public/assets/'.FE .'/images/blank.gif')}}" alt="assets/images/blank.gif">
                                        <span class="product-title">{{$row->title}}</span>
                                    </a>
                                    <span class="electro-price"><ins><span class="amount">{{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}</span></ins> <del><span class="amount">  {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}</span></del></span>
                                </li>
                                @endforeach


                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">{{trans('cpanel.Top_Rated_Products')}}</h4>
                            <ul class="product_list_widget">


                                @foreach(toprates() as $row)
                                <li>
                                    <a href="{{lang_url('dashboard/items/'.$row->id)}}" title="{{$row->title}}">
                                        <img class="wp-post-image" data-echo="{{ asset($row->thumbnail_image)}}" src="{{ asset('public/assets/'.FE .'/images/blank.gif')}}" alt="assets/images/blank.gif">
                                        <span class="product-title">{{$row->title}}</span>
                                    </a>
                                    <div class="star-rating" title="{{$row->title}}">
                                        <span style="width:{{$row->average*20}}%"><strong class="rating">5</strong> out of 5</span></div>
                                    @if($row->ratio == 0)
                                    <span class="electro-price"><span class="amount">     {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}        </span>        </span>
                                    @else
                                    <span class="electro-price"><ins>
                                            <span class="amount">{{number_format($row->discount_price)}} {{trans('cpanel.R_S')}}</span></ins>
                                        <del><span class="amount"> {{number_format($row->fixed_price)}} {{trans('cpanel.R_S')}}</span></del>

                                    </span>
                                    @endif

                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h5 class="newsletter-title">{{trans('cpanel.Subscribe_to_our_Newsletter')}}</h5>
<!--                    <span class="newsletter-marketing-text">...and receive <strong>$20 coupon for first shopping</strong></span>-->
                </div>
                <div class="col-xs-12 col-sm-6">
                    <form class="sub">
                        <div class="input-group">
                            <input type="text" id="email_susqribe" class="form-control"  placeholder="{{trans('cpanel.Enter_your_email_address')}}">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" onclick="subscribe()" type="button">{{trans('cpanel.subscribe')}}</button>
                            </span>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom-widgets">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-md-push-5">
                    <?php
                    $cat = get_category_array();
                    $halved = array_chunk($cat, ceil(count($cat) / 2));
                    ?>

                    <div class="columns">
                        <aside id="nav_menu-2" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">{{trans('cpanel.Find_It_Fast')}}</h4>
                                <div class="menu-footer-menu-1-container">
                                    <ul id="menu-footer-menu-1" class="menu">
                                        @foreach($halved[0] as $row)
                                        <li class="menu-item"><a href="{{lang_url('categories/'.$row->id)}}">{{$row->title}}</a></li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                    <div class="columns">
                        <aside id="nav_menu-3" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">&nbsp;</h4>
                                <div class="menu-footer-menu-2-container">
                                    <ul id="menu-footer-menu-2" class="menu">
                                        @foreach($halved[1] as $row)
                                        <li class="menu-item"><a href="{{lang_url('categories/'.$row->id)}}">{{$row->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                    <div class="columns">
                        <aside id="nav_menu-4" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">{{trans('cpanel.Customer_Care')}}</h4>
                                <div class="menu-footer-menu-3-container">
                                    <ul id="menu-footer-menu-3" class="menu">
                                        @if(auth()->user())
                                        <li class="menu-item"><a href="{{lang_url('dashboard/settings')}}">{{trans('cpanel.My_Account')}}</a></li>
                                        <li class="menu-item"><a href="{{lang_url('your-Order')}}">{{trans('cpanel.Track_your_Order')}}</a></li>
                                        <li class="menu-item"><a href="{{lang_url('Wishlist')}}">{{trans('cpanel.Wishlist')}}</a></li>

                                        @else
                                        <li class="menu-item"><a href="{{lang_url('login')}}">{{trans('cpanel.My_Account')}}</a></li>
                                        <li class="menu-item"><a  href="{{lang_url('login')}}">{{trans('cpanel.Wishlist')}}</a></li>
                                        @endif
                                        <li class="menu-item"><a href="#">{{trans('cpanel.FAQs')}}</a></li>
                                        <li class="menu-item"><a href="#">{{trans('cpanel.Product_Support')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                </div><!-- /.col -->

                <div class="footer-contact col-xs-12 col-sm-12 col-md-5 col-md-pull-7">
                    <div class="footer-logo">


                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="233px" height="84px">
                        <image x="0px" y="0px" width="233px" height="64px" xlink:href="data:img/png;base64,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"></image>
                        </svg>




                    </div><!-- /.footer-contact -->





                    <div class="footer-call-us">
                        <div class="media">
<!--                            <span class="media-left call-us-icon media-middle"><i class="ec ec-support"></i></span>-->
                            <div class="media-body">
                                <span class="call-us-text">{{trans('cpanel.Got_Questions')}} ? {{trans('cpanel.Call_us')}} 24/7!</span>
                                <span class="call-us-number">(800) 8001-8588, (0600) 874 548</span>
                            </div>
                        </div>
                    </div><!-- /.footer-call-us -->


                    <div class="footer-address">
                        <strong class="footer-address-title">{{trans('cpanel.Contact_Info')}}</strong>
                        <address>{{trans('cpanel.enter_your_addres')}}</address>
                    </div><!-- /.footer-address -->

                    <div class="footer-social-icons">
                        <ul class="social-icons list-unstyled">
                            <li><a class="fa fa-facebook" href="#"></a></li>
                            <li><a class="fa fa-twitter" href="#"></a></li>
                            <li><a class="fa fa-pinterest" href="#"></a></li>
                            <li><a class="fa fa-linkedin" href="#"></a></li>
                            <li><a class="fa fa-google-plus" href="#"></a></li>
                            <li><a class="fa fa-tumblr" href="#"></a></li>
                            <li><a class="fa fa-instagram" href="#"></a></li>
                            <li><a class="fa fa-youtube" href="#"></a></li>
                            <li><a class="fa fa-rss" href="#"></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="pull-left flip copyright">&copy; <a href="#">{{trans('cpanel.Electro')}}</a> - {{trans('cpane.All_Rights_Reserved')}}</div>
            <div class="pull-right flip payment">
                <div class="footer-payment-logo">
                    <ul class="cash-card card-inline">
                        <li class="card-item"><img src="{{ asset('public/assets/'.FE .'/images/products/payment-icon/1.png')}}" alt="" width="52"></li>
                        <li class="card-item"><img src="{{ asset('public/assets/'.FE .'/images/products/payment-icon/2.png')}}" alt="" width="52"></li>
                        <li class="card-item"><img src="{{ asset('public/assets/'.FE .'/images/products/payment-icon/3.png')}}" alt="" width="52"></li>
                        <li class="card-item"><img src="{{ asset('public/assets/'.FE .'/images/products/payment-icon/4.png')}}" alt="" width="52"></li>
                        <li class="card-item"><img src="{{ asset('public/assets/'.FE .'/images/products/payment-icon/5.png')}}" alt="" width="52"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->
</footer><!-- #colophon -->

</div><!-- #page -->

<!-- jq theme -->
<!-- <script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/jquery.min.js')}}"></script> --><!-- to work rating -->


<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/tether.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/bootstrap.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/bootstrap-hover-dropdown.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/echo.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/jquery.waypoints.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/electro.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/jquery.zoom.js')}}"></script>
<!-- <script type="text/javascript" src="{{ asset('public/assets/'.FE .'/rate/rate.js')}}"></script> -->

<!-- <script type="text/javascript" src="{{ asset('public/assets/jquery-bar-rating-master/dist/jquery.barrating.min.js')}}"></script> -->












                                      <script>
                                    function subscribe() {
                                        var email = $('#email_susqribe').val();
                                        var fun_url3 = "{!! lang_url('subscribe') !!}";
                                        if (validateEmail(email)) {
                                            var data = {

                                                email: email, _token: '{{csrf_token()}}'

                                            };
                                            $.ajax({
                                                type: "POST",
                                                url: fun_url3,
                                                data: data,
                                                success: function (data) {
                                                    if (data == 'error')
                                                    {


                                                        $('#subscribe-error').modal('show');
                                                    } else {
                                                        $('#subscribe-done').modal('show');
                                                    }
                                                }

                                            });
                                        } else {

                                            $('#subscribe-mesage').modal('show');
                                        }
                                    }

                                    function validateEmail(email) {
                                        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                        return re.test(email);
                                    }
</script>
<script>

$(document).ready(function(){



    if ($('body').hasClass('home')) {

        $('.other-header').css("display", "none");

    }


    if ($('body').hasClass('full')) {

        $('.Home-Header').css("display", "none");

    }


    if ($('body').hasClass('left-sidebar')) {

        $('.Home-Header').css("display", "none");

    }



    if ($('body').hasClass('single-product')) {

        $('.Home-Header').css("display", "none");
    }


});


</script>

<div class="modal fade" id="subscribe-mesage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog dashboard" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('cpanel.subscribe')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{trans('cpanel.please_enter_email_right_!')}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('cpanel.Close')}}</button>


            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="subscribe-done" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog dashboard" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('cpanel.subscribe')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{trans('cpanel.done_subscribe')}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('cpanel.Close')}}</button>


            </div>
        </div>
    </div>
</div>

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
                $("#amount").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
            }
        });
        $("#amount").val($("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
    });
</script>

<script>
    function add_cart_end() {
        var name = $('#name').val();
         var item_id = $('#item_id').val();
          var image = $('#image').val();
           var price = $('#price').val();
            var color= $('.colors:checked').val(); 
             var size= $('.sizes:checked').val(); 
            var valdation=0
             if(!color){

               $("#colors").html("<h2>required</h2>");
                          valdation=1
             }
                if(!size){

               $("#sizes").html("<h2>required</h2>");
                          valdation=1
             }
     if(valdation == 0){
        var fun_url3 = "{!! url('add_to_cart') !!}";
        
            var data = {

                name: name, item_id: item_id, image: image, price: price, color: color, size: size, _token: '{{csrf_token()}}'

            };
            $.ajax({
                type: "POST",
                url: fun_url3,
                data: data,
                success: function (data) {
                         $('#cart_details').modal('hide');
                               document.getElementById("carthome").innerHTML = data.html;

                    if (data == 'error')
                    {
                        $('#add-error').modal('show');
                    } else {
                        $('#add_cart-done').modal('show');
                    }
                }

            });
        }
        
    }

    function add_cart(id, price,name,image) {
      
        $('#item_id').val(id);
        $('#price').val(price);
        $('#name').val(name);
        $('#image').val(image);
        var price1 =price+"{{trans('cpanel.R_S')}}";
         $('#modal_price').text(price1);
        var sizes = new Array();
        $.each($(".row" + id), function () {

            sizes.push($(this).val());

        });
           var colors = new Array();
        $.each($(".color" + id), function () {

            colors.push($(this).val());

        });
        var output = '<div class="title">المقاس</div> ';
        for (var i = 0; i < sizes.length; i++) {
            output += ' <div class="input-group"><input type="radio"class="sizes" name="sizes" value="' + sizes[i] + '"><span class="sku-size -available" >' + sizes[i] + '</span></div>';
        }
     
        
        var output1 = '<div class="title">اﻻلوان</div> ';
        for (var i = 0; i < colors.length; i++) {
            output1 += ' <div class="input-group"><input type="radio" class="colors"name="colors" value="'+ colors[i] +'"><span class="sku-size -available" >' + colors[i] + '</span></div>';
        }
      if(sizes.length > 0 || colors.length > 0){   

          $("#sizes").html(output);
        $("#colors").html(output1);
        $('#cart_details').modal('show');

          
        $("#colors").html(output);
        $('#cart_details1').modal('show');

    }else{
        var fun_url3 = "{!! url('add_to_cart') !!}";
        
            var data = {

                name: name, item_id: id, image: image, price: price, _token: '{{csrf_token()}}'

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
                        $('#add_cart-done').modal('show');
                    }
                }

            });
        
    }
    }
</script>

<div class="modal fade" id="cart_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog dashboard" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('cpanel.Please_choose')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list -sizes" id='sizes'>

                </div>
                <br>
                <div class="list colors" id='colors'>

                </div>
                
                <br>
                <input type="hidden" id="item_id">
                <input type="hidden" id="price">
                <input type="hidden" id="name">
                <input type="hidden" id="image">
                   <div class="last">
                       السعر : 
                         <span class="price">
                    <span class="electro-price">
                        <ins><span class="amount"> </span></ins>
                        <span class="amount"id="modal_price"></span>
                    </span>
                </span>
                       
                     
                                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('cpanel.Close')}}</button>
                <button type="button" class="btn btn-primary"onclick="add_cart_end()">{{trans('cpanel.continueDelte')}}</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_cart-done" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog dashboard" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('cpanel.add_cart')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{trans('cpanel.done_add_to_cart')}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('cpanel.Close')}}</button>


            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog dashboard" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('cpanel.add_cart')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{trans('cpanel.error_add_to_cart')}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('cpanel.Close')}}</button>


            </div>
        </div>
    </div>
</div>
</body>

<!-- Mirrored from transvelo.github.io/electro-html/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Feb 2018 15:39:57 GMT -->
</html>
