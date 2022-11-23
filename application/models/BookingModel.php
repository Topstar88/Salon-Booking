<?php 
    class BookingModel extends CI_Model{
		
		public function addBooking($array){
			$query 		= $this->db->insert('bookingtbl', $array);
			$bokingId 	= $this->db->insert_id();
			return array(
				"return" 	=> $query,
				"bokingId" 	=> $bokingId
			);
        }
		public function setBooking($id, $fields){
			$res = $this->db->where('id', $id)->set($fields)->update('bookingtbl');
			return $res;
		}
		public function getbyid($id){
            $res = $this->db->select('*,bookingtbl.id as id, servicetable.id as service_id, servicetable.image as servicetable_image, orders.id as orders_id, orders.orderId as orders_orderId, agents.id as agents_id')
                            ->from('bookingtbl')
                            ->join('servicetable', 'bookingtbl.serviceId = servicetable.id')
							->join('orders', 'bookingtbl.orderId = orders.orderId', 'left')
							->join('agents', 'bookingtbl.agentId = agents.id', 'left')
                            ->order_by('bookingtbl.id','desc')
                            ->where(array('servicetable.id !=' => null, 'bookingtbl.serviceId != ' => NULL))
                            ->where('bookingtbl.userId', $id)
							->get();
			if($res->num_rows()) {
				return $res->result_array();
			}
			else{
				return false;
			}
		}
		public function doesBookingExist($array) {
			if($service_id = $array['serviceId']) {
				$res = $this->db->where('serviceId', $service_id)->get('bookingtbl')->result();
				foreach($res as $booking) {
					if($array['date'] == $booking->date){
						if($array['timing'] == $booking->timing){
							if($array['agentId'] == $booking->agentId){
								return true;
							}
						}
					}
					
				}
			}
			
			return false;
		}

		public function showAdminBookings(){
			$res = $this->db->select('*,bookingtbl.id as id, servicetable.id as service_id, logintbl.id as logintbl_id, agents.id as agents_id')
							->from('bookingtbl')
							->join('servicetable', 'bookingtbl.serviceId = servicetable.id')
							->join('logintbl', 'bookingtbl.userId = logintbl.id')
							->join('agents', 'bookingtbl.agentId = agents.id', 'left')
							->order_by('bookingtbl.id','desc')
							->get();
			if($res->num_rows()) {
				return $res->result_array();
			}
			else{
				return false;
			}
		}

		public function deleteBooking($id) {
            $this->db->delete('bookingtbl',['id'=>$id]);
        }
		public function bookingConfirm($id, Array $fields){
            $query = $this->db->where(['id'=>$id])->update('bookingtbl',$fields);
            return $query;
        }
		public function bookingCancel($id, Array $fields){
            $query = $this->db->where(['id'=>$id])->update('bookingtbl',$fields);
            return $query;
        }
		public function bookingPay($id, Array $fields){
            $query = $this->db->where(['id'=>$id])->update('bookingtbl',$fields);
            return $query;
		}
		
		public function recent_bookings($num) {
			$res = $this->db->select('*,bookingtbl.id as id, servicetable.id as service_id, logintbl.id as logintbl_id, agents.id as agents_id')
							->from('bookingtbl')
							->join('servicetable', 'bookingtbl.serviceId = servicetable.id')
							->join('logintbl', 'bookingtbl.userId = logintbl.id')
							->join('agents', 'bookingtbl.agentId = agents.id', 'left')
							->order_by('bookingtbl.id','desc')
							->limit($num)
							->get();
			if($res->num_rows()) {
				return $res->result_array();
			}
			else{
				return false;
			}
		}
		
		public function weekly_bookings() {
			return $this->db->where('YEARWEEK(`upload_date`) = YEARWEEK(NOW())')->get('bookingtbl')->num_rows();
		}
		
		public function total_bookings($user = null) {
			$query = $this->db;
			if($user) $query->where('user', $user);
			return $query->get('bookingtbl')->num_rows();
		}
		
		public function getBookingbyOrderId($orderId) {
			$res = $this->db->limit(1)->where('orderId', $orderId)->get('bookingtbl')->row_array();
            return $res;
		}
		public function getBooking($id) {
			$res = $this->db->limit(1)->where('id', $id)->get('bookingtbl')->row_array();
            return $res;
		}

		
		public function agentExist($service, $date, $time) {
			$res = $this->db->select('agentId')->where(['serviceId' => $service, 'date' => $date, 'timing' => $time])->get('bookingtbl');
			if($res->num_rows()) {
				return $res->result_array();
			}
			else{
				return false;
			}
		}
	}

?>