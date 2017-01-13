/**
 * Created by OluwadamilolaAdebayo on 1/25/16.
 */
$(document).ready(function(){
    var $modal = $('#ajax-modal');
    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
        '<div class="loading-spinner" style="width: 400px; margin-left: -200px;">' +
        '<div class="progress progress-striped active">' +
        '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
        '</div>';

    $.ajax({
        type: "POST",
        dataType:"json",
        url: '/school/all_events',
        data: {'sid': $("#id").val()},
        success: function(data){
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                events: data['data'],
                eventClick: function(event, jsEvent, view){
                    var time = $.fullCalendar.moment(event.start['_d']);

                    localStorage.setItem("start", time.format('YYYY-MM-DD[T]HH:mm:SS'));
                    localStorage.setItem("title", event.title);

                    var end_time = $.fullCalendar.moment(event.end['_d']);
                    localStorage.setItem("end", end_time.format('YYYY-MM-DD[T]HH:mm:SS'));

                    $('body').modalmanager('loading');
                    setTimeout(function(){
                        $modal.load('/event_description.html', '', function(){
                            $modal.modal();
                            $('.title').text(localStorage.getItem('title'))
                            $('.start').text(localStorage.getItem('start'))
                            $('.end').text(localStorage.getItem('end'))
                        });
                    }, 1000);
                }

        })
        },
        error: function(data){
        }
    })

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

    $(document).on('click','.fa-star-o', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');

        if($(this).hasClass('fa-star-o')){
            $(this).removeClass('fa-star-o')
                .addClass('fa-star')
                .css({
                    "color":"#f2994b",
                    "font-size":"24px",
                    "margin-left":"50px"
                });
            $(this).prevAll()
                .removeClass('fa-star-o')
                .addClass('fa-star')
                .css({
                    "color":"#f2994b",
                    "font-size":"24px",
                    "margin-left":"50px"
                });

            //Ajax Call
            var $sid = $('#id').val();
            var $value = $(this).attr('data-value');
            $.ajax({
                type: "POST",
                dataType:"json",
                url: '/guest/rank',
                data: {'value': $value, 'sid':$sid},
                success: function(data){
                    ajax(data, $modal);
                },
                error: function(data){

                }
            })

        }
    });

    $('.clear-rank').on('click', function (e) {
        e.preventDefault();

            $('.rank .fa-star').removeClass('fa-star')
                .addClass('fa-star-o')
                .css({
                    "color":"#999999",
                    "font-size":"24px",
                    "margin-left":"50px"
                });
    });

    //Calendar

});