<?php   
    
    class ClientsModel extends CI_Model{
       
        public function get(){
            $res = $this->db->select()->order_by('id','asc')->where('role', 0)->get('logintbl')->result_array();
            return $res;
        }

        public function getclient($id) {
            $res = $this->db->limit(1)->where('id', $id)->get('logintbl')->row_array();
            return $res;
        }

        public function set($id, Array $fields){
            $query = $this->db->where(['id'=>$id])->update('logintbl',$fields);
            return $query;
        }

        public function deleteclient($id) {
            $this->db->delete('logintbl',['id'=>$id]);
        }
    }
    
?>