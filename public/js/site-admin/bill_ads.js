/**
 * Created by OluwadamilolaAdebayo on 6/4/16.
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
        var current = $(this);
        var status = 'status_ar_'+current.attr('data-id');
        var future_status = 'status_su_'+current.attr('data-id');
        var data = {"uid" : current.attr('data-id')}

        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/admin/advert/suspend',
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
                                $('.'+status).removeClass('bg-green').removeClass(status).addClass('bg-red').addClass(future_status).text('Suspended');
                                $(current).parent()
                                    .prev()
                                    .find('a.approved')
                                    .removeClass('approved')
                                    .addClass('approve')
                                    .find('i')
                                    .css("color", '#009a00');
                                $(current).removeClass('suspend').addClass('suspended').find('i').css('color', 'grey');
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
        var current = $(this);
        var status = 'status_su_'+current.attr('data-id');
        var future_status = 'status_ar_'+current.attr('data-id');
        var data = {"uid" : current.attr('data-id')}



            $.ajax({
                type: "POST",
                dataType:"json",
                url: '/admin/advert/approve',
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
                                    $('.'+status).removeClass('bg-red').removeClass(status).addClass('bg-green').addClass(future_status).text('Approved');
                                    $(current).parent()
                                        .next()
                                        .find('a.suspended')
                                        .removeClass('suspended')
                                        .addClass('suspend')
                                        .find('i')
                                        .css("color", '#ffae1a');
                                    $(current).removeClass('approve').addClass('approved').find('i').css('color', 'grey');
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
});