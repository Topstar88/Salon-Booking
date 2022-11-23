<?php defined('BASEPATH') || exit('Direct script access is blocked.');

class Account extends CI_Controller {
    private $page_data;
    private $admin_user;

    public function __construct() {
        parent::__construct();
        
        // Load Admin Model
        $this->load->database();
        $this->load->model('AdminModel');

        $this->page_data            = $this->MainModel->pageData();
        $this->page_data['update']  = $this->MainModel->updates_settings();
        $this->admin_user           = $this->AdminModel->adminDetails();  // Get admin details, if logged in.
        
        // Check if Admin is logged in. Redirect to login otherwise.
        if(!$this->admin_user) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
    }

    // Account settings for the Currently logged in User.
    public function me() {
        $data = array(
            'page_data' => $this->page_data,
            'page_title' => 'My Account',
            'user' => $this->admin_user,
        );

        // If submit.
        if($this->input->post('submit')) {
            $fullName       = str_replace(" ",'',$this->security->xss_clean($this->input->post('admin-fullName')));
            $email          = $this->security->xss_clean($this->input->post('admin-email'));
            $new_password   = $this->security->xss_clean($this->input->post('admin-new-password')); // New Pass
            $password       = $this->security->xss_clean($this->input->post('admin-password')); // Current Pass

            // By default, Form Validation only checks for Current Password field.
            $rules = array(
                array(
                    'field' => 'admin-password',
                    'label' => 'Current Password',
                    'rules' => 'required'
                )
            );

            // Fields to Update. Empty by default.
            $to_update = array();

            // If fullName exists & fullName is not equal to current fullName. Then add Form Validation rules, and add it in $to_update;
            if($fullName != $data['user']['fullName']) {
                array_push($rules, array(
                    'field' => 'admin-fullName',
                    'label' => 'fullName',
                    'rules' => 'required|is_unique[logintbl.fullName]',
                    'errors' => array(
                        'is_unique' => 'That fullName is already in use by another Administrator account.'
                    )
                ));
                $to_update['fullName'] = strtolower($fullName);
            }
            
            // If email exists, and it's not equal to current email. Add Validation rules and also add it to $to_update;
            if($email != $data['user']['email']) {
                array_push($rules, array(
                    'field' => 'admin-email',
                    'label' => 'E-Mail',
                    'rules' => 'required|valid_email|is_unique[logintbl.email]',
                    'errors' => array(
                        'is_unique' => 'That E-Mail is already in use by another Administrator account.'
                    )
                ));
                $to_update['email'] = strtolower($email);
            }
            
            // Same as the above 2 fields, but We're using password_hash() to hash the password before submitting. 
            // The model will not hash the password. SO we have to do it in the controller
            if($new_password) {
                array_push($rules, array(
                    'field' => 'admin-new-password',
                    'label' => 'New Password',
                    'rules' => 'min_length[3]|max_length[48]'
                ));
                $to_update['password'] = password_hash($new_password, PASSWORD_DEFAULT);
            }
            
            // Load database for 'is_unique' Rule (Form Validation) to work.
            $this->form_validation->set_rules($rules);
            $validation = $this->form_validation->run();

            if($validation) {
                // If success, then Verify the user's current password.
                if($this->AdminModel->verifyPassword($data['user']['id'], $password)) {
                    // If $to_update includes any fields, then update the user account.
                    if(count($to_update) > 0 && !$data['user']['disabled'])
                        $this->AdminModel->updateAccount($data['user']['id'], $to_update);

                    // Recreate the session based on newly updated data.
                    $data['user'] = $this->AdminModel->recreateSession();
                    $data['alert'] = array(
                        'type' => 'alert alert-success',
                        'msg'  => 'Account details updated successfully.'
                    );
                } else
                    $data['alert'] = array( // Else show an error.
                        'type' => 'alert alert-danger',
                        'msg'  => 'Invalid current Password provided.'
                    );
            }
        }

        $this->load->view('admin/account/me', $data);
    }
}