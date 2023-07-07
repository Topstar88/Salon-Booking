<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	private $admin_user;
	private $page_data;
	
	public function __construct() {
        parent::__construct();
		
		$this->load->database();
        $this->load->model('AdminModel');
        $this->load->model('ClientsModel');

		$this->page_data 			= $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user 			= $this->AdminModel->adminDetails();
        $this->all_clients 			= $this->ClientsModel->get();
        
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
	
	public function index(){
		redirect(base_url(CLIENTS_CONTROLLER . '/clients'));
	}

	public function clients() {

		$data = array(
            'page_data' => $this->page_data,
            'page_title' => 'All Clients',
            'user' => $this->admin_user,
            'clients' => $this->all_clients,
		);
		$this->load->view('admin/clients/clients', $data);
	}

	public function editclients($id = null) {

        if($clients = $this->ClientsModel->getclient($id)) {
			
            $data = array(
                'page_data'     => $this->page_data,
                'page_title'    => 'Editing: ' . html_entity_decode($clients['fullName']),
                'user'          => $this->admin_user,
                'clients'      => $clients
			);

            if($this->input->post('submit') && !$data['user']['disabled']) {
				
				$fullName	= $this->security->xss_clean($this->input->post('client-name'));
				$email    	= $this->input->post('client-email');
				$phone    	= $this->input->post('client-phone');

				$rules = array(
					array(
						'field'     => 'client-name',
						'label'     => 'Client Name',
						'rules'     => 'required'
					),
					array(
						'field'     => 'client-email',
						'label'     => 'Client Email',
						'rules'     => 'required|valid_email'
					),
					array(
						'field'     => 'client-phone',
						'label'     => 'Client Phone',
						'rules'     => 'required|regex_match[/([0-9\s\-]{7,})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/]'
					)
				);

                $this->form_validation->set_rules($rules);
                $validation = $this->form_validation->run();

                if($validation) {
                    $to_update = array(
                        'fullName'      => htmlentities($fullName),
						'email'   		=> htmlentities($email),
						'phone'      	=> $phone
					);

					$this->ClientsModel->set($id, $to_update);
					$data['clients'] = $this->ClientsModel->getclient($clients['id']);
                    $this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully updated client.'));

                    redirect(CLIENTS_CONTROLLER . '/editclients/' . $id);
                }
            }

            $this->load->view('admin/clients/editclients', $data);
		}
		else{
			redirect(base_url(CLIENTS_CONTROLLER));
		}
	}

	public function deleteclient($id = null, $confirm = false) {

		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Clients',
            'user' 			=> $this->admin_user,
            'clients' 		=> $this->all_clients,
		);

		if($confirm && !$data['user']['disabled']) {
			$this->ClientsModel->deleteclient($id);
			$data['clients'] = $this->ClientsModel->get();
			$data['alert'] = array('type' => 'alert alert-success', 'msg' => 'Successfully delete client.');
		}
		$this->load->view('admin/clients/clients', $data);
	}
}
