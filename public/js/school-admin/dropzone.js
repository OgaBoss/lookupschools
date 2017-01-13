/**
 * Created by OluwadamilolaAdebayo on 2/22/16.
 */
$(document).ready(function(){
    $('#lightgallery').lightGallery();
    Dropzone.autoDiscover = false; // keep this line if you have multiple dropzones in the same page
    $(".uploadform").dropzone({
        acceptedFiles: "image/jpeg",
        url: '/school/page_image_upload?id='+$('.uicon').attr('data-id'),
        paramName : 'webpageimage',
        maxFiles: 1, // Number of files at a time
        maxFilesize: 2, //in MB
        maxfilesexceeded: function(file) {
            alert('You have uploaded more than 1 Image. Only the first file will be uploaded!');
        },
        success: function (response, data) {
            $('.else').text('');
            for (var key in data) {
                if (key == 'error_msg') {
                    $(".modal-header").prepend('<div class="alert alert-danger fade in">' +
                        data[key]+'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '</div>');
                } else if (key == 'save') {
                    var msg = data[key];
                    $(".modal-header").prepend('<div class="alert alert-success fade in">School Image Uploaded<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '</div>');
                    var li = $("<li />", {
                        "class": "col-md-2", // you need to quote "class" since it's a reserved keyword
                        "data-src" : msg
                    });
                    var anch = $("<a />", {
                        "href" : ""
                    })
                    var img = $("<img />", {
                        "src" : msg,
                        "width" : 120,
                        "height" : 120,
                        "class" : "img-responsive"
                    });
                    var inner = anch.append(img);
                    li = li.append(inner)
                    $('#lightgallery').append(li);
                }
            }
            console.log(data);

            //var x = JSON.parse(response.xhr.responseText);
            //$('.icon').hide();
            //$('#uploader').modal('hide');
            //$('.img').attr('src',x.img);
            //$('.thumb').attr('src',x.thumb);
            //$('img').addClass('imgdecoration');
            this.removeAllFiles();
            //console.log('Image -> '+x.img+', Thumb -> '+x.thumb);          // Just to return the JSON to the console.
        },
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }

    });

});