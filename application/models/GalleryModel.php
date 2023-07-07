<?php   
    
    class GalleryModel extends CI_Model{
       //Gallery Categories Models
        public function listCat(){
            $res = $this->db->select()->order_by('id','asc')->get('gcategory')->result_array();
            foreach($res as $i => $cat) {
				$gallery_items = $this->db->select('id')->from('gallery')->where('catId', $cat['id'])->get()->num_rows();
				$res[$i]['count'] = $gallery_items;
			}
            return $res;
        }

        public function setCat($array) {
            if($this->db->insert('gcategory', $array))
                return true;
            return false;
        }

        public function getCat($id) {
            $res = $this->db->limit(1)->where('id', $id)->get('gcategory')->row_array();
            return $res;
        }

        public function updateCat($id, Array $fields){
            $query = $this->db->where(['id'=>$id])->update('gcategory',$fields);
            return $query;
        }

        public function deleteCat($id) {
            $this->db->delete('gcategory',['id'=>$id]);
        }
        //Gallery Models
        public function listGallery(){
            $res = $this->db->select()->order_by('id','asc')->get('gallery')->result_array();
            return $res;
        }
        public function listGalleryWidCat(){
            $res = $this->db->select()
                            ->from('gcategory')
                            ->join('gallery', 'gcategory.id = gallery.catId', 'left')
                            ->order_by('gallery.id','desc')
                            ->where(array('gcategory.id !=' => null, 'gallery.catId != ' => NULL))
                            ->get()
                            ->result_array();
            return $res;
        }
        public function getGallery($id) {
            $res = $this->db->limit(1)->where('id', $id)->get('gallery')->row_array();
            return $res;
        }

        public function setGallery($array) {
            if($this->db->insert('gallery', $array))
                return true;
            return false;
        }

        public function updateGallery($id, Array $fields){
            $query = $this->db->where(['id'=>$id])->update('gallery',$fields);
            return $query;
        }

        public function deleteGallery($id) {
            $this->db->delete('gallery',['id'=>$id]);
        }
    }
    
?>