<?php 

class Customer_model extends CI_Model {

	public function get_content_byId($user_id)
	{		
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('user');
		return $query->result_array();
	}

    public function reservations_details($user_id,$limit=null,$offset=null)
    {          
                $this->db->where('reservations.user_id',$user_id);  
                $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
                $this->db->from('reservations');
                $this->db->join('user', 'user.user_id = reservations.user_id');
                $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
                $this->db->join('leases', 'leases.id = lease_areas.lease_id');
                $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
                $this->db->order_by('reservations.start_date','desc');   
                if(isset($limit) && isset($offset))
                {
                   $this->db->limit($limit,$offset);
                }            
                $query = $this->db->get();
                return $query->result_array(); 
    }

    public function reservations_details_num_rows($user_id)
    {          
                $this->db->where('reservations.user_id',$user_id);  
                $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
                $this->db->from('reservations');
                $this->db->join('user', 'user.user_id = reservations.user_id');
                $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
                $this->db->join('leases', 'leases.id = lease_areas.lease_id');
                $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
                $this->db->order_by('reservations.start_date','desc');              
                $query = $this->db->get();
                return $query->num_rows(); 
    }
	
	
	public function lodge_details($user_id,$limit=null,$offset=null){
		        $this->db->where('lodge_reservations.user_id',$user_id);
				$this->db->where('lodge_reservations.reservation_status!=','trash');  
                $this->db->select('lodge_reservations.*, user.first_name,user.last_name, user.badge,lodges.name,lodge_beds.name AS bedname,lodge_beds.room_id,lodge_rooms.name as roomname');
                $this->db->from('lodge_reservations');
                $this->db->join('user', 'user.user_id = lodge_reservations.user_id');
				$this->db->join('lodges', 'lodges.id = lodge_reservations.lodge_id');
				$this->db->join('lodge_beds', 'lodge_beds.id = lodge_reservations.bed_id');
				$this->db->join('lodge_rooms', 'lodge_beds.room_id = lodge_rooms.id');
				 $this->db->order_by('lodge_reservations.start_date','desc');  
                 if(isset($limit) && isset($offset))
                 {
                    $this->db->limit($limit,$offset);
                 }            
                $query = $this->db->get();
                return $query->result_array(); 
	    }

    public function lodge_details_num_rows($user_id){
            $this->db->where('lodge_reservations.user_id',$user_id);
            $this->db->where('lodge_reservations.reservation_status!=','trash');  
            $this->db->select('lodge_reservations.*, user.first_name,user.last_name, user.badge,lodges.name,lodge_beds.name AS bedname,lodge_beds.room_id,lodge_rooms.name as roomname');
            $this->db->from('lodge_reservations');
            $this->db->join('user', 'user.user_id = lodge_reservations.user_id');
            $this->db->join('lodges', 'lodges.id = lodge_reservations.lodge_id');
            $this->db->join('lodge_beds', 'lodge_beds.id = lodge_reservations.bed_id');
            $this->db->join('lodge_rooms', 'lodge_beds.room_id = lodge_rooms.id');
             $this->db->order_by('lodge_reservations.start_date','desc');              
            $query = $this->db->get();
            return $query->num_rows(); 
    }
		
		
   public function my_guests($user_id)
      {
		$this->db->where('user_id',$user_id);
		$this->db->select('users_guests.*,guest_types.name AS guestname');
        $this->db->from('users_guests');
		$this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
		$query = $this->db->get();
        return $query->result_array();
	
      }
}
?>