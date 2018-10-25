<!-- Start Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="about">
                        <h2 class="footer-head">{{trans('cpanel.About_tajer')}}</h2>
                        <p>{{trans('cpanel.The_best_products_you_will_find_here')}} {{trans('cpanel.with_tajer')}} </p>
                    </div>
                </div>
                <div class="col-lg-3 mx-auto ">
                    <h2 class="footer-head"> {{trans('cpanel.Overview')}}</h2>
                    <ul class=" list-unstyled">
                        <li><a href="{{lang_url('/')}}">{{trans('cpanel.home')}}</a></li>
                        <li><a href="{{lang_url('categories')}}">{{trans('cpanel.Categories')}}</a></li>
                        <li><a href="{{lang_url('Brands')}}">{{trans('cpanel.Brands')}}</a></li>
                        @if(auth()->user())
                        <li><a href="{{lang_url('myorders')}}">{{trans('cpanel.My_orders')}}</a></li>
                        <li><a href="{{lang_url('dashboard/settings')}}">{{trans('cpanel.My_Settings')}}</a></li>
                        @endif
                        <li><a href="{{lang_url('About-us')}}">{{trans('cpanel.About')}}</a></li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h2 class="footer-head">{{trans('cpanel.Contact_us')}}</h2>
                    <span>{{trans('cpanel.Addresses')}} :</span>
                    <p>ز شارع المنيل بالقصر العيني - القاهرة - مصر</p>
                    <span>{{trans('cpanel.phone')}} :</span>
                    <p>(+2 ) 0115 2548 396</p>
                    <span>{{trans('cpanel.email')}} : </span>
                    <p>example@gmail.com</p>
                </div>
                <div class="col-lg-3 mx-auto">
                    <div class="socil">
                        <a class="lgo-footer" href="{{lang_url('/')}}">
                            <img src="{{ asset('public/assets/'.FE .'/Images/Icons/logo_white.png')}}" alt="">
                        </a>
                        <ul class="list-unstyled  text-center">
                            <li><a href="#"><img src="Images/Icons/googleplay.png" alt=""></a></li>
                            <li><a href="#"><img src="Images/Icons/Apple-App-Store-icon.png" alt=""></a></li>
                            <li><a href="#"><img src="Images/Icons/twitter.png" alt=""></a></li>
                            <li><a href="#"><img src="Images/Icons/facebook.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <p class="Copyright" class="text-center">Copyright @ 2018 Tajer All Right Reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/popper.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/'.FE .'/js/main.js')}}"></script>







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


<div class="modal fade" id="subscribe-error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog dashboard" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('cpanel.subscribe')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{trans('cpanel.you_subscribe_before')}}

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

</html>