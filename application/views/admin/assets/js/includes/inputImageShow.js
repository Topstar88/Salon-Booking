(function($){
	'use strict';
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).parent('.input-file-image').find('.img-upload-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.input-file-image input[type="file"]').change(function () {
        readURL(this);
    });
})(jQuery);