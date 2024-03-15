<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Avail extends MY_Controller {

	public function index()
	{
       
        
        $lodgeId=1;
		$toDay=date('Y-m-d');
        $toDay='2021-10-22'; /// for test
		$startDate='2021-10-19';
        $endDate='2021-10-20';
		$end=1;
        $middle=1;
		$start=1;
		$noMorecheking=0;
		$availableBedId=0;
		
         /// Get Room and bed for a lodge
        $this->db->where('lodge_id',$lodgeId);		
        $this->db->join('lodge_beds', 'lodge_beds.room_id = lodge_rooms.id');
        $this->db->select('lodge_beds.id as bedid');
        $this->db->from('lodge_rooms');
		$query = $this->db->get();       
		$Beddata= $query->result_array();
		
      ////////////////////////////////////////////////
         
         //// Check Bed is booked on any date or not
         $data= array();
         
          foreach($Beddata as $bedid){  if($availableBedId) break; 
				$this->db->where('bed_id',$bedid['bedid']);
				$this->db->where('start_date >= ',$toDay);
				$this->db->select('id');
				$this->db->from('lodge_reservations');
				$query = $this->db->get();       
				$Revdata= $query->result_array();
        
        ////////////////Find bed is booked or not///////////
               foreach($Revdata as $revid){ 
                        $this->db->where('id',$revid['id']);
						$this->db->where("start_date BETWEEN '$startDate' AND '$endDate'");
                        $this->db->select('id,start_date,end_date');
                        $this->db->from('lodge_reservations');
		                $query = $this->db->get();       
		                $data= $query->result_array();
                        $start=count($data);
                        if(!$start):
                            $this->db->where('id',$revid['id']);
							$this->db->where("end_date BETWEEN '$startDate' AND '$endDate'");
							$this->db->select('id,start_date,end_date');
							$this->db->from('lodge_reservations');
		                    $query = $this->db->get();       
		                    $data= $query->result_array();
                            $end=count($data);
                       endif;
                       if(!$end):
							$this->db->where('id',$revid['id']);
							$this->db->where("start_date <'$startDate' ");
							$this->db->where("end_date >'$endDate'");
							$this->db->select('id,start_date,end_date');
							$this->db->from('lodge_reservations');
							$query = $this->db->get();       
							$data= $query->result_array();
							$middle=count($data);
                       endif;
        
                    if(!$middle) {
						  $availableBedId=$bedid['bedid'];
						  break;
					   }
					   else{ break; }
          
		          }
		  }
        
		echo $availableBedId; 
		
        
    }
}  