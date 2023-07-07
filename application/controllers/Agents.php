<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {

	private $admin_user;
	private $page_data;
	
	public function __construct() {
        parent::__construct();
		
		$this->load->database();
		$this->load->model('AdminModel');
		$this->load->model('AgentsModel');
		
		$this->page_data 	        = $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user 	        = $this->AdminModel->adminDetails();
        $this->all_agents           = $this->AgentsModel->agentList();
        
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
	
	public function index(){
        $data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'All Agents',
            'user'          => $this->admin_user,
            'agents'        => $this->all_agents
        );
		$this->load->view('admin/agents/agent', $data);
	}

	public function addagent(){

		$data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'Add Agent',
            'user'          => $this->admin_user
		);

        if($this->input->post('submit') && !$data['user']['disabled']) {
			$agentName		    = $this->security->xss_clean($this->input->post('agentName'));
            $experience         = $this->security->xss_clean($this->input->post('experience'));
            $totalBookings      = $this->security->xss_clean($this->input->post('totalBookings'));
            $agentDetail        = $this->security->xss_clean($this->input->post('agentDescription'));

            $rules = array(
                array(
                    'field'     => 'agentName',
                    'label'     => 'Agent Name',
                    'rules'     => 'required'
                ),
                array(
                    'field'     => 'agentDescription',
                    'label'     => 'Description',
                    'rules'     => 'required'
                ),
                array(
                    'field'     => 'experience',
                    'label'     => 'Experience',
                    'rules'     => 'required|numeric'
                ),
                array(
                    'field'     => 'totalBookings',
                    'label'     => 'Total Bookings',
                    'rules'     => 'required|numeric'
				)
			);
			
            $this->form_validation->set_rules($rules);
			$validation = $this->form_validation->run();
			
			$this->load->library('upload', array(
				'upload_path' => APPPATH.'uploads/img/agents/',
				'allowed_types' => 'gif|jpg|png|jpeg|svg',
                'overwrite' => true,
                'max_width' => 500,
                'max_height' => 500,
			));

			if(file_exists($_FILES['site-logo']['tmp_name']) == ''){
				$data['logo_error'] = 'Please must select image file for Agent.';
			}
			else{
				if($validation && $this->upload->do_upload('site-logo')) {
					$new_added = array(
						'agentName'         => htmlentities($agentName),
						'agentDetail'       => htmlentities($agentDetail),
						'experience'        => $experience,
						'totalBookings'     => $totalBookings
                    );

					if(file_exists($_FILES['site-logo']['tmp_name'])) {
						$success = $this->upload->do_upload('site-logo');
						if($success) {
							$res                        = $this->upload->data();
							$name                       = $res['file_name'];
							$new_added['agentImage']    = $name;
						} else {
							$data['logo_error']         = $this->upload->display_errors();
						}
					}
					
					$this->AgentsModel->addAgent($new_added);
					$data['alert'] = array('type' => 'alert alert-success', 'msg' => 'Agent Added Successfully.');
				}
				else{
					$data['logo_error'] = $this->upload->display_errors();
				}
			}
        }
		$this->load->view('admin/agents/addagent', $data);
	}

	public function editagent($id = null) {
        if($agent = $this->AgentsModel->getAgent($id)) {
            $data = array(
                'page_data'     => $this->page_data,
                'page_title'    => 'Editing: ' . html_entity_decode($agent['agentName']),
                'user'          => $this->admin_user,
                'agent'         => $agent
            );

            if($this->input->post('submit') && !$data['user']['disabled']) {
				
				$agentName		    = $this->security->xss_clean($this->input->post('agentName'));
                $experience         = $this->security->xss_clean($this->input->post('experience'));
                $totalBookings      = $this->security->xss_clean($this->input->post('totalBookings'));
                $agentDetail        = $this->security->xss_clean($this->input->post('agentDescription'));

                $rules = array(
                    array(
                        'field'     => 'agentName',
                        'label'     => 'Agent Name',
                        'rules'     => 'required'
                    ),
                    array(
                        'field'     => 'agentDescription',
                        'label'     => 'Description',
                        'rules'     => 'required'
                    ),
                    array(
                        'field'     => 'experience',
                        'label'     => 'Experience',
                        'rules'     => 'required|numeric'
                    ),
                    array(
                        'field'     => 'totalBookings',
                        'label'     => 'Total Bookings',
                        'rules'     => 'required|numeric'
                    )
                );

                $this->form_validation->set_rules($rules);
                $validation = $this->form_validation->run();

                if($validation) {
                    $to_update = array(
                        'agentName'         => htmlentities($agentName),
						'agentDetail'       => htmlentities($agentDetail),
						'experience'        => $experience,
						'totalBookings'     => $totalBookings
					);
					
					if(file_exists($_FILES['site-logo']['tmp_name'])) {

						$this->load->library('upload', array(
							'upload_path' => APPPATH.'uploads/img/agents',
							'allowed_types' => 'gif|jpg|png|jpeg|svg',
							'overwrite' => false,
						));
		
						if(file_exists($_FILES['site-logo']['tmp_name'])) {
							$success = $this->upload->do_upload('site-logo');
							if($success) {
								$res = $this->upload->data();
								$name = $res['file_name'];
								$to_update['agentImage'] = $name;
							}
						}
							
					}

					$this->AgentsModel->updateAgent($id, $to_update);
                    $data['agent'] = $this->AgentsModel->getAgent($agent['id']);
                    $this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully updated agent.'));

                    redirect(AGENTS_CONTROLLER . '/editagent/' . $id);
                }
            }

            $this->load->view('admin/agents/editagent', $data);
        } else
            redirect(base_url(AGENTS_CONTROLLER));
	}

	public function deleteAgent($id = null, $confirm = false) {
		
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Agents',
            'user' 			=> $this->admin_user,
            'agents'        => $this->all_agents,
		);

		if($confirm && !$data['user']['disabled']) {
			$this->AgentsModel->deleteAgent($id);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully delete agent.'));
		}
		return redirect(AGENTS_CONTROLLER);
	}
}
