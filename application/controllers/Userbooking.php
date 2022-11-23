<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Userbooking extends CI_Controller {
	
	private $page_data;

	public function __construct() {
		parent::__construct();
		
		$this->load->database();
        $this->load->model('MainModel');
        $this->load->model('LoginModel');
        $this->load->model('BookingModel');
        $this->load->model('OrderModel');
		$this->load->model('StripeModel');

		$this->loginSession 			= $this->session->userdata('id');
		$this->page_data 			    = $this->MainModel->pageData();
		$this->page_data['user'] 	    = $this->LoginModel->user_info($this->loginSession);
		$this->page_data['bookings'] 	= $this->BookingModel->getbyid($this->loginSession);
        $this->validateSession 			= $this->LoginModel->validateSession($this->loginSession);
		$this->StripeModel 				= $this->StripeModel->get();$this->load->library('stripe_lib', array(
            'stripe_api_key'     		=> $this->StripeModel['stripe_api_key'],
            'stripe_publishable_key' 	=> $this->StripeModel['stripe_publishable_key'],
            'stripe_currency' 			=> $this->StripeModel['stripe_currency']
        ));

		if($this->validateSession == "" || !$this->page_data['user'])
		return redirect('login');
	}

	public function index() {
		$this->page_data['title'] 		= 'Your Bookings';
		$this->page_data['stripe'] 		= $this->OrderModel->getStripe();
		$themeViewData 					= $this->page_data;
		$theme_view 					= $this->page_data['theme_view'];
		$theme_view('userbooking', $themeViewData);
	}
	public function paynow($bookingId = ''){
		if($bookingId){
			$this->page_data['title'] 					= 'Pay By Stripe';
			$this->page_data['stripe'] 					= $this->OrderModel->getStripe();
			$this->page_data['stripe_publishable_key'] 	= $this->StripeModel['stripe_publishable_key'];
			$this->page_data['booking'] 				= $this->BookingModel->getBooking($bookingId);
			$this->page_data['service'] 				= $this->ServiceModel->servicedataById($this->page_data['booking']['serviceId']);

			if($this->security->xss_clean($this->input->post('selectPayment')) == 1 && $token = $this->security->xss_clean($this->input->post('stripeToken'))){
				$booking 			= false;
				$payment_message 	= [];
				$formService 		= array();

				// Retrieve stripe token, card and user info from the submitted form data
				$orderID 		= strtoupper(md5((str_replace('.','',uniqid('', true).time()))));
				$formData 		= $this->page_data['service'];
				$totalPrice		= ($this->page_data['booking']['adults'] + $this->page_data['booking']['childrens'])*$this->page_data['service']['price'];

				// Send email & token to Stripe
				$customer 		= $this->stripe_lib->addCustomer($this->page_data['user']['email'], $token);
				if($customer){
					// Charge a credit or a debit card
					$charge = $this->stripe_lib->createCharge($customer->id, $formData['title'], $totalPrice, $orderID);
					
					if($charge){
						// Check whether the charge is successful
						if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
							// Transaction details 
							$chargeId 		= $charge['id'];
							$transactionID 	= $charge['balance_transaction'];
							$paidAmount 	= $charge['amount'];
							$paidAmount 	= ($paidAmount/100);
							$paidCurrency 	= $charge['currency'];
							$receipt_url 	= $charge['receipt_url'];
							$payment_status = $charge['status'];
							
							$formService = array(
								'orderId'			=> $chargeId,
								'paymentStatus' 	=> true,
								'serviceStatus' 	=> true
							);
							$booking = $this->BookingModel->setBooking($this->page_data['booking']['id'], $formService);
							
							// Insert tansaction data into the database
							$orderData = array(
								'orderId'				=> $chargeId,
								'serviceId' 			=> $this->page_data['service']['id'],
								'bookingId' 			=> $this->page_data['booking']['id'],
								'transectionId' 		=> $transactionID,
								'userId' 				=> $this->page_data['user']['id'],
								'paid_amount' 			=> $paidAmount,
								'paid_currency' 		=> $paidCurrency,
								'receipt_url' 			=> $receipt_url,
								'payment_status' 		=> $payment_status
							);
							$paymentId = $this->OrderModel->insertOrder($orderData);
							$this->session->set_flashdata('invMsg','Your Payment & Booking has bees Submited.');
							$this->session->set_flashdata('inv_class','alert alert-success');
							$payment_message = [ 'success' => true, 'msg' => 'Transaction successful!', 'orderid' => $chargeId ];
						}
						else{
							$payment_message = [ 'success' => false, 'msg' => 'Transaction failed!' ];
						}
					}
				}
				echo json_encode(['serviceAdded' => $booking, 'payment' => $payment_message]);
			}
			else{
				$themeViewData = $this->page_data;
				$theme_view = $this->page_data['theme_view'];
				$theme_view('paynow', $themeViewData);
			}
		}
		else{
			return redirect('userbooking');
		}
	}
}
