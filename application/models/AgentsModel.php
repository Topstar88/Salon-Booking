<?php   
    
    class AgentsModel extends CI_Model{
       
        public function agentList(){
            $res = $this->db->select()->order_by('id','desc')->get('agents')->result_array();
            return $res;
        }

        public function addAgent($array) {
            if($this->db->insert('agents', $array))
                return true;
            return false;
        }

        public function getAgent($id) {
            $res = $this->db->limit(1)->where('id', $id)->get('agents')->row_array();
            return $res;
        }

        public function updateAgent($id, Array $fields){
            $query = $this->db->where(['id'=>$id])->update('agents',$fields);
            return $query;
        }

        public function deleteAgent($id) {
            $this->db->delete('agents',['id'=>$id]);
        }
    }
    
?>