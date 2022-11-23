<?php

defined('BASEPATH') || exit('Access Denied.');

class Xl_recaptcha {
    private $CI;
    private $options;

    public function __construct($options) {
        $this->CI =& get_instance();
        $this->options = $options;
    }

    public function verify_captcha($resp, $ip) {
        $url = "https://www.google.com/recaptcha/api/siteverify?".http_build_query(['secret' => $this->options['secret_key'],'remoteip' => $ip,'response' => $resp]);
        $response = getRemoteContents($url);
        $response = json_decode($response, true);

        if(!isset($response['success']) || $response['success'] != true)
            return false;
        
        return true;
    }
}