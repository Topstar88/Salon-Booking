<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe_lib{
	private $config;
	var $api_error;
    
    function __construct($paymentKeys){
		
		$this->api_error = '';
		$this->config = array(
			'stripe_api_key'     		=> $paymentKeys['stripe_api_key'],
            'stripe_publishable_key' 	=> $paymentKeys['stripe_publishable_key'],
			'stripe_currency' 			=> $paymentKeys['stripe_currency']
        );
		
		// Include the Stripe PHP bindings library
		require APPPATH .'third_party/stripe-php/init.php';
		
		// Set API key
		\Stripe\Stripe::setApiKey($this->config['stripe_api_key']);
    }

    function addCustomer($email, $token){
		try {
			// Add customer to stripe
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
			return $customer;
		}catch(Exception $e) {
			$this->api_error = $e->getMessage();
			return false;
		}
    }
	
	function createCharge($customerId, $itemName, $itemPrice, $orderID){
	
		// Convert price to cents
		$itemPriceCents = ($itemPrice*100);
		$currency = $this->config['stripe_currency'];
		
		try {
			// Charge a credit or a debit card
			$charge = \Stripe\Charge::create(array(
				'customer' => $customerId,
				'amount'   => $itemPriceCents,
				'currency' => $currency,
				'description' => $itemName,
				'metadata' => array(
					'order_id' => $orderID
				)
			));
			
			// Retrieve charge details
			$chargeJson = $charge->jsonSerialize();
			return $chargeJson;
		}catch(Exception $e) {
			$this->api_error = $e->getMessage();
			return false;
		}
    }
}