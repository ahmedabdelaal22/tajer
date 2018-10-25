@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")







    <!-- Start Section Brands -->
    <section class="brands">
        <div class="container">
            <div class="row" id="post-data">

            </div>
        </div>
    </section>
    <!-- End Section Brands  -->




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


@stop