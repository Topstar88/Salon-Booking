<?php

defined('BASEPATH') || exit('Direct script access is prohibited.');

class MetaModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get() {
        $res = $this->db
                    ->limit(1)
                    ->get('meta-tags-settings')
                    ->row_array();
        if($res) {
            return $res['meta_tags'];
        }
        else{
            return false;
        }
    }
    
    public function set($fields) {
        $this->db
             ->set($fields)
             ->where('id', 1)
             ->update('meta-tags-settings');
    }
}