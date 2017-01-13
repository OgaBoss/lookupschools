/**
 * Created by OluwadamilolaAdebayo on 12/5/15.
 */
$(document).ready(function(){
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

    //Create User
    //Send Affiliation
    $('.create_user').on('submit', function(e){
        e.preventDefault();
        //show a spinner here
        $('body').modalmanager('loading');
        form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/createNewUser',
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
        });
    });
});
