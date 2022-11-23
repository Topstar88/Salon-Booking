<?php

defined('BASEPATH') || exit('Access Denied.');

require_once APPPATH . 'third_party/libraries/hybridauth/autoload.php';

class Google_auth {
    private $CI;
    private $config;
    private $adapter;

    public function __construct($options) {
        $this->CI =& get_instance();
        $this->config = array(
            'callback' => base_url(OAUTH_CONTROLLER . '/google'),
            'keys'     => array(
                'id'     => $options['client_id'],
                'secret' => $options['client_secret']
            ),
            'scope'    => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email'
        );

        $this->adapter = new Hybridauth\Provider\Google($this->config);
    }

    public function authenticate() {
        $this->adapter->authenticate(); // Authenticate The User.
        $token = $this->adapter->getAccessToken();
        $profile = $this->adapter->getUserProfile();

        return $profile;
    }
}