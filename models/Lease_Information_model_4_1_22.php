<?php

class Lease_Information_model extends CI_Model {
	public function get_content()
	{	
		$this->db->where('slug','lease-information');
		$query = $this->db->get('content_pages');
		return $query->result_array();
	}
	
	public function get_available_hunter($leseAreaId=NULL,$activity=NULL,$startDate=NULL){

		$this->db->where('id',$activity);
        $this->db->where('start_date<=',$startDate);
        $this->db->where('end_date>=',$startDate);
        $this->db->select('*');
        $this->db->from('reservation_types');
        $query = $this->db->get();
        $open_area = count($query->result_array());   
		if(!$open_area)
		{
			return 0;
		}

		$avilableData=0;
		$bookedSlots=0;
		$toDay=date('Y-m-d');
		if($leseAreaId!=NULL && $activity!=NULL && $toDay!=NULL)
		 {
			 
			/// Get Max hunter
			$this->db->where('lease_area_id',$leseAreaId);
			$this->db->where('reservation_type_id',$activity);	
			$this->db->select('max_hunters');
			$this->db->from('lease_area_reservation_types');
			$query = $this->db->get();       
			$hunterdata= $query->result_array();
			
			
			//////////////Check Booked data////////////////////
		//	$this->db->where('lease_area_id',$leseAreaId);
		//	$this->db->where('reservation_type_id',$activity);
		//	$this->db->where('start_date',$toDay);
		//	$this->db->where('reservation_status','active');
		//	$this->db->select('count(*) AS count');
		//	$this->db->from('reservations');
		//
		//    $query = $this->db->get();       
		//    $bokeddata= $query->result_array();
		
		$this->db->where('lease_area_id',$leseAreaId);
		$this->db->where('reservation_type_id',$activity);
		$this->db->where('start_date',$startDate);
		$this->db->where('reservation_status','active');
        $this->db->select('id,count(*) AS count');
		$this->db->from('reservations');
		$query = $this->db->get();       
		$bokeddata= $query->result_array();
		
		if($startDate==$toDay){
			//////////// check for end date
			$bookedSlots=$bookedSlots+$bokeddata[0]['count'];
			$this->db->where('lease_area_id',$leseAreaId);
			$this->db->where('reservation_type_id',$activity);
			$this->db->where('end_date',$startDate);
			$this->db->where('reservation_status','active');
			$this->db->select('id,count(*) AS count');
			$this->db->from('reservations');
			$query = $this->db->get();       
			$bokeddata= $query->result_array();
			
			$bookedSlots=$bookedSlots+$bokeddata[0]['count'];
			
			
			return $hunterdata[0]['max_hunters']-$bokeddata[0]['count'];
			
			
			}
			
	    
		if($startDate!=$toDay){ 
		    $bookedSlots=$bookedSlots+$bokeddata[0]['count']; /// match with start date 
			
			//////////// check for end date    
			$this->db->where('lease_area_id',$leseAreaId);
			$this->db->where('reservation_type_id',$activity);
			$this->db->where('end_date',$startDate);
			$this->db->where('reservation_status','active');
			$this->db->select('id,count(*) AS count');
			$this->db->from('reservations');
			$query = $this->db->get();       
			$bokeddata= $query->result_array();
			
			$bookedSlots=$bookedSlots+$bokeddata[0]['count'];
			
			///////////// Check for middle date ////////////
			$this->db->where('lease_area_id',$leseAreaId);
			$this->db->where('reservation_type_id',$activity);
			$this->db->where('end_date>',$startDate);
			$this->db->where('start_date<',$startDate);
			$this->db->where('reservation_status','active');
			$this->db->select('id,count(*) AS count');
			$this->db->from('reservations');
			$query = $this->db->get();       
			$bokeddata= $query->result_array();
			$bookedSlots=$bookedSlots+$bokeddata[0]['count'];
			   
			}
		
		$avilableData=$hunterdata[0]['max_hunters'] - $bookedSlots;
				
			
		 }
		 
		 return $avilableData;
		
	}
}

?>