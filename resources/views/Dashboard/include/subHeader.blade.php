
<!-- Start Nav3 -->
<section class="nav3">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <form>
                    <div class="row">
                        <div class="col-8 pl-0">
                            <input class="btn-block" type="text" name="" id="" placeholder="بحث...">
                            <i class="fa fa-search"></i>
                        </div>
                        <div class="col-4 pr-0">
                            <select class="btn-block" name="" id="">
                                <option value="">الاقسام</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="row">
                    <div class="col-8">
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
                                 <a class="dropdown-item" href="#">{{ trans("cpanel.Setting") }}</a>
                                 <a class="dropdown-item" href="{{ lang_url('myorders') }}">{{ trans("cpanel.myorders") }}</a>
                                <a class="dropdown-item" href="{{ lang_url('Wishlist') }}"> المفضلة</a>
                                <a class="dropdown-item" href="{{ lang_url('dashboard/settings') }}"> {{ trans("cpanel.Setting") }} </a>
                                <a class="dropdown-item" href="{{ lang_url('logout') }}"> {{ trans("cpanel.logout") }} </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <a href="" class="icon">
                            <i class="fa fa-shopping-cart  fa-3x"></i>
                            <span>20</span>
                        </a>
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