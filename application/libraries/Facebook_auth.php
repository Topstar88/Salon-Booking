<?php

defined('BASEPATH') || exit('Access Denied.');

require_once APPPATH . 'third_party/libraries/hybridauth/autoload.php';

class Facebook_auth {
    private $CI;
    private $config;
    private $adapter;

    public function __construct($options) {
        $this->CI =& get_instance();
        $this->config = array(
            'callback' => base_url(OAUTH_CONTROLLER . '/facebook'),
            'keys'     => array(
                'id'     => $options['public_key'],
                'secret' => $options['secret_key']
            )
        );

        $this->adapter = new Hybridauth\Provider\Facebook($this->config);
    }

    public function authenticate() {
        $this->adapter->authenticate(); // Authenticate The User.
        $token = $this->adapter->getAccessToken();
        $profile = $this->adapter->getUserProfile();

        return $profile;
    }
}