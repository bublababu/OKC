<?php

class Lease_Information_model extends CI_Model {
	public function get_content()
	{	
		$this->db->where('slug','lease-information');
		$query = $this->db->get('content_pages');
		return $query->result_array();
	}
	
	public function get_available_hunter($leseAreaId=NULL,$activity=NULL,$startDate=NULL)
	{

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
			
			
			////////////// Get all Book reserved ID ////////////		

			$this->db->select('reservations.id');
			$this->db->distinct();
			$this->db->from('reservations');
			$this->db->join('user', 'user.user_id = reservations.user_id');
			$this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
			$this->db->join('leases', 'leases.id = lease_areas.lease_id');
			$this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
			$this->db->where('reservations.lease_area_id', $leseAreaId);
			$this->db->where('reservations.reservation_type_id', $activity);
			$this->db->where('reservations.reservation_status','active');
			$this->db->where("((reservations.start_date BETWEEN '$startDate' AND '$startDate')");
			$this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$startDate')");
			$this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$startDate'))");         
			$query = $this->db->get();       
		    $revIds= $query->result_array();
			
			// print("<pre>".print_r($this->db->last_query(),true)."</pre>");
			// print("<pre>".print_r(count($revIds),true)."</pre>");
			$bookedSlots=count($revIds);
		
			foreach($revIds as $revId)
			{
				/////////////////////Get use_spot///////////////////////
				$this->db->where('id',$revId['id']);
				$this->db->select('*');
				$this->db->from('reservations');
				$query = $this->db->get();       
		    	$use_spotData= $query->result_array();
				$use_spot=$use_spotData[0]['use_spot'];
				//print("<pre>".print_r($this->db->last_query(),true)."</pre>");
				//print("<pre>".print_r($use_spotData,true)."</pre>");
				//print("<pre>".print_r($use_spot,true)."</pre>");
				if(!$use_spot)
				{
					$bookedSlots = $bookedSlots - 1;
				}
				/////////////////END
				
				//////////////////// guest count  ////////////////////////
				$this->db->where('guest_types.id !=','5');
				$this->db->where('reservation_users.reservation_id',$revId['id']);
				$this->db->join('users_guests', 'users_guests.id = reservation_users.guest_id');
				$this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
				$this->db->select('users_guests.*,guest_types.name as guest_types');
				$this->db->from('reservation_users');
				$query = $this->db->get();
				$bokeddata = $query->num_rows();
				//print("<pre>".print_r($bokeddata,true)."</pre>");
				$bookedSlots = $bookedSlots + $bokeddata;			
				//print("<pre>".print_r($bookedSlots,true)."</pre>");				
			}	
			
		    	$avilableData=$hunterdata[0]['max_hunters'] - $bookedSlots;
				//print("<pre>".print_r($avilableData,true)."</pre>");	
			 	return $avilableData;	
			
		 }
		 
	}
		  
		  public function get_other_hunter($leseAreaId=NULL,$activity=NULL,$startDate=NULL,$user_id=NULL){
			
			$this->db->where('lease_area_id',$leseAreaId);
			$this->db->where('reservation_type_id',$activity);
			
			 $this->db->group_start();
			 $this->db->where('start_date>=',$startDate);
			 $this->db->or_where('end_date>=',$startDate);
			 $this->db->group_end();   
			
			$this->db->where('reservation_status','active');
			$this->db->select('id');
			$this->db->from('reservations');
		    $query = $this->db->get();       
		    $revIds= $query->result_array();
			 $ids= array();
			 
			 
              foreach($revIds as $revId)
			{
					///echo $startDate . '=>'. $revId['id'];
					
			   $bokeddata=array();		
					
				$this->db->where('start_date',$startDate);
				$this->db->from('reservations');
				$this->db->where('id',$revId['id']);
			   $this->db->select('id,count(*) AS count');
				$query = $this->db->get();       
				$bokeddata= $query->result_array(); 
			    if($bokeddata[0]['count']>0){
			     $ids[]=$revId['id'];
					 continue; 
				}
			   
			   $this->db->where('end_date',$startDate);
			   $this->db->where('id',$revId['id']);
			   	$this->db->select('id,count(*) AS count');
			   $this->db->from('reservations');
			   $query = $this->db->get();       
			    $bokeddata= $query->result_array(); 
			    if($bokeddata[0]['count']>0){
					 $ids[]=$revId['id'];
					 continue; 
				}
			   
		    ///////////// Check for middle date ////////////
			
			$this->db->where('end_date>',$startDate);
			$this->db->where('start_date<',$startDate);
			 $this->db->where('id',$revId['id']);
			$this->db->select('id,count(*) AS count');
			$this->db->from('reservations');
			$query = $this->db->get();       
			$bokeddata= $query->result_array();
			 if($bokeddata[0]['count']>0){
					 $ids[]=$revId['id'];
					 continue; 
				}
		
			
			}
			$other_hunters= array();
			if(count($ids)>0){
			 $this->db->where('reservations.user_id!=',$user_id);
             $this->db->where_in('reservations.id',$ids);
             $this->db->from('reservations');
             $this->db->select('reservations.user_id, user.first_name,user.last_name, user.badge,reservations.id as reservations_id');
             $this->db->join('user', 'user.user_id = reservations.user_id');
             $query1 = $this->db->get();
             $other_hunters = $query1->result_array();
			}
			 return $other_hunters;
			 
		  
		  }
	
}

?>