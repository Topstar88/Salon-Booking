<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ------------------------------

Updates Controller

This controller is part of the Administrator Panel.
It is used to update the Script.

Only accessible to Administrators.

------------------------------ */

class Updates extends CI_Controller {
	private $page_data;
    private $admin_user;

    /* This is a Controller only accessible to Administrator Accounts */
	public function __construct() {
        parent::__construct();

        // Load Admin model
        $this->load->model('AdminModel');
        $this->load->model('UpdatesModel');

        $this->page_data            = $this->MainModel->pageData();     // Retrieve Page Data, MainModel is Auto-loaded
        $this->admin_user           = $this->AdminModel->adminDetails();  // Retrive Admin Details, if logged in.
        
        $this->page_data['update']  = $this->MainModel->updates_settings();
        
        // Check if Admin is logged in. Redirect to login otherwise.
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}

	public function index() {
        redirect(base_url(UPDATES_CONTROLLER . '/main'));
    }
    
    // This Function is responsible for Loading and Visualizing Basic Information for the User.
    public function main() {
        $data = array(
            'page_title'    => 'Updates',
            'page_data'     => $this->page_data,
            'user'          => $this->admin_user,

            'load_scripts'  => array(
                'js/includes/updates.js'
            )
        );

        $this->load->view('admin/updates/main', $data);
    }

    public function ajax_extract_package() {
        if(file_exists(APPPATH."third_party/update/upload.zip") && file_exists(APPPATH."third_party/update/update.json")) {
            $this->load->database();
            $this->load->model('UpdatesModel');
            $host       = $this->db->hostname;
            $username   = $this->db->username;
            $password   = $this->db->password;
            $database   = $this->db->database;
            $base_url   = $this->config->item('base_url');
            $file       = APPPATH."third_party/update/upload.zip";
            $path       = FCPATH;
            $zip        = new ZipArchive;
            $res        = $zip->open($file);
            if ($res === TRUE) {
                $zip->extractTo($path);
                $zip->close();
                $this->UpdatesModel->update_db_details($host,$username,$password,$database);
                $this->UpdatesModel->paste_config_details($base_url);
                echo json_encode(array("success"=>"true"));
            } else {
                echo json_encode(array("success"=>"false"));
                }
        } else {
            echo json_encode(array("success"=>"false"));
        }
    }

    public function ajax_import_database() {
		if($this->UpdatesModel->paste_db_details()) {
		 echo json_encode(array("success"=>"true"));
		} else {
		 echo json_encode(array("success"=>"false"));
		}
	}
	
	public function ajax_finalize_settings() {
		$productInfo = $this->UpdatesModel->fetch_info();
		$updateData = json_decode(file_get_contents(APPPATH."third_party/update/update.json"),true);
        if(count($updateData['deleteFiles']) > 0) {
            foreach($updateData['deleteFiles'] as $file) {
                if(file_exists(FCPATH.$file)) {
                    unlink(FCPATH.$file);
                }
            }
        }
        
		file_put_contents(APPPATH."config/constants.php",file_get_contents(APPPATH.'views/install/includes/constants.php'));
		if($this->session->has_userdata("version_latest")) {
			$this->session->unset_userdata('version_latest');
		}
		echo json_encode(array("success"=>"true"));
	}
}
