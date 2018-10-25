@extends(FEI.'.master')
@section('content')
 <?php @$title = $lang . '_title' ?>
<div id="content" class="site-content" tabindex="-1">
    @if(count($items))
    <div class="container">
        <nav class="woocommerce-breadcrumb" >
            <a href="{{lang_url('/')}}">{{trans('cpanel.Home')}}</a>
          <a href="{{lang_url('categories/'.$items[0]->sub_categories->Categories->id)}}">  <span class="delimiter">
                <i class="fa fa-angle-right"></i>
              </span>{{$items[0]->sub_categories->Categories->@$title}}</a>
        </nav>

        <div id="primary" class="content-area">
            <main id="main" class="site-main">
  
                <section>
                   
                    <header>
                   
                        <h2 class="h1">{{$items[0]->sub_categories->@$title}}</h2>
                    </header>

                    <div class="woocommerce columns-4" id="post-data">
                        @include(FE.'.items_by_subcategory_load_more')
                           <div class="ajax-load text-center" style="display:none">
                            <p><img src="{{ asset('public/assets/' .FE.'/loader.gif')}}">{{trans('cpanel.Loading_More_post')}}</p>
                        </div>
                    </div>
                    
                </section>


            </main><!-- /.site-main -->
        </div><!-- /.content-area -->
    </div>
    @endif
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    var page = 1;
   $(window).scroll(function() {
//    if($(window).scrollTop() == $(document).height() - $(window).height()) {
//     page++;
//            loadMoreData(page);
//    }
if ($("#post-data").scrollTop() +  $("#post-data").innerHeight()  >  this.scrollHeight - 100 ) {
       page++;
            loadMoreData(page);
        
}
});


    function loadMoreData(page) {
     
        var load_more_url = '{{lang_url("sub-cat/")."/".$sub_cat_id}}' + '?page='+ page;
 
        $.ajax(
                {
                    url: load_more_url,
                    type: "get",
                    asynk: false,
                    cache: false,

                    beforeSend: function ()
                    {
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
                    alert('server not responding...');
                });

    }

</script>

@stop
