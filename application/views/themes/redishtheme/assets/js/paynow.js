(function($){
	'use strict';
		
		//services show in div's
		let $selectMethod 		= $('#selectMethod');//
		var form 				= $('#serviceUserForm');//
		var is_card 			= false;

		$selectMethod.on('change', function(){
			$(this).find("option:selected").each(function(){
				var optionValue = $(this).attr("value");
				if(optionValue == 1){
					is_card = true;
					$('#payment-card').removeClass('d-none');
				} else{
					is_card = false;
					$("#payment-card").addClass('d-none');
				}
			});
		});
		
		// Card
		var elements = stripe.elements();

		var style = {
		base: {
			color: '#32325d',
			fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
			fontSmoothing: 'antialiased',
			fontSize: '16px',
			'::placeholder': {
			color: '#aab7c4'
			}
		},
		invalid: {
			color: '#fa755a',
			iconColor: '#fa755a'
		}
		};

		// Create an instance of the card Element.
		var card = elements.create('card', {style: style});

		// Add an instance of the card Element into the `card-element` <div>.
		card.mount('#card-element');

		// Handle real-time validation errors from the card Element.
		card.on('change', function(event) {
		var displayError = document.getElementById('card-errors');
		if (event.error) {
			displayError.textContent = event.error.message;
		} else {
			displayError.textContent = '';
		}
		});

		// Handle form submission.
		form.on('submit', function(event) {
			event.preventDefault();
			if(is_card) { // When Stripe Select
				stripe.createToken(card).then(function(result) {
					if (result.error) {
					// Inform the user if there was an error.
					var errorElement = document.getElementById('card-errors');
					errorElement.textContent = result.error.message;
					} else {
						submit_form(result);
					}
				});
			} else { // When By Cash Select
				window.location.replace(base + "userbooking/");
			}
		});

		// Function by Submit Form
		function submit_form(result) {
			if(is_card){
				form.append('<input type="hidden" name="stripeToken" value="' + result.token.id + '">');
			}

			$('.stage').removeClass('d-none');
			$('.loaderBeforeSubmit').addClass('d-none');
			$.ajax({
				type: "POST",
				url: form.attr('action'),
				data : form.serialize(),
				dataType: "json",

				success: function(data) {
					console.log(data);
					$.each(data, function(key, value) {
						if(value!=''){
							$('.stage').addClass('d-none');
							$('.loaderBeforeSubmit').removeClass('d-none');
						}
						else{
							$('.stage').addClass('d-none');
							$('.loaderBeforeSubmit').removeClass('d-none');
						}
					});
					if(data.serviceAdded == true){
						if(data.payment.orderid == ''){
							window.location.replace(base + "userbooking/")
						}
						else{
							window.location.replace(base + "invoice/" + data.payment.orderid);
						}
					}
					if(data.serviceAdded == false){
						$('.stage').addClass('d-none');
						$('.loaderBeforeSubmit').removeClass('d-none');
					}
					
				}
			});
		}
})(jQuery);