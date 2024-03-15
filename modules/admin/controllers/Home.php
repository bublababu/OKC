<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{
		$this->load->model('user_model', 'users');
		$this->mViewData['count'] = array(
			'users' => $this->users->count_all(),
		);
		
		
		  $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
                $this->db->from('reservations');
                $this->db->join('user', 'user.user_id = reservations.user_id');
                $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
                $this->db->join('leases', 'leases.id = lease_areas.lease_id');
                $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
                $this->db->order_by('reservations.start_date','desc');
                $this->db->limit(10,0); 
		        $query = $this->db->get();
                $revdata= $query->result_array();
				
				
				/// Lodge data///
				 $this->db->select('lodge_reservations.*, user.first_name,user.last_name, user.badge');
                $this->db->from('lodge_reservations');
                $this->db->join('user', 'user.user_id = lodge_reservations.user_id');
				$this->db->order_by('lodge_reservations.id','desc'); 
				$this->db->limit(10,0);
				  $query = $this->db->get();
                $lodgedata= $query->result_array(); 
				
				//print_r($lodgedata);
				
		       $this->mViewData['lodgedata']= $lodgedata;
				$this->mViewData['reservations']= $revdata;
				$this->mViewData['controller'] = $this;
				$this->render('home');
	}
	
	   public function reservation_users($revid)
	{
        $this->db->where('reservation_id',$revid);
         $this->db->join('reservation_users', 'id = guest_id');
		$this->db->select('*');
        $this->db->from('users_guests');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
	
	   public function bedroom($bedid,$lodgeid)
	{
        // $this->db->get_compiled_select();
        $this->db->where('lodge_beds.id',$bedid);
         $this->db->join('lodge_rooms', 'lodge_rooms.id = lodge_beds.room_id');
		$this->db->select('lodge_beds.name,lodge_rooms.name as lodgename');
        $this->db->from('lodge_beds');
      
    //  echo  $this->db->last_query(); 
       
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
	   public function lodge_name($lodgeid)
	{
        $this->db->where('id',$lodgeid);
       
		$this->db->select('name');
        $this->db->from('lodges');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
	
}
