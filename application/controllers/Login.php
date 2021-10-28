<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	private $page_data;

	public function __construct(){
		parent::__construct();

		$this->load->database();
		
		$loginSession 					= $this->session->userdata('id');
		$this->page_data 				= $this->MainModel->pageData();
		$this->page_data['email']   	= $this->MainModel->smtp_settings();
        $cookieModl 					= $this->LoginModel->validateSession($loginSession);
		$this->page_data['user'] 		= $this->LoginModel->user_info($loginSession);
        $this->page_data['social_keys'] = $this->MainModel->social_keys();

		if($cookieModl != "")
		return redirect('enduser');
	}
	
	public function index(){
		$this->form_validation->set_rules('email', 'Username/Email', 'required');
		$this->form_validation->set_rules('password','Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');

		$runValidation = $this->form_validation->run();

		if($runValidation){
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));

			$loginId = $this->LoginModel->isValidate($email, $password);
			if($loginId){
				if($loginId['activation']){
					if($loginId['id']){
						$this->session->set_userdata('id',$loginId['id']);
						return redirect('enduser');
					}
					else{
						$this->session->set_flashdata('userMsg','Username / Email / Password Not Matched');
						$this->session->set_flashdata('userMsg_class','alert alert-danger');
						return redirect('login/index');
					}
				}
				else{
					$this->session->set_flashdata('userMsg','You have not activate your account yet. Please check your Email.');
					$this->session->set_flashdata('userMsg_class','alert alert-danger');
					return redirect('login/index');
				}
			}
			else{
				$this->session->set_flashdata('userMsg','Account not find by this email.');
				$this->session->set_flashdata('userMsg_class','alert alert-danger');
				return redirect('login/index');
			}
		}
		$themeViewData = $this->page_data;
		$theme_view = $this->page_data['theme_view'];
		$theme_view('login', $themeViewData);
	}

	public function signUp(){
		$this->form_validation->set_rules('fullName','Username', 'trim|required|min_length[2]|max_length[20]|is_unique[logintbl.fullName]', array('is_unique' => 'The %s is already taken'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[logintbl.email]', array('is_unique' => 'You are Already Signed Up with this %s.'));
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|regex_match[/([0-9\s\-]{7,})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/]');
		$this->form_validation->set_rules('password','Password', 'trim|required');
		$this->form_validation->set_rules('userCnPassword', 'Confirm Password', 'trim|required|matches[password]', array('matches' => 'The %s does not match.'));
		$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');

		$runValidation = $this->form_validation->run();

		if($runValidation){
			
			$post = $this->security->xss_clean($this->input->post());
			$post['fullName'] = str_replace(" ",'',$this->security->xss_clean($this->input->post('fullName')));
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));
			unset($post['userCnPassword']);

			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
			$post['password'] = $passwordHash;
			$post['activated'] = '0';
			$post['activationCode'] = md5(time() . rand(1, 100));

			$loginId = $this->LoginModel->addUser($post);
			$smtpDetails = $this->page_data['email'];

			if($loginId){
				$config = Array(
					'charset' 	=> 'iso-8859-1',
					'wordwrap' 	=> TRUE,
					'mailtype' 	=> 'html',
					'newline' 	=> "\r\n",
				);
				
				if($smtpDetails['status'] == 1){
					$config['protocol']  = 'smtp';
					$config['smtp_host'] = $smtpDetails['host'];
					$config['smtp_port'] = $smtpDetails['port'];
					$config['smtp_user'] = $smtpDetails['username'];
					$config['smtp_pass'] = $smtpDetails['password'];
				}
				
				$this->load->library('email', $config);
	
				$this->email->from($smtpDetails['email'],'Salon Script');
				$this->email->to($email);
				
				$this->email->subject('Salon Activation');
				$this->email->message('<div style="padding:25px;border-radius:5px;background-color:#fff;max-width:500px;margin:30px auto;border: #343a40 1px solid;"><h1 style="font-size: 40px;text-align: center;line-height: initial;font-weight: 700;margin: 0 0 0;">Activate your Account</h1><p class="loginSignupSubTitle" style="font-size: 15px;line-height: 25px;margin: 10px 0 5px;text-align: center;color: #343a40;font-weight: 400;">Click on Activate Now Button for activation.</p><a href="'.base_url('login/activate/'.$post['activationCode']).'" target="_blank" style="text-align:center;font-size:21px;line-height:40px;margin-top:20px;display:block;padding:.375rem 0;border-radius:.25rem;background-color: #343a40;border-color: #343a40;color: #fff;text-decoration: none;">Activate Now</a></div>');
	
				$sendEmail = $this->email->send();
				if(!$sendEmail){
					$this->session->set_flashdata('userMsg','your smtp email is wrong.');
					$this->session->set_flashdata('userMsg_class','alert alert-danger');
				}
				
				$this->session->set_flashdata('userMsg','You have Sigun Up Successfully please check your email for Verification.');
				$this->session->set_flashdata('userMsg_class','alert alert-success');
			}
			else{
				$this->session->set_flashdata('userMsg','Something went wrong please signup again or check your Email.');
				$this->session->set_flashdata('userMsg_class','alert alert-danger');
			}

			return redirect('login/signup');
		}		
		$themeViewData = $this->page_data;
		$theme_view = $this->page_data['theme_view'];
		$theme_view('signup', $themeViewData);
	}

	public function activate($direct_code = null) {

		$userActivation = $this->LoginModel->activate($direct_code);

		if($userActivation){
			$this->session->set_flashdata('userMsg','Your account Activated Successfully.');
			$this->session->set_flashdata('userMsg_class','alert alert-success');
			return redirect('login');
		}
		else{
			$this->session->set_flashdata('userMsg','Sorry! your activation code is wrong, Please Contact with us if you have any problem.');
			$this->session->set_flashdata('userMsg_class','alert alert-danger');
		}
		$themeViewData = $this->page_data;
		$theme_view = $this->page_data['theme_view'];
		$theme_view('activate', $themeViewData);
	}

	public function reset(){

		$email = $this->security->xss_clean($this->input->post('email'));

		if($this->security->xss_clean($this->input->post('submit'))){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_error_delimiters('<small class="form-text text-danger login-error-text">', '</small>');
			$runValidation = $this->form_validation->run();

			if($runValidation){
				$isValidEmail 	= $this->LoginModel->isValidEmail($email);
				$id_by_email 	= $this->LoginModel->get_id_by_email($email);
				
				if($isValidEmail){
					// random strint for Hash
					$this->load->helper('string');
					$randomStr 				=  random_string('alnum',12);
					$hashForUser 			= password_hash($randomStr, PASSWORD_DEFAULT);
					$smtpDetails 			= $this->page_data['email'];
					$this->LoginModel->updatePassword($id_by_email, $hashForUser);

					$config = Array(
						'charset' 	=> 'iso-8859-1',
						'wordwrap' 	=> TRUE,
						'mailtype' 	=> 'html',
						'newline' 	=> "\r\n",
					);
					if($smtpDetails['status'] == 1){
						$config['protocol']  = 'smtp';
						$config['smtp_host'] = $smtpDetails['host'];
						$config['smtp_port'] = $smtpDetails['port'];
						$config['smtp_user'] = $smtpDetails['username'];
						$config['smtp_pass'] = $smtpDetails['password'];
					}
					$this->load->library('email', $config);
					$this->email->from($smtpDetails['email'],'Salon Script');
					$this->email->to($email);
					
					$this->email->subject('Beauty Salon New Password');
					$this->email->message('<div style="padding:25px;border-radius:5px;background-color:#fff;max-width:500px;margin:30px auto;border: #343a40 1px solid;"><h1 style="font-size: 40px;text-align: center;line-height: initial;font-weight: 700;margin: 0 0 0;">New Password</h1><p style="font-size: 15px;line-height: 25px;margin: 10px 0 5px;text-align: center;color: #343a40;font-weight: 400;">You have generated a new password for salon booking system, New Password: '.$randomStr.'</p></div>');
		
					$sendEmail = $this->email->send();
					if(!$sendEmail){
						$this->session->set_flashdata('userMsg','your smtp email is wrong.');
						$this->session->set_flashdata('userMsg_class','alert alert-danger');
					}
					
					$this->session->set_flashdata('userMsg','You have Successfully generated a news password, please check your email.');
					$this->session->set_flashdata('userMsg_class','alert alert-success');
					return redirect('login');
				}
				else{
					$this->session->set_flashdata('userMsg','Could not find your email.');
					$this->session->set_flashdata('userMsg_class','alert alert-danger');
				}
			}		
		}

		$themeViewData = $this->page_data;
		$theme_view = $this->page_data['theme_view'];
		$theme_view('reset', $themeViewData);
	}
}
