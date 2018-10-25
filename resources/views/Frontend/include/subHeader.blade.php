
<!-- Start Nav3 -->
<section class="nav3">
    <div class="container">
        <div class="row">



            <div class="col-lg-7">
                 <form class="navbar-search" method="Post" action="{{lang_url('search')}}">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="row">
                        <div class="col-8 pl-0">
                            <input class="btn-block search-field" type="text" name="search" id="search" placeholder="{{trans('cpanel.Search')}}..." required>
                      
                       <!--   <i class="fa fa-search"></i> -->

                            <button type="submit" style="display:block;border:none" class="btn-dark">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="col-4 pr-0">
                        




                             <select name='category_id' id='product_cat' class='btn-block resizeselect' required>
                                            <option value="" selected='selected'>{{trans('cpanel.All_Categories')}}</option>
                                            @foreach(get_category() as $row)
                                            <?php
                                            $ch = '';
                                            if ($row->id == @$category_id) {
                                                $ch = 'selected="selected"';
                                            }
                                            ?>
                                            <option class="level-0"{{$ch}} value="{{$row->id}}">{{$row->title}}</option>
                                            @endforeach
                                
                                        </select>

                        </div>
                    </div>
                </form>
            </div>





            <div class="col-lg-5">
                <div class="row">
                    <div class="col-8">

                     @if(auth()->user())
                        <div class="dropdown btn-block">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(auth()->user()->image != null)
                                <img src="{{ asset('public/uploads/user_img')}}/{{auth()->user()->image}}" alt="user Avatar" >
                                
                                @else
                                    <img src="{{ asset('public/assets/Frontend/Images/User-Avatar-Big.png') }}" alt="user Avatar">

                                @endif

                                {{ auth()->user()->name }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                @trader
                             <a class="dropdown-item" href="{{lang_url('myordervendor')}}">{{trans('cpanel.My_orders')}}</a>
                            <a class="dropdown-item" href="{{lang_url('myproducts')}}">{{trans('cpanel.myproducts')}}</a>
                            @endtrader
                            <a class="dropdown-item" href="{{lang_url('myorders')}}">{{trans('cpanel.My_purchases')}}</a>
                                <a class="dropdown-item" href="{{ lang_url('Wishlist') }}">{{trans('cpanel.My_wishlist')}}</a>
                                <a class="dropdown-item" href="{{lang_url('dashboard/settings')}}">{{trans('cpanel.My_Settings')}} </a>
                                <a class="dropdown-item" href="{{ lang_url('logout') }}"> {{ trans("cpanel.log_out") }} </a>
                            </div>
                        </div>
                     @else
                    
                 
                                <a class="nav-link" href="{{ lang_url('login') }}" >{{ trans("cpanel.login") }}</a>
                          
                      
                      @endif


                    </div>
                    <div class="col-2">
                        <?php if(count(Cart::content())) {?>
                        <a href="{{ lang_url('cart') }}" class="icon">
                            <i class="fa fa-shopping-cart  fa-3x"></i>
                            <span class="countcart">{{count(Cart::content())}}</span>
                        </a>
                        <?php }else{ ?>
                        <a href="#" class="icon">
                            <i class="fa fa-shopping-cart  fa-3x"></i>
                            <span class="countcart">{{count(Cart::content())}}</span>
                        </a>
                        <?php }?>
                    </div>
                    <div class="col-2">
                        <a href="#" class="icon">
                            <i class="fa fa-bell fa-3x"></i>
                            <span>20</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>