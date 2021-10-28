<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adminblog extends CI_Controller {
	private $page_data;
    private $admin_user;

	public function __construct() {
        parent::__construct();

        // Load Admin Model
		$this->load->database();
        $this->load->helper('text');
        $this->load->model('AdminModel');
        $this->load->model('BlogModel');

		$this->page_data    		= $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user   		= $this->AdminModel->adminDetails();
        $this->blogList     		= $this->BlogModel->blogList();
        $this->blogStatus   		= $this->BlogModel->blogStatus();
        
        // Redirect to Login if not logged in.
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
    public function index() {
        $data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'All Posts',
            'user'          => $this->admin_user,
            'blogLists'      => $this->blogList,
            'blogStatus'      => $this->blogStatus
		);
		
		$this->load->view('admin/blog/blog', $data);
	}
	
    public function blogStatus() {
		
		$bstatus['bstatus'] = $this->input->post('bstatus');

		if($bstatus['bstatus'] == 'true'){
			$bstatus['bstatus'] = 1;
		}

        if($status = $this->BlogModel->blogStatusSet($bstatus)){
            $returnJsn = array('bstatus' => $bstatus['bstatus']);
			echo json_encode($bstatus);
        }
        
	}
	
    public function add_post() {
		
		$data = array(
            'page_data' => $this->page_data,
            'page_title' => 'Add Post',
            'user' => $this->admin_user
        );
		
		$error = false;
        if($this->input->post('submit') && !$data['user']['disabled']) {
            
            $this->form_validation->set_rules('title','Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');
            $runValidation = $this->form_validation->run();

			$to_update = array();
			
			$title = $this->security->xss_clean($this->input->post("title"));
			$description = $this->security->xss_clean($this->input->post("description"));
			if($runValidation){
                $to_update = array(
                    'title'         => htmlentities($title),
                    'description'       => htmlentities($description)
                );
                if(!empty($_FILES['image']['name'])) {
                    $base = explode(".", strtolower(basename($_FILES["image"]["name"])));
                    $ext = end($base);
                    $extArr = array("jpeg","jpg","png");
                    if(!in_array($ext,$extArr)) {
                        $data['imageError'] = "Only image types allowed";
                        $error = true;
                    }
                    else {
                        $image = uniqid().".".$ext;
                    }
                }
                else {
                    $data['imageError'] = "Upload Image";
                    $error = true;
                }
                
                $status = $this->input->post("status");
                $status = $status == "on" ? 1 : 2;
                $data['status'] = $status;
                $to_update['status'] = $status;
                
                
                if(!$error) {
                    $to_update['image'] = $image;
                    move_uploaded_file($_FILES["image"]["tmp_name"], APPPATH.'uploads/img/blog/'.$image);
                    $this->load->model('BlogModel');
                    $dateTime = date("Y-m-d H:i:s");
                    $to_update['datetime_added'] = $dateTime;
                    $to_update['datetime_updated'] = $dateTime;
                    
                    $i = 1;
                    $permalink = generatePermalink($title);
                    while($this->BlogModel->checkPermalink($permalink) > 0) {
                        $permalink = $permalink."-".$i;
                        $i++;
                    }
                    
                    $to_update['permalink'] = $permalink;
                    
                    $this->BlogModel->add_post($to_update);
                    $data['alert'] = array(
                        'type' => 'alert alert-success',
                        'msg' => 'Blog post added successfully'
                    );
                }
            }
		}
		
		$this->load->view('admin/blog/add_post', $data);
	}
	
	public function edit_post($id = null) {
		
		if(!is_null($id) && is_numeric($id)) {
			$id = $this->security->xss_clean($id);
		
			if($postData = $this->BlogModel->get_post($id)) {
				
				$data = array(
					'page_data' 	=> $this->page_data,
					'page_title' 	=> 'Edit Blog Post - '.$postData['title'],
					'user' 			=> $this->admin_user,
					'postData'     => $postData
				);

				$error = false;
				if($this->input->post('submit') && !$data['user']['disabled']) {
					
					$this->form_validation->set_rules('title','Title', 'trim|required');
					$this->form_validation->set_rules('description', 'Description', 'trim|required');
					$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');
					$runValidation = $this->form_validation->run();

					$to_update = array();

					if($runValidation){
						$title 				= $this->security->xss_clean($this->input->post("title"));
						$description 		= $this->security->xss_clean($this->input->post("description"));
						
						$status 			= $this->security->xss_clean($this->input->post("status"));
						$status 			= $status == "on" ? 1 : 2;
						$data['status'] 	= $status;

						$dateTime = date("Y-m-d H:i:s");
							
						$to_update = array(
							'title'         	=> htmlentities($title),
							'description'       => htmlentities($description),
							'status' 			=> $status,
							'datetime_updated' 	=> $dateTime
						);

						if(!empty($_FILES['image']['name'])) {
							$base = explode(".", strtolower(basename($_FILES["image"]["name"])));
							$ext = end($base);
							$extArr = array("jpeg","jpg","png");
							if(!in_array($ext,$extArr)) {
								$data['imageError'] = "Only image types allowed";
								$error = true;
							}
							else {
								$image = uniqid().".".$ext;
							}
						}
						else {
							$image = $postData['image'];
						}
	
						if(!$error) {
							$to_update['image'] = $image;
							if(!empty($_FILES['image']['name'])) {
								move_uploaded_file($_FILES["image"]["tmp_name"], APPPATH.'uploads/img/blog/'.$image);
								$to_update['image'] = $image;
							}
							
							$i = 1;
							$permalink = generatePermalink($title);
							if($permalink != $postData['permalink']) {
								while($this->BlogModel->checkPermalink($permalink) > 0) {
									$permalink = $permalink."-".$i;
									$i++;
								}
							}
							
							$to_update['permalink'] = $permalink;
							
							$this->BlogModel->update_post($id, $to_update);
							$data['postData'] = $this->BlogModel->get_post($id);
							$data['alert'] = array(
								'type' => 'alert alert-success',
								'msg' => 'Blog post updated successfully'
							);
						}
					}
				}
				
				$this->load->view('admin/blog/edit_post', $data);
			} else
            redirect(base_url(BLOG_CONTROLLER));
		}
	}

	public function delete_post($id = null, $confirm = false) {
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Services',
            'user' 			=> $this->admin_user,
            'blogLists'      => $this->blogList,
		);

		if($confirm && !$data['user']['disabled']) {
			$this->BlogModel->delete_post($id);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully delete service.'));
		}
		return redirect(BLOG_CONTROLLER);
	}
}