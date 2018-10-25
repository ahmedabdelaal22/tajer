$(document).ready(function () {
    var base_url = $('#base_url').val();
//    $(".admin_delete").click(function () {
//        var id = $(this).data("id");
//        var action = $(this).data("action");
//        $("#Delete_form").attr("action", action);
//        $('html, body').animate({scrollTop: 0}, 0);
//    });





    jQuery("#user_id_permission").change(function () {
        var user_id = jQuery(this).val();
        var redirec_url = base_url + "/user_permissions";
        if (user_id > 0) {
            redirec_url = base_url + '/user_permissions/' + user_id + '/edit';
        }
        location.href = redirec_url;
        //location.href = jQuery(this).val();
    })


    var lounge_radio = jQuery('input[name="type"]:checked').val();
//        var lounge_radio = jQuery('#type').val();
    if (lounge_radio > 1) {
        jQuery('#has_lounge').prop("checked", false); // Unchecks it
        jQuery('#has_lounge').css('pointerEvents', 'none');
    } else {
        jQuery('#has_lounge').css('pointerEvents', 'auto');
    }

    jQuery('.select_type').click(function () {
        var lounge_radio = jQuery('input[name="type"]:checked').val();
//        var lounge_radio = jQuery('#type').val();
        if (lounge_radio > 1) {
            jQuery('#has_lounge').prop("checked", false); // Unchecks it
            jQuery('#has_lounge').css('pointerEvents', 'none');
        } else {
            jQuery('#has_lounge').css('pointerEvents', 'auto');
        }
    });
});

/****** to preview uploaded image ******/

function readURL(input, img_id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#' + img_id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}



/****************************************/
