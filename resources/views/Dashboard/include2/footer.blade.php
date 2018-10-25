
</div>
<!-- /DASHBOARD BODY -->

<div class="shadow-film closed"></div>

<!-- SVG ARROW -->
<svg style="display: none;">
<symbol id="svg-arrow" viewBox="0 0 3.923 6.64014" preserveAspectRatio="xMinYMin meet">
    <path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
          L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"/>
</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG PLUS -->
<svg style="display: none;">
<symbol id="svg-plus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
    <rect x="5" width="3" height="13"/>
    <rect y="5" width="13" height="3"/>
</symbol>
</svg>
<!-- /SVG PLUS -->

<!-- SVG MINUS -->
<svg style="display: none;">
<symbol id="svg-minus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
    <rect y="5" width="13" height="3"/>
</symbol>
</svg>
<!-- /SVG MINUS -->
<!-- jQuery -->


<!--
<script src="{{ asset('public/assets/'.DSH .'/js/vendor/jquery-3.1.0.min.js')}}"></script>

<script src="{{ asset('public/assets/'.DSH .'/js/vendor/tether.min.js')}}"></script>

<script src="{{ asset('public/assets/'.DSH .'/js/vendor/bootstrap.min.js')}}"></script>
-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


<!-- XM Pie Chart -->
<script src="{{ asset('public/assets/'.DSH .'/js/vendor/jquery.xmpiechart.min.js')}}"></script>
<!-- Side Menu -->
<script src="{{ asset('public/assets/'.DSH .'/js/side-menu.js')}}"></script>
<!-- Dashboard Header -->
<script src="{{ asset('public/assets/'.DSH .'/js/dashboard-header.js')}}"></script>
</body>
<!-- Mirrored from odindesign-themes.com/emerald-dragon/dashboard-settings.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Jul 2017 15:49:38 GMT -->
<script type="text/javascript">

/****** to preview uploaded image ******/

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/****************************************/

</script>

<script>
    $(document).ready(function () {

        $('#country1').on('change', function () {
            // $("body").on('change', '#country', function() {
            var country_id = this.value;
            var req_url = "{!! lang_url('ajax_cities_country') !!}" + '/' + country_id;

            $.ajax({
                type: "Get",
                url: req_url,
                data: {country_id: country_id},
                dataType: 'json', // Define data type will be JSON
                success: function (result) {
                    var cities_data = result.cities_data;
                    var $el = $("#city");
                    $el.empty(); // remove old options
                    cities_data.forEach(function (entry) {
                        $el.append('<option value="' + entry.id + '">' + entry.name + '</option>');
                    });

                },
                error: function (error) {
                    $("#ajaxResponse").append("<div>" + error + "</div>");
                }
            }); //end ajax
        }); //end on change country


        $('#category_id').on('change', function () {
            // $("body").on('change', '#country', function() {
            var category_id = this.value;
            var req_url = "{!! lang_url('ajax_get_sub_category') !!}" + '/' + category_id;

            $.ajax({
                type: "Get",
                url: req_url,
                data: {category_id: category_id},
                dataType: 'json', // Define data type will be JSON
                success: function (result) {

                    var cities_data = result.sub_categories_data;
                    var $el = $("#sub_categories");
                    $el.empty(); // remove old options
                    cities_data.forEach(function (entry) {
                        $el.append('<option value="' + entry.id + '">' + entry.title + '</option>');
                    });

                },
                error: function (error) {
                    $("#ajaxResponse").append("<div>" + error + "</div>");
                }
            }); //end ajax
        }); //end on change country

    });  //End Document.Ready


</script>


<script type="text/javascript">
    $(document).ready(function () {
        //   alert('1');
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click

            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input class="image_gallery "  name="image_gallery[]" type="file"><a href="#" class="remove_field">{{trans("cpanel.Remove")}}</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })


        var max_multi_size_fields = 10; //maximum input boxes allowed
        var wrapper_multi_size = $(".input_multi_size_fields_wrap"); //Fields wrapper_multi_size
        var add_multi_size_button = $(".add_multi_sizes_button"); //Add button ID

        var x_multi_size = 1; //initlal text box count
        $(add_multi_size_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x_multi_size < max_multi_size_fields) { //max input box allowed
                x_multi_size++; //text box increment
                $(wrapper_multi_size).append('<div><input class="multi_sizes form-control"  name="multi_size[]" type="text"><a href="#" class="remove_multi_size_field">Remove</a></div>'); //add input box
            }
        });
        $(wrapper_multi_size).on("click", ".remove_multi_size_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x_multi_size--;
        })

        /*
         var max_multi_color_fields = 10; //maximum input boxes allowed
         var wrapper_multi_color = $(".input_multi_color_fields_wrap"); //Fields wrapper_multi_color
         var add_multi_color_button = $(".add_multi_colors_button"); //Add button ID

         var x_multi_color = 1; //initlal text box count
         $(add_multi_color_button).click(function (e) { //on add input button click
         e.preventDefault();
         if (x_multi_color < max_multi_color_fields) { //max input box allowed
         x_multi_color++; //text box increment
         $(wrapper_multi_color).append('<div><input class="multi_colors form-control"  name="multi_color[]" type="color"><a href="#" class="remove_multi_color_field">Remove</a></div>'); //add input box
         }
         });
         $(wrapper_multi_color).on("click", ".remove_multi_color_field", function (e) { //user click on remove text
         e.preventDefault();
         $(this).parent('div').remove();
         x_multi_color--;
         })*/
    });
    function deleteimage(image_id)
    {
        var answer = confirm("Are you sure you want to delete from this post?");
        if (answer)
        {
            $.ajax({
                type: "Get",
                url: "<?php echo url('admin/delete_gallery_ajax'); ?>",
                data: {id: image_id},
                dataType: 'json', // Define data type will be JSON
                success: function (response) {

                    if (response > 0) {
                        $(".imagelocation" + image_id).remove(".imagelocation" + image_id);
                    }

                },
                error: function (err) {
                    console.log(err.error);
                }
            });
        }
    }
