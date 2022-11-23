<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class PageModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get() {
        $res = $this->db
                    ->select('page_order,position,status,permalink,title')
                    ->order_by('page_order', 'asc')
                    ->get('pages')
                    ->result_array();
        return $res;
    }

    public function set_order($array_permalinks) {

        foreach($array_permalinks as $order => $page) {
            if(!$this->db
                        ->where('permalink', $page)
                        ->set('page_order', $order)
                        ->update('pages'))
                        return false;
        }
        return true;
    }

    public function get_new_page_order() {
        $pages = $this->get();
        $latest = array_pop($pages);
        return ($latest['page_order'] + 1);
    }

    public function get_page($permalink) {
        $permalink = strtolower($permalink);
        $res = $this->db
                    ->limit(1)
                    ->where('permalink', strtolower($permalink))
                    ->get('pages')
                    ->row_array();
        return $res;
    }

    public function create_page($insert) {
        if($this->db->insert('pages', $insert))
            return true;
        return false;
    }
    

    public function delete_page($permalink) {
        $permalink = strtolower($permalink);
        $this->db
             ->where('permalink', $permalink)
             ->delete('pages');

        $pages = $this->get();
        foreach($pages as $order => $page) {
            $this->db
                 ->where('permalink', $page['permalink'])
                 ->set('page_order', $order)
                 ->update('pages');
        }
    }

    public function set_page($permalink, $fields) {
        $permalink = strtolower($permalink);
        $this->db
             ->where('permalink', strtolower($permalink))
             ->set($fields)
             ->update('pages');
    }
}