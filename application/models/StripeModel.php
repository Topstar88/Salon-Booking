<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class StripeModel extends CI_Model {
    
    public function get() {
        $res = $this->db
                    ->limit(1)
                    ->get('stripe-settings')
                    ->row_array();
        
        if($res['stripe_api_key'] != '' && $res['stripe_publishable_key'] != '' && $res['stripe_currency'] != ''){
            $res['stripe_status'] = true;
        }
        else {
            $res['stripe_status'] = false;
        }

        return $res;
    }
    
    public function set($fields) {
        $this->db
             ->set($fields)
             ->where('id', 1)
             ->update('stripe-settings');
    }
}