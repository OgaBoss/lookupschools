/**
 * Created by OluwadamilolaAdebayo on 11/4/15.
 */

$('#ad-icons .col-md-4 .fa').mouseenter(function(){
   $(this).parent().next().animate({
       bottom: 0,
   }, 200);
}).mouseleave(function(){
    $(this).parent().next().animate({
        bottom: '-20px',
    }, 200);
});

