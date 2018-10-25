
@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")



<!-- Start Section my cart -->
<section class="mycart">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <h1>{{trans('cpanel.Shopping_cart')}}</h1>
            </div>
            <div class="col-lg-9">
                <?php foreach(Cart::content() as $row) : ?>
                <div class="box-cart" id="row{{$row->rowId}}">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="{{ asset($row->options->image)}}" alt="">
                        </div>
                        <div class="col-lg-9">
                            <div class="info">
                                <div class="row">
                                    <div class="col-12">
                                        <p><?php echo $row->name; ?></p>
                                    </div>
                                    <form class="col-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <span><?php echo $row->price; ?></span>
                                            </div>
                                            <div class="col-4 text-center mt-1">
                                                <button class="" type="button" onclick="edit_cart('{{$row->rowId}}',2)" >+</button>
                                                <input class="myinput" type="text" value="<?php echo $row->qty; ?>" id="qtity{{$row->rowId}}" readonly disabled>
                                                <button class="" type="button"  onclick="edit_cart('{{$row->rowId}}',1)">-</button>
                                            </div>
                                            <div class="col-4 text-left"><span id="subtotal{{$row->rowId}}"><?php echo $row->subtotal; ?></span></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="delete" onclick="cleare('{{$row->rowId}}')"> {{trans('cpanel.delete')}}</span>
                </div>
                    <?php endforeach; ?>
            
            </div>
            <div class="col-lg-3">
                <div class='content'>
                    <div class="row">
                        <div class="col-12">
                            <h2>{{trans('cpanel.summary')}}</h2>
                        </div>
                        <table class="table">
                            <tr>
                                <td class="name" colspan="6"> {{trans('cpanel.Number_of_products')}}</td>
                                <td class="text-left price countcart" colspan="6" >{{count(Cart::content())}}</td>
                            </tr>
                            <tr>
                                <td class="name" colspan="6"> {{trans('cpanel.The_amount_is_net')}}</td>
                                <td class="text-left price total" colspan="6" >{{Cart::subtotal()}}</td>
                            </tr>
                            <tr>
                                <td class="name" colspan="6"> {{trans('cpanel.Delivery_Service')}}</td>
                                <td class="text-left price" colspan="6">0.0</td>
                            </tr>
                            <tr>
                                <td class="all" colspan="6"> {{trans('cpanel.Total')}}</td>
                                <td class="text-left f-price total" colspan="6">{{Cart::subtotal()}}</td>
                            </tr>
                        </table>
                        
                        <?php if(auth()->user()){?>
                        <a href="{{ lang_url('payment') }}" class="btn btn-block mx-auto">{{trans('cpanel.buy_now')}}</a>
                        <?php }else{?>
                        <a href="{{ lang_url('login') }}" class="btn btn-block mx-auto">{{trans('cpanel.buy_now')}}</a>
                         <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function cleare(row){
  
        var answer = confirm("Are you sure you want to delete from this post?");
        if (answer)
        {
         
            $.ajax({
                type: "Get",
                url: "<?php echo url('delte_item_cart'); ?>",
                data: {row: row},
                dataType: 'text', // Define data type will be JSON
                success: function (data) {
                  var countcart=" <?=count(Cart::content())?>";
                 countcart=countcart-1;
            
             $('.countcart').text(countcart);
//             document.getElementById("carthome").innerHTML = data.html;
               $('#row'+row).hide();
               $('.total').text(data);

                },
                error: function (err) {
                    console.log(err.error);
                }
            });
        }
    
    }
    function send_coupen(){
    var coupon_code=$('#coupon_code').val();
    if(coupon_code){
          $.ajax({
                type: "get",
                url: "<?php echo url('add_couben'); ?>",
                data: {coupon_code: coupon_code},
            
                success: function (data) {
                    if(data=='error'){
                       
                      $('#couboun-error').modal('show');
                    }else{
                   $('#couboun-done').modal('show');
               //  location.reload();
                  }
                },
                error: function (err) {
                    console.log(err.error);
                }
            });
            }
    }
   function edit_cart(row_id,type){



   var qtyend=parseInt($('#qtity'+row_id).val());

   if(type == 2){
       qtyend=qtyend+1;
      
   $('#qtity'+row_id).val(qtyend);
   }else{ 
       if(qtyend > 1){
           qtyend=qtyend-1;
         
    $('#qtity'+row_id).val(qtyend);
   }
   
   }
     var data = {

                row: row_id, qtyend: qtyend, _token: '{{csrf_token()}}'

            };
         $.ajax({
                type: "Post",
                url: "<?php echo url('update_item_cart'); ?>",
                data:data,
                dataType: 'Json', // Define data type will be JSON
                success: function (data) {
                    $('#subtotal'+row_id).text(data.subtotal);
                    $('.total').text(data.total);
//                    location.reload();

                },
                error: function (err) {
                    console.log(err.error);
                }
            });
   

   }
    
</script>

<!-- End Section My cart -->
@stop

