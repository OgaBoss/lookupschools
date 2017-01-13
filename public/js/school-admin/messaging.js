/**
 * Created by OluwadamilolaAdebayo on 2/27/16.
 */
$(document).ready(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
   var editor =  CKEDITOR.replace('editor1');

   toastr.options.closeButton = true;

   function ajax(data) {
      for (var key in data) {
         if (key == 'error_msg') {
            var msg = data[key];
            setTimeout(function () {
               $('.fa-spinner').hide();
               toastr.error(msg);
            }, 3000)

         } else if (key == 'save') {
            var msg = data[key];
            setTimeout(function () {
               $('.fa-spinner').hide();
               toastr.success(msg);
            }, 3000)
         }
      }
   }

   $('.compose').on('submit', function(e){
      e.preventDefault();
      $('.fa-spinner').show();

      var form_data = {
         'receiver' : $('.to').val(),
         'slug' : $('#slug').val(),
         'subject' : $('.subject').val(),
         'body' : editor.getData(),
         'id' : $('#id').val()
      };

      $.ajax({
         type: "POST",
         dataType : "json",
         url : '/guest/post_compose',
         data : form_data,
         success : function(data){
            ajax(data);

         }
      });
   });
});
