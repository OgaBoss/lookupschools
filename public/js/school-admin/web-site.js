/**
 * Created by OluwadamilolaAdebayo on 3/19/16.
 */
$(document).ready(function(){
    var $modal = $('#ajax-modal');
    toastr.options.closeButton = true;
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

    $('.form-edit').on('click', function(e){
        e.preventDefault();
        $('.form-edit').hide();
        $("input[type='text'], input[type='email'], .select2").prop('disabled', false);
        $(".bio").attr('disabled', false);
        $(".bio").css({
            'border':'1px solid #d2d6de'
        });
        $("input[type='text'], input[type='email'], .select2").css({
            'border':'1px solid #d2d6de'
        });
        $('.select2-container--default .select2-selection--single .select2-selection__arrow b').show();
        $('.select2-container--default.select2-container--disabled .select2-selection--single').css({
            'background-color':"#E7E7E7"
        });
        $('.btn-info').show();
    });

    var form_show = function(){
        $('.form-edit').hide();
        $("input[type='text'], input[type='email'], .select2").prop('disabled', false);
        $(".bio").attr('disabled', false);
        $(".bio").css({
            'border':'1px solid #d2d6de'
        });
        $("input[type='text'], input[type='email'], .select2").css({
            'border':'1px solid #d2d6de'
        });
        $('.select2-container--default .select2-selection--single .select2-selection__arrow b').show();
        $('.select2-container--default.select2-container--disabled .select2-selection--single').css({
            'background-color':"#E7E7E7"
        });
        $('.btn-info').show();
    }

    var form_hide = function(){
        $("input[type='text'], input[type='email'], .select2, input[type='textarea']").css({
            'border':'none'
        });
        $("input[type='text'], .select2, input[type='textarea']").prop('disabled', true);
        $(".bio").attr('disabled', true);
        $(".bio").css({
            'border':'none'
        });
        $('.btn-info').hide();
        $('.form-edit').show();
        $('.select2-container--default .select2-selection--single .select2-selection__arrow b').hide();
    }

    $('.statement').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        var form_data = $(this).serialize();

        //Hide button, disable form text
       form_hide();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/statement',
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

    //Upload Team members Image

    function ajaxImage(data,img,d_form,loader) {
        for (var key in data) {
            if (key == 'error_msg') {
                var msg = data[key];
                setTimeout(function () {
                    var load = '.'+loader;
                    console.log(load);
                    $(load).hide();
                    toastr.error(msg);
                }, 3000)

            } else if (key == 'save') {
                var msg = data[key];
                var frm = '.'+d_form;
                var new_img = '.'+img;
                var loader = '.'+loader;
                setTimeout(function () {
                    $(loader).hide();
                    $(new_img).attr('src', msg);
                    $(frm).show();
                    form_show();
                    toastr.success('School Logo Uploaded!');
                }, 3000)
            }
        }
    }

    function uploadFile(file,url,type,img,d_form,count,loader){
        //var url = $('#image_upload').attr('data-url');
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                //if it all went well
                var data = JSON.parse(xhr.responseText);
                ajaxImage(data,img,d_form,loader);
            }
        };
        fd.append("upload_file", file);
        fd.append("id",$('#id').val() );
        fd.append("type",type );
        fd.append("count",count );
        xhr.send(fd);
    }

    var uploadFiles = document.querySelector('#image_upload');
    uploadFiles.addEventListener('change', function(){
        $('.img-loader').show();
        var loader = 'img-loader';
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i], $(this).attr('data-url'), $(this).attr('data-type'), $(this).attr('data-image-class'), $(this).attr('data-form'), $(this).attr('data-team-count'), loader); // call the function to upload the file
        }
    }, false);

    var uploadFiles_2 = document.querySelector('#image_upload_2');
    uploadFiles_2.addEventListener('change', function(){
        $('.img-loader-2').show();
        var loader = 'img-loader-2';
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i], $(this).attr('data-url'), $(this).attr('data-type'), $(this).attr('data-image-class'), $(this).attr('data-form'), $(this).attr('data-team-count'), loader); // call the function to upload the file
        }
    }, false);

    var uploadFiles_3 = document.querySelector('#image_upload_3');
    uploadFiles_3.addEventListener('change', function(){
        $('.img-loader-3').show();
        var loader = 'img-loader-3';
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i], $(this).attr('data-url'), $(this).attr('data-type'), $(this).attr('data-image-class'), $(this).attr('data-form'), $(this).attr('data-team-count'), loader); // call the function to upload the file
        }
    }, false);

    var testimony_1 = document.querySelector('#testimony_upload_1');
    testimony_1.addEventListener('change', function(){
        $('.testimony-loader-1').show();
        var loader = 'testimony-loader-1';
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i], $(this).attr('data-url'), $(this).attr('data-type'), $(this).attr('data-image-class'), $(this).attr('data-form'), $(this).attr('data-team-count'), loader); // call the function to upload the file
        }
    }, false);

    var testimony_2 = document.querySelector('#testimony_upload_2');
    testimony_2.addEventListener('change', function(){
        $('.testimony-loader-2').show();
        var loader = 'testimony-loader-2';
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i], $(this).attr('data-url'), $(this).attr('data-type'), $(this).attr('data-image-class'), $(this).attr('data-form'), $(this).attr('data-team-count'), loader); // call the function to upload the file
        }
    }, false);

    var testimony_3 = document.querySelector('#testimony_upload_3');
    testimony_3.addEventListener('change', function(){
        $('.testimony-loader-3').show();
        var loader = 'testimony-loader-3';
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i], $(this).attr('data-url'), $(this).attr('data-type'), $(this).attr('data-image-class'), $(this).attr('data-form'), $(this).attr('data-team-count'), loader); // call the function to upload the file
        }
    }, false);

    //Save data for each team member
    $('.member_one').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        var form_data = $(this).serialize();

        //Hide button, disable form text
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/team-member',
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

    //Save data for each Testimony
    $('.testimony_one').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        var form_data = $(this).serialize();

        //Hide button, disable form text
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/setTestimony',
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
