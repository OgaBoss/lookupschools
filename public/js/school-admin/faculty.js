/**
 * Created by OluwadamilolaAdebayo on 12/8/15.
 */
$(document).ready(function(){
    var $modal = $('#ajax-modal');
    $('#multiselect').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
        }
    });
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
            }else if(key == 'warning'){
                setTimeout(function(){
                    $modal.load('/warning.html', '', function(){
                        $modal.modal();
                        $('#input_success').append("<li>"+data[key]+"</li>");
                    });
                }, 1000);
            }
        }
    }

    $('.faculty-course').on('submit', function(e){
        e.preventDefault();
        console.log($('#multiselect_to').val());

        //show a loader here
        $('body').modalmanager('loading');
        form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/post_faculty_courses',
            data: {'id':$('#multiselect_to').val(), 'school_id':$('#id').val()},
            success: function(data){
                ajax(data);
            },
            error: function(data){
                console.log(data);
                setTimeout(function(){
                    $modal.load('/error.html', '', function(){
                        $modal.modal();
                        $('#input_error').append("<li>Something went wrong, please refresh the page and try again, thank you.</li>");
                    });
                }, 1000);
            }
        })
    });

    $('.save-course').on('click', function (e){
        e.preventDefault();
        var $this = $(this);
        var $this_attr = $this.attr('data-button-id');
        var current_select = $("[data-select-id='" + $this_attr + "']");
        var course_names = current_select.val()
        var faculty_id = current_select.attr('data-faculty-id');
        console.log(current_select.attr('name'));

        $('body').modalmanager('loading');

        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/post_courses',
            data: {
                'courses' : course_names,
                'school_id' : $('#id').val(),
                'faculty_id' : faculty_id,
            },
            success: function(data){
                ajax(data);
            },
            error: function(){
                setTimeout(function(){
                    $modal.load('/error.html', '', function(){
                        $modal.modal();
                        $('#input_error').append("<li>Something went wrong, please refresh the page and try again, thank you.</li>");
                    });
                }, 1000);
            }
        })


    });
})
