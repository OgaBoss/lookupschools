/**
 * Created by OluwadamilolaAdebayo on 3/5/16.
 */
$(document).ready(function() {
    var $modal = $('#ajax-modal');

    $("#owl-demo").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds

        items : 2,
    });

    $('.ads').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 60px; width: 120px">Please provide a youtube video url of the video you want people to see</p>')
    });

    //Ajax call for Signup

    function ajax(data,type,$this) {
        for (var key in data) {
            if (key == 'error_msg') {
                var msg = data[key];
                setTimeout(function () {
                    $('.fa-spinner').hide();
                    toastr.error(msg);
                }, 1000);
            } else if (key == 'save') {
                var msg = data[key];
                setTimeout(function () {
                    $('.fa-spinner').hide();
                    if(type ='sign'){
                        $($this).find('.btn-save').removeClass('btn-info').addClass('btn-danger').text('Cancel');
                        $($this).removeClass('ad_sign').addClass('ad_cancel');
                        $('select').hide();
                    }else{
                        $($this).find('.btn-save').removeClass('btn-danger').addClass('btn-info').text('SignUp');
                        $($this).removeClass('ad_cancel').addClass('ad_sign');
                        $('select').show();
                    }
                    toastr.success(msg);
                }, 1000);
            }
        }
    }


    //$(document).on('submit','.ad_sign', function(e){
    //    e.preventDefault();
    //    var $this = $(this);
    //    $(this).parent().find('.fa-spinner').show();
    //
    //    //show a spinner here
    //    var form_data = $(this).serialize();
    //    $.ajax({
    //        type: "POST",
    //        dataType:"json",
    //        url: '/advert/ad_signup',
    //        data: form_data,
    //        success: function(data){
    //            ajax(data, 'sign', $this);
    //        },
    //        error: function(data){
    //            setTimeout(function(){
    //                $modal.load('/error.html', '', function(){
    //                    $modal.modal();
    //                    $('#input_error').append("<li>Something went wrong, please refresh the page and try again, thank you.</li>");
    //                });
    //            }, 1000);
    //        }
    //    });
    //});

    $(document).on('submit','.ad_cancel', function(e){
        e.preventDefault();
        $(this).parent().find('.fa-spinner').show();
        //show a spinner here
        var form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/advert/cancel_ad',
            data: form_data,
            success: function(data){
                ajax(data, 'cancel');
            },
            error: function(data){
                setTimeout(function(){
                    $modal.load('/error.html', '', function(){
                        $modal.modal();
                        $('#input_error').append("<li>Something went wrong, please refresh the page and try again, thank you.</li>");
                    });
                }, 1000);
            }
        });
    });

    $('#modal_type').change(function(e){
        e.preventDefault();
        if($(this).val() == 'video'){
            $('.modal_url').show();
        }else{
            $('.modal_url').hide();

        }
    })


});