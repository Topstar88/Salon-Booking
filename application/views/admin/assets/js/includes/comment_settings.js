(function($) {
"use strict";
    $(document).ready(function(e) {
		
        $(".activePlugin").click(function() {
			$(".settings-container").addClass("d-none");
			var value = $(this).val();
			if(value == 1) {
				$("#facebook-settings-container").removeClass("d-none");
			}
			else {
				$("#disqus-settings-container").removeClass("d-none");
			}
		});
    });
})(jQuery);