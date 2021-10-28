<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	private $admin_user;
	private $page_data;
	
	public function __construct() {
        parent::__construct();
		
		$this->load->database();
        $this->load->model('AdminModel');
        $this->load->model('GalleryModel');

		$this->page_data 			= $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user 			= $this->AdminModel->adminDetails();
        $this->all_cats 			= $this->GalleryModel->listCat();
        $this->listGallery 			= $this->GalleryModel->listGallery();
        $this->listGalleryWidCat 	= $this->GalleryModel->listGalleryWidCat();
        
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
	
	public function index(){
		redirect(base_url(GALLERY_CONTROLLER . '/listGallery'));
	}// redirect to listGallery

	public function listGallery() {

		$data = array(
            'page_data' 		=> $this->page_data,
            'page_title' 		=> 'All Gallery Images',
            'user' 				=> $this->admin_user,
			'listGalleryWidCat'	=> $this->listGalleryWidCat
		);
		$this->load->view('admin/gallery/gallery', $data);
	}//Show list of gallery & categories

	public function addImg(){

		$data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'Add Gallery Image',
            'user'          => $this->admin_user,
            'categories'    => $this->all_cats
		);

        if($this->input->post('submit') && !$data['user']['disabled']) {
			$title		= $this->security->xss_clean($this->input->post('image-title'));
			$content    = $this->security->xss_clean($this->input->post('image-content'));
			$category  	= $this->input->post('categoryId');

            $rules = array(
				array(
					'field'     => 'image-title',
					'label'     => 'Image Title',
					'rules'     => 'required'
				),
				array(
					'field'     => 'image-content',
					'label'     => 'Image Short Detail',
					'rules'     => 'required'
				),
				array(
					'field'     => 'categoryId',
					'label'     => 'Image Category',
					'rules'     => 'required'
				)
			);
			
            $this->form_validation->set_rules($rules);
			$validation = $this->form_validation->run();
			
			$this->load->library('upload', array(
				'upload_path' => APPPATH.'uploads/gallery/',
				'allowed_types' => 'gif|jpg|png|jpeg|svg',
				'overwrite' => true,
			));

			if($_FILES['gImage']['tmp_name'] == ''){
				$data['logo_error'] = 'Please select Image.';
			}
			else{
				if($validation && $this->upload->do_upload('gImage')) {
					$new_img = array(
						'imgName'       => htmlentities($title),
						'imgDetails'   	=> htmlentities($content),
						'catId'      	=> $category
					);

					if(file_exists($_FILES['gImage']['tmp_name'])) {
						$success = $this->upload->do_upload('gImage');
						if($success) {
							$res = $this->upload->data();
							$name = $res['file_name'];
							$new_img['imgPath'] = $name;
						} else {
							$data['logo_error'] = $this->upload->display_errors();
						}
					}
					
					$this->GalleryModel->setGallery($new_img);
					$data['alert'] = array('type' => 'alert alert-success', 'msg' => 'Service Added Successfully.');
				}
			}
        }
		$this->load->view('admin/gallery/addGallery', $data);
	}//Add gallery Image

	public function editImg($id = null) {

        if($gallery = $this->GalleryModel->getGallery($id)) {
            $data = array(
                'page_data'     	=> $this->page_data,
                'page_title'    	=> 'Editing: ' . html_entity_decode($gallery['imgName']),
                'user'          	=> $this->admin_user,
				'gallery'      		=> $gallery,
				'listGalleryWidCat'	=> $this->listGalleryWidCat,
				'categories' 		=> $this->all_cats
			);

            if($this->input->post('submit') && !$data['user']['disabled']) {
				
				$title		= $this->security->xss_clean($this->input->post('image-title'));
				$content    = $this->security->xss_clean($this->input->post('image-content'));
				$category  	= $this->input->post('categoryId');

				$rules = array(
					array(
						'field'     => 'image-title',
						'label'     => 'Image Title',
						'rules'     => 'required'
					),
					array(
						'field'     => 'image-content',
						'label'     => 'Image Short Detail',
						'rules'     => 'required'
					),
					array(
						'field'     => 'categoryId',
						'label'     => 'Image Category',
						'rules'     => 'required'
					)
				);

                $this->form_validation->set_rules($rules);
                $validation = $this->form_validation->run();

                if($validation) {
                    $to_update = array(
                        'imgName'       => htmlentities($title),
						'imgDetails'   	=> htmlentities($content),
						'catId'      	=> $category
					);
					
					if(file_exists($_FILES['gImage']['tmp_name'])) {

						$this->load->library('upload', array(
							'upload_path' => APPPATH.'uploads/gallery/',
							'allowed_types' => 'gif|jpg|png|jpeg|svg',
							'overwrite' => true,
						));
		
						if(file_exists($_FILES['gImage']['tmp_name'])) {
							$success = $this->upload->do_upload('gImage');
							if($success) {
								$res = $this->upload->data();
								$name = $res['file_name'];
								$to_update['imgPath'] = $name;
							}
						}
							
					}

					$this->GalleryModel->updateGallery($id, $to_update);
					$data['service'] = $this->GalleryModel->getGallery($gallery['id']);
                    $this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully updated service.'));

                    redirect(GALLERY_CONTROLLER . '/editImg/' . $id);
                }
            }

            $this->load->view('admin/gallery/editGallery', $data);
        } else
            redirect(base_url(GALLERY_CONTROLLER));
	}//Edit & Update Gallery Image

	public function deleteImg($id = null, $confirm = false) {
		$this->load->model('GalleryModel');
		
		$data = array(
			'page_data' 		=> $this->page_data,
            'page_title' 		=> 'All Gallery Images',
            'user' 				=> $this->admin_user,
			'listGalleryWidCat'	=> $this->listGalleryWidCat
		);

		if($confirm && !$data['user']['disabled']) {
			$this->GalleryModel->deleteGallery($id);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully delete Image.'));
		}
		return redirect(GALLERY_CONTROLLER);
	}//Delete Gallery Image

	/************ Categories ************/
	public function categories(){
		$data = array(
            'page_data' => $this->page_data,
            'page_title' => 'All Categories',
            'user' => $this->admin_user,
            'categories' => $this->all_cats,
		);
		$this->load->view('admin/gallery/galleryCat', $data);
	}//show category list

	public function catAdd(){
		$data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'Add Category',
            'user'          => $this->admin_user
		);

        if($this->input->post('submit') && !$data['user']['disabled']) {

			$cName		= $this->security->xss_clean($this->input->post('category-name'));
            $rules = array(
                array(
                    'field'     => 'category-name',
                    'label'     => 'Category Name',
                    'rules'     => 'required'
                )
			);
			
            $this->form_validation->set_rules($rules);
			$validation = $this->form_validation->run();
			
			
			if($validation) {
				$catAdd = array(
					'cName'         => htmlentities($cName)
				);
				
				$this->GalleryModel->setCat($catAdd);
				$data['alert'] = array('type' => 'alert alert-success', 'msg' => 'Category Added Successfully.');
			}
        }
		$this->load->view('admin/gallery/addGalleryCat', $data);
	}//add category

	public function catEdit($id = null){
		if($categories = $this->GalleryModel->getCat($id)) {
            $data = array(
                'page_data'     => $this->page_data,
                'page_title'    => 'Editing: ' . html_entity_decode($categories['cName']),
                'user'          => $this->admin_user,
                'categories'      => $categories
			);

            if($this->input->post('submit') && !$data['user']['disabled']) {
				
				$cName		= $this->security->xss_clean($this->input->post('category-name'));

				$rules = array(
					array(
						'field'     => 'category-name',
						'label'     => 'Category Name',
						'rules'     => 'required'
					)
				);

                $this->form_validation->set_rules($rules);
                $validation = $this->form_validation->run();

                if($validation) {
                    $to_update = array(
                        'cName'      => htmlentities($cName)
					);

					$this->GalleryModel->updateCat($id, $to_update);
					$data['categories'] = $this->GalleryModel->getCat($categories['id']);
                    $this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully updated client.'));

                    redirect(GALLERY_CONTROLLER . '/catEdit/' . $id);
                }
            }

            $this->load->view('admin/gallery/editGalleryCat', $data);
		}
		else{
			redirect(base_url(GALLERY_CONTROLLER . '/categories'));
		}
	}//edit & update category

	public function catDelete($id = null, $confirm = false){
		$data = array(
			'page_data' 	=> $this->page_data,
            'page_title' 	=> 'All Clients',
            'user' 			=> $this->admin_user,
			'categories' 	=> $this->all_cats
		);

		if($confirm && !$data['user']['disabled']) {
			$this->GalleryModel->deleteCat($id);
			$this->session->set_flashdata('alert', array('type' => 'alert alert-success', 'msg'  => 'Successfully delete category.'));
		}
		return redirect(GALLERY_CONTROLLER.'/categories');
	}//delete category
}
