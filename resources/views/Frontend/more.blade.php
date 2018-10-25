<li class="nav-item dropdown">
    <a href="{{lang_url("cart")}}" class="nav-link" data-toggle="dropdown">
        <i class="ec ec-shopping-bag"></i> 
        <span class="cart-items-count count">{{Cart::count()}}</span>
        <span class="cart-items-total-price total-price">
            <span class="amount"><?php 
              if(session()->has('coupon')){
                        
                        $ratio=session()->get('coupon')['discount'];
                            $subtotal_integer =remove_non_numerics(Cart::subtotal());

             $end= ($subtotal_integer*$ratio)/100;
         
           
                       $subtotal_integer=$subtotal_integer-$end ;
                        echo number_format($subtotal_integer);
                    }else{
                        echo Cart::subtotal(); 
                    }
                    
                    ?> {{trans('cpanel.R_S')}}</span>
        </span>
    </a>
    @if(Cart::count() >0)
    <ul class="dropdown-menu dropdown-menu-mini-cart">
        <li><div class="widget_shopping_cart_content">
                <ul class="cart_list product_list_widget ">

                    @foreach(Cart::content() as $row)
              
                   <li class="mini_cart_item">
                       <a title="Remove this item" class="remove" id="{{$row->rowId}}"href="#" onclick="cleare('{{$row->rowId}}')">×</a>
                        <a href="{{lang_url('dashboard/items/'.$row->id)}}">
                            <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="{{ asset($row->options->image)}}" alt="">
                                <?php echo $row->name; ?>&nbsp;
                        </a><span class="quantity"><?php echo $row->qty; ?> x 
                            <span class="amount">{{number_format($row->price)}} 
                                {{trans('cpanel.R_S')}}</span></span>
                        @endforeach
				</ul><!-- end product list -->


				<p class="total"><strong>Subtotal:</strong> <span class="amount"><?php   if(session()->has('coupon')){
                        
                        $ratio=session()->get('coupon')['discount'];
                            $subtotal_integer =remove_non_numerics(Cart::subtotal());

             $end= ($subtotal_integer*$ratio)/100;
         
           
                       $subtotal_integer=$subtotal_integer-$end ;
                        echo number_format($subtotal_integer);
                    }else{
                        echo Cart::subtotal(); 
                    }
                    
                    ?>{{trans('cpanel.R_S')}}</span></p>


					<p class="buttons">
						<a class="button wc-forward" href="{{lang_url("cart")}}">View Cart</a>
						<a class="button checkout wc-forward" href="checkout.php">Checkout</a>
					</p>


				</div>
			</li>
		</ul>
    @endif
	</li>
