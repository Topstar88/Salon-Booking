<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
	
	private $page_data;

	public function __construct() {
		parent::__construct();
		
		$this->load->database();
		$this->load->model('ContactDetails');
        $this->load->model('GalleryModel');	
		$this->load->model('LayoutModel');
		$this->load->model('StripeModel');
		$this->load->model('OrderModel');

		$this->loginSession 			= $this->session->userdata('id');
		$this->contactDetails 			= $this->ContactDetails->get();
		$this->page_data 				= $this->MainModel->pageData();
		$this->page_data['email'] 		= $this->MainModel->smtp_settings();
		$this->page_data['user'] 	    = $this->LoginModel->user_info($this->loginSession);
		$this->page_data['stripe'] 		= $this->OrderModel->getStripe();
		$this->StripeModel 				= $this->StripeModel->get();
		$this->validateSession 			= $this->LoginModel->validateSession($this->loginSession);
		
		$this->load->library('stripe_lib', array(
            'stripe_api_key'     		=> $this->page_data['stripe']['stripe_api_key'],
            'stripe_publishable_key' 	=> $this->page_data['stripe']['stripe_publishable_key'],
            'stripe_currency' 			=> $this->page_data['stripe']['stripe_currency']
        ));
	}

	public function index() {
		$data 			= $this->ServiceModel->serviceList();
		$gcategories 	= $this->GalleryModel->listCat();
        $galleryImages 	= $this->GalleryModel->listGallery();
		$contactdetails = $this->ContactDetails->get();
		$themeViewData  = array_merge(
								$this->page_data,
								array(
									'serviceList' 				=> $data,
									'gcategories'				=> $gcategories,
									'galleryImages'				=> $galleryImages,
									'contactdetails'			=> $contactdetails,
									'userinfo'					=> $this->page_data['user']
								)
						);
		$theme_view = $this->page_data['theme_view'];
		$theme_view('default', $themeViewData);
	}

	public function selectagent(){
		$service 				= $this->security->xss_clean($this->input->post('service'));
		$date 					= $this->security->xss_clean($this->input->post('date'));
		$time 					= $this->security->xss_clean($this->input->post('time'));

		$agentData['service'] 	= $this->ServiceModel->servicedataById($service);//Model Get Service by ID
		$agentData['agents'] 	= $this->ServiceModel->selectAgents($agentData['service']['agentIds']);//Model Get Service by ID


		$agentData['exist']	= $this->BookingModel->agentExist($service, $date, $time);
		echo json_encode($agentData);
	}
	public function selectFromDataById(){
		$dpto 					= $this->security->xss_clean($this->input->post('bookingId'));
		$formData 				= $this->ServiceModel->servicedataById($dpto);//Model Get Service by ID
		$formData['agents'] 	= $this->ServiceModel->selectAgents($formData['agentIds']);//Model Get Service by ID

		if($formData == false){
			$arr = array('success' => false);
			echo json_encode($arr);
		}
		else{

			$duration = $formData['servDuration'];
			$hours = date("G", strtotime($duration))*60;  //hours convert in Minutes
			$minutes = date("i", strtotime($duration)); // also have Munites
			$totalMinutes = $hours + $minutes;

			$startTime = $formData['servStart'];
			$endTime = $formData['servEnd'];

			$startingTime = strtotime($startTime);
			$endingTime = strtotime($endTime);

			//convert duration to seconds
			$durationSeconds = $totalMinutes * 60;
			
			$arry = array();

			while($startingTime < $endingTime) {
				
				$endValue = $startingTime + $durationSeconds;
				if($endValue <= $endingTime) {
					array_push($arry, date("h:i A", $startingTime)." - ".date("h:i A", $endValue));
				}
				else {
					array_push($arry, date("h:i A", $startingTime)." - ".date("h:i A", $endValue));
				}
				$startingTime = $endValue;
			}
			$formData['timing'] = $arry;
			echo json_encode($formData);
		}
	}

	public function submitData(){
		$email 				= null;
		$userInfo 			= null;
		$booking 			= [];
		$booking_return 	= false;
		$payment_message 	= [];
		$loginId 			= array('return' => '');
		
		if(!$this->loginSession){
			$this->form_validation->set_rules('userFullName','Username', 'trim|required|alpha_numeric|min_length[2]|max_length[20]|is_unique[logintbl.fullName]', array('is_unique' => 'The %s is already taken'));
			$this->form_validation->set_rules('userEmail', 'Email', 'trim|required|valid_email|is_unique[logintbl.email]', array('is_unique' => 'You are Already Signed Up with this %s. Please Login first for more Booking.'));
			$this->form_validation->set_rules('userPhone','Phone Number', 'required|regex_match[/([0-9\s\-]{7,})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/]');
			$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');

			$runValidation = $this->form_validation->run();

			$json = array();
			
			if (!$runValidation) {
				$json = array(
					'userFullName'	=> form_error('userFullName', '<small class="form-text text-danger">', '</small>'),
					'userEmail'		=> form_error('userEmail', '<small class="form-text text-danger">', '</small>'),
					'userPhone'		=> form_error('userPhone', '<small class="form-text text-danger">', '</small>')
				);
				
				echo json_encode($json);
			}
			else {
					$email = $this->security->xss_clean($this->input->post('userEmail'));
					$data = $this->security->xss_clean($this->input->post());
					
					// random strint for Hash
					$this->load->helper('string');
					$randomStr 				=  random_string('alnum',12);
					$hashForUser 			= password_hash($randomStr, PASSWORD_DEFAULT);

					// Service Array
					$formService = array(
						'serviceId'	=> $this->security->xss_clean($this->input->post('serviceTitle')),
						'adults' 	=> $this->security->xss_clean($this->input->post('serviceAdult')),
						'childrens' => $this->security->xss_clean($this->input->post('serviceChildren')),
						'date' 		=> $this->security->xss_clean($this->input->post('serviceDate')),
						'timing' 	=> $this->security->xss_clean($this->input->post('serviceTiming')),
						'agentId' 	=> $this->security->xss_clean($this->input->post('agent'))
					);
					// User Info Array
					$userInfo = array(
						'fullName' 	=> $this->security->xss_clean($this->input->post('userFullName')),
						'email' 	=> $this->security->xss_clean($this->input->post('userEmail')),
						'phone' 	=> $this->security->xss_clean($this->input->post('userPhone'))
					);
					
					$userInfo['password'] 		= $hashForUser;
					$userInfo['activated'] 		= '0';
					$userInfo['activationCode'] = md5(time() . rand(1, 100));

					if(!$this->BookingModel->doesBookingExist($formService)) {
						
						$loginId 				= $this->LoginModel->addUser($userInfo);// Model Add User to Table & 'return' True/False & 'userId'
						$formService['userId'] 	= $loginId['userId'];// User ID add to Booking

						if($loginId['return']) {// If User Added Return True
							
							// Send User Email {Activation Code & Random Password}
							$res = $this->LoginModel->sendActivation($email, $randomStr, $userInfo['activationCode'], $this->page_data['email']);
							
							if(!$res) {
								$this->session->set_flashdata('added','Email not Send, Something wrong with our email Please check your.');
								$this->session->set_flashdata('added_class','alert alert-danger');
							}
							if($this->security->xss_clean($this->input->post('selectPayment')) == 0) {
								$formService['paymentStatus'] 	= false;
								$booking 						= $this->BookingModel->addBooking($formService);
								$booking_return 				= $booking['return'];
								$payment_message 				= [ 'success' => true, 'msg' => 'You would be pay by cash!', 'orderid' => ''];
							}
							if($this->security->xss_clean($this->input->post('selectPayment')) == 1 && $token = $this->security->xss_clean($this->input->post('stripeToken'))){
								// Retrieve stripe token, card and user info from the submitted form data
								$orderID 		= strtoupper(md5((str_replace('.','',uniqid('', true).time()))));
								$formData 		= $this->ServiceModel->servicedataById($formService['serviceId']); // Model Get service Data by ID
								$totalPrice		= ($formService['adults'] + $formService['childrens'])*$formData['price'];

								// Send email & token to Stripe
								$customer 		= $this->stripe_lib->addCustomer($email, $token);
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

											$formService['orderId'] 		= $chargeId;
											$formService['paymentStatus'] 	= true;
											$formService['serviceStatus'] 	= true;
											$booking 						= $this->BookingModel->addBooking($formService);
											$booking_return 				= $booking['return'];
											
											// Insert tansaction data into the database
											$orderData = array(
												'orderId'				=> $chargeId,
												'serviceId' 			=> $formService['serviceId'],
												'bookingId' 			=> $booking['bokingId'],
												'transectionId' 		=> $transactionID,
												'userId' 				=> $loginId['userId'],
												'paid_amount' 			=> $paidAmount,
												'paid_currency' 		=> $paidCurrency,
												'receipt_url' 			=> $receipt_url,
												'payment_status' 		=> $payment_status
											);
											$paymentId = $this->OrderModel->insertOrder($orderData);
											$this->session->set_flashdata('invMsg','Your Payment & Booking has bees Submited, Please check your email for Password & Activate your account.');
											$this->session->set_flashdata('inv_class','alert alert-success');
											$payment_message = [ 'success' => true, 'msg' => 'Transaction successful!', 'orderid' => $chargeId ];
										}// Transactions Successfull
										else{
											$payment_message = [ 'success' => false, 'msg' => 'Transaction failed!' ];
										}// Transaction Failed
									}
								}// Start Credit Card Payment Method
							}
						}
					}
					echo json_encode(['serviceAdded' => $booking_return, 'payment' => $payment_message]);

					if($loginId['return'] != '' && $booking_return){
						
						$this->session->set_flashdata('added','Booking has bees Submited, Please check your email for Password & Activate your account.');
						$this->session->set_flashdata('added_class','alert alert-success');
					}
					else{
						$this->session->set_flashdata('added','Something wrong please try again for booking.');
						$this->session->set_flashdata('added_class','alert alert-danger');
					}
			}
		}// if not have user session
		else { // else: if not user added phone number
			if(!$this->page_data['user']['phone']){
				$this->form_validation->set_rules('userPhone','Phone Number', 'required');
				$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');

				$runValidation 	= $this->form_validation->run();
				$json 			= array();

				if(!$runValidation) {
					$json = array(
						'userPhone'		=> form_error('userPhone', '<small class="form-text text-danger">', '</small>')
					);
					$this->output->set_content_type('application/json')
								->set_output(json_encode($json));
				}
				else {
					// User Info Array
					$formService = array(
						'serviceId'	=> $this->security->xss_clean($this->input->post('serviceTitle')),
						'adults' 	=> $this->security->xss_clean($this->input->post('serviceAdult')),
						'childrens' => $this->security->xss_clean($this->input->post('serviceChildren')),
						'date' 		=> $this->security->xss_clean($this->input->post('serviceDate')),
						'timing' 	=> $this->security->xss_clean($this->input->post('serviceTiming')),
						'agentId' 	=> $this->security->xss_clean($this->input->post('agent'))
					);
					
					$loginId['userId'] 	= $this->loginSession;
					$isAddedPhone 		= false;
					$userInfo			= $this->LoginModel->user_info($loginId['userId']);// Get user info by Login Session ID
					$email 				= $userInfo['email'];

					if(!$this->BookingModel->doesBookingExist($formService)) {

						$isAddedPhone 			= $this->LoginModel->addUserPhone($this->loginSession, $this->security->xss_clean($this->input->post('userPhone')));
						$formService['userId'] 	= $loginId['userId'];// User ID add to Booking

						if($loginId['userId']) {// If have user Login Session
							if($this->security->xss_clean($this->input->post('selectPayment')) == 0) {
								// Payment By Cash
								$formService['paymentStatus'] 	= false;
								$booking 						= $this->BookingModel->addBooking($formService);
								$booking_return 				= $booking['return'];
								$payment_message 				= [ 'success' => true, 'msg' => 'You would be pay by cash!', 'orderid' => ''];
							}
						}
						if($this->security->xss_clean($this->input->post('selectPayment')) == 1 && $token = $this->security->xss_clean($this->input->post('stripeToken'))){
							
							// Retrieve stripe token, card and user info from the submitted form data
							$orderID 		= strtoupper(md5((str_replace('.','',uniqid('', true).time()))));
							$formData 		= $this->ServiceModel->servicedataById($formService['serviceId']); // Model Get service Data by ID
							$totalPrice		= ($formService['adults'] + $formService['childrens'])*$formData['price'];

							// Send email & token to Stripe
							$customer 		= $this->stripe_lib->addCustomer($email, $token);
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
										
										$formService['orderId'] 		= $chargeId;
										$formService['paymentStatus'] 	= true;
										$formService['serviceStatus'] 	= true;
										$booking 						= $this->BookingModel->addBooking($formService);
										$booking_return 				= $booking['return'];

										// Insert tansaction data into the database
										$orderData = array(
											'orderId'				=> $chargeId,
											'serviceId' 			=> $formService['serviceId'],
											'bookingId' 			=> $booking['bokingId'],
											'transectionId' 		=> $transactionID,
											'userId' 				=> $loginId['userId'],
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
						}
					}
					
					echo json_encode(['serviceAdded' => $booking_return, 'payment' => $payment_message]);

					if($isAddedPhone && $booking_return){
						
						$this->session->set_flashdata('added','Your Booking is Submited Successfully.');
						$this->session->set_flashdata('added_class','alert alert-success');
					}
					else{
						$this->session->set_flashdata('added','Something wrong please try again for booking.');
						$this->session->set_flashdata('added_class','alert alert-danger');
					}
					
				}
			}
			else{
				// Service Array
				$formService = array(
					'serviceId'	=> $this->security->xss_clean($this->input->post('serviceTitle')),
					'adults' 	=> $this->security->xss_clean($this->input->post('serviceAdult')),
					'childrens' => $this->security->xss_clean($this->input->post('serviceChildren')),
					'date' 		=> $this->security->xss_clean($this->input->post('serviceDate')),
					'timing' 	=> $this->security->xss_clean($this->input->post('serviceTiming')),
					'agentId' 	=> $this->security->xss_clean($this->input->post('agent'))
				);
				
				$loginId['userId'] 	= $this->loginSession;
				$userInfo			= $this->LoginModel->user_info($loginId['userId']);// Get user info by Login Session ID
				$email 				= $userInfo['email'];

				if(!$this->BookingModel->doesBookingExist($formService)) {	
					$formService['userId'] 	= $loginId['userId'];
					if($this->security->xss_clean($this->input->post('selectPayment')) == 0){
						// Payment By Cash
						$formService['paymentStatus'] 	= false;
						$booking 						= $this->BookingModel->addBooking($formService);
						$booking_return 				= $booking['return'];
						$payment_message 				= [ 'success' => true, 'msg' => 'You would be pay by cash!', 'orderid' => ''];
					}
					if($this->security->xss_clean($this->input->post('selectPayment')) == 1 && $token = $this->security->xss_clean($this->input->post('stripeToken'))){
						
						// Retrieve stripe token, card and user info from the submitted form data
						$orderID 		= strtoupper(md5((str_replace('.','',uniqid('', true).time()))));
						$formData 		= $this->ServiceModel->servicedataById($formService['serviceId']); // Model Get service Data by ID
						$totalPrice		= ($formService['adults'] + $formService['childrens'])*$formData['price'];

						// Send email & token to Stripe
						$customer 		= $this->stripe_lib->addCustomer($email, $token);
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
									
									$formService['orderId'] 		= $chargeId;
									$formService['paymentStatus'] 	= true;
									$formService['serviceStatus'] 	= true;
									$booking 						= $this->BookingModel->addBooking($formService);
									$booking_return 				= $booking['return'];
									
									// Insert tansaction data into the database
									$orderData = array(
										'orderId'				=> $chargeId,
										'serviceId' 			=> $formService['serviceId'],
										'bookingId' 			=> $booking['bokingId'],
										'transectionId' 		=> $transactionID,
										'userId' 				=> $loginId['userId'],
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
					}
				}
				
				echo json_encode(['serviceAdded' => $booking_return, 'payment' => $payment_message]);

				if($loginId && $booking_return){
					
					$this->session->set_flashdata('added','Your Booking is Submited Successfully.');
					$this->session->set_flashdata('added_class','alert alert-success');
				}
				else{
					$this->session->set_flashdata('added','Something wrong please try again for booking.');
					$this->session->set_flashdata('added_class','alert alert-danger');
				}
			}
		}

	}

	public function mailme(){

		$email = null;
		$userInfo = null;
			
		$this->form_validation->set_rules('name','Name', 'trim|required|alpha_numeric|min_length[2]|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message','Message', 'required');
		$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');

		$runValidation = $this->form_validation->run();

		$json = array();
		
		if (!$runValidation) {
			$json = array(
				'name'		=> form_error('name', '<small class="form-text text-danger">', '</small>'),
				'email'		=> form_error('email', '<small class="form-text text-danger">', '</small>'),
				'message'	=> form_error('message', '<small class="form-text text-danger">', '</small>')
			);
			$this->output->set_content_type('application/json')
							->set_output(json_encode($json));
		} else {
			$captcha = true;
			if($this->page_data['recaptcha']['status']) {
				$this->load->library('xl_recaptcha', $this->page_data['recaptcha']);
				$captcha = $this->xl_recaptcha->verify_captcha($this->security->xss_clean($this->input->post('g-response-response')), $this->input->ip_address());
			}
			if($captcha) {
				$smtpDetails = $this->page_data['email'];
				$config = Array(
					'charset' 	=> 'iso-8859-1',
					'wordwrap' 	=> TRUE,
					'mailtype' 	=> 'html',
					'newline' 	=> "\r\n",
				);
				
				if($smtpDetails['status'] == 1){
					$config['protocol']  = 'smtp';
					$config['smtp_host'] = $smtpDetails['host'];
					$config['smtp_port'] = $smtpDetails['port'];
					$config['smtp_user'] = $smtpDetails['username'];
					$config['smtp_pass'] = $smtpDetails['password'];
				}
				
				$this->load->library('email', $config);
				
				$this->email->from($smtpDetails['email'],'Salon Script');
				$this->email->reply_to($this->security->xss_clean($this->input->post('email')), $this->security->xss_clean($this->input->post('name')));
				$this->email->to($smtpDetails['email']);
				$this->email->subject('New message from ' . esc($this->security->xss_clean($this->input->post('name'))));

				$this->email->message(compile_template(array(
						'logo' => base_url('application/uploads/img/' . $this->page_data['general']['logo']),
						'web_url' => base_url(),
						'sender_name' => $this->security->xss_clean($this->input->post('name')),
						'sender_email' => $this->security->xss_clean($this->input->post('email')),
						'content'	=> nl2br($this->security->xss_clean($this->input->post('message'))),
						'year'		=> date('Y'),
						'name'		=> $this->page_data['general']['title'],
					), file_get_contents(APPPATH . 'views/themes/' . $this->page_data['theme'] . '/email_templates/contact_message.html')));

				$sendEmail = $this->email->send();
				if(!$sendEmail){
					$returnJsn = array('emailSent' => false);
					echo json_encode($returnJsn);
				}
				else {
					$returnJsn = array('emailSent' => true);
					echo json_encode($returnJsn);
				}

			} else {
				$this->page_data['alert'] = array(
					'type' => 'alert alert-danger',
					'msg'  => lang('captcha_failed')
				);
			}
		}

	}
	
	public function notfound() {
		$themeViewData  = $this->page_data;
		$theme_view = $this->page_data['theme_view'];
		$theme_view('404', $themeViewData);
	}
}
