<?php

class Lease_Information_model extends CI_Model {
	public function get_content()
	{	
		$this->db->where('slug','lease-information');
		$query = $this->db->get('content_pages');
		return $query->result_array();
	}
	
	public function get_available_hunter($leseAreaId=NULL,$activity=NULL,$toDay=NULL){
		$avilableData=0;
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
			$this->db->where('lease_area_id',$leseAreaId);
			$this->db->where('reservation_type_id',$activity);
			$this->db->where('start_date',$toDay);
			$this->db->where('reservation_status','active');
			$this->db->select('count(*) AS count');
			$this->db->from('reservations');
		
		    $query = $this->db->get();       
		    $bokeddata= $query->result_array();
		
		   $avilableData=$hunterdata[0]['max_hunters'] - $bokeddata[0]['count']; 
			
			
			
		 }
		 
		 return $avilableData;
		
	}
}

?>