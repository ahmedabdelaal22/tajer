@extends(DSHI.'.master')
@section('content')

<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- HEADLINE -->
    <div class="headline buttons primary sp_color">
        <h4>{{trans('cpanel.Your_Notifications')}}</h4>
        <!--        <a href="#" class="button mid-short primary"></a>-->
    </div>
    <!-- /HEADLINE -->

    <!-- PROFILE NOTIFICATIONS -->
    <div class="profile-notifications" id='post-data'>
        <!-- PROFILE NOTIFICATION -->

        <!-- PROFILE NOTIFICATION -->


        <!-- PROFILE NOTIFICATION -->


    </div>

    <div class="ajax-load text-center" style="display:none">

        <p><img src="{{ asset('public/assets/' .FE.'/loader.gif')}}">{{trans('cpanel.Loading_More_post')}}</p>
    </div>
    <!-- /PROFILE NOTIFICATIONS -->

    <!-- PAGER -->

    <!-- /PAGER -->
</div>



 <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog dashboard" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    {{trans('Are_you_sure_accept_notfication_?')}}

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Close')}}</button>
                                   
                                    <button type="button" class="btn btn-primary"id="saveaccept">{{trans('Save_accept')}}</button>
                                  

                                </div>
                            </div>
                        </div>
                    </div>
 <div class="modal fade" id="delte_notfication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog dashboard" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    {{trans('Are_you_sure_delte_notfication_?')}}

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Close')}}</button>
                                   
                                    <button type="button" class="btn btn-primary"id="delte_end">{{trans('Delte')}}</button>
                                  

                                </div>
                            </div>
                        </div>
                    </div>


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
//                alert('server not responding...');
            });

}

function accept_price(item_id, user_id, price) {

 $("#accept").modal('show');
    var fun_url3 = "{!! lang_url('add_bids') !!}";

   var data = {

      item_id: item_id, user_id: user_id, price: price, _token: '{{csrf_token()}}'
//
  };
//    
//    

$('#saveaccept').on('click', function (evt) {
  
    $.ajax({
        type: "POST",
        url: fun_url3,
        data: data,
        success: function (data) {

            if (data == 'error')
            {
                var errmesage = "{{trans('cpanel.error')}}";
                alert(errmesage);
                location.reload();

            } else {
                var succes = "{{trans('cpanel.done_accepd_bids')}}";
                alert(succes);
                location.reload();

            }
        }

    });
        });


}
function delte_notfication(id){
     $("#delte_notfication").modal('show');
    var fun_url3 = "{!! lang_url('delte_notfication') !!}";
       var data = {

      id: id, _token: '{{csrf_token()}}'
//
  };


$('#delte_end').on('click', function (evt) {
  
    $.ajax({
        type: "POST",
        url: fun_url3,
        data: data,
        success: function (data) {

           if(data==1){
                 $("#delte_notfication").modal('hide');
           $("#row"+id).hide();

           }
         

        }

    });
        });
}

</script>





<!-- DASHBOARD CONTENT -->
@stop