/**
 * Created by OluwadamilolaAdebayo on 1/29/16.
 */
$(document).ready(function(){
    var $modal = $('#ajax-modal');
    function uniqueId () {
        return 'id-' + Math.random().toString(36).substr(2, 16);
    };

    //Get ALL EVENTS FOR THIS SCHOOL
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
                editable: true,
                droppable: true,
                utc:false,
                timezone: 'Africa/Lagos',
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    //copiedEventObject.allDay = false;
                    copiedEventObject.start = date
                    copiedEventObject.id = uniqueId();
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("border-color");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },

                eventReceive: function(event){
                    event.id = uniqueId();
                    $('#calendar').fullCalendar('updateEvent',event);
                },
                eventClick: function(event, jsEvent, view){
                    var time = $.fullCalendar.moment(event.start['_d']);

                    localStorage.setItem("start", time.format('YYYY-MM-DD[T]HH:mm:SS'));
                    localStorage.setItem("title", event.title);

                    if(event.end != null){
                        var end_time = $.fullCalendar.moment(event.end['_d']);
                        localStorage.setItem("end", end_time.format('YYYY-MM-DD[T]HH:mm:SS'));
                    }else{
                        var end_time = null;
                        localStorage.setItem("end", end_time);

                    }

                    //Bring up modal
                    $('body').modalmanager('loading');
                    setTimeout(function(){
                        $modal.load('/events.html', '', function(){
                            $modal.modal();
                        });
                    }, 1000);

                    $modal.on('click', '.event-save', function(e){
                        e.preventDefault();
                        var dataObj = {
                            "title" : localStorage.getItem('title'),
                            "start" : localStorage.getItem('start'),
                            "end"   : localStorage.getItem('end'),
                            "sid"   : $("#id").val(),
                            "event_id" : event.id,
                            "color" : event.backgroundColor
                        };
                        $modal.modal('loading');
                        setTimeout(function(){
                            $.ajax({
                                type: "POST",
                                dataType:"json",
                                url: '/school/save_events',
                                data: dataObj,
                                success: function(data){
                                    $modal.find('.modal-footer').hide();
                                    $modal.find('.todo').hide();
                                    for(var key in data){
                                        if(key == 'save'){
                                            $modal
                                                .modal('loading')
                                                .find('.modal-body')
                                                .prepend('<div class="alert alert-success fade in">Events Created and Saved<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                                '</div>');
                                        }else if(key == 'error_msg'){
                                            $modal
                                                .modal('loading')
                                                .find('.modal-body')
                                                .prepend('<div class="alert alert-danger fade in">'+ data[key] +'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                                '</div>');
                                        }
                                        localStorage.removeItem('start');
                                        localStorage.removeItem('end');
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
                            });
                        }, 2000);
                    });

                    //Edit Title
                    $modal.on('click', '.event-change', function (e){
                        e.preventDefault();
                        $modal.modal('loading');
                        setTimeout(function(){
                            $modal.load('/change_events.html', '', function(){
                                $modal.modal();
                            });
                        }, 1000);

                        $modal.on('click', '.save-change', function(e){

                            e.preventDefault();
                            $modal.modal('loading');
                            var new_data = {
                                'uid' : event.id,
                                'title' : $('#new-title').val()
                            };
                            event.title = $('#new-title').val();
                            $('#calendar').fullCalendar('updateEvent',event);
                            setTimeout(function(){
                                $.ajax({
                                    type: "POST",
                                    dataType:"json",
                                    url: '/school/edit_events',
                                    data: new_data,
                                    success: function(data){
                                        $modal.find('.modal-footer').hide();
                                        $modal.find('.new-data').hide();
                                        console.log(data);
                                        for(var key in data){
                                            if(key == 'save'){
                                                $modal
                                                    .modal('loading')
                                                    .find('.modal-body')
                                                    .prepend('<div class="alert alert-success fade in">'+ data[key] +'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                                    '</div>');
                                            }else if(key == 'error_msg'){
                                                $modal
                                                    .modal('loading')
                                                    .find('.modal-body')
                                                    .prepend('<div class="alert alert-danger fade in">'+ data[key] +'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                                    '</div>');
                                            }
                                            localStorage.removeItem('start');
                                            localStorage.removeItem('end');
                                        }
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
                                });
                            }, 1000);
                        });
                    });

                    //Delete title
                    $modal.on('click', '.event-delete', function(e){
                        e.preventDefault();
                        $modal.modal('loading');
                        var new_data = {
                            'uid' : event.id,
                        };
                        $('#calendar').fullCalendar('removeEvents',event.id);
                        setTimeout(function(){
                            $.ajax({
                                type: "POST",
                                dataType:"json",
                                url: '/school/delete_events',
                                data: new_data,
                                success: function(data){
                                    $modal.find('.modal-footer').hide();
                                    $modal.find('.todo').hide();
                                    console.log(data);
                                    for(var key in data){
                                        if(key == 'save'){
                                            $modal
                                                .modal('loading')
                                                .find('.modal-body')
                                                .prepend('<div class="alert alert-success fade in">'+ data[key] +'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                                '</div>');
                                        }else if(key == 'error_msg'){
                                            $modal
                                                .modal('loading')
                                                .find('.modal-body')
                                                .prepend('<div class="alert alert-danger fade in">'+ data[key] +'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                                '</div>');
                                        }
                                        localStorage.removeItem('start');
                                        localStorage.removeItem('end');
                                    }
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
                            });
                        }, 1000);
                    });
                }
            });

        },
        error: function(data){

        }
    });

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
        ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });
    }

    ini_events($('#external-events div.external-event'));


    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
        e.preventDefault();
        //Save color
        currColor = $(this).css("color");
        //Add color effect to button
        $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });


    $("#add-new-event").click(function (e) {
        e.preventDefault();
        //Get value and make sure it is not null
        var val = $("#new-event").val();
        if (val.length == 0) {
            return;
        }

        //Create events
        var event = $("<div />");
        event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
        event.html(val);
        $('#external-events').prepend(event);

        //Add draggable funtionality
        ini_events(event);

        //Remove event from text input
        $("#new-event").val("");
        $(".timepicker").val("");
    });

    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });
});