<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends CI_Controller {

	private $admin_user;
	private $page_data;
	
	public function __construct() {
        parent::__construct();
		
		$this->load->database();
        $this->load->model('AdminModel');
        $this->load->model('BookingModel');

		$this->page_data 			= $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user 			= $this->AdminModel->adminDetails();
        $this->all_bookings 		= $this->BookingModel->showAdminBookings();
        
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
	
	public function index(){
        $data = array(
            'page_data' => $this->page_data,
            'page_title' => 'All Bookings',
            'user' => $this->admin_user,
            'bookings' => $this->all_bookings,
		);
        $this->load->view('admin/bookings/bookings', $data);
	}

	public function deleteBookings($id = null, $confirm = false) {
		
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Bookings',
            'user' 			=> $this->admin_user,
            'bookings' 		=> $this->all_bookings,
        );
		if($confirm && !$data['user']['disabled'] && $data['user']['role'] == 1) {
			$this->BookingModel->deleteBooking($id);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully delete booking.'));
        }
		
		return redirect(BOOKINGS_CONTROLLER);
	}
	public function bookingConfirm($id = null, $confirm = false) {
		
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Bookings',
            'user' 			=> $this->admin_user,
            'bookings' 		=> $this->all_bookings,
        );
        $to_update = array(
            'serviceStatus'         => '1'
        );
        
		if($confirm && !$data['user']['disabled'] && $data['user']['role'] == 1) {
			$this->BookingModel->bookingConfirm($id, $to_update);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully confirm booking.'));
        }

		return redirect(BOOKINGS_CONTROLLER);
	}
	public function bookingCancel($id = null, $confirm = false) {
		
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Bookings',
            'user' 			=> $this->admin_user,
            'bookings' 		=> $this->all_bookings,
        );
        $to_update = array(
            'serviceStatus'         => '2'
        );
        
		if($confirm && !$data['user']['disabled'] && $data['user']['role'] == 1) {
			$this->BookingModel->bookingCancel($id, $to_update);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully cancel booking.'));
        }

		return redirect(BOOKINGS_CONTROLLER);
	}
	public function bookingPay($id = null, $confirm = false) {
		
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Bookings',
            'user' 			=> $this->admin_user,
            'bookings' 		=> $this->all_bookings,
        );
        $to_update = array(
            'paymentStatus'         => '1'
        );
        
		if($confirm && !$data['user']['disabled'] && $data['user']['role'] == 1) {
			$this->BookingModel->bookingPay($id, $to_update);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully paid booking.'));
        }
		return redirect(BOOKINGS_CONTROLLER);
	}
}
