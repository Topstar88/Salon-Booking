<?php

class ContactDetails extends CI_Model{
    
    public function get(){
        $res = $this->db->limit(1)->get('contactdetails')->row_array();
        return $res;
    }
    
    public function set($fields) {
        $this->db->set($fields)->where('id', 1)->update('contactdetails');
    }

}
?>