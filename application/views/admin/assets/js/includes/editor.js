(function($) {
"use strict";

	CKEDITOR.replace('service-content');
	const regex = /<[^>]*script/gi;
	$('form').on('submit',function(fe) {
		
		var found = 0;

		let m;
		var formContext = $(this);
		formContext.find("#service-content").each(function(e) {
			var value = CKEDITOR.instances['service-content'].getData();
			var varTitle = $('<textarea />').html(value).text();
			
			while ((m = regex.exec(varTitle)) !== null) {
				if (m.index === regex.lastIndex) {
					regex.lastIndex++;
				}
				
				m.forEach((match, groupIndex) => {
					fe.preventDefault();
					found = 1;
				});
			}
		});
		
		if(found == 1) {
			$('#somethngwrng').fadeIn().delay('4000').fadeOut('slow');
			return false;
		}
	});
  
})(jQuery);