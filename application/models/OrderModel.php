<?php 
    class OrderModel extends CI_Model{
        public function insertOrder($array){
            if($this->db->insert('orders', $array))
                return $this->db->insert_id();
            return false;
        }
        public function getOrder($orderId) {
            $res = $this->db->limit(1)->where('orderId', $orderId)->get('orders')->row_array();
            return $res;
        }   
        public function getAllOrders() {
            $res = $this->db->get('orders')->result_array();
            return $res;
        }

        public function orderByAllData(){
			$res = $this->db->select('*,orders.id as id, servicetable.id as service_id, logintbl.id as logintbl_id, servicetable.image as servicetable_image')
							->from('orders')
							->join('servicetable', 'orders.serviceId = servicetable.id')
							->join('logintbl', 'orders.userId = logintbl.id')
							->order_by('orders.id','desc')
							->get();
			if($res->num_rows()) {
				return $res->result_array();
			}
			else{
				return false;
			}
		}
        public function getStripe() {
            $res = $this->db->limit(1)->where('id', 1)->get('stripe-settings')->row_array();
            return $res;
        }
        public function setStripe($fields) {
            $this->db->set($fields)->where('id', 1)->update('stripe-settings');
        }
    }  
?>