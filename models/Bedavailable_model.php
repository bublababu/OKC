<?php 

class Bedavailable_model extends CI_Model {

	public function get_bed($lodgeId=1,$startDate,$endDate)
	{
        $toDay=date('Y-m-d');
        $end=1;
        $middle=1;
		$start=1;
		$availableBedId=array();
      
		//////// UPDATED on 20-09-2023 PB
		$this->db->where('lodge_id',$lodgeId);	
		$this->db->where("lodge_beds.id NOT IN (SELECT DISTINCT bed_id FROM `lodge_reservations` WHERE reservation_status='active' and lodge_id = '".$lodgeId."' and ((start_date BETWEEN '".$startDate."' AND '".$endDate."') OR (end_date BETWEEN '".$startDate."' AND '".$endDate."') OR (start_date <= '".$startDate."' AND end_date >= '".$endDate."')))");		
        $this->db->join('lodge_beds', 'lodge_beds.room_id = lodge_rooms.id');
        $this->db->select('lodge_beds.id as bedid');
        $this->db->from('lodge_rooms');
		$query = $this->db->get();       
		$Beddata= $query->result_array();		
		$availableBedId = array_column($Beddata, 'bedid');
		//print("<pre>".print_r($availableBedId,true)."</pre>");
      //////////////////////////////////////////////// END PB
	  
        
    //      /// Get Room and bed for a lodge
    //     $this->db->where('lodge_id',$lodgeId);		
    //     $this->db->join('lodge_beds', 'lodge_beds.room_id = lodge_rooms.id');
    //     $this->db->select('lodge_beds.id as bedid');
    //     $this->db->from('lodge_rooms');
	// 	$query = $this->db->get();       
	// 	$Beddata= $query->result_array();
		
    //   ////////////////////////////////////////////////
         
    //      //// Check Bed is booked on any date or not
    //      $data= array();
         
    //       foreach($Beddata as $bedid){  
	// 			$this->db->where('bed_id',$bedid['bedid']);
    //             $this->db->where('reservation_status','active');
                
	// 			$this->db->where('end_date >= ',$toDay);
	// 			$this->db->select('id');
	// 			$this->db->from('lodge_reservations');
	// 			$query = $this->db->get();       
	// 			$Revdata= $query->result_array();
                
    //             if(!count($Revdata)) { $availableBedId[]=$bedid['bedid']   ;continue;}
        
    //     ////////////////Find bed is booked or not///////////
	// 	$pass=0;
    //            foreach($Revdata as $revid){ 
    //                     $this->db->where('id',$revid['id']);
	// 					$this->db->where("start_date BETWEEN '$startDate' AND '$endDate'");
    //                     $this->db->select('id,start_date,end_date');
    //                     $this->db->from('lodge_reservations');
	// 	                $query = $this->db->get();       
	// 	                $data= $query->result_array();
    //                     $start=count($data);
    //                     if(!$start):
    //                         $this->db->where('id',$revid['id']);
	// 						$this->db->where("end_date BETWEEN '$startDate' AND '$endDate'");
	// 						$this->db->select('id,start_date,end_date');
	// 						$this->db->from('lodge_reservations');
	// 	                    $query = $this->db->get();       
	// 	                    $data= $query->result_array();
    //                         $end=count($data);
    //                    endif;
    //                    if(!$end):
	// 						$this->db->where('id',$revid['id']);
	// 						$this->db->where("start_date <'$startDate' ");
	// 						$this->db->where("end_date >'$endDate'");
	// 						$this->db->select('id,start_date,end_date');
	// 						$this->db->from('lodge_reservations');
	// 						$query = $this->db->get();       
	// 						$data= $query->result_array();
	// 						$middle=count($data);
    //                    endif;
        
    //                 if(!$middle) {
	// 					 // $availableBedId[]=$bedid['bedid'];
	// 					//  break;
	// 					$pass=1;
	// 				  }
	// 				   else{$pass=0; break; }
          
	// 	          }
				  
	// 			  if($pass) { $availableBedId[]=$bedid['bedid']; }
				  
	// 	  }
        
		return $availableBedId; 
		
        
    }
}   
    