<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Reservations extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}
    
    
      public function index()
    {
        $this->load->model('Reservations_model','reservations');
        $this->load->model('Users_model','members');
        $this->load->library('pagination');

        //CREATE CI FROM FROM FORM BUILER START
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="people_list"');
        $this->mViewData['form'] = $form;
        //CREATE CI FROM FROM FORM BUILER END

        //SEND CONTROLLER NAME TO VIEW PAGE START
        $this->mViewData['controller'] = $this;
        //SEND CONTROLLER NAME TO VIEW PAGE END

       //SEARCH POSTBACK START
       if ($this->input->method() === 'post') 
       {

          $CusSartDate= $this->input->post('CusSartDate'); 
          //print("<pre>".print_r( $CusSartDate,true)."</pre>");exit;
           $search= $this->input->post('search');            
           $count=$this->input->post('count');           
           //redirect('admin/reports/reservations?startDate=2015-01-01&endDate=2015-01-01&count='.$count.'&search='.$search);
           redirect('admin/reports/reservations?startDate='.$CusSartDate.'&endDate=2015-01-01&count='.$count.'&search='.$search);
       }
       //SEARCH POSTBACK END

    //GET VALUE FROM URL PARAMETERS START 
       //$role=$this->input->get('role', TRUE);   
       $per_page=$this->input->get('count', TRUE);   

       $startDate=$this->input->get('startDate', TRUE); 
       if($startDate=="")
       {
        $startDate=date('2015-01-01');
       }
       $endDate=$this->input->get('endDate', TRUE); 
       if($endDate=="")
       {
        $endDate = date('2015-01-01');
       }

       $status=$this->input->get('status', TRUE); 
       $lease=$this->input->get('lease', TRUE); 
       $gametype=$this->input->get('gametype', TRUE);           
       $draw=$this->input->get('draw', TRUE);
       $search=$this->input->get('search', TRUE);
       $user_id = $this->input->get('member', true);
    //GET VALUE FROM URL PARAMETERS END

        //GET TOTAL ROW FROM FROM MODEL FN START 
        $total_row = $this->reservations->num_rows($startDate,$endDate,$status,$gametype,$lease,$draw,$search,$user_id);      
        //GET TOTAL ROW FROM FROM MODEL FN END 

        //SET DEFAULT PER PAGE ROWS START 
        if($per_page=="")
        {
            $per_page=25;
        }
        //SET DEFAULT PER PAGE ROWS END

       // $this->db->get_compiled_select();
       
        //PAGINATION CONFIGARATION START         
        $config=[
            'base_url' => base_url('admin//reports/reservations'),
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
      $reservations=$this->reservations->get_reservationsList($config['per_page'],$page,$startDate,$endDate,$status,$gametype,$lease,$draw,$search,$user_id);
      //GET DATA FROM MODEL AS PER CONFIGARATION START

      //VALUES SEND TO THE VIEW PAGE

        $members=$this->members->member_list();
        $this->mViewData['members']=$members; 

        $this->mViewData['reservations']=$reservations; 
        $this->mViewData['total_row']=$total_row; 
        $this->mViewData['offset']=$offset; 
         //FOR URL CONFIGARATION START
        $this->mViewData['per_page']=$per_page; 
        $this->mViewData['count_from']=$page; 
        
        $this->mViewData['startDate']=$startDate; 
        $this->mViewData['endDate']=$endDate; 
        $this->mViewData['status']=$status; 
        $this->mViewData['gametype']=$gametype; 
        $this->mViewData['lease']=$lease; 
        $this->mViewData['draw']=$draw; 
        $this->mViewData['search']=$search; 

        $this->mViewData['member_id'] = $user_id;
        //FOR URL CONFIGARATION END       
        $this->mPageTitle = 'Reservations Report';		
        $this->render('custom/reports/reservations-list', 'with_breadcrumb');	
    }

    public function download_csv()
    {
        $this->load->model('Reservations_model','reservations');
        $this->load->model('Users_model','members');

        $startDate=$this->input->get('startDate', TRUE); 
        if($startDate=="")
        {
         $startDate=date('2015-01-01');
        }
        $endDate=$this->input->get('endDate', TRUE); 
        if($endDate=="")
        {
         $endDate = date('2015-01-01');
        }
 
        $status=$this->input->get('status', TRUE); 
        $lease=$this->input->get('lease', TRUE); 
        $gametype=$this->input->get('gametype', TRUE);           
        $draw=$this->input->get('draw', TRUE);
        $search=$this->input->get('search', TRUE);
        $user_id = $this->input->get('member', true);

        // get data 
        $reservations=$this->reservations->get_reservationsList(0,0,$startDate,$endDate,$status,$gametype,$lease,$draw,$search,$user_id);
    
         // file creation 
         $file = fopen('php://output', 'w');

         $file_name = 'Reservations_Report_'.date('Ymd').'.csv'; 
         header("Content-Description: File Transfer"); 
         header("Content-Disposition: attachment; filename=$file_name"); 
         header("Content-Type: application/csv;");
  
         // header row creation 
         $header = array("MEMBER", "DATES", "DRAW HUNT","LEASE", "LEASE AREA", "RESERVATION TYPE", "ATTENDING" , "RESERVATION STATUS"); 
 
         // CSV File DataRow row creation 
         fputcsv($file, $header);
         foreach ($reservations as $fields)
         { 
             //Attending Data
             $attending=$fields["first_name"] .' '. $fields["last_name"];
             $users = $this->reservation_users($fields['id']);
             foreach ($users as $guest) {
                 $attending .= ", ".$guest['name'];
             }
             ////
             $dataRow=array(
                $fields["first_name"] .' '. $fields["last_name"] .' (#'. $fields["badge"].')',   
                $fields['start_date'].' - '.$fields['end_date'],
                $fields['draw_hunt']==1? "True" : "false",
                $fields["leases_name"],
                $fields["lease_areas_name"],
                $fields["reservation_types_name"],
                $attending, $fields["reservation_status"]);
              fputcsv($file, $dataRow); 
         }
         fclose($file); 
 
       // print("<pre>".print_r( $reservations,true)."</pre>");
    }
    
    public function lease($lease_id)
	{
        $this->db->where('id',$lease_id);
		$this->db->select('name');
        $this->db->from('leases');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
    
    
      public function RevTypeName($typeId)
	{
        $this->db->where('id',$typeId);
		$this->db->select('name');
        $this->db->from('reservation_types');
      
        $query = $this->db->get();
        $data=$query->result_array(); 
		return $data[0]['name'];
	}
    
//      public function RevTypeName($revid)
//	{
//        $this->db->where('reservations.id',$revid);
//         $this->db->join('reservations', 'reservations.reservation_type_id = reservation_types.id');
//		$this->db->select('name');
//        $this->db->from('reservation_types');
//      
//        $query = $this->db->get();
//      
//        $data=$query->result_array(); 
//		return $data[0]['name'];
//	}
    
    //  public function lease($lease_id)
	// {
    //     $this->db->where('id',$lease_id);
	// 	$this->db->select('name');
    //     $this->db->from('leases');
      
    //     $query = $this->db->get();
    //     $query->result_array(); 
	// 	return $query->result_array();	
	// }
    
    //   public function lease_area($lease_area_id)
	// {
    //     $this->db->where('id',$lease_area_id);
	// 	$this->db->select('name');
    //     $this->db->from('lease_areas');
      
    //     $query = $this->db->get();
    //     $query->result_array(); 
	// 	return $query->result_array();	
	// }
       public function user($user_id)
	{
        $this->db->where('user_id',$user_id);
		$this->db->select('*');
        $this->db->from('user');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
    
        public function reservation_users($revid)
	{
        // $this->db->where('reservation_id',$revid);
        //  $this->db->join('reservation_users', 'id = guest_id');
		// $this->db->select('*');
        // $this->db->from('users_guests');

        $this->db->where('reservation_id',$revid);
        $this->db->join('users_guests', 'users_guests.id = reservation_users.guest_id');
        $this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
		$this->db->select('users_guests.*,guest_types.name as guest_types');
        $this->db->from('reservation_users');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
//         public function harvest_report($revid)
//	{
//        $today=date('Y-m-d'); 
//        $this->db->where('id',$revid);
//        $this->db->where('reservation_status','active');
//        $this->db->where('end_date >',$today);
//		$this->db->select('harvest_report');
//        $this->db->from('reservations');
//      
//        $query = $this->db->get();
//        $query->result_array(); 
//		return $query->result_array();	
//	}
        public function  leaselist()
        {
           $this->db->select('*');
           $this->db->order_by('name','asc');
           $this->db->from('leases');
           $query = $this->db->get();
           $query->result_array(); 
		   return $query->result_array();	
        }
    
        public function  reservation_types_list()
        {
           $this->db->select('*');
           $this->db->order_by('name','asc');
           $this->db->from('reservation_types');
           $query = $this->db->get();
           $query->result_array(); 
		   return $query->result_array();	
        }
    
}   