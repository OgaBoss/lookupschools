/**
 * Created by OluwadamilolaAdebayo on 9/23/15.
 */

$(document).ready(function() {
    var locations = [
        ['Bondi Beach', -33.890542, 151.274856, 4],
        ['Coogee Beach', -33.923036, 151.259052, 5],
        ['Cronulla Beach', -34.028249, 151.157507, 3],
        ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(-33.92, 151.25),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    $('.class-type .fa-question-circle ').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 45px; width: 120px; color:red;">School Type/ School Level not available.</p>')
    });


    $('.com-tooltip').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: 'Loading....',
        functionBefore: function(origin, continueTooltip) {
            // we'll make this function asynchronous and allow the tooltip to go ahead and show the loading notification while fetching our data
            continueTooltip();
            // next, we want to check if our data has already been cached
            var content = $(this).attr('data-truncate');
            origin.tooltipster('content', content);

        }
    });



    //Compare criteria
    $("input:checkbox").on('click', function() {
        if($(this).attr('name') == 'sch-basic'){
            if($(this).prop('checked')){
                $('.compare-details').show('slow');
            }else{
                $('.compare-details').hide('slow');
            }
        }

        if($(this).attr('name') == 'sch-contact'){
            if($(this).prop('checked')){
                $('.contact').show('slow');
            }else{
                $('.contact').hide('slow');
            }
        }

        if($(this).attr('name') == 'sch-accre'){
            if($(this).prop('checked')){
                $('.accreditation').show('slow');
            }else{
                $('.accreditation').hide('slow');
            }
        }

        if($(this).attr('name') == 'sch-affi'){
            if($(this).prop('checked')){
                $('.affiliation').show('slow');
            }else{
                $('.affiliation').hide('slow');
            }
        }

        if($(this).attr('name') == 'sch-struc'){
            if($(this).prop('checked')){
                $('.structure').show('slow');
            }else{
                $('.structure').hide('slow');
            }
        }

        if($(this).attr('name') == 'sch-extra'){
            if($(this).prop('checked')){
                $('.extras').show('slow');
            }else{
                $('.extras').hide('slow');
            }
        }
    });

    $(".toggle").on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('fa-toggle-off')){
            $(this).removeClass('fa-toggle-off').addClass('fa-toggle-on')
            $('.sch-deselect').prop('checked',true);
            $('.sch-basic').prop('checked',true);
            $('.sch-contact').prop('checked',true);
            $('.sch-accre').prop('checked',true);
            $('.sch-affi').prop('checked',true);
            $('.sch-struc').prop('checked',true);
            $('.sch-extra').prop('checked',true);
            $('.compare-details, .contact, .accreditation, .affiliation, .structure, .extras').show('slow');
            $('.toggle-text').text('Show all');
        }else if($(this).hasClass('fa-toggle-on')){
            $(this).removeClass('fa-toggle-on').addClass('fa-toggle-off')
            $('.sch-deselect').prop('checked',false);
            $('.sch-basic').prop('checked',false);
            $('.sch-contact').prop('checked',false);
            $('.sch-accre').prop('checked',false);
            $('.sch-affi').prop('checked',false);
            $('.sch-struc').prop('checked',false);
            $('.sch-extra').prop('checked',false);
            $('.compare-details, .contact, .accreditation, .affiliation, .structure, .extras').hide('slow');
            $('.toggle-text').text('Show none');
        }
    });

    $('.fa-times-circle').on('click',function(e){
        e.preventDefault();
        $(this).parent().parent().parent().hide('slow');
    });

    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
        '<div class="loading-spinner" style="width: 400px; margin-left: -200px;">' +
        '<div class="progress progress-striped active">' +
        '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
        '</div>';

    //Guest follow school
    var $modal = $('#ajax-modal');
    $('.follow').on('submit', function(event){
        var class_check = $(this).parent();
        class_check = $(class_check[0]).attr('data-class-check');
        event.preventDefault();
        $('body').modalmanager('loading');
        var $btn = $(this).find('.follow-sch');
        var $sid  = $(this).find("input[name='school_id']");
        $.ajax({
            type:"POST",
            url: '/follows',
            data: {'school_id': $sid.val()},
            success: function(data){
                for(var key in data) {
                    if (key == 'error_msg') {
                        setTimeout(function () {
                            $modal.load('/error.html', '', function () {
                                $modal.modal();
                                $('#input_error').append("<li>" + data[key] + "</li>");
                            });
                        }, 1000);
                    } else if (key == 'save') {
                        $($btn[0]).text('Following');
                        $($btn[0]).css(
                            "padding-left", '30',
                            "padding-right", '30'
                        );
                        setTimeout(function () {
                            $modal.load('/success.html', '', function () {
                                $modal.modal();
                                $('#input_success').append("<li>" + data[key] + "</li>");
                            });
                        }, 1000);
                    }else if (key == 'login') {
                        //$('#login-modal').modal('show');
                        setTimeout(function () {
                            $modal.load('/success.html', '', function () {
                                $('#md-close-success').text('Cancel');
                                $modal.modal();
                                var $url = window.location.href;
                                console.log($url);
                                $('#input_success').append("<li>Please click <a href='/login?backPage="+$url+";"+class_check+"'>here</a> to login</li>");
                            });
                        }, 1000);
                    }
                }
            }
        });
    })
});
