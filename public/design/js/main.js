$(document).ready(function(){
    $('.lest-menu').on('click',function(){
     $('.list').toggleClass('activelist');
    });
    $('.fa-close').click(function () { 
        $('.list').removeClass('activelist');
    });
    $('.grid').on('click',function(){
        $('.grid i').addClass('active');
        $('.list i').removeClass('active');

        $(' .g-l').removeClass('col-lg-12').addClass('col-lg-4');
        $(' .img-col').removeClass('col-lg-4').addClass('col-lg-12');
        $(' .col-info').removeClass('col-lg-8').addClass('col-lg-12');
        $(' .info p').addClass('grid-p text-center');
        $(' .info .price').addClass('d-block text-center');
        $(' .info .old-price').addClass('d-block text-center');
        $(' .btn-info').removeClass('mr-lg-0 ml-lg-0 mr-sm-auto ml-sm-auto').addClass('mx-auto');
         
    });
    $('.list').on('click',function(){
        $('.list i').addClass('active');
        $('.grid i').removeClass('active');

        $(' .g-l').removeClass('col-lg-4').addClass('col-lg-12');
        $(' .img-col').removeClass('col-lg-12').addClass('col-lg-4');
        $(' .col-info').removeClass('col-lg-12').addClass('col-lg-8');
        $(' .info p').removeClass('grid-p text-center');
        $(' .info .price').removeClass('d-block text-center');
        $(' .info .old-price').removeClass('d-block text-center');
        $(' .btn-info').removeClass('mx-auto').addClass('mr-lg-0 ml-lg-0 mr-sm-auto ml-sm-auto');
    });

    //Gallery images change 

    $('.img-smaill').on('click',function () {
        $('.img-smaill').removeClass('active');
        $(this).addClass('active');
        $('.img-big').attr('src', $(this).attr('src'));
    });

    $('.inc').on('click',function(){
        var myinput = $('.myinput');
        var myval = parseInt(myinput.val());
        myval = myval +1;
        myinput.val(myval);
    });
    $('.dec').on('click',function(){
        var myinput = $('.myinput');
        var myval = parseInt(myinput.val());
        myval = myval -1;
        myinput.val(myval);
    });

});

/****** to preview uploaded image ******/
function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $('#blah')
    .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
    }
    }
    /****************************************/