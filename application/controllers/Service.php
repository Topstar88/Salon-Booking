<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

	private $admin_user;
	private $page_data;
	
	public function __construct() {
        parent::__construct();
		
		$this->load->database();
		$this->load->model('AdminModel');
		$this->load->model('AgentsModel');
		
		$this->page_data 				= $this->MainModel->pageData();
        $this->page_data['update']  	= $this->MainModel->updates_settings();
        $this->admin_user 				= $this->AdminModel->adminDetails();
        $this->all_services 			= $this->ServiceModel->serviceList();
        $this->agent_List_By_Service 	= $this->ServiceModel->agentListByService();
        $this->all_agents   			= $this->AgentsModel->agentList();
        
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
	
	public function index(){
		redirect(base_url(SERVICE_CONTROLLER . '/services'));
	}

	public function services() {

		$data = array(
            'page_data' 				=> $this->page_data,
            'page_title' 				=> 'All Services',
            'user' 						=> $this->admin_user,
            'services' 					=> $this->all_services,
            'agent_List_By_Service' 	=> $this->agent_List_By_Service
		);
		$this->load->view('admin/service/service', $data);
	}

	public function addservice(){

		$data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'Add Service',
            'user'          => $this->admin_user,
            'agents'        => $this->all_agents
		);

        if($this->input->post('submit') && !$data['user']['disabled']) {
			$title		= $this->security->xss_clean($this->input->post('service-title'));
            $content    = $this->security->xss_clean($this->input->post('service-content'));
            $price    	= $this->input->post('service-price');
            $space    	= $this->input->post('service-space');
            $starts    	= $this->input->post('service-starts');
            $ends    	= $this->input->post('service-ends');
			$duration   = $this->input->post('service-duration');
			$agent   	= $this->input->post('agent[]');

			if($agent){
				$agentArray	= implode (",", $agent);
			}

            $rules = array(
                array(
                    'field'     => 'service-title',
                    'label'     => 'Service Title',
                    'rules'     => 'required'
                ),
                array(
                    'field'     => 'service-content',
                    'label'     => 'Content',
                    'rules'     => 'required'
                ),
                array(
                    'field'     => 'service-price',
                    'label'     => 'Price',
                    'rules'     => 'required|numeric|greater_than[0.99]'
                ),
                array(
                    'field'     => 'service-space',
                    'label'     => 'Space',
                    'rules'     => 'required'
				),
                array(
                    'field'     => 'service-starts',
                    'label'     => 'Starts',
                    'rules'     => 'required'
				),
                array(
                    'field'     => 'service-ends',
                    'label'     => 'Ends',
                    'rules'     => 'required'
				),
                array(
                    'field'     => 'service-duration',
                    'label'     => 'Duration',
                    'rules'     => 'required'
				),
                array(
                    'field'     => 'agent[]',
                    'label'     => 'Agent',
                    'rules'     => 'required'
                )
			);
			
            $this->form_validation->set_rules($rules);
			$validation = $this->form_validation->run();
			
			$this->load->library('upload', array(
				'upload_path' => APPPATH.'uploads/img/',
				'allowed_types' => 'gif|jpg|png|jpeg|svg',
				'overwrite' => true,
			));

			if(file_exists($_FILES['site-logo']['tmp_name']) == ''){
				$data['logo_error'] = 'Please must select image file for service.';
			}
			else{
				if($validation && $this->upload->do_upload('site-logo')) {
					$new_page = array(
						'title'         => htmlentities($title),
						'description'   => htmlentities($content),
						'price'       	=> $price,
						'servSpace'     => $space,
						'servStart'     => $starts,
						'servEnd'       => $ends,
						'servDuration'  => $duration,
						'agentIds'      => $agentArray
					);

					if(file_exists($_FILES['site-logo']['tmp_name'])) {
						$success = $this->upload->do_upload('site-logo');
						if($success) {
							$res = $this->upload->data();
							$name = $res['file_name'];
							$new_page['image'] = $name;
						} else {
							$data['logo_error'] = $this->upload->display_errors();
						}
					}
					
					$this->ServiceModel->addService($new_page);
					$data['alert'] = array('type' => 'alert alert-success', 'msg' => 'Service Added Successfully.');
				}
				else{
					$data['logo_error'] = $this->upload->display_errors();
				}
			}
        }
		$this->load->view('admin/service/addservice', $data);
	}

	public function editservice($id = null) {
        $this->load->model('ServiceModel');
        if($service = $this->ServiceModel->getservice($id)) {
            $data = array(
                'page_data'     => $this->page_data,
                'page_title'    => 'Editing: ' . html_entity_decode($service['title']),
                'user'          => $this->admin_user,
                'service'      => $service,
				'agents'        => $this->all_agents
			);
			if($data['service']['agentIds']){
				$data['service']['agentIds'] = explode (",", $data['service']['agentIds']);
			}

            if($this->input->post('submit') && !$data['user']['disabled']) {
				
				$title		= $this->security->xss_clean($this->input->post('service-title'));
				$content    = $this->security->xss_clean($this->input->post('service-content'));
				$price    	= $this->input->post('service-price');
				$space    	= $this->input->post('service-space');
				$starts    	= $this->input->post('service-starts');
				$ends    	= $this->input->post('service-ends');
				$duration   = $this->input->post('service-duration');
				$agent   	= $this->input->post('agent[]');
	
				if($agent){
					$agentArray	= implode (",", $agent);
				}

				$rules = array(
					array(
						'field'     => 'service-title',
						'label'     => 'Service Title',
						'rules'     => 'required'
					),
					array(
						'field'     => 'service-content',
						'label'     => 'Content',
						'rules'     => 'required'
					),
					array(
						'field'     => 'service-price',
						'label'     => 'Price',
						'rules'     => 'required|numeric|greater_than[0.99]'
					),
					array(
						'field'     => 'service-space',
						'label'     => 'Space',
						'rules'     => 'required'
					),
					array(
						'field'     => 'service-starts',
						'label'     => 'Starts',
						'rules'     => 'required'
					),
					array(
						'field'     => 'service-ends',
						'label'     => 'Ends',
						'rules'     => 'required'
					),
					array(
						'field'     => 'service-duration',
						'label'     => 'Duration',
						'rules'     => 'required'
					),
					array(
						'field'     => 'agent[]',
						'label'     => 'Agent',
						'rules'     => 'required'
					)
				);

                $this->form_validation->set_rules($rules);
                $validation = $this->form_validation->run();

                if($validation) {
                    $to_update = array(
                        'title'         => htmlentities($title),
						'description'   => htmlentities($content),
						'price'      	=> $price,
						'servSpace'     => $space,
						'servStart'     => $starts,
						'servEnd'       => $ends,
						'servDuration'  => $duration,
						'agentIds'      => $agentArray
					);
					
					if(file_exists($_FILES['site-logo']['tmp_name'])) {

						$this->load->library('upload', array(
							'upload_path' => APPPATH.'uploads/img/',
							'allowed_types' => 'gif|jpg|png|jpeg|svg',
							'overwrite' => false,
						));
		
						if(file_exists($_FILES['site-logo']['tmp_name'])) {
							$success = $this->upload->do_upload('site-logo');
							if($success) {
								$res = $this->upload->data();
								$name = $res['file_name'];
								$to_update['image'] = $name;
							}
						}
							
					}

					$this->ServiceModel->updateService($id, $to_update);
					$data['service'] = $this->ServiceModel->getservice($service['id']);
                    $this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully updated service.'));

                    redirect(SERVICE_CONTROLLER . '/editservice/' . $id);
                }
            }

            $this->load->view('admin/service/editservice', $data);
        } else
            redirect(base_url(SERVICE_CONTROLLER));
	}

	public function deleteService($id = null, $confirm = false) {
		$this->load->model('ServiceModel');
		
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Services',
            'user' 			=> $this->admin_user,
            'services' 		=> $this->all_services,
		);
		if($confirm && !$data['user']['disabled']) {
			$this->ServiceModel->deleteService($id);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully delete service.'));
		}
		return redirect(SERVICE_CONTROLLER);
	}
}
