/**
 * Created by OluwadamilolaAdebayo on 11/14/15.
 */
$(document).ready(function () {
    //Disable all input fields
    //$("input[type='text']").prop('disabled', true).addClass('remove-input');
    //$('.select2').prop('disabled', true)
    //$('.select2-selection__arrow').hide();
    //$('.select2-container--default.select2-container--disabled .select2-selection--single').addClass('remove-input');

    //Enable text input on click
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

    var $modal = $('#ajax-modal');
    toastr.options.closeButton = true;


    function ajaxImage(data) {
        for (var key in data) {
            if (key == 'error_msg') {
                var msg = data[key];
                setTimeout(function () {
                    $('.img-loader').hide();
                    toastr.error(msg);
                }, 3000)

            } else if (key == 'save') {
                var msg = data[key];
                setTimeout(function () {
                    $('.img-loader').hide();
                    $("#school_logo").attr('src', data['save']);
                    $(".img-circle").attr('src', data['save']);
                    toastr.success('School Logo Uploaded !');
                }, 3000)
            } else if (key == 'update') {
                var msg = data[key];
                setTimeout(function () {
                    $('.img-loader').hide();
                    toastr.success(msg);
                }, 3000)
            }
        }
    }

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

    function uploadFile(file,url){
        //var url = $('#image_upload').attr('data-url');
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                //if it all went well
                var data = JSON.parse(xhr.responseText);
                ajaxImage(data);
            }
        };
        fd.append("upload_file", file);
        fd.append("id",$('#id').val() )
        xhr.send(fd);
    }

    var uploadFiles = document.querySelector('#image_upload');
    uploadFiles.addEventListener('change', function(){
        $('.img-loader').show();
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i], $(this).attr('data-url')); // call the function to upload the file
        }
    }, false);

    //Update Image method
    function updateImage(file,url,who){
        //var url = $('#image_upload').attr('data-url');
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                //if it all went well
                var data = JSON.parse(xhr.responseText);
                if(who == 'user'){
                    for(var key in data){
                        if(key == 'save'){
                            $('.image-update-delete').hide();
                            $(".user_profile_pic").attr('src', data['save']);
                            $modal
                                .modal('loading')
                                .find('.modal-body')
                                .prepend('<div class="alert alert-success fade in">User Image updated<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '</div>');
                        }else if(key == 'error_msg'){
                            $('.image-update-delete').hide();
                            $modal
                                .modal('loading')
                                .find('.modal-body')
                                .prepend('<div class="alert alert-danger fade in">' +
                                data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '</div>');
                        }
                    }
                }else{
                    for(var key in data){
                        if(key == 'save'){
                            $("#school_logo").attr('src', data['save']);
                            $('.image-update-delete').hide();
                            $modal
                                .modal('loading')
                                .find('.modal-body')
                                .prepend('<div class="alert alert-success fade in"> School logo updated<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '</div>');
                        }else if(key == 'error_msg'){
                            $('.image-update-delete').hide();
                            $modal
                                .modal('loading')
                                .find('.modal-body')
                                .prepend('<div class="alert alert-danger fade in">' +
                                data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '</div>');
                        }
                    }
                }
            }
        };
        fd.append("upload_file", file);
        fd.append("id",$('#id').val() )
        xhr.send(fd);
    }

    //Update school Image
    $('.image-update').on('click', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');

        $modal.load('/image.html', '', function(response, status, xhr){
            $modal.modal();
            if(status != 'error') {
                var uploadFiles = document.querySelector('#image_upload_update');
                uploadFiles.addEventListener('change', function(){
                    $modal.modal('loading');
                    var files = this.files;
                    for(var i=0; i<files.length; i++){
                        updateImage(this.files[i], $(this).attr('data-url')); // call the function to upload the file
                    }
                }, false);
            }
        });
    });

    //Update user profile Image
    $('.user_update_image').on('click', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');

        $modal.load('/user_image.html', '', function(response, status, xhr){
            $modal.modal();
            if(status != 'error') {
                var uploadFiles = document.querySelector('#image_upload_update');
                uploadFiles.addEventListener('change', function(){
                    $modal.modal('loading');
                    var files = this.files;
                    for(var i=0; i<files.length; i++){
                        updateImage(this.files[i], $(this).attr('data-url'), 'user'); // call the function to upload the file
                    }
                }, false);
            }
        });
    });

    $(document).on('click', '.fa-eye-slash', function(){
        var $this = $(this);
        $this.removeClass('fa-eye-slash').addClass('fa-eye');
        var this_input = $this.parent().parent().prev();
        this_input.prop("type", "text");
    });


    $(document).on('click', '.fa-eye', function(){
        var $this = $(this);
        $this.removeClass('fa-eye').addClass('fa-eye-slash');
        var this_input = $this.parent().parent().prev();
        this_input.prop("type", "password");
    });

    //Change user profile
    $('.edit_profile').on('submit', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');
        var form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/edit_profile',
            data: form_data,
            success: function(data){
                ajax(data, $modal);
            },
            error: function(data){

            }
        })
    });

    //Delete school logo
    $('.logo-delete').on('click', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');

        $modal.load('/delete_logo.html', '', function(response, status, xhr){
            $modal.modal();
            if(status != 'error') {
                var uploadFiles = document.querySelector('.del-logo');
                uploadFiles.addEventListener('click', function(){
                    $modal.modal('loading');
                    $.ajax({
                        type: "POST",
                        dataType:"json",
                        url: '/school/delete_school_logo',
                        data: {id: $('#id').val()},
                        success: function(data){
                            $('.check').hide();
                            for(var key in data){
                                if(key == 'save'){
                                    $("#school_logo").attr('src', '/img/school-icon.png');
                                    $modal
                                        .modal('loading')
                                        .find('.modal-body')
                                        .prepend('<div class="alert alert-success fade in">'+ data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '</div>');
                                }else if(key == 'error_msg'){
                                    $modal
                                        .modal('loading')
                                        .find('.modal-body')
                                        .prepend('<div class="alert alert-danger fade in">' +
                                        data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '</div>');
                                }
                            }
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
                }, false);
            }
        });
    });

    //Delete user profile image
    $('.image-delete').on('click', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');

        $modal.load('/delete_logo.html', '', function(response, status, xhr){
            $modal.modal();
            if(status != 'error') {
                var uploadFiles = document.querySelector('.del-logo');
                uploadFiles.addEventListener('click', function(){
                    $modal.modal('loading');
                    $.ajax({
                        type: "POST",
                        dataType:"json",
                        url: '/school/delete_user_image',
                        data: {id: 'null'},
                        success: function(data){
                            $('.check').hide();
                            for(var key in data){
                                if(key == 'save'){
                                    $(".user_profile_pic").attr('src', '/img/user.png');
                                    $modal
                                        .modal('loading')
                                        .find('.modal-body')
                                        .prepend('<div class="alert alert-success fade in">'+ data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '</div>');
                                }else if(key == 'error_msg'){
                                    $modal
                                        .modal('loading')
                                        .find('.modal-body')
                                        .prepend('<div class="alert alert-danger fade in">' +
                                        data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '</div>');
                                }
                            }
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
                }, false);
            }
        });
    });

    //change password
    $('.change_password').on('submit', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');
        var form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/change_password',
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
    })
});