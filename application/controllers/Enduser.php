<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enduser extends CI_Controller {
	
	private $page_data;

	public function __construct() {
		parent::__construct();
		
		$this->load->database();

		$loginSession 				= $this->session->userdata('id');
		$this->page_data 			= $this->MainModel->pageData();
		$this->page_data['user'] 	= $this->LoginModel->user_info($loginSession);
        $validateSession 			= $this->LoginModel->validateSession($loginSession);

		if($validateSession == "" || !$this->page_data['user'])
		return redirect('login');
	}

	public function index() {
			
		if($this->input->post('submit-pass')) {
			$this->page_data['tab'] = 'password';

			$rules = array(
				array(
					'field' => 'password',
					'label' => 'Old Password',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Old Password is Required'
					)
				),
				array(
					'field' => 'newpassword',
					'label' => 'New Password',
					'rules' => 'required|min_length[3]',
					'errors' => array(
						'required' => 'New Password Required',
						'min_length' => 'Minimum Password Length 3 Required'
					)
				)
			);

			$this->form_validation->set_rules($rules);
			$validation = $this->form_validation->run();

			if($validation) {
				$this->load->model('LoginModel');

				if($this->LoginModel->verify_password($this->input->post('password'))) {
					$this->LoginModel->set_new_password($this->input->post('newpassword'));
					$this->page_data['alert'] = array(
						'type' => 'alert alert-success',
						'msg' => 'Password has been changed.'
					);
				} else {
					$this->page_data['alert'] = array(
						'type' => 'alert alert-danger',
						'msg' => 'Old password is in-valid.'
					);
				}
			}
		} else if($this->input->post('submit-acc')) {
			$fullname = $this->security->xss_clean($this->input->post('fullname'));

			$this->page_data['alert'] = array(
				'type' => 'alert alert-success',
				'msg' => 'Updated Successfully.'
			);

			if(is_uploaded('avatar')) {
				if(is_image('avatar')) {
					$this->load->library('upload', array(
						'upload_path' => APPPATH.'uploads/user/',
						'allowed_types' => 'gif|jpg|png|jpeg|svg',
						'overwrite' => false,
						'file_name'  => md5($this->page_data['user']['id']),
						'max_width' => 1000,
						'max_height' => 1000,
					));

					$success = $this->upload->do_upload('avatar');
					if($success) {
						$data = $this->upload->data();
						$this->LoginModel->set_new_avatar($data['file_name'], $this->page_data['user']['id']);
						$this->page_data['user'] = $this->LoginModel->user_info($this->page_data['user']['id']);
					} else 
						$this->page_data['alert'] = array(
							'type' => 'alert alert-danger',
							'msg' => 'File Max Size 1000 X 1000.'
						);
				} else
					$this->page_data['alert'] = array(
						'type' => 'alert alert-danger',
						'msg' => 'Image type not matched.'
					);
			}

			if($fullname) {
				$fullname = strtolower(str_replace(" ",'',$fullname));
				if($fullname != $this->page_data['user']['fullName']) {
					
					$this->form_validation->set_rules('fullname','Full Name', 'trim|required|min_length[2]|max_length[20]|is_unique[logintbl.fullName]', array('is_unique' => 'The %s is already taken'));
					$validation = $this->form_validation->run();

					if($validation) {
						$this->LoginModel->set_new_fullname($fullname, $this->page_data['user']['id']);
						$this->page_data['user'] = $this->LoginModel->user_info($this->page_data['user']['id']);

					} else {
						$this->page_data['alert'] = array(
							'type' => 'alert alert-danger',
							'msg' => 'Username is not Update;'
						);
					}
				}
			}
		}

		$this->page_data['title'] = 'User Settings';
		$themeViewData = $this->page_data;
		$theme_view = $this->page_data['theme_view'];
		$theme_view('enduser', $themeViewData);
	}
	
	public function logout() {
		$this->session->sess_destroy();
		return redirect('homepage');
	}
}
