<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class BlogModel extends CI_Model {
	
	public function blogStatus(){
		$res = $this->db->select()->get('blogstatus')->row_array();
		return $res;
	}
	public function blogStatusSet($fields){		
		$this->db->where(['id'=> 1])->update('blogstatus',$fields);
		$res = $this->blogStatus;
		return $res;
	}
	public function blogList(){
		$res = $this->db->select()->order_by('id','DESC')->get('blog')->result_array();
		return $res;
	}
	public function blogListu($limit,$offest)
    {
        $res = $this->db->select()->order_by('id','DESC')->limit($limit,$offest)->get('blog')->result_array();
        return $res;
                    
	}
	public function num_rows(){
        $res = $this->db->select()
                    ->from('blog')
                    ->get();
                    return $res->num_rows();
    }
	public function add_post($array) {
		if($this->db->insert('blog', $array))
			return true;
		return false;
	}

	public function get_post($id) {
		$res = $this->db->limit(1)->where('id', $id)->get('blog')->row_array();
		return $res;
	}
	public function get_post_by_permalink($permalink) {
        $permalink = strtolower($permalink);
        $res = $this->db
                    ->limit(1)
                    ->where('permalink', strtolower($permalink))
                    ->get('blog')
                    ->row_array();
        return $res;
    }

	public function update_post($id, Array $fields){
		$query = $this->db->where(['id'=>$id])->update('blog',$fields);
		return $query;
	}

	public function checkPermalink($permalink) {
		$this->db->where("permalink", $permalink);
		return $this->db->count_all_results("blog");
	}

	public function delete_post($id) {
		$this->db->delete('blog',['id'=>$id]);
	}
}