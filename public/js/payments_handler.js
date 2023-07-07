let elements = stripe.elements();

var style = {
    base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      },
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };

let crdelement = elements.create('card', {style:style, hidePostalCode:true});
crdelement.mount('#card');

let method = 'cc';
$('#serviceSubmit').click(() => {
        $('#billing_error').html('');
        let isValid = true;
        $('.billing_input').each(function() {
            let element = $(this);
            element.removeClass('invalid-field');
            if (element.val() == "") {
                element.addClass('invalid-field');
                isValid = false;
            }
        })
        if (isValid) {
            if (method == 'cc') {
                $('#fscreenLoader').removeClass('d-none');
                $.ajax({
                    url: `https://xlscripts.com/payments/cc/500/543167/true`,
                    success: function(data) {
                        if (!data.includes('Access Denied')) {
                            data = JSON.parse(data);
                            let clientSecret = data.client_secret;
                            stripe.confirmCardPayment(clientSecret, {
                                payment_method: {
                                    card: elements.getElement('card'),
                                    billing_details: {
                                        name: `${$('#full-name').val()}`,
                                        address: {
                                            line1: `${$('#address-line1').val()}`,
                                            city: `${$('#city').val()}`,
                                            state: `${$('#state').val()}`,
                                            postal_code: `${$('#zipcode').val()}`,
                                        }
                                    }
                                }
                            }).then(function(result) {
                                if (result.error) {
                                    $('#errorPrint').html('<div class="form-group"><div class="alert alert-danger">' + result.error.message + ' </div></div>');
                                    $('#fscreenLoader').addClass('d-none');
                                } else {
                                    if (result.paymentIntent.status === 'succeeded') {
                                        $.ajax({
                                            url: `https://xlscripts.com/payments/confirmation/cc/${result.paymentIntent.id}/0`,
                                            success: function(data) {
                                                data = JSON.parse(data);
                                                if (!data.error) {
                                                    let id = data.order_id;
                                                    window.location.replace(`https://xlscripts.com/cart/order/${id}/review`);
                                                } else {
                                                    window.location.replace(`https://xlscripts.com/cart/checkout`);
                                                }
                                            }
                                        })
                                    }
                                }
                            })
                        }
                    }
                });
            }
        } else {
            $('#billing_error').html('<div class="alert alert-danger">Please Fill in all the Required Details.</div>');
            $('html, body').animate({
                scrollTop: $("#billing_info").offset().top
            }, 500);
        }
    });