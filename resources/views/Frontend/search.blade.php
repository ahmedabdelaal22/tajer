@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")
<?php

use Carbon\Carbon;

$locale = App::getLocale();
?>

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



    <!-- Start Section search -->
    <section class="brands">
        <div class="container">
            <div class="row" id="post-data">

            </div>
        </div>
    </section>
    <!-- End Section search  -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
function wishlist(link_data) {


    var input_wishlist = $("#wish_" + link_data);
    // var link_data = input_wishlist.data('data');

    var fun_url3 = "{!! lang_url('wishlist') !!}";
    $.ajax({
        type: "GET",
        url: fun_url3,
        data: ({items_id: link_data}),
        success: function (data) {

            if (data == 'added')
            {
//                console.log(evt);
                input_wishlist.children('svg').addClass('sp_color');

            } else {

                input_wishlist.children('svg').removeClass('sp_color');
            }
        }
    });

}

</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".addtowishlist_login").on('click', function (evt) {

            var message = '{{trans('cpanel.You_Must_Login_First_To_Add_Item_To_Wishlist')}}'
            alert(message);
        });
    });
</script>

<script type="text/javascript">
    var page = 1;
    var cities_id = $("#cities_id").val();
    var type = $("#type").val();
    var filteration = $("#filteration_id").val();
    var filteration2 = $("#filteration2_id").val();


    $(document).ready(function () {
        $('#cities_id').on('click', function (evt) {
            $("#post-data").html('');
            cities_id = $("#cities_id").val();
            type = $("#type").val();
            filteration = $("#filteration_id").val();
            filteration2 = $("#filteration2_id").val();
            page = 1;

            loadMoreData(page, cities_id, type, filteration, filteration2);

        });


        $('#type').on('click', function (evt) {
            $("#post-data").html('');
            cities_id = $("#cities_id").val();
            type = $("#type").val();
            filteration = $("#filteration_id").val();
            filteration2 = $("#filteration2_id").val();
            page = 1;

            loadMoreData(page, cities_id, type, filteration, filteration2);

        });


        $('#filteration_id').on('click', function (evt) {
            $("#post-data").html('');
            cities_id = $("#cities_id").val();
            type = $("#type").val();
            filteration = $("#filteration_id").val();
            filteration2 = $("#filteration2_id").val();
            page = 1;

            loadMoreData(page, cities_id, type, filteration, filteration2);

        });


        $('#filteration2_id').on('click', function (evt) {
            $("#post-data").html('');
            cities_id = $("#cities_id").val();
            type = $("#type").val();
            filteration = $("#filteration_id").val();
            filteration2 = $("#filteration2_id").val();
            page = 1;

            loadMoreData(page, cities_id, type, filteration, filteration2);

        });


    });


    loadMoreData(page, 0, 0, 'all', 'all2'); //initial content load
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page, cities_id, type, filteration, filteration2);
        }
    });

    function loadMoreData(page, cities_id = 0, type = 0, filteration = 'all', filteration2 = 'all2') {
        var category_id = '<?php echo $category_id; ?>';
        var search = '<?php echo $search; ?>';
        $.ajax(
                {
                    url: '?page=' + page + '&cities_id=' + cities_id + '&type=' + type + '&filteration=' + filteration + '&filteration2=' + filteration2 + '&category_id=' + category_id + '&search=' + search,
                    type: "get",

                    error: function (error) {
                        console.log(error);
//                        $("#ajaxResponse").append("<div>" + error + "</div>");
                    },
                    beforeSend: function () {
                        $('.ajax-load').show();
                    }
                })

                .done(function (data) {
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


                });

    }

</script>

@stop
