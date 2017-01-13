/**
 * Created by OluwadamilolaAdebayo on 2/7/16.
 */
$(document).ready(function(){
    var $modal = $('#ajax-modal');
    toastr.options.closeButton = true;
    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
        '<div class="loading-spinner" style="width: 400px; margin-left: -200px;">' +
        '<div class="progress progress-striped active">' +
        '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
        '</div>';

    $('.suspend').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 15px; width: 55px">Suspend</p>')
    });

    $('.suspended').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 25px; width: 100px">User Already Suspended</p>')
    });

    $('.ban').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 15px; width: 30px">Ban</p>')
    });

    $('.approve').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 15px; width: 50px">Approve</p>')
    });

    $('.approved').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 25px; width: 100px">User Already Approved</p>')
    });

    $(document).on('click', '.suspend', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');

        var data = {"uid" : $(this).attr('data-id')}

        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/admin/suspend',
            data: data,
            success: function(data){
                for(var key in data){
                    if(key == 'error_msg'){
                        setTimeout(function(){
                            $modal.load('/error.html', '', function(){
                                $modal.modal();
                                $('#input_error').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }else if(key == 'save'){
                        setTimeout(function(){
                            $modal.load('/success.html', '', function(){
                                $modal.modal();
                                $('#input_success').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }else if(key == 'map'){
                        setTimeout(function(){
                            $modal.load('/warning.html', '', function(){
                                $modal.modal();
                                $('#input_success').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }
                }
            }
        });
    });

    $(document).on('click', '.approve', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');

        var data = {"uid" : $(this).attr('data-id')}
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/admin/approve',
            data: data,
            success: function(data){
                for(var key in data){
                    if(key == 'error_msg'){
                        setTimeout(function(){
                            $modal.load('/error.html', '', function(){
                                $modal.modal();
                                $('#input_error').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }else if(key == 'save'){
                        setTimeout(function(){
                            $modal.load('/success.html', '', function(){
                                $modal.modal();
                                $('#input_success').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }else if(key == 'map'){
                        setTimeout(function(){
                            $modal.load('/warning.html', '', function(){
                                $modal.modal();
                                $('#input_success').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }
                }
            }
        });
    });

    //Show User profile
    $('.user_name').on('click', function (e) {
        e.preventDefault();
        $('body').modalmanager('loading');

        setTimeout(function(){
            $modal.load('/user_profile.html', '', function(){
                $modal.modal();
                $modal.css({
                    'margin-left' : '-500px'
                })
                $modal.width('1000');
            });
        }, 1000);
    });

    //Search for user by email
    $(".search-by-email").on('submit', function(e){
        e.preventDefault();
        $('.ajax-loader').show();
        var data = $(this).serialize();
        $.ajax({
            type: "GET",
            dataType:"json",
            url: '/admin/user_by_email',
            data: data,
            success: function(data){
                for(var key in data){
                    if(key == 'error_msg'){
                        setTimeout(function(){
                            $('.ajax-loader').hide();
                            toastr.error(data[key]);
                        }, 1000);
                    }else if(key == 'save'){
                        setTimeout(function(){
                            console.log();
                            $('.user_name').text(data[key].name);
                            $('.user_name').attr('data-user-id', data[key].id);
                            $('.user-email').text(data[key].email);
                            $('.user-date').text(data[key].date);
                            $('.user-sch').text(data[key].count);
                            $('.approved, .suspend, .fa-thumbs-up, .fa-ban').attr('data-id',data[key].id);

                            if(data[key].status == true){
                                $('.user-status').append(
                                    '<td><small class="label bg-green">Approved</small></td>'
                                );

                            }else{
                                $('.user-status').append(
                                    '<td><small class="label bg-red">Supended</small></td>'
                                )
                                $('.approved').removeClass('approved').addClass('approve');
                                $('.fa-thumbs-up').css({
                                    'color' : '#009a00'
                                });

                                $('.suspend').removeClass('suspend').addClass('suspended');
                                $('.fa-ban').css({
                                    'color' : 'grey'
                                });
                            }
                            $('.ajax-loader').hide();
                        }, 1000);
                    }
                }
            }
        });
    })
})
