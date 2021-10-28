<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class SocialKeysModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get() {
        
        $res = $this->db
                    ->limit(1)
                    ->get('social-keys-settings')
                    ->row_array();

        if($res['google_secret'] != '' && $res['google_public'] != '') $res['google_status'] = true;
        else $res['google_status'] = false;
                
        if($res['facebook_secret'] != '' && $res['facebook_public'] != '') $res['facebook_status'] = true;
        else $res['facebook_status'] = false;

        return $res;
    }
    
    public function set($fields) {
        $this->db
             ->set($fields)
             ->where('id', 1)
             ->update('social-keys-settings');
    }
}