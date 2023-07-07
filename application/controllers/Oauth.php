<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oauth extends CI_Controller {
    private $keys;

    public function __construct() {
        parent::__construct();
		
		$this->load->database();
        $this->keys                 = $this->MainModel->social_keys();
		$this->page_data            = $this->MainModel->pageData();
		$this->page_data['email']   = $this->MainModel->smtp_settings();
        $loginSession               = $this->session->userdata('id');
        $cookieModl                 = $this->LoginModel->validateSession($loginSession);

		if($cookieModl != "")
        return redirect('enduser');
    }
	
	public function google() {
        if(!$this->keys['google_status']) redirect(base_url());

        $this->load->library('google_auth', array(
            'client_id'     => $this->keys['google_public'],
            'client_secret' => $this->keys['google_secret']
        ));

        $profile    = $this->google_auth->authenticate();
        $email      = $profile->email;
        $photoURL   = $profile->photoURL;

        $userInfo = $this->LoginModel->do_social_login($email, $photoURL, 'google');
        $smtpDetails = $this->page_data['email'];
        if($userInfo['nlg']){
            
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
            $this->email->to($userInfo['email']);
            
            $this->email->subject('Salon Activation');
            $this->email->message('<div style="padding:25px;border-radius:5px;background-color:#fff;max-width:500px;margin:30px auto;border: #343a40 1px solid;"><h1 style="font-size: 40px;text-align: center;line-height: initial;font-weight: 700;margin: 0 0 0;">Account Created</h1><p class="loginSignupSubTitle" style="font-size: 15px;line-height: 25px;margin: 10px 0 5px;text-align: center;color: #343a40;font-weight: 400;">Your Account Created Successfully. If you need to login with Email form so you can login with this Password: '.$userInfo['randomStr'].'</p></div>');

            $sendEmail = $this->email->send();
            if(!$sendEmail){
                show_error($this->email->print_debugger());
            }

            $this->session->set_userdata('id', $userInfo['userId']);
            return redirect('enduser');
        }
        else{
            $this->session->set_userdata('id', $userInfo['userId']);
            return redirect('enduser');
        }
        redirect(base_url());
    }

    public function facebook() {

        if(!$this->keys['facebook_status']) redirect(base_url());

        $this->load->library('facebook_auth', array(
            'public_key' => $this->keys['facebook_public'],
            'secret_key' => $this->keys['facebook_secret']
        ));

        $profile    = $this->facebook_auth->authenticate();
        $email      = $profile->email;
        $photoURL   = $profile->photoURL;

        $userInfo = $this->LoginModel->do_social_login($email, $photoURL, 'facebook');
        $smtpDetails = $this->page_data['email'];
        
        if($userInfo['nlg']){
            $config = Array(        
                'protocol' 	=> 'smtp',
                'smtp_host' => $smtpDetails['host'],
                'smtp_port' => $smtpDetails['port'],
                'smtp_user' => $smtpDetails['username'],
                'smtp_pass' => $smtpDetails['password'],
                'charset' 	=> 'iso-8859-1',
                'wordwrap' 	=> TRUE,
                'mailtype' 	=> 'html',
                'newline' 	=> "\r\n"
            );
            
            $this->load->library('email', $config);

            $this->email->from($smtpDetails['email'],'Salon Script');
            $this->email->to($userInfo['email']);
            
            $this->email->subject('Salon Activation');
            $this->email->message('<div style="padding:25px;border-radius:5px;background-color:#fff;max-width:500px;margin:30px auto;border: #343a40 1px solid;"><h1 style="font-size: 40px;text-align: center;line-height: initial;font-weight: 700;margin: 0 0 0;">Account Created</h1><p class="loginSignupSubTitle" style="font-size: 15px;line-height: 25px;margin: 10px 0 5px;text-align: center;color: #343a40;font-weight: 400;">Your Account Created Successfully. If you need to login with Email form so you can login with this Password: '.$userInfo['randomStr'].'</p></div>');

            $sendEmail = $this->email->send();
            if(!$sendEmail){
                show_error($this->email->print_debugger());
            }

            $this->session->set_userdata('id', $userInfo['userId']);
            return redirect('enduser');
        }
        else{
            $this->session->set_userdata('id', $userInfo['userId']);
            return redirect('enduser');
        }
        redirect(base_url());
    }
}
