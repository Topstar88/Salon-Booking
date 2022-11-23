<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Allpayments extends CI_Controller {
	private $page_data;
    private $admin_data;

	public function __construct() {
        parent::__construct();

        // Load Admin Model
		$this->load->database();
        $this->load->model('AdminModel');
		$this->load->model('OrderModel');

		$this->page_data                = $this->MainModel->pageData();
        $this->page_data['update']      = $this->MainModel->updates_settings();
        $this->page_data['orders']      = $this->OrderModel->orderByAllData();
        $this->admin_data               = $this->AdminModel->adminDetails(); // Retrieve details of the Admin user, If logged in.
        
        // Redirect to Login if not logged in.
        if(!$this->admin_data) {
            redirect(base_url(AUTH_CONTROLLER . '/login?redirect='.urlencode(current_url())));
        }
	}
    // All Payments.
    public function index() {
        $data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'All Payments',
            'user'          => $this->admin_data,
            'orders'        => $this->page_data['orders']
        );
        $this->load->view('admin/orders/orders', $data);
    }

    // Used to Update stripe settings.
    public function stripe() {
        $this->page_data['stripe'] = $this->OrderModel->getStripe();
        $data = array(
            'page_data'     => $this->page_data,
            'page_title'    => 'Stripe Settings',
            'user'          => $this->admin_data,
            'stripe'        => $this->page_data['stripe']
        );

        if($this->input->post('submit') && !$data['user']['disabled']) {
            $stripe_api_key             = $this->security->xss_clean($this->input->post('stripe_api_key'));
            $stripe_publishable_key     = $this->security->xss_clean($this->input->post('stripe_publishable_key'));
            $stripe_currency            = $this->security->xss_clean($this->input->post('stripe_currency'));
            $status                     = $this->security->xss_clean($this->input->post('site-status'));

            $this->load->model('Settings/RecaptchaModel');
            
            $rules = array();
            if($status) {
                $rules = array(
                    array(
                        'field' => 'stripe_api_key',
                        'label' => 'Stripe API Key',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'stripe_publishable_key',
                        'label' => 'Stripe Publishable Key',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'stripe_currency',
                        'label' => 'Stripe Currency',
                        'rules' => 'required'
                    ),
                );
            }
            $this->form_validation->set_rules($rules);
            $validation = (count($rules) > 0) ? $this->form_validation->run() : true;
            if($validation) {
                $to_update = array(
                    'status' 		            => ($status)                    ? true 	                    : false,
                    'stripe_api_key' 		    => ($stripe_api_key)            ? $stripe_api_key 	        : '',
                    'stripe_publishable_key' 	=> ($stripe_publishable_key)    ? $stripe_publishable_key 	: '',
                    'stripe_currency'       	=> ($stripe_currency)           ? $stripe_currency 	        : ''
                );
                $this->OrderModel->setStripe($to_update);
                $data['stripe'] = $this->OrderModel->getStripe();
                $data['alert'] = array(
                    'type' => 'alert alert-success',
                    'msg' => 'Stripe Settings updated successfully.'
                );
            }
        }
        $this->load->view('admin/orders/stripe_settings', $data);
    }
}
