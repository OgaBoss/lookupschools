
/**
 * Created by OluwadamilolaAdebayo on 11/17/15.
 */
$(document).ready(function(){
    $('.form-edit').on('click', function(e){
        e.preventDefault();
        $('.form-edit').hide();
        $("input[type='text'], input[type='email'], .select2").prop('disabled', false);
        $("input[type='text'], input[type='email'], .select2").css({
            'border':'1px solid #d2d6de'
        });
        $('.select2-container--default .select2-selection--single .select2-selection__arrow b').show();
        $('.select2-container--default.select2-container--disabled .select2-selection--single').css({
            'background-color':"#E7E7E7"
        });
        $('.btn-info').show();
    });

    //Send Affiliations to db
    var $modal = $('#ajax-modal');

    function ajax(data, $modal) {
        for (var key in data) {
            if (key == 'error_msg') {
                setTimeout(function () {
                    $modal.load('/error.html', '', function () {
                        $modal.modal();
                        $('#input_error').append("<li>" + data[key] + "</li>");
                    });
                }, 1000);
            } else if (key == 'save') {
                setTimeout(function () {
                    $modal.load('/success.html', '', function () {
                        $modal.modal();
                        $('#input_success').append("<li>" + data[key] + "</li>");
                    });
                }, 1000);
            } else if (key == 'update') {
                setTimeout(function () {
                    $modal.load('/success.html', '', function () {
                        $modal.modal();
                        $('#input_success').append("<li>" + data[key] + "</li>");
                    });
                }, 1000);
            }
        }
    }

    $('.accreditation').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        var form_data = $(this).serialize();

        //Hide button, disable form text
        $("input[type='text'], input[type='email'], .select2").css({
            'border':'none'
        });
        $("input[type='text'], .select2").prop('disabled', true);
        $('.btn-info').hide();
        $('.form-edit').show();
        $('.select2-container--default .select2-selection--single .select2-selection__arrow b').hide();

        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/post_school_accreditation',
            data: form_data,
            success: function(data){
                ajax(data, $modal);
            },
            error: function(data){
                setTimeout(function(){
                    $modal.load('/error.html', '', function(){
                        $modal.modal();
                        $('#input_error').append("<li>Something went wrong, please refresh the page and try again, thank you.</li>");
                    });
                }, 1000);
            }
        })
    });

    //Send Affiliation
    $('.affiliation').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        var form_data = $(this).serialize();

        //Hide button, disable form text
        $("input[type='text'], input[type='email'], .select2").css({
            'border':'none'
        });
        $("input[type='text'], .select2").prop('disabled', true).addClass('remove-input');
        $('.btn-info').hide();
        $('.form-edit').show();
        $('.select2-container--default .select2-selection--single .select2-selection__arrow b').hide();

        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/post_school_affiliation',
            data: form_data,
            success: function(data){
                ajax(data, $modal);
            },
            error: function(data){
                setTimeout(function(){
                    $modal.load('/error.html', '', function(){
                        $modal.modal();
                        $('#input_error').append("<li>Something went wrong, please refresh the page and try again, thank you.</li>");
                    });
                }, 1000);
            }
        })
    });
});