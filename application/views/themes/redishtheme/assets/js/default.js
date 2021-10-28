(function($){
	'use strict';
		$(".filterList li").first().addClass("active");
		let $formContinue 		= $("#formContinue");
		let $afterContinueMain 	= $(".afterContinueMain");
		let $formDataMain 		= $(".formDataMain");
		let $formChange 		= $(".formChange");
		let $sTitleError 		= $("#sTitleError");
		let $dateError 			= $("#dateError");
		let $timeError 			= $("#timeError");

		let $adultsVal 			= $("#adultsVal");
		let $childVal 			= $("#childVal");
		let $userSelectTiming 	= $('#userSelectTiming');
		let $datepicker 		= $('#datepicker');
		let $selectBookNow 		= $('#selectBookNow');
		
		//services show in div's
		let $serviceTitle 		= $('#serviceTitle');
		let $selectedAdults 	= $('#selectedAdults');
		let $selectedChildrens 	= $('#selectedChildrens');
		let $selectedDate 		= $('#selectedDate');
		let $selectedTime 		= $('#selectedTime');
		let $servicePersonPrice = $('#servicePersonPrice');
		let $priceDiv 			= $('#serviceTotalPrice');
		let $selectMethod 		= $('#selectMethod');
		var form 				= $('#serviceUserForm');
		var is_card 			= false;
		var card 				= '';

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
		
		
		if(stripePub && stripeStatus == true){
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
		}

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
				submit_form();
			}
		});

		// Function by Submit Form
		function submit_form(result) {
			if(is_card){
				form.append('<input type="hidden" name="stripeToken" value="' + result.token.id + '">');
			}

			form.removeClass('is-invalid');
			$('.stage').removeClass('d-none');
			$('.loaderBeforeSubmit').addClass('d-none');
			$.ajax({
				type: "POST",
				url: form.attr('action'),
				data : form.serialize(),
				dataType: "json",

				success: function(data) {
					$.each(data, function(key, value) {
						if(value!=''){
							$('#input-' + key).addClass('is-invalid');
							$('.stage').addClass('d-none');
							$('.loaderBeforeSubmit').removeClass('d-none');
						}
						else{
							$('#input-' + key).addClass('is-valid');
							$('.stage').addClass('d-none');
							$('.loaderBeforeSubmit').removeClass('d-none');
						}
						$('#input-' + key).parents('.form-group').find('#error').html(value);
					});
					if(data.serviceAdded == true){
						if(data.payment.orderid == ''){
							location.reload();
						}
						else{
							window.location.replace(base + "invoice/" + data.payment.orderid);
						}
					}
					if(data.serviceAdded == false){
						$('#alreadyBooked').fadeIn().delay('4000').fadeOut('slow');
						$('.stage').addClass('d-none');
						$('.loaderBeforeSubmit').removeClass('d-none');
					}
					
				}
			});
		}

		// Apear Loader when Click on Button
		$('#serviceUserForm input').on('keyup', function () { 
			$(this).removeClass('is-invalid');
			$(this).parents('.form-group').find('#error').html(" ");
		});

		function compareDate(timing) {
            let current = new Date();
			let hours   = current.getHours();
            let minutes = current.getMinutes();

			let split = timing.split(':');

            let start_hours = split[0].trimLeft('0');
            let start_minutes = split[1].trimLeft('0');
			

			if(start_minutes.includes('PM')) {
				if(parseInt(start_hours) != 12) {
					start_hours = parseInt(start_hours) + 12;
				}
			}

			start_minutes = start_minutes.split(/\s+/g)[0];

            if(start_hours > hours) {
				return true;
            } else if(start_hours == hours) {
                if(parseInt(start_minutes) > minutes) {
                    return true;
                }
            }

            return false;
		}

		// on select time check if agent busy
		$("#userSelectTiming").on('change', function(e){
			$('input:radio[name="agent"]').removeAttr('checked');
			$formContinue.addClass('disabled').prop('disabled', true);
			
			var date 		= $('.dateTimePickerInput').val();
			var time 		= $('#userSelectTiming').val();
			var service 	= $('#selectBookNow').val();
			var user_data 	= $('input:radio[name="agent"][value="0"]').attr('user_data');
			let agents 		= '';
			

			$('.selectAgentMain').removeClass('d-none');
			$('#selectAgentLabel').removeClass('d-none');
			let i;
			let agentId = '';
			$.ajax({
				url: base + homepage + '/selectagent',
				async: false,
				type: "POST",
				data : {"date" : date, 'time' : time, 'service' : service},
				dataType: "json",

				success: function(data) {
					if(data.exist){
						var x=0;
						for(x; x < data.exist.length; x++) { 
							var value = data.exist[x];
							if('input:radio[name="agent"][value="'+value.agentId+'"]'){
								$('input:radio[name="agent"][value="'+value.agentId+'"]').prop('disabled', true);
								$formContinue.addClass('disabled').prop('disabled', true);
							}
							if(data.exist.length >= user_data){
								$('#anyAgent').remove();
							}
							if('input:radio[name="agent"][value="0"]'){
								$('input:radio[name="agent"][value="0"]').prop('disabled', false);
							}
						}
					}
					else{
						$('input:radio[name="agent"]').prop('disabled', false);
						var isAny = $('.selectAgentMain').find('input:radio[name="agent"][value="0"]');
						if(isAny.length == 0 && data.agents.length > 1){
							agents += '<label class="agentItem" id="anyAgent"><input type="radio" value="0" name="agent" user_data="'+data.agents.length+'" label="Any Agent" class="viewDetail"><div class="agentItemInner"><div class="avatar"><div class="avatarBg" style="background-image: url('+upimg+'agents/default-avatar.jpg)"></div></div><div class="avatarName">Any Agent</div></div></label>';
							$('.selectAgentMain').prepend(agents);
						}
					}
				}
			});
		});
		
		//On Select Service
		$("#selectBookNow").on('change', function(e){
			$('#notimeError').addClass('d-none');
			$formContinue.addClass('disabled').prop('disabled', true);

			if($selectBookNow.val()!=''){
				$sTitleError.addClass('d-none');
			}
			if($datepicker.val()!=''){
				$dateError.addClass('d-none');
			}
			if($userSelectTiming.val()!=''){
				$timeError.addClass('d-none');
			}

			var selectedId = $(this).children("option:selected").val();
			if(selectedId != ''){
				$selectedAdults.html($adultsVal.val());
				$('.selectAgentMain').html('').addClass('d-none');
				$('#selectAgentLabel').addClass('d-none');

				$.ajax({
					url: base + homepage + '/selectFromDataById',
					async: false,
					type: "POST",
					data : {"bookingId" : selectedId},
					dataType: "json",

					success: function(data) {
						if(data.success == false){
							$adultsVal.attr("disabled", "disabled");
							$childVal.attr("disabled", "disabled");
							$userSelectTiming.prop("disabled", "disabled");
							$datepicker.prop("disabled", "disabled");
						}
						else{
							let i;
							let opt = '';
							let incd = 0;
							let timing = '';
							let agents = '';
							for(i=0; i < data.timing.length; i++){
								timing += '<option value="'+data.timing[i]+'" label="'+data.timing[i]+'">'+data.timing[i]+'</option>';
								let start_time = data.timing[i].split('-')[0].trim();
								
								if(compareDate(start_time)) {
									incd += 1;
									opt += '<option value="'+data.timing[i]+'" label="'+data.timing[i]+'">'+data.timing[i]+'</option>';
								}
							}
							if(data.agents.length > 1){
								agents += '<label class="agentItem" id="anyAgent"><input type="radio" value="0" name="agent" user_data="'+data.agents.length+'" label="Any Agent" class="viewDetail" checked="checked"><div class="agentItemInner"><div class="avatar"><div class="avatarBg" style="background-image: url('+upimg+'agents/default-avatar.jpg)"></div></div><div class="avatarName">Any Agent</div></div></label>';
							}
							$.each(data.agents, function(i, agent) {
								
								agents += '<label class="agentItem agentsAnim"><input id="agentRad" type="radio" value="'+agent.id+'" name="agent" label="'+agent.agentName+'" class="viewDetail"><div class="agentItemInner"><div class="avatar"><div class="avatarBg" style="background-image: url('+upimg+'agents/'+agent.agentImage+')"></div></div><div class="avatarName">'+agent.agentName+'</div><a class="agentModalOpen viewDetail"><span>View Details</span></a></div><div class="agentModal"><div class="agentModalInner"><span class="closeModalBtn">Close Details <i class="icon-close"></i></span><div class="agentModalHeader"><img src="'+upimg+'agents/'+agent.agentImage+'" class="img-thumbnail rounded-circle"><h3>'+agent.agentName+'</h3></div><div class="userColumns"><div class="row"><div class="col-md-6"><h4>'+agent.experience+'</h4><span>Experience Years</span></div><div class="col-md-6"><h4>'+agent.totalBookings+'</h4><span>Served Customers</span></div></div></div><p class="agentDetails">'+agent.agentDetail+'</p></div></div></label>';
							});
							$('.selectAgentMain').append(agents);
							if(incd == 0) {
								$userSelectTiming.prop('disabled', true);
								$('#notimeError').removeClass('d-none');
								$userSelectTiming.empty().append('<option value="">Select Time</option>');

								$datepicker.datetimepicker({
									minDate: moment().add(-1, "days"),
									maxDate: new Date(new Date().setMonth(new Date().getMonth() + 2)),
									format: 'MM-DD-YYYY',
									defaultDate: new Date(),
									daysOfWeekDisabled: [0, 6]
								});

								$datepicker.on('dp.show dp.change', function() {
									let today = moment().format('DD');
									let dateToday = $(this).val().split('-')[1];

									if(today != dateToday) {
										$userSelectTiming.prop('disabled', false);
										$userSelectTiming.empty().append('<option value="">Select Time</option>').append(timing);
										$('#notimeError').addClass('d-none');
									} else {
										$userSelectTiming.prop('disabled', true);
										$userSelectTiming.empty().append('<option value="">Select Time</option>');
										$('#notimeError').removeClass('d-none');
									}
								});

							} else {
								let todayOpt = opt;

								$datepicker.on('dp.show dp.change', function() {
									let today = moment().format('DD');
									let dateToday = $(this).val().split('-')[1];

									if(today != dateToday) {
										$userSelectTiming.prop('disabled', false);
										$userSelectTiming.empty().append('<option value="">Select Time</option>').append(timing);
									} else {
										$userSelectTiming.prop('disabled', false);
										$userSelectTiming.empty().append('<option value="">Select Time</option>').append(todayOpt);
									}
								})

								$userSelectTiming.prop("disabled", false);
								$userSelectTiming.empty().append('<option value="">Select Time</option>').append(opt);
							}

							$datepicker.prop("disabled", '');
							
							$serviceTitle.html($selectBookNow.find('option:selected').attr("label"));
							$userSelectTiming.on('change', function(e){
								$selectedTime.html($userSelectTiming.val());
								
								if($userSelectTiming.val()!=''){
									$timeError.addClass('d-none');
								}

							});
							$datepicker.on('focusout', function(e){
								$selectedDate.html($datepicker.val());
								if($datepicker.val()!=''){
									$dateError.addClass('d-none');
								}
							});
							$('.serviceImg').attr('src',  upimg + data.image);
							$servicePersonPrice.html(data.price);
							
							

							$adultsVal.attr("max", data.servSpace);
							$childVal.attr("max", data.servSpace);

							$adultsVal.prop("disabled", '');
							$childVal.prop("disabled", '');

							var $totalSpace = data.servSpace;
							var $totalPrice = 0.0;
							$priceDiv.html(data.price)
							function calculatePrice($adults, $children, $price) {
								$price = (parseInt($adults) + parseInt($children)) * $price;
								$priceDiv.html($price);
								return $price;
							}
							$adultsVal.val('1');
							$childVal.val('0');
							$datepicker.val('');
							$adultsVal.on("change", function (event) {
								$childVal.attr("max", $totalSpace - $adultsVal.val());
								$selectedAdults.html($adultsVal.val());
								$totalPrice = calculatePrice($adultsVal.val(), $childVal.val(), data.price);
							});
							$childVal.on("change", function (event) {
								$adultsVal.attr("max", $totalSpace - $childVal.val());
								$selectedChildrens.html($childVal.val());
								$totalPrice = calculatePrice($adultsVal.val(), $childVal.val(), data.price);
							});
							
						}
						
					},
					error : function(data) {
						alert('Somthing wrong you have done.!');
					}
				});
			}
		});
		$('.selectAgentMain').on("change", "input[name='agent']", function () {
			if($('input:radio[name="agent"]:checked').length > 0){
				$formContinue.removeClass('disabled').prop('disabled', false);
				$('#agentName').html($('input:radio[name="agent"]:checked').attr("label"));
				//On Continue Form
				$(document).on('click', '#formContinue', function(e) {
					let $sTitleError = $("#sTitleError");
					let $dateError = $("#dateError");
					let $timeError = $("#timeError");
					if($selectBookNow.val()==''){
						$sTitleError.removeClass('d-none');
					}
					if($datepicker.val()==''){
						$dateError.removeClass('d-none');
					}
					if($userSelectTiming.val()==''){
						$timeError.removeClass('d-none');
					}
					if($selectBookNow.val()!='' & $datepicker.val()!='' & $userSelectTiming.val()!=''){
						$afterContinueMain.removeClass('d-none');
						$formDataMain.addClass('d-none');
					}
				});
			}
		});
		$(document).on('click', '.formChange', function(e) {
			$afterContinueMain.addClass('d-none');
			$formDataMain.removeClass('d-none');
		});

		$(document).on('click', '.agentModalOpen', function(e) {
			$(this).parent().next().addClass('active');
		 });
		$(document).on('click', '.closeModalBtn', function(e) {
			$(this).parent().parent().removeClass('active');
		 });

		$("input[type='number']").inputSpinner();

		$datepicker.datetimepicker({
			format: 'MM-DD-YYYY',
			minDate: moment().add(-1, 'days'),
			maxDate: moment().add(2, 'months'),
			defaultDate: new Date(),
			daysOfWeekDisabled: [0, 6]
		});
		
		//Navigation on click Go Path
		$(document).ready(function(){
			$("a").on('click', function(event) {
				if (this.hash !== "") {
				event.preventDefault();
				var hash = this.hash;
				$('html, body').animate({
					scrollTop: $(hash).offset().top
				}, 800, function(){
					window.location.hash = hash;
				});
				}
			});

			//Navigation on click add Active class
			var header = document.getElementById("myDIV");
			var btns = header.getElementsByClassName("bdtn");
			for (var i = 0; i < btns.length; i++) {
				btns[i].addEventListener("click", function() {
					var current = document.getElementsByClassName("active");
					current[0].className = current[0].className.replace(" active", "");
					this.className += " active";
				});
			}
		});


		// Open Image in a Lightbox.
		const trigger = $('#trigger-lightbox');
		$('.galleryLists').magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: {
				enabled: true
			}
		});

		// Submit mail
		$('#mailmesubmit').on('submit', function(e){
			e.preventDefault();
			$('.loaderBeforeC').addClass('d-none');
			$('.loaderBeforeCg').removeClass('d-none');
			$.ajax({
				type: "POST",
				url: this.action,
				data : $(this).serialize(),
				dataType: "json",

				success: function(data) {
					$.each(data, function(key, value) {
							if(value!=''){
								$('#cForm-' + key).addClass('is-invalid').removeClass('is-valid');
								$('.loaderBeforeC').removeClass('d-none');
								$('.loaderBeforeCg').addClass('d-none');
							}
							else{
								$('#cForm-' + key).addClass('is-valid').removeClass('is-invalid');
								$('.loaderBeforeC').removeClass('d-none');
								$('.loaderBeforeCg').addClass('d-none');
							}
							$('#cForm-' + key).parents('.form-group').find('#error').html(value);
						});
					if(data.emailSent == true){
						$('.loaderBeforeC').removeClass('d-none');
						$('.loaderBeforeCg').addClass('d-none');
						$('#submitedEmail').fadeIn().delay('4000').fadeOut('slow');
						$('#cForm-name').removeClass('is-invalid');$('#cForm-name').removeClass('is-valid');
						$('#cForm-email').removeClass('is-invalid');$('#cForm-email').removeClass('is-valid');
						$('#cForm-message').removeClass('is-invalid');$('#cForm-message').removeClass('is-valid');
					}
					if(data.emailSent == false){
						$('.loaderBeforeC').removeClass('d-none');
						$('.loaderBeforeCg').addClass('d-none');
						$('#somethngwrng').fadeIn().delay('4000').fadeOut('slow');
						$('#cForm-name').removeClass('is-invalid');$('#cForm-name').removeClass('is-valid');
						$('#cForm-name').parents('.form-group').find('#error').html(value);
						$('#cForm-email').removeClass('is-invalid');$('#cForm-email').removeClass('is-valid');
						$('#cForm-email').parents('.form-group').find('#error').html(value);
						$('#cForm-message').removeClass('is-invalid');$('#cForm-message').removeClass('is-valid');
						$('#cForm-message').parents('.form-group').find('#error').html(value);
					}
					
				}
			});
		});
})(jQuery);