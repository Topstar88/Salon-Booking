<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	private $page_data;
    private $admin_user;

    /* This is a Controller only accessible to Administrator Accounts */
	public function __construct() {
        parent::__construct();

        // Load Admin model
		$this->load->database();
        $this->load->model('AdminModel');
        $this->load->model('ThemesModel');

		$this->page_data            = $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user           = $this->AdminModel->adminDetails();
        
        // Check if Admin is logged in. Redirect to login otherwise.
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}

	public function index() {
        redirect(base_url(GENERAL_CONTROLLER . '/settings'));
    }
    
    // This Function is responsible for Loading and Visualizing Basic Information for the User.
    public function dashboard() {
        $this->load->model('LoginModel');
        $this->load->model('BookingModel');

        $this->page_data['clients'] = $this->LoginModel->recent_registrations(10);
        $this->page_data['weekly_users'] = $this->LoginModel->weekly_registrations();
        $this->page_data['total_users'] = $this->LoginModel->total_registrations();
        
        $this->page_data['recent_bookings'] = $this->BookingModel->recent_bookings(10);
        $this->page_data['weekly_bookings'] = $this->BookingModel->weekly_bookings();
        $this->page_data['total_bookings'] = $this->BookingModel->total_bookings();
        $data = array(
            'page_title' => 'Dashboard',
            'page_data' => $this->page_data,
            'user' => $this->admin_user
        );

        $this->load->view('admin/general/dashboard', $data);
    }

    // This method is used to update General Settings.
    public function settings() {
        $data = array(
            'page_title' => 'General Settings',
            'page_data' => $this->page_data,
            'user' => $this->admin_user
        );

        // If the User Submits the Form.
        if($this->input->post('submit') && !$data['user']['disabled']) {
			
            // Retrieve POST fields
            $title          = $this->security->xss_clean($this->input->post('site-title'));
            $description    = $this->security->xss_clean($this->input->post('site-description'));
            $keywords       = $this->security->xss_clean($this->input->post('site-keywords'));
			
			$rules = array(
				array(
					'field'     => 'site-title',
					'label'     => 'Title',
					'rules'     => 'required'
				),
				array(
					'field'     => 'site-description',
					'label'     => 'Description',
					'rules'     => 'required'
				),
				array(
					'field'     => 'site-keywords',
					'label'     => 'Keywords',
					'rules'     => 'required'
				)
			);

			$this->form_validation->set_rules($rules);
			$validation = $this->form_validation->run();

            // Load GeneralModel
            $this->load->model('GeneralModel');
			
			if($validation) {
				// Fields to Update
				$to_update = array(
					'title' => $title,
					'description' => $description,
					'keywords' => $keywords
				);

				// Check if Logo or Favicon was uploaded by User.
				if(file_exists($_FILES['site-logo']['tmp_name']) || file_exists($_FILES['site-favicon']['tmp_name'])) {

					// Load the Uploader Class if true.
					$this->load->library('upload', array(
						'upload_path' => APPPATH.'uploads/img/',
						'allowed_types' => 'gif|jpg|png|jpeg|svg',
						'overwrite' => false,
					));

					// This block of code runs for both Favicon & Logo. It will upload the Logo. If there is an error, It will push that error inside $data
					if(file_exists($_FILES['site-logo']['tmp_name'])) {
						$success = $this->upload->do_upload('site-logo');
						
						if($success) {
							$res = $this->upload->data();
							$name = $res['file_name'];
							$to_update['logo'] = $name;
						} else {
							$data['logo_error'] = 'Only .gif, .jpg, .jpeg, .png, .svg Files are allowed.';
						}
					}

					if(file_exists($_FILES['site-favicon']['tmp_name'])) {
						$success = $this->upload->do_upload('site-favicon');

						if($success) {
							$res = $this->upload->data();
							$name = $res['file_name'];
							$to_update['favicon'] = $name;
						} else {
							$data['logo_error'] = 'Only .gif, .jpg, .jpeg, .png, .svg Files are allowed.';
						}
					}
						
				}
				// GenralModel is a Getter & Setter model. Passing an array of Fields to Update.
				$this->GeneralModel->set($to_update);
				$data['page_data']['general'] = $this->GeneralModel->get(); // Refresh General Settings after the Update.
				$data['alert'] = array('type' => 'alert alert-success', 'msg' => 'General settings updated successfully.');
			}
        }
        $this->load->view('admin/general/settings', $data);
    }

    // This method lets the user choose the theme for their website.
    public function themes() {
        $this->load->model('ThemesModel');

        $data = array(
            'page_title' => 'Theme Settings',
            'page_data' => $this->page_data,
            'user' => $this->admin_user,
            'current_theme' => $this->ThemesModel->get(),
            'themes' => $this->ThemesModel->getAvailableThemes(), // This method inside ThemesModel will return an array of installed themes.
        );
        $this->load->view('admin/general/themes/main', $data);
    }

    // This method lets the user upload a theme.
    public function upload_theme() {
        $this->load->model('ThemesModel');

        $data = array(
            'page_title' => 'Theme Upload',
            'page_data' => $this->page_data,
            'user' => $this->admin_user,
        );

        // If Submitted.
        if($this->input->post('submit')) {
            // If file uploaded.
            if(file_exists($_FILES['theme']['tmp_name'])) {
                $this->load->library('upload', array(
                    'upload_path' => APPPATH.'uploads/themes/',
                    'allowed_types' => 'zip|rar',
                    'overwrite' => false,
                ));

                $success = $this->upload->do_upload('theme');
                if($success && !$data['user']['disabled']) {
                    $file = $this->upload->data();

                    // Set up a ZipArchive and open up the newly uploaded zip file.
                    $zip = new ZipArchive;
                    $res = $zip->open($file['full_path']);

                    if($res) {
                        // If successful, Extract the Theme to it's own folder inside /views/themes - And Close the Zip archive.
                        $zip->extractTo(APPPATH.'views/themes/' . str_replace('.zip', '', strtolower($file['file_name'])));
                        $zip->close();
                        $this->session->set_flashdata('alert', array(
                            'type' => 'alert alert-success',
                            'msg'  => 'Theme Installed successfully. To use the new theme, Activate it from the list below.'
                        ));

                        // Redirect to Themes page.
                        redirect(base_url(GENERAL_CONTROLLER . '/themes'));
                    }

                    // Delete the uploaded file.
                    unlink($file['full_path']);
                } else 
                    // Show an error if anything other than .zip was uploaded.
                    $data['alert'] = array(
                        'type' => 'alert alert-danger',
                        'msg'  => !$data['user']['disabled'] ? 'Unknown file format. Please only upload .zip files.' : 'Disabled in Demo Mode.'
                    );
            }
        }

        $this->load->view('admin/general/themes/upload', $data);
    }

    // This function is a middleware function. This function checks if the Theme exists using the method provided by ThemesModel, and applies the theme if it exists.
    public function set_theme($theme = null) {
        if($theme) {
            // Check if Theme exists. If yes, load it's manifest.
            if($manifest = $this->ThemesModel->doesThemeExist($theme)) {
                // Set the Website theme to the theme.
                if(!$data['user']['disabled'])
                    $this->ThemesModel->set(array(
                        'theme' => trim(strtolower($theme))
                    ));

                // Set an alert.
                $this->session->set_flashdata('alert', array(
                    'type' => 'alert alert-success',
                    'msg' => $manifest['name'] . ' was applied successfully.'
                ));
            }
        }

        // Redirect back to Themes.
        redirect(base_url(GENERAL_CONTROLLER . '/themes'));
    }

    // This function is also a middleware function. It is used to clean the cache entirely.
    public function purge_cache() {
        // Load cache driver & Clean it.
        $this->load->driver('cache', array('adapter' => 'file'));
        $this->cache->clean();

        // Set an Alert.
        $this->session->set_flashdata('alert', array(
            'type' => 'alert alert-success',
            'msg' => 'Destroyed all cache successfully.'
        ));

        // Redirect to Dashboard.
        redirect(base_url(GENERAL_CONTROLLER . '/dashboard'));
    }
}
