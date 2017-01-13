
/**
 * Created by OluwadamilolaAdebayo on 11/21/15.
 */
$(document).ready(function (){
    var $modal = $('#ajax-modal');
    toastr.options.closeButton = true;
    var $select = $("#average-child-no, #average-child-room, #average-class-no, #teacher_student_ratio, #nanny_baby_ratio, #average-student");
    for (i=1;i<=20;i++){
        $select.append($('<option></option>').val(i).html(i))
    }

    function dataTable(data) {
        var clubs = data['clubs'];
        var health = data['health'];
        var medical = data['medical'];
        var daycare = data['daycare'];
        var vocational = data['vocational'];
        var sport = data['sport'];
        var subject = data['subject'];
        var vocation = data['vocation'];
        var program = data['program'];
        var accommodation = data['accommodation'];
        $("#clubs").select2({
            data: allNames(clubs)
        });
        $("#health").select2({
            data: allNames(health)
        });
        $("#medical").select2({
            data: allNames(medical)
        })
        $("#daycare").select2({
            data: allNames(daycare)
        })
        $("#vocational").select2({
            data: allNames(vocational)
        })
        $("#sport").select2({
            data: allNames(sport)
        })
        $("#subject").select2({
            data: allNames(subject)
        })
        $("#vocation").select2({
            data: allNames(vocation)
        })
        $("#program").select2({
            data: allNames(program)
        })
        $("#accommodation").select2({
            data: allNames(accommodation)
        })
    }


    $('#add-new-data').on('click', function (e) {
        e.preventDefault();
        $modal.load('/new-data.html', '', function(){
            $modal.modal();
        });
    });

    $modal.on('click', '.test', function(e){
        var table = $('.school-data-table').val();
        var name = $('#data').val();
        var name_arr = name.split(',');
        $('.modal-body')
            .empty()
            .append('<p>Are you sure you want to add the following data</p>')
            .append('<ul></ul>')
            .append('<button type="button" class="btn btn-success test-yes" style="margin-right: 30px">Yes</button>')
            .append('<button type="button" class="btn btn-info test-no">No</button>');
        for(var r = 0; r < name_arr.length; r++){
            $('.modal-body ul').append('<li>'+name_arr[r]+'</li>')
        }

        $(document).on('click', '.test-yes', function(e){
            e.preventDefault();
            $modal.modal('loading');
            setTimeout(function(){
                $.ajax({
                    type: "POST",
                    dataType:"json",
                    url: '/school/postTableData',
                    data: {'table':table, 'data':name},
                    success: function(data){
                        for(var key in data){
                            if(key == 'save'){
                                $modal
                                    .modal('loading')
                                    .find('.modal-body')
                                    .prepend('<div class="alert alert-success fade in">' +
                                    data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '</div>');
                                $('.test-yes, .test-no').hide();
                            }else if(key == 'error'){
                                $modal
                                    .modal('loading')
                                    .find('.modal-body')
                                    .prepend('<div class="alert alert-danger fade in">' +
                                    data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '</div>');
                                $('.test-yes, .test-no').hide();
                            }
                        }
                    },
                    error: function(data){
                        setTimeout(function(){
                            $modal.load('/error.html', '', function(){
                                $modal.modal();
                                $('#input_error').append("<li>Something went wrong, please refresh the page and try again, thank you.</li>");
                            });
                        }, 1000);                    }
                });
            }, 2000);
        });
    });



    $('.refresh').on('click', function(e){
        $('.refresh').addClass('img-loader');
        $('.giphy').removeClass('img-loader');
        setTimeout(function(){
            $.ajax({
                type: "GET",
                dataType:"json",
                url: '/school/tableData',
                success: function(data){
                    $('.giphy').addClass('img-loader');
                    $('.refresh').removeClass('img-loader');
                    toastr.success('Data has being reloaded!');
                    dataTable(data);
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
        }, 3000);
    })

    for(i=1; i <= 15; i++){
        $('#age_limit_pps').append($('<option></option>').val(i).html(i));
    }

    $('#age_limit').append($('<option></option>').val('no limit').html('No age Limit'));
    for(i=1; i <= 40; i++){
        $('#age_limit').append($('<option></option>').val(i).html(i));
    }

    function allNames(obj) {
        var arr = new Array();
        for (var i = 0; i < obj.length; i++) {
            arr.push(obj[i]['name']);
        }
        return arr;
    }

    function ajax(data){
        for(var key in data){
            if(key == 'error_msg'){
                setTimeout(function(){
                    $modal.load('/error.html', '', function(){
                        $modal.modal();
                        $('#input_error').append("<li>"+data[key]+"</li>");
                    });
                }, 1000);
            }else if(data['save']){
                setTimeout(function(){
                    $modal.load('/success.html', '', function(){
                        $modal.modal();
                        $('#input_success').append("<li>"+data[key]+"</li>");
                    });
                }, 1000);
            }else if(key == 'update'){
                setTimeout(function(){
                    $modal.load('/success.html', '', function(){
                        $modal.modal();
                        $('#input_success').append("<li>"+data[key]+"</li>");
                    });
                }, 1000);
            }
        }
    }

    $('.tvbasic').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/post_tv_school_extras',
            data: form_data,
            success: function(data){
                ajax(data);
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

    $('.primary-section-one').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/post_pps_school_extras_one',
            data: form_data,
            success: function(data){
                ajax(data);
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

    $('.primary-section-two').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/post_pps_school_extras_two',
            data: form_data,
            success: function(data){
                ajax(data);
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

    $.ajax({
        type: "GET",
        dataType:"json",
        url: '/school/tableData',
        success: function(data){
            dataTable(data);
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