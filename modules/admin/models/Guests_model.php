<?php 

class Guests_model extends CI_Model {

	public function get_reservationsList($limit,$offset,$startDate="",$endDate="",$user_id="")
	{                
                $this->db->limit($limit,$offset);
				if($startDate!='2015-01-01')
				{
					$this->db->where('reservations.start_date >=',$startDate); 
                	$this->db->where('reservations.end_date <=',$endDate); 
				}
				if ($user_id != "all" && $user_id != "") {
					$this->db->where('user.user_id', $user_id);
				}
				$this->db->join('reservation_users', 'reservation_id = id','left');
				$this->db->join('user', 'user.user_id = reservations.user_id');
				$this->db->group_by('reservation_id'); 
                $this->db->order_by('id','desc');
				$this->db->having('count(*)>0');
                $query = $this->db->get('reservations');
				
			//  $sql=	"SELECT * FROM reservations,reservation_users WHERE reservations.id = reservation_users.reservation_id GROUP BY reservations.id HAVING ";
			 
			  
			 // $query = $this->db->query($sql);
			 // $this->db->get_compiled_select();
			  // $this->db->order_by('id','desc');   
			//  $this->db->limit($limit,$offset);
                return $query->result_array();
			
		
			
			
	}

        public function num_rows($startDate="",$endDate="",$user_id="")
        {
			if($startDate!='2015-01-01')
			{
                $this->db->where('reservations.start_date >=',$startDate); 
                $this->db->where('reservations.end_date <=',$endDate);
				
			}
			if ($user_id != "all" && $user_id != "") {
				$this->db->where('user.user_id', $user_id);
			}
				
				$this->db->join('reservation_users', 'reservation_id = id','left');
				$this->db->join('user', 'user.user_id = reservations.user_id');
				$this->db->group_by('reservation_id'); 
                $this->db->order_by('id','desc');
				$this->db->having('count(*)>0');
                $query = $this->db->get('reservations');
				
                return $query->num_rows(); 

        }
}
?>