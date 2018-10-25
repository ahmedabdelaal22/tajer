@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")

<!-- Start Section favorit -->
    <section class="favorit item-details prodect">
        <div class="container">
            <div class="row" id="post-data">
                <div class="col-12">
                    <h2>{{trans('cpanel.My_wishlist')}}</h2>
                </div>


            </div>
                   <div class="ajax-load text-center" style="display:none">

                            <p><img src="{{ asset('public/assets/' .FE.'/loader.gif')}}">Loading More post</p>
                        </div>
        </div>
    </section>
      <!-- End Section favorit -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
var page = 1;

loadMoreData(page); //initial content load
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
    }
});

function loadMoreData(page) {
    $.ajax(
            {
                url: '?page=' + page,
                type: "get",
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
                        $("#product_"+item_id).remove();
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