<?php defined('BASEPATH') || exit('Access Denied.');

class UserUploadModel extends CI_Model {
    
    public function recent_bookings($num) {
        return $this->db->order_by('id', 'desc')->limit($num)->get('bookingtbl')->result_array();
    }
    
    public function weekly_bookings() {
        return $this->db->where('YEARWEEK(`upload_date`) = YEARWEEK(NOW())')->get('bookingtbl')->num_rows();
    }
    
    public function total_bookings($user = null) {
        $query = $this->db;
        if($user) $query->where('user', $user);
        return $query->get('bookingtbl')->num_rows();
    }
}