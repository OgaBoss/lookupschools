/**
 * Created by OluwadamilolaAdebayo on 11/15/15.
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

    //Ajax post to submit school-contact
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

    $('.contact').on('submit', function(e){
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
            url: '/school/post_school_contact',
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

    //Set up placeholder for select boxes
    $('#ownership').select2({
        placeholder: "Select a kind of owner"
    });

    $('#sex').select2({
        placeholder: "Sex Orientation"
    });

    $('#public').select2({
        placeholder: "Type of public ownership"
    });

    $('#private').select2({
        placeholder: "Type of private ownership"
    });

    $('#religion').select2({
        placeholder: "Select a religion type"
    });

    $('#school_type').select2({
        placeholder: "Select a school type"
    });

    $('#tertiary').select2({
        placeholder: "Select type os tertiary school"
    });

    var $width = $('.ownership .select2.select2-container.select2-container--default').css('width');
    $('#ownership').on('change', function(){
        if($('#ownership').val() == 'Public'){
            $('.public').show();
            $('.public .select2.select2-container.select2-container--default').css('width', $width);
            if($('.private').is(':visible')){
                $('.private').hide();
            }
        }else if($('#ownership').val() == 'Private'){
            $('.private').show();
            $('.select2.select2-container.select2-container--default').css('width', $width);
            if($('.public').is(':visible')){
                $('.public').hide();
            }
        }
    });

    $('#public').on('change', function(){
        if($('#public').val() == 'Military'){
            $('.military').show();
            $('.military .select2.select2-container.select2-container--default').css('width', $width);
        }else{
            $('.military').hide();
        }
    });

    //If the value of ownership is public show the public div
    //If the value of ownership is private show the private div
    if($('#ownership').val() == 'Public' ){
        $('.public').show();
        $('.public .select2.select2-container.select2-container--default').css('width', $width);

    }else if($('#ownership').val() == 'Private'){
        $('.private').show();
        $('.select2.select2-container.select2-container--default').css('width', $width);

    }

    //Ajax post to submit school-structure
    $('.structure').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        var max = localStorage.getItem('max');
        var min = localStorage.getItem('min');
        $('body').modalmanager('loading');
        form_data = $(this).serialize();

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
            url: '/school/post_school_structure',
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

    //Ion SLider
    $("#range_2").ionRangeSlider({
        onFinish : function (data) {
            localStorage.setItem('max', data.toNumber)
            localStorage.setItem('min', data.fromNumber)
        }
    });
});