//



//
    function deletesize(size_id)
    {

        var answer = confirm("Are you sure you want to delete from this post?");
        if (answer)
        {
            $.ajax({
                type: "Get",
                url: "<?php echo url('delete_size_ajax'); ?>",
                data: {id: size_id},
                dataType: 'json', // Define data type will be JSON
                success: function (response) {
                    if (response > 0) {
                        $(".sizelocation" + size_id).remove(".sizelocation" + size_id);
                    }


                },
                error: function (err) {
                    console.log(err.error);
                }
            });
        }
    }

    /*
     function deletecolor(color_id)
     {

     var answer = confirm("Are you sure you want to delete from this post?");
     if (answer)
     {
     $.ajax({
     type: "Get",
     url: "<?php echo url('delete_color_ajax'); ?>",
     data: {id: color_id},
     dataType: 'json', // Define data type will be JSON
     success: function (response) {
     if (response > 0) {
     $(".colorlocation" + color_id).remove(".colorlocation" + color_id);
     }


     },
     error: function (err) {
     console.log(err.error);
     }
     });
     }
     }*/






//    $(document).ready(function() {
//
//
//      $(".add-more").click(function(){
//
//          var html = $(".copy").html();
//
//          $(".after-add-more").after(html);
//
//      });
//
//
//      $("body").on("click",".remove",function(){
//
//          $(this).parents(".control-group").remove();
//
//      });
//
//
//    });




</script>


<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

<script>
    /*
     $(document).ready(function () {
     //        $(function () {
     ////            $("#start_date").datepicker();
     //            $("#start_date").datepicker("option", "dateFormat", "DD/MM/YYYY");
     //        });
     //
     //        jQuery(function () {
     //            jQuery(".start_date").datepicker({
     //                dateFormat: "DD/MM/YYYY",
     //                minDate: '1'
     //            });
     //
     //        });



     $(function () {
     var dateFormat = "DD/MM/YYYY",
     from = $("#start_date")
     .datepicker({
     defaultDate: "+1w",
     changeMonth: false,
     minDate: 0,
     numberOfMonths: 1
     }).on("change", function () {
     to.datepicker("option", "minDate", getDate(this));
     }),
     to = $("#end_date").datepicker({
     defaultDate: "+1w",
     changeMonth: false,
     numberOfMonths: 2
     }).on("change", function () {
     from.datepicker("option", "maxDate", getDate(this));
     });

     function getDate(element) {
     var date;
     try {
     date = $.datepicker.parseDate(dateFormat, element.value);
     } catch (error) {
     date = null;
     }

     return date;
     }
     });
     });  //End Document.Ready*/
</script>

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
<!--Load Script and Stylesheet -->
<script type="text/javascript" src="{{ asset('public/assets/dtpicker/jquery.simple-dtpicker.js')}}"></script>
<link type="text/css" href="{{ asset('public/assets/dtpicker/jquery.simple-dtpicker.css')}}" rel="stylesheet" />

<script type="text/javascript">
    $(function () {
        // -- Example Only - Set the date range --
        var d = new Date();
        d.setDate(d.getDate());
//				$('#start_time').val(d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + " 1:00 pm");
        // Example Only - Set the end date to 7 days in the future so we have an actual
        d.setDate(d.getDate() + 2);
//				$('#end_time').val(d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + " 13:45 ");
        // -- End Example Only Code --

        $('#start_time').appendDtpicker({
            "futureOnly": true,

        });
        $('#start_time_edit').appendDtpicker({
            // "futureOnly": true,

        });

        $('#end_time').appendDtpicker({
            "futureOnly": true,
            minDate: $('#start_time').val() // when the start time changes, update the minDate on the end field
        });

        // Attach a change event to end_time -
        // NOTE we are using '#ID' instead of '*[name=]' selectors in this example to ensure we have the correct field
        $('#end_time').change(function () {
            $('#start_time').appendDtpicker({
                maxDate: $('#end_time').val() // when the end time changes, update the maxDate on the start field
            });
        });

        $('#start_time').change(function () {
            $('#end_time').appendDtpicker({
                minDate: $('#start_time').val() // when the start time changes, update the minDate on the end field
            });
        });

        // trigger change event so datapickers get attached
        $('#end_time').trigger('change');
        $('#start_time').trigger('change');
    });
</script>



<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script>
    $('.make-text-editor').ckeditor();

// $('.textarea').ckeditor(); // if class is prefered.
</script>

<input type="hidden" id="base_url" value="{{url('/')}}" />

<style>
    .input-file{
        display: none;
    }
</style>
</html>