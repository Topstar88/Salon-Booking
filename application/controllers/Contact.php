<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	private $admin_user;
	private $page_data;
	
	public function __construct() {
        parent::__construct();
		
		$this->load->database();
        $this->load->model('AdminModel');
        $this->load->model('ContactDetails');

		$this->page_data 				= $this->MainModel->pageData();
        $this->page_data['update']  	= $this->MainModel->updates_settings();
        $this->admin_user 				= $this->AdminModel->adminDetails();
        $this->contactDetails 			= $this->ContactDetails->get();
        
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
	
	public function index(){
		redirect(base_url(CONTACT_CONTROLLER . '/contactDetails'));
	}

	public function contactDetails() {
		$data = array(
            'page_data' 		=> $this->page_data,
            'page_title' 		=> 'Contact Settings',
            'user' 				=> $this->admin_user,
			'contactDetails' 	=> $this->contactDetails
		);

		if($this->input->post('submit') && !$data['user']['disabled']) {

			$phone	 	= $this->security->xss_clean($this->input->post('contact-phone'));
			$email   	= $this->security->xss_clean($this->input->post('contact-email'));
			$address 	= $this->security->xss_clean($this->input->post('contact-address'));
			$map_src 	= $this->security->xss_clean($this->input->post('map_src'));
			$map_wd   	= $this->security->xss_clean($this->input->post('map_wd'));
			$map_ht   	= $this->security->xss_clean($this->input->post('map_ht'));
			$urlFb   	= $this->security->xss_clean($this->input->post('contact-urlFb'));
			$urlTwt  	= $this->security->xss_clean($this->input->post('contact-urlTwt'));
			$urlIn   	= $this->security->xss_clean($this->input->post('contact-urlIn'));

			$rules = array(
				array(
					'field'     => 'contact-phone',
					'label'     => 'Phone Number',
					'rules'     => 'required|regex_match[/([0-9\s\-]{7,})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/]'
				),
				array(
					'field'     => 'contact-email',
					'label'     => 'Email',
					'rules'     => 'required|valid_email'
				),
				array(
					'field'     => 'contact-address',
					'label'     => 'Address',
					'rules'     => 'required'
				),
				array(
					'field'     => 'map_src',
					'label'     => 'Map Src',
					'rules'     => 'required'
				),
				array(
					'field'     => 'map_wd',
					'label'     => 'Map Width',
					'rules'     => 'required'
				),
				array(
					'field'     => 'map_ht',
					'label'     => 'Map Height',
					'rules'     => 'required'
				),
				array(
					'field'     => 'contact-urlFb',
					'label'     => 'Facebook URL',
					'rules'     => 'required'
				),
				array(
					'field'     => 'contact-urlTwt',
					'label'     => 'Twitter URL',
					'rules'     => 'required'
				),
				array(
					'field'     => 'contact-urlIn',
					'label'     => 'Linked In URL',
					'rules'     => 'required'
				)
			);

			$this->form_validation->set_rules($rules);
			$validation = $this->form_validation->run();

			if($validation) {
				
				$to_update = array(
					'phone'         => htmlentities($phone),
					'email'         => $email,
					'address'   	=> htmlentities($address),
					'map_src'      	=> htmlentities($map_src),
					'map_wd'      	=> htmlentities($map_wd),
					'map_ht'      	=> htmlentities($map_ht),
					'urlFb'     	=> htmlentities($urlFb),
					'urlTwt'     	=> htmlentities($urlTwt),
					'urlIn'      	=> htmlentities($urlIn)
				);
				$this->ContactDetails->set($to_update);
				$data['contactDetails'] = $this->ContactDetails->get();
				$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully updated contact details.'));
			}
		}
		$this->load->view('admin/contact/contact', $data);
	}

	
}
