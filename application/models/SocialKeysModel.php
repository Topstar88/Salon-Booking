<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class SocialKeysModel extends CI_Model {
    
    public function get() {
        $res = $this->db
                    ->limit(1)
                    ->get('social-keys-settings')
                    ->row_array();
        
        if($res['google_secret'] != '' && $res['google_public'] != '') $res['google_status'] = true;
        else $res['google_status'] = false;

        return $res;
    }
    
    public function set($fields) {
        $this->db
             ->set($fields)
             ->where('id', 1)
             ->update('social-keys-settings');
    }
}