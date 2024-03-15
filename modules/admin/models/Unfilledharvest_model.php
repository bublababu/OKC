<?php 

class Unfilledharvest_model extends CI_Model {

	public function get_unfilledharvestList($limit,$offset,$startDate="",$endDate="",$user_id="")
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
                $this->db->where('reservation_status','active');
                $this->db->where('harvest_report','0');
		$this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
                $this->db->from('reservations');
                $this->db->join('user', 'user.user_id = reservations.user_id');
                $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
                $this->db->join('leases', 'leases.id = lease_areas.lease_id');
                $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
                $this->db->order_by('reservations.start_date','desc');
                $query = $this->db->get();       
                return $query->result_array(); 
	}

        public function num_rows($startDate="",$endDate="",$user_id="")
        {
                $this->db->order_by('reservations.start_date','desc');
                if($startDate!='2015-01-01')
                {
		        $this->db->where('reservations.start_date >=',$startDate); 
                        $this->db->where('reservations.end_date <=',$endDate);
                }
                 if ($user_id != "all" && $user_id != "") {
                        $this->db->where('user.user_id', $user_id);
                    }
		$this->db->where('reservation_status','active');
                $this->db->where('harvest_report','0');
		$this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
                $this->db->from('reservations');
                $this->db->join('user', 'user.user_id = reservations.user_id');
                $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
                $this->db->join('leases', 'leases.id = lease_areas.lease_id');
                $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
                $query = $this->db->get();       
                return $query->num_rows(); 

        }
}
?>