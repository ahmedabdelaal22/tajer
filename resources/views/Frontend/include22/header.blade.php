<?php
$url_segment = \Request::segment(1);
if ($url_segment == 'ar' || $url_segment == 'en') {
    App::setLocale($url_segment);
    $locale = App::getLocale();
} else {
    App::setLocale('ar');
    $locale = App::getLocale();
}

session(['sess_locale' => $locale]);
$sess_locale = session('sess_locale');
//  if(auth()->user()){
$sess_user_id = session('user_id');
?>
<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="../../schema.org/WebPage.php">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />


    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tajer.com</title>
        <!-- {{ asset('public/assets/'.FE .'/css/bootstrap.min.css')}} -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/bootstrap.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/font-awesome.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/animate.min.css')}}" media="all" />


        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/font-electro.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/owl-carousel.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/style.css')}}"  media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/colors/blue.css')}}" media="all" />

        
        

        <!-- Demo Purpose Only. Should be removed in production -->
        <link rel="stylesheet" href="{{ asset('public/assets/'.FE .'/css/config.css')}}"/>

        <link  href="{{ asset('public/assets/'.FE .'/css/colors/green.css')}}" rel="alternate stylesheet" title="Green color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/pink.css')}}" rel="alternate stylesheet" title="Pink color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/blue.css')}}" rel="alternate stylesheet" title="Blue color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/red.css')}}" rel="alternate stylesheet" title="Red color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/orange.css')}}" rel="alternate stylesheet" title="Orange color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/black.css')}}" rel="alternate stylesheet" title="Black color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/gold.css')}}" rel="alternate stylesheet" title="Gold color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/yellow.css')}}" rel="alternate stylesheet" title="Yellow color"/>
        <link href="{{ asset('public/assets/'.FE .'/css/colors/flat-blue.css')}}" rel="alternate stylesheet" title="Flat Blue color"/>
        <!-- Demo Purpose Only. Should be removed in production : END -->


        <!--         <link href='../../fonts.googleapis.com/css7372.css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>
        -->

        <!--         <link href='../../fonts.googleapis.com/css7372.css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>
        -->


        <!-- Start Rate CSS -->
    
        <!-- Start Rate CSS -->
        <link href="{{ asset('public/assets/'.'rating/style.css')}}" type="text/css" rel="stylesheet" />
        <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">-->
        <link href="{{ asset('public/assets/'.'rating/jquery-bar-rating-master/dist/themes/fontawesome-stars.css')}}" rel='stylesheet' type='text/css'/>



        <link rel="shortcut icon" href="{{ asset('public/assets/'.FE .'/images/fav-icon.png')}}"/>
           <?php
        if ($sess_locale == 'ar') {
            ?>
         
             <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.FE .'/css/style_ar.css')}}"  media="all" />
            
        <?php } ?>
    </head>    


    <!-- page home page-template-default -->
    <?php
    if (isset($body_class)) {
        $body_class = $body_class;
    } else {
        $body_class = '';
    }
    ?>
    <body class="{{ $body_class }}">
        <div id="page" class="hfeed site">


            <div class="top-bar">
                <div class="container">
                    <nav>
                        <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                            <li class="menu-item animate-dropdown"><a title="Welcome to Tajer" href="#">Welcome to Tajer</a></li>
                        </ul>
                    </nav>

                    <nav>
                        <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                            





                        

                            <?php
                            if ($sess_locale == 'ar') {
                                ?>

                             <li class="menu-item animate-dropdown"><a title="Store Locator" href="{{url('en')}}">English</a></li>

                                <?php
                            }
                            ?>

                            <?php
                            if ($sess_locale == 'en') {
                                ?>

                          <li class="menu-item animate-dropdown"><a title="Store Locator" href="{{url('ar')}}">Arabic</a></li>


                                <?php
                            }
                            ?>

                    




                            <li class="menu-item animate-dropdown"><a title="Track Your Order" href="track-your-order.php"><i class="ec ec-transport"></i>Track Your Order</a></li>
                       <!--      <li class="menu-item animate-dropdown"><a title="Shop" href="shop.php"><i class="ec ec-shopping-bag"></i>Shop</a></li> -->
                            <li class="menu-item animate-dropdown"><a title="Shop" href="{{lang_url('tajers')}}"><i class="ec ec-shopping-bag"></i>Tajer</a></li>


                            <li class="menu-item animate-dropdown">
                                <a title="My Account" href="{{lang_url('register_view')}}"><i class="ec ec-user"></i>
                                    {{trans('cpanel.sign_up')}}
                                </a>
                            </li>





                            @if(!auth()->user())

                            <li class="menu-item animate-dropdown">
                                <a title="{{trans('cpanel.sign_up')}}" href="{{lang_url('login')}}">
                                    <i class="ec ec-user"></i>
                              <!--      <img src="{{ asset('public/assets/images/user.svg')}}"> -->
                                    {{trans('cpanel.login')}}
                                </a>
                            </li>
                            @else

                            <li class="menu-item animate-dropdown">
                                <a title="{{trans('cpanel.sign_up')}}" href="{{lang_url('dashboard/settings')}}">
                                    <i class="ec ec-user"></i>

                                    {{auth()->user()->name}}  
                                </a>
                            </li>
                            @endif








                        </ul>
                    </nav>
                </div>
            </div><!-- /.top-bar -->

@if (Request::route()->getName() == "home") 
@include(FEI.'.home_header')
@else
@include(FEI.'.other_header')
@endif

          


          

            <script>

        function cleare(row){
  
        var answer = confirm("Are you sure you want to delete from this post?");
        if (answer)
        {
         
            $.ajax({
                type: "Get",
                url: "<?php echo url('delte_item_cart'); ?>",
                data: {row: row},
        
                success: function (data) {
     
      document.getElementById("carthome").innerHTML = data.html;
                },
                error: function (err) {
                    console.log(err.error);
                }
            });
        }
    
    }
    

    
    
</script>
