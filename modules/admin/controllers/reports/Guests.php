<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Guests extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}
    
    
      public function index()
    {
        $this->load->model('Guests_model','reservations');
        $this->load->model('Users_model','members');
        $this->load->library('pagination');
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="people_list"');
        $this->mViewData['form'] = $form;
        $this->mViewData['controller'] = $this;
       // $this->db->get_compiled_select();
        
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
       // $per_page=25;
       if($per_page=="")
       {
        $per_page=25;
       }
       $user_id = $this->input->get('member', true);
        
        $total_row = $this->reservations->num_rows($startDate,$endDate,$user_id);  
        $config=[
            'base_url' => base_url('admin/reports/guests'),
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
     
    
        $this->pagination->initialize($config);
    
        $offset=$this->input->get('p', TRUE);    
        $page = ($offset) ? ($offset * $config["per_page"]) - $config["per_page"] : 0;
       
        $reservations=$this->reservations->get_reservationsList($config['per_page'],$page,$startDate,$endDate,$user_id);
       
       
        $members=$this->members->member_list();
        $this->mViewData['members']=$members; 

        $this->mViewData['member_id'] = $user_id;

        $this->mViewData['total_row']=$total_row; 
        $this->mViewData['per_page']=$per_page; 
        $this->mViewData['count_from']=$page; 
        $this->mViewData['offset']=$offset; 
        $this->mViewData['reservations']=$reservations; 
         $this->mViewData['startDate']=$startDate; 
        $this->mViewData['endDate']=$endDate; 
        $this->mPageTitle = 'Guests Report';		
        $this->render('custom/reports/guest-list', 'with_breadcrumb');	
    }
    
   public function download_csv()
   {
    $this->load->model('Guests_model','reservations');
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
    $user_id = $this->input->get('member', true);

     // get data 
     $reservations=$this->reservations->get_reservationsList(0,0,$startDate,$endDate,$user_id);
    
     // file creation 
     $file = fopen('php://output', 'w');

     $file_name = 'Guests_Report_'.date('Ymd').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");

     // header row creation 
     $header = array("MEMBER", "DATES", "DRAW HUNT",	"LEASE", "LEASE AREA", "RESERVATION TYPE", "GUESTS"); 

     // CSV File DataRow row creation 
     fputcsv($file, $header);
     foreach ($reservations as $fields)
     { 
         //Attending Data
         //$attending=$fields["first_name"] .' '. $fields["last_name"];
         $attending="";
         $users = $this->reservation_users($fields['id']);
         foreach ($users as $guest) {
             $attending .= ", ".$guest['name'];
         }
         $attending = trim($attending," ,");
         ////
         $lease = $this->leaseData($fields['lease_area_id']);
         $reservation_types_name = $this->RevTypeName($fields['reservation_type_id']);
         $dataRow=array(
            $fields["first_name"] .' '. $fields["last_name"] .' (#'. $fields["badge"].')',   
            $fields['start_date'].' - '.$fields['end_date'],
            $fields['draw_hunt']==1? "True" : "false",
            $lease[0]['lname'],
            $lease[0]['aname'],
            $reservation_types_name,
            $attending);
          fputcsv($file, $dataRow); 
     }
     fclose($file); 

    //print("<pre>".print_r( $reservations,true)."</pre>");

   }
    
    
     public function leaseData($lease_id)
	{
        $this->db->where('lease_areas.id',$lease_id);
		 $this->db->join('lease_areas', 'lease_areas.lease_id = leases.id');
		$this->db->select('leases.name as lname , lease_areas.name as aname');
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
        $this->db->where('reservation_id',$revid);
        $this->db->join('users_guests', 'users_guests.id = reservation_users.guest_id');
        $this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
		$this->db->select('users_guests.*,guest_types.name as guest_types');
        $this->db->from('reservation_users');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
         public function harvest_report($revid)
	{
        $today=date('Y-m-d'); 
        $this->db->where('id',$revid);
        $this->db->where('reservation_status','active');
        $this->db->where('end_date >',$today);
		$this->db->select('harvest_report');
        $this->db->from('reservations');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
        public function  leaselist()
        {
           $this->db->select('*');
           $this->db->order_by('name','asc');
           $this->db->from('leases');
           $query = $this->db->get();
           $query->result_array(); 
		   return $query->result_array();	
        }
    
    
}   