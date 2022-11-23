<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $page_data;
    private $admin_user;

	public function __construct() {
        parent::__construct();
		
		$this->load->database();
        $this->load->model('AdminModel');
		$this->page_data            = $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user           = $this->AdminModel->adminDetails();
        
        if(!$this->admin_user)
            redirect(base_url(AUTH_CONTROLLER));
    }
    
    public function index() {
        redirect(base_url(GENERAL_CONTROLLER));
    }
}
