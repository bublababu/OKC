<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Lodge_reservations extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
		$this->load->model('Lodge_reservations_model','lodges');
        if(!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('account/login', 'refresh');
        }
	}
    

	public function index()
	{
       

	}

    public function location()
    {
		$form = $this->form_builder->create_form('','enctype= multipart/form-data','class="" id="form3"');
        $this->mViewData['form'] = $form;

		$lodges=$this->lodges->get_lodges();
		

		 //SEND CONTROLLER NAME TO VIEW PAGE START
		 $this->mViewData['controller'] = $this;
		 //SEND CONTROLLER NAME TO VIEW PAGE END
 

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

		$this->mViewData['lodges']=$lodges; 

        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='Lodge Reservations';
		$this->render('user/Lodge_Reservations', 'with_breadcrumb');		
    }
	
	public function lodge_files($lodge_id)
	{		
		$this->db->where('lodge_id',$lodge_id);
		$this->db->select('*');
        $this->db->from('lodge_files');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}

	public function dates($lodgeId=null)
	  {
        if (! isset($lodgeId)) {	
			redirect('404');
		}
        else
        {
            $lodge_data=$this->lodges->get_lodge_byid($lodgeId);
            
            //print("<pre>".print_r($lodge_data,true)."</pre>");

            $this->mPageTitle='Lodge Reservations';
            $this->mViewData['lodge_data']=$lodge_data; 
            $this->mViewData['lodgeId']=$lodgeId; 
            $this->render('user/Lodge_Reservations_Dates', 'with_breadcrumb');	
        }
	  }

	  public function get_lodge_dates()
	  {
		$this->load->model('Bedavailable_model','bedavailable');


		$lodgeId=$this->input->get('lodge', TRUE); 
		$startDate1=$this->input->get('start', TRUE);

        // Check to make sure required variables are passed in
	   if (! isset($lodgeId) or ! isset($startDate1)) {	
            echo json_encode(array());
        }

		$startDate = date('Y-m-d', strtotime($startDate1));
		$today = date('Y-m-d', strtotime(date('Y-m-d')));
		if($startDate < $today)
		{
			$startDate = $today;
		}

		$endDate=$this->input->get('end', TRUE); 		
		

		$event_data = array();
		$bedId=$this->bedavailable->get_bed($lodgeId,$startDate,$startDate);

		$date1=date_create($startDate1);
		$date2=date_create($endDate);
		$diff=date_diff($date1,$date2);
		$interval = $diff->format("%a");


		$event_data[]=array($startDate,count($bedId));
		for ($days=1;$days<=$interval ;$days++){
		     $startDate= date('Y-m-d', strtotime($startDate. ' + 1 days'));
			 $bedId=$this->bedavailable->get_bed($lodgeId,$startDate,$startDate);
			 $event_data[]=array($startDate,count($bedId));
		}		
		

		foreach($event_data as $row)
		{
			$data[] = array(
				'id'	=>	$lodgeId,
				'dateText'	=>	date('l, F j, Y',strtotime($row[0])),
				'title'	=>	$row[1].' Open Beds',
				'start'	=>	$row[0],
				'end'	=>	$row[0],
				'className'=> 'green',								
				'url' => '/lodge-reservations/book/'.$lodgeId.'/'.$row[0].''
			);
		}
		echo json_encode($data);
	  }

	  public function lists()
	  {
        $this->load->library('pagination');
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','class="sky-form" id="sky-form3"');
        $this->mViewData['form'] = $form;
		
		 $this->load->model('Customer_model', 'customer');
         $this->mViewData['controller'] = $this;

        $userid = $this->session->userdata('userid');		

        //GET TOTAL ROW FROM FROM MODEL FN START 
        $total_row = $this->customer->lodge_details_num_rows($userid);      
        //GET TOTAL ROW FROM FROM MODEL FN END 

         //SET DEFAULT PER PAGE ROWS START         
         $per_page=10;        
         //SET DEFAULT PER PAGE ROWS END

          //PAGINATION CONFIGARATION START
        $config=[
            'base_url' => base_url('lodge-reservations/lists'),
            'per_page' => $per_page,
            'total_rows' => $total_row,

            'full_tag_open'=>"<ul class='pagination'>",
            'full_tag_close'=>"</ul>",

            'next_tag_open' =>"<li>",
            'next_link'=>'Next',
            'next_tag_close' =>"</li>",

            'prev_tag_open' =>"<li>",
            'prev_link'=>'Previous',
            'prev_tag_close' =>"</li>",

            'first_tag_open' =>"<li>",
            'first_link'=>'First',
            'first_tag_close' =>"</li>",

            'last_tag_open' =>"<li>",
            'last_link'=>'Last',
            'first_tag_close' =>"</li>",

            'num_tag_open' =>"<li>",
            'num_tag_close' =>"<li>",

            'cur_tag_open' =>"<li class='active'><a>",
            'cur_tag_close' =>"</a></li>",
            'num_links' => 10    
        ];   
        //PAGINATION CONFIGARATION END
    
        //PAGINATION INITIALIZATION START
        $this->pagination->initialize($config);
        //PAGINATION INITIALIZATION END

        //CALCULATION OF OFFSET VALUE FROM PAGE NO START
        $offset=$this->input->get('p', TRUE);    
        $page = ($offset) ? ($offset * $config["per_page"]) - $config["per_page"] : 0;   
        //CALCULATION OF OFFSET VALUE FROM PAGE NO END

         //GET DATA FROM MODEL AS PER CONFIGARATION START       
         $lodges = $this->customer->lodge_details($userid,$config['per_page'],$page);         
         //GET DATA FROM MODEL AS PER CONFIGARATION START

        //print("<pre>".print_r($total_row,true)."</pre>");

		$this->mViewData['lodges'] = $lodges;
		$this->mPageTitle='Lodge Reservations';	
	    $this->render('user/lodge-reservations-list', 'with_breadcrumb');	

	  }

      public function book($lodge_id="",$start_date="",$add_days="")
      {       

         if($lodge_id!="" && $start_date!="" && $add_days!="")
         {
            $this->load->model('User_model','eligibility'); 
            $form = $this->form_builder->create_form('lodge-reservations/lodge_reservations_save','enctype= multipart/form-data','class="sky-form" id="sky-form3"');
            $this->mViewData['form'] = $form;
            $this->mViewData['controller'] = $this;

            $addday = $add_days -1;
            $start_date = str_replace('_', '-', $start_date); 
            $end_date = date('Y-m-d', strtotime($start_date. ' + '.$addday.' days'));         
            $lodge_data=$this->lodges->get_lodge_byid($lodge_id);


            if ($this->input->method() === 'post') { 
                $cancel = $this->input->post('cancel');
                if(!$cancel)
                {                
                 
                }
                else
                {
                    redirect('admin/lodge-reservations', 'refresh');
                }
            }

            $bedId=array();
            $this->load->model('Bedavailable_model','bedavailable');
            $bedId=$this->bedavailable->get_bed($lodge_id,$start_date,$end_date); 
            //print("<pre>".print_r($bedId,true)."</pre>");

            $userid = $this->session->userdata('userid');

             //// Reservision booking check
             $iseligible = $this->eligibility->lodge_book_eligibility($userid,$start_date);
            // $iseligible=0;
             //print("<pre>".print_r($iseligible,true)."</pre>"); 

            $this->mViewData['iseligible']=$iseligible;
            $this->mViewData['user_id']=$userid;
            $this->mViewData['bedId']=$bedId;
            $this->mViewData['add_days']=$add_days;
            $this->mViewData['start_date']=$start_date;
            $this->mViewData['end_date']=$end_date;
            $this->mViewData['lodge_id']=$lodge_id;
            $this->mViewData['lodge_data']=$lodge_data;
            $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
            $this->mPageTitle='Lodge Reservations';
            $this->render('user/Lodge_Reservations_Book', 'with_breadcrumb');	

         }
         else
         {
            redirect('404', 'refresh');  
         }       
      }

      public function bedroom($bedid,$lodgeid)
      {
          // $this->db->get_compiled_select();
          $this->db->where('lodge_beds.id',$bedid);
           $this->db->join('lodge_rooms', 'lodge_rooms.id = lodge_beds.room_id');
          $this->db->select('lodge_beds.name,lodge_rooms.name as lodgename');
          $this->db->from('lodge_beds');
        
          $query = $this->db->get();
          $query->result_array(); 
          return $query->result_array();	
      }

      public function lodge_reservations_save()
      {
          if ($this->input->method() === 'post') { 
              $cancel = $this->input->post('cancel');
              if(!$cancel)
              {
                  $user_id = $this->input->post('user_id');
                  $lodge_id = $this->input->post('lodge_id');
                  $startDate = $this->input->post('startDate'); 
                  $end_date = $this->input->post('end_date'); 
                  $beds= $this->input->post('beds');
  
                  $this->db->trans_start();
                  foreach($beds as $bed)
                  {
                      $data = array(
                          'user_id' => $user_id,
                          'lodge_id' => $lodge_id,
                          'bed_id' => $bed,
                          'start_date' => $startDate,
                          'end_date' =>  $end_date,
                          'reservation_status' => 'active',
                          'reservation_created_on' => date('Y-m-d H:i:s'),
                          'reservation_updated_on' => date('Y-m-d H:i:s')                   
                      );
                      $this->db->set($data);
                      $this->db->insert('lodge_reservations');
                  }
                  $this->db->trans_complete();
                  
                  if ($this->db->trans_status() === FALSE)
                  {
                      $msg = "<strong>Error!</strong> Something went wrong please try again...";
                      $this->system_message->set_error($msg);
                  }
                  else
                  {
                      $msg = "<strong>Success!</strong> Lodge Reservations added successfully.";
                      $this->system_message->set_success($msg);
                      redirect('lodge-reservations/location');  
                  }
              }
              else
              {
                  redirect('lodge-reservations/location', 'refresh');  
              }
          }
      }
}

