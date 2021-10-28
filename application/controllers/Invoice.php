<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	private $page_data;

	public function __construct(){
		parent::__construct();
		$this->load->model('OrderModel');
		$this->page_data = $this->MainModel->pageData();
	}
	
	public function index($orderId = ''){
		if($orderId){
			
			$this->page_data['order'] 		= $this->OrderModel->getOrder($orderId);
			$this->page_data['user'] 		= $this->LoginModel->user_info($this->page_data['order']['userId']);
			$this->page_data['service'] 	= $this->ServiceModel->servicedataById($this->page_data['order']['serviceId']);
			$this->page_data['booking'] 	= $this->BookingModel->getBookingbyOrderId($orderId);
			
			$themeViewData = $this->page_data;
			$theme_view = $this->page_data['theme_view'];
			$theme_view('invoice', $themeViewData);
		}
		else{
			return redirect(base_url());
		}
		
	}
}
