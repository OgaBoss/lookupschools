/**
 * Created by OluwadamilolaAdebayo on 4/25/16.
 */
$(document).ready(function(){
    $(document).on('click', '.fa-plus-circle', function(e){
        e.preventDefault();
        //alert('hello');
        var form = '<div class="form-group"><label class="col-md-2 control-label">Name</label><div class="col-md-8"><input placeholder="Data Name" class="form-control input-sm" id="school-name" name="name" type="text"></div></div>';
        $('.textbox1').after(form);
    });

    $('.data').on('submit', function(e){
        e.preventDefault();
        $('.ajax-loader').show();
        var data = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/admin/data_post',
            data: data,
            success: function(data){
                console.log(data);
            },
        })
    })
});