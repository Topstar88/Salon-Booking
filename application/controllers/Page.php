<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	private $page_data;

	public function __construct() {
		parent::__construct();
		$this->page_data            = $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
	}

	public function index($permalink = null) {
		$this->load->model('Settings/PageModel');

        if($permalink && $page = $this->PageModel->get_page($permalink)) {
            $data = $this->page_data;
            $data['page'] = $page;

            $theme_view = $data['theme_view'];
            $theme_view('page', $data);
        } else
            redirect(base_url());
    }
}
