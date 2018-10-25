@extends(FEI.'.master')
@section('content')

<div id="content" class="site-content" tabindex="-1">
<div class="container">
<nav class="woocommerce-breadcrumb" >
<a href="home.php">Home</a>
<span class="delimiter">
<i class="fa fa-angle-right"></i>
</span>Laptops &amp; Computers
</nav>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<section>

<header>
<h2 class="h1">Tajer</h2>
</header>

<div class="woocommerce columns-4">

<ul class="product-loop-categories">


@foreach($all_items_tajer as $value)

<li class="product-category product">

<!-- 
<a href="shop.php"><img src="assets/images/product-category/4.jpg" class="img-responsive" alt=""></a> -->

      @if($value->image !='')
          <a href="{{lang_url('products/'.$value->id)}}"> 
             <img   src="{{ asset('public/uploads/user_img')}}/{{$value->image}}" class="img-responsive" alt="{{$value->name}}" /> </a>
       @else
        <a href="{{lang_url('products/'.$value->id)}}"> 
        <img src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}" class="img-responsive" alt="{{$value->name}}">
        </a>
         
        @endif


<h3>{{$value->name}} </h3>
<p> Products : {{$value->totalItem}} </p>
</li>

@endforeach











</ul>
</div>
</section>
</main><!-- /.site-main -->
</div><!-- /.content-area -->
</div>
</div>
@stop