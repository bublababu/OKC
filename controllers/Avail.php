<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Avail extends MY_Controller {

	public function index()
	{
       
        
		       $user_id=388;
		        $BookDate='2022-01-08'; /// for test
				
				
				
				$leseAreaId=30;
				$activity=7;
				$startDate='2022-01-16'; /// for test	
				
			
			  
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
			
			 $this->db->where('reservations.user_id!=',$user_id);
              $this->db->where_in('reservations.id',$ids);
             $this->db->from('reservations');
             $this->db->select('reservations.user_id, user.first_name,user.last_name, user.badge');
             $this->db->join('user', 'user.user_id = reservations.user_id');
             $query1 = $this->db->get();
             $other_hunters = $query1->result_array();
			 
			 
			  
			 
			 print_r( $other_hunters );
				
				
				exit;
				
		$stardate='2022-01-08'; /// for test		
		$toDay=date('Y-m-d');
		$previousDay= date('Y-m-d', strtotime('-1 day', strtotime($stardate)));
	    $time=date('H');
		
		if($toDay>=$previousDay && $time>=5){
			echo 'cancellation not allowed';
		}
		
		/// check active user ////
		 $this->db->where('allow_reservations',1);
		 $this->db->where('state',1);
		 $this->db->where('user_id',$user_id);
		 $this->db->select('count(*) AS total');
		 $this->db->from('user');
		 $query = $this->db->get();       
		 $userData= $query->result_array();
		 
		 if($userData[0]['total']==0) {  echo 'not eligible' ; }
		 
		 
		 //// GET reservation count ////////////
		 
		 // First day of the month.
		 $firstDay= date('Y-m-01', strtotime($BookDate));
			// Last day of the month.
		 $lastday= date('Y-m-t', strtotime($BookDate));
		 
		//$this->db->where('start_date>=',$firstDay);
		$this->db->where("start_date BETWEEN '$firstDay' AND '$lastday'");
		//$this->db->where('end_date<=',$lastday); // Need to clarify from client
		$this->db->where('user_id',$user_id);
		$this->db->where('reservation_status','active');
        $this->db->select('count(*) AS count');
		$this->db->from('reservations');
		$query = $this->db->get();       
		$revData= $query->result_array();	
			
		 print_r($revData);
		 
		 
		  //// GET Lodge count ////////////
		 
		 // First day of the month.
		 $firstDay= date('Y-m-01', strtotime($BookDate));
			// Last day of the month.
		 $lastday= date('Y-m-t', strtotime($BookDate));
		 
		
		$this->db->where("start_date BETWEEN '$firstDay' AND '$lastday'");
		$this->db->where('reservation_status','active');
		$this->db->where('user_id',$user_id);
		$this->db->group_by('start_date');
		//$this->db->where('end_date<=',$lastday); // Need to clarify from client
		//$this->db->where($where);
		
        $this->db->select('start_date');
		$this->db->from('lodge_reservations');
		$query = $this->db->get();       
		$lodgeData= $query->result_array();	
		
		  echo (count($lodgeData));
		 
		 

    }
}  