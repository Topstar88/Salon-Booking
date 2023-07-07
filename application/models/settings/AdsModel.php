<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class AdsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
	}

    public function get() {
        $res = $this->db
                    ->limit(1)
                    ->get('ad-settings')
                    ->row_array();
        return array(
            'top' => array(
                'status' => $res['top_ad_status'],
                'code' => $res['top_ad']
            ),
            'bottom' => array(
                'status' => $res['bottom_ad_status'],
                'code' => $res['bottom_ad']
            )
        );
    }
    
    public function set($fields) {
        $this->db
            ->set($fields)
            ->where('id', 1)
            ->update('ad-settings');
    }
}