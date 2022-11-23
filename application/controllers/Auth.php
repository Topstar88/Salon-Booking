<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	private $page_data;
    private $admin_user;

	public function __construct() {
        parent::__construct();
		
		$this->load->database();
        $this->load->model('AdminModel');
		$this->page_data 			= $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
		$this->admin_user 			= $this->AdminModel->adminDetails();
	}

	public function index() {        
        redirect(base_url(GENERAL_CONTROLLER));
	}

	// Logs in the User. Returns User Info if Success. Returns False on Invalid.
	public function login() {
		if($this->admin_user)
			redirect(base_url(GENERAL_CONTROLLER .  '/dashboard'));

		$data = array(
			'page_title' => 'Login',
			'body_class' => 'login',
			'page_data' => $this->page_data,
			'error' => false,
			'redirect_to' => $this->input->get('redirect')
		);

		if($this->security->xss_clean($this->input->post('submit'))) {
			$this->form_validation->set_rules('identifier', 'Username / E-Mail', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run()) {
				$user = $this->AdminModel->login($this->security->xss_clean($this->input->post('identifier')), $this->input->post('password'), $this->input->post('remember-me'));
				if($user) {
					if($redirect_to = $this->input->post('redirect'))
						redirect(urldecode($redirect_to));
					redirect(GENERAL_CONTROLLER);
				} else {
					$data['error'] = 'Invalid Credentials.';
				}
			}
		}
		$this->load->view('admin/auth/login', $data);
	}

	public function logout() {
		if($this->AdminModel->adminDetails()) {
			$this->AdminModel->logout();
		}
		redirect(base_url(AUTH_CONTROLLER . '/login'));
	}
}
