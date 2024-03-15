<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Leases extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->library('session');  
        $this->load->helper('url');
        if(!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('account/login', 'refresh');
        }
    }

	public function index()
	{
		$this->db->where('active','1');
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get('leases');       
		$data['leases'] = $query->result_array();	
		$this->mViewData['leases']=$data['leases'];	

		$this->mViewData['controller'] = $this; 
		
		 //**CHECK Assessment Status START******************************************************
		 $userid = $this->session->userdata('userid');
        
		 $this->db->where('user_id',$userid);
		 $this->db->select('examp_status,annual_form_status,allow_reservations');
		 $this->db->from('user');
	   
		 $query = $this->db->get();
		 $userData=$query->result_array();
 
		 //print("<pre>".print_r($userData[0]['annual_form_status'],true)."</pre>"); 
		 $examstatus = $userData[0]['examp_status'];
		 if($examstatus!=2)
		 {  
			 $errors = "You have to pass your assessment.";
			 $this->system_message->set_error($errors);                       
			 redirect('assessment/index', 'refresh');
		 }
		 $annual_form_status=$userData[0]['annual_form_status'];
		 if($annual_form_status==0)
		 {  
			 $errors = "Please submit your Annual Submission Form.";
			 $this->system_message->set_error($errors);                
			 redirect('submission/index', 'refresh');
		 }
		 $allow_reservations=$userData[0]['allow_reservations'];
		 if($allow_reservations==0)
		 {  
			 $errors = "You are not allowed for any Reservations. Please contact Admin";
			 $this->system_message->set_error($errors);                
			 redirect('account', 'refresh');
		 }
		 //**CHECK Assessment Status END********************************************************
		      
        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='Leases';
		$this->render('frontend/Leases', 'with_breadcrumb');	

	}

	public function view($lease_id=null)
	{
		if(is_null($lease_id))
        {
            redirect('404');
        }
        else
        {
			
			
			 ///Code added on 10-Feb-24 
        
        
          $this->load->model('Customer_model', 'customer');
          $userid = $this->session->userdata('userid'); 
          $data2 = $this->customer->reservations_details($userid);
          
            $pending_report=0;
			$i=0;
           foreach($data2 as $harvest):
              $today=  strtotime( date('Y-m-d'));         
              $lastday= strtotime($harvest['end_date']);
          $days_between = ($today - $lastday) / 86400;
		  
		  //  if($harvest['reservation_type_id']=='38' || $harvest['reservation_type_id']=='39' || $harvest['reservation_type_id']!='40')
         // {
           // continue;
         // }
          
              if($harvest['harvest_report'] == 0 && $harvest['reservation_status']=='active' && 
                 $harvest['reservation_type_id']!='38' && $harvest['reservation_type_id']!='39' && $harvest['reservation_type_id']!='40') 
              {
                $pending_report=$pending_report+1;
                
              }
			  if($i++>5)  break;
           endforeach;
        
           
          if ($pending_report>0) {
            $errors = "New reservations cannot be completed as you have  pending harvest reports. If you believe this to be in error, please contact an administrator.";
            $this->system_message->set_error($errors);
            redirect('account', 'refresh');
        }
        
			
			
			
			$this->db->where('id',$lease_id);		
			$query = $this->db->get('leases');       
			$data['leases'] = $query->result_array();

			if(!empty($data['leases'] ))
            {
				$this->mViewData['lease_Id']=$lease_id;

				$this->mViewData['leases']=$data['leases'];	
				
				$this->mViewData['controller'] = $this;

				$this->db->where('lease_id', $lease_id);
				$this->db->order_by('file_name', 'ASC');
				$query2 = $this->db->get('lease_files');       
				$data['leasefiles'] = $query2->result_array();	
				$this->mViewData['leasefiles']=$data['leasefiles'];

				$this->db->where('lease_reservation_types.lease_id',$lease_id);	
				$this->db->select('*');
				$this->db->from('lease_reservation_types');
				$this->db->join('reservation_types', 'reservation_types.id=lease_reservation_types.reservation_type_id');
				$query3 = $this->db->get();
				$data_reservationtypes = $query3->result_array();	
				//print("<pre>".print_r($data_reservationtypes,true)."</pre>");
				$this->mViewData['reservationtypes']=$data_reservationtypes;

				$this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
				$this->mPageTitle='Leases';
				$this->render('frontend/Leases_View', 'with_breadcrumb');
			}
			else
            {
                redirect('404');
            }
		}
	}

	public function count_lease_areas($lease_id)
	{
		$this->db->where('lease_id', $lease_id);
		$this->db->not_like('name', 'All Areas');
		$this->db->from('lease_areas');
		return $count_lease = $this->db->count_all_results();	

	}

	public function leases_area_name($reservationtype,$leaseid)
	{
		$areaName=array();
		$this->db->where('active','1');	
		$this->db->where('lease_id',$leaseid);		
		$query = $this->db->get('lease_areas');       
		$data['lease_areas'] = $query->result_array();	
		foreach ($data['lease_areas'] as $ls)
		{
			$ls_id=$ls['id'];

			$this->db->where('lease_area_id',$ls_id);	
			$this->db->where('reservation_type_id',$reservationtype);		
			$query = $this->db->get('lease_area_reservation_types');       
			$data['lease_area_reservation_types'] = $query->result_array();	

			if(count($data['lease_area_reservation_types'])>0)
			{
				$areaName[]= $ls['name'];
			}

		}

		return $areaName;
	}

	
	public function leases_area_name_Id($reservationtype,$leaseid)
	{
		$areaName=array();
		$this->db->where('active','1');	
		$this->db->where('lease_id',$leaseid);		
		$query = $this->db->get('lease_areas');       
		$data['lease_areas'] = $query->result_array();	
		foreach ($data['lease_areas'] as $ls)
		{
			$ls_id=$ls['id'];

			$this->db->where('lease_area_id',$ls_id);	
			$this->db->where('reservation_type_id',$reservationtype);		
			$query = $this->db->get('lease_area_reservation_types');       
			$data['lease_area_reservation_types'] = $query->result_array();	

			if(count($data['lease_area_reservation_types'])>0)
			{
				$areaName[]= array('name'=>$ls['name'],'id'=>$ls['id']);
			}
		}
		   
		return $areaName;
	}	
	
	
	public function get_Lease_Area_Dates()
	{
		$data = array();
		$this->load->model('Lease_Information_model','Lease_Info');

	  $leaseId=$this->input->get('lease', TRUE); 
	  $activityId=$this->input->get('activity', TRUE); 
	  $calendar_startDate=$this->input->get('start', TRUE);
	  $calendar_endDate=$this->input->get('end', TRUE);

	  //print("<pre>".print_r($activityId,true)."</pre>");exit;
	  
	   // Check to make sure required variables are passed in
	   if (! isset($leaseId) or ! isset($activityId) or ! isset($calendar_startDate) or ! isset($calendar_endDate)) {	
			echo json_encode(array());
		}

		//GET ACTIVITY DETAILS BY ID (reservation_types)
		$this->db->where('id',$activityId);		
		$query = $this->db->get('reservation_types');       
		$reservation_types_data = $query->result_array();	
		//print("<pre>".print_r($reservation_types_data,true)."</pre>");exit;
		////GET ACTIVITY DETAILS BY ID (reservation_types)
		$activity_start_date=$reservation_types_data[0]["start_date"];
		$activity_end_date=$reservation_types_data[0]["end_date"];

		////////OLD LOGIC
	  	// $startDate = date('Y-m-d', strtotime($calendar_startDate));

	 	// $today = date('Y-m-d', strtotime(date('Y-m-d')));
		// if($startDate < $today)
		// {
		// 	$startDate = $today;
		// }
		////////OLD LOGIC

		$startDate = date('Y-m-d', strtotime($activity_start_date));
		$endDate = date('Y-m-d', strtotime($activity_end_date));
		$today = date('Y-m-d', strtotime(date('Y-m-d')));
		
		if($startDate < $today)
		{
			$startDate = $today;
		}
		
		//ADDED 01-03-20222
        // if ($endDate < $today) {
        //     $startDate = $endDate;
        // }       
        if ($endDate < $today) {
            $endDate = $today;
        }
        /////

		//$leases_area_names1 = $this->leases_area_name($activityId,$leaseId);
		//print("<pre>".print_r($leases_area_names1,true)."</pre>"); 

    	$leases_area_names = $this->leases_area_name_Id($activityId,$leaseId);
		//print("<pre>".print_r($leases_area_names,true)."</pre>"); exit;

	  $event_data = array();
	 

	  $date1=date_create($startDate);
	  $date2=date_create($endDate);
	  $diff=(array) date_diff($date1,$date2);	  
	  $interval = $diff['days'];
	  //$interval = 13; //(19.08.2022)

	
	  //print("<pre>".print_r($interval,true)."</pre>"); exit;

	 
	    // Build colors
        $colorList = ['', 'fc-blue', 'fc-orange', 'fc-red', 'fc-green', 'fc-purple', 'fc-sea', 'fc-brown'];
        $colorCount = 0;

		
		for ($days=0;$days<=$interval ;$days++){			
				foreach($leases_area_names as $name)
				{
					$leseAreaId=$name['id'];
					//print("<pre>".print_r($startDate,true)."</pre>");
					$count_available=$this->Lease_Info->get_available_hunter($leseAreaId,$activityId,$startDate);
					
					if($count_available=='0')
					{
						$class_name='fc-gray'; 
					}
					else
					{
						$class_name=$colorList[$colorCount]; 
					}

					$event_data[]=array($startDate,$name['name'],$class_name,$count_available,$leseAreaId);
					$colorCount ++;
						if ($colorCount > 7) {
							$colorCount = 0;
						}
				}
				
				$startDate= date('Y-m-d', strtotime($startDate. ' + 1 days'));
				$colorCount = 0;
		}	

			// print("<pre>".print_r($event_data,true)."</pre>");
			// exit;
	/*	$rowIndex=0;
	  foreach($event_data as $row)
	  {
		$rowIndex++;
		  if($row[3]!='0')
		  {
			if($rowIndex<15)
				{
				$data[] = array(
					'id'	=>	$leaseId,
					'dateText'	=>	date('l, F j, Y',strtotime($row[0])),
					'title'	=>	$row[1].' - '.$row[3].' Open Slots',
					'start'	=>	$row[0],
					'end'	=>	$row[0],
					'className'=> $row[2],							
					'url' => '/reservations/book/'.$activityId.'/'.$row[4].'/'.$row[0].''
				);
				}
				else
				{
					$data[] = array(
						'id'	=>	$leaseId,
						'dateText'	=>	date('l, F j, Y',strtotime($row[0])),
						'title'	=>	$row[1].' - '.$row[3].' Open Slots',
						'start'	=>	$row[0],
						'end'	=>	$row[0],
						'className'=> 'fc-gray'						
						//'url' => '/reservations/book/'.$activityId.'/'.$row[4].'/'.$row[0].''
					);
				}
			}
			else
			{
				$data[] = array(
					'id'	=>	$leaseId,
					'dateText'	=>	date('l, F j, Y',strtotime($row[0])),
					'title'	=>	$row[1].' - No Slots Available',
					'start'	=>	$row[0],
					'end'	=>	$row[0],
					'className'=> $row[2]	
				);
			}
	  } */
	      // $rowIndex=0;
			$nextLastDate = date('Y-m-d', strtotime($today. ' + 13 days'));
			//print("<pre>".print_r($today,true)."</pre>");
			//print("<pre>".print_r($nextLastDate,true)."</pre>");exit;
			foreach($event_data as $row)
			{
			 // $rowIndex++;
				if($row[3]!='0')
				{
					$stDate=date('Y-m-d', strtotime($row[0]));
				  if(($stDate >= $today) && ($stDate <= $nextLastDate))
					  {
						$data[] = array(
							'id'	=>	$leaseId,
							'dateText'	=>	date('l, F j, Y',strtotime($row[0])),
							'title'	=>	$row[1].' - '.$row[3].' Open Slots',
							'start'	=>	$row[0],
							'end'	=>	$row[0],
							'className'=> $row[2],							
							'url' => '/reservations/book/'.$activityId.'/'.$row[4].'/'.$row[0].''
						);
					  }
					  else
					  {
						  $data[] = array(
							  'id'	=>	$leaseId,
							  'dateText'	=>	date('l, F j, Y',strtotime($row[0])),
							  'title'	=>	$row[1].' - '.$row[3].' Open Slots',
							  'start'	=>	$row[0],
							  'end'	=>	$row[0],
							  'className'=> 'fc-gray'							
							  //'url' => '/reservations/book/'.$activityId.'/'.$row[4].'/'.$row[0].''
						  );
					  }
				  }
				  else
				  {
					  $data[] = array(
						  'id'	=>	$leaseId,
						  'dateText'	=>	date('l, F j, Y',strtotime($row[0])),
						  'title'	=>	$row[1].' - No Slots Available',
						  'start'	=>	$row[0],
						  'end'	=>	$row[0],
						  'className'=> $row[2]	
					  );
				  }
			}
	  //print("<pre>".print_r(json_encode($data),true)."</pre>");
		//	exit;
	  echo json_encode($data);
	}
   
}

