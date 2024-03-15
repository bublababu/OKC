<?php 
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Harvest_reports extends MY_Controller{

    public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
		$this->load->library('form_builder');
        $this->load->model('common_model');
        if(!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('account/login', 'refresh');
        }
	}    
    
    
    public function view($revId=null)
    {
        if(is_null($revId))
        {
            redirect('404');
        }
        else
        {    
            $this->db->where('reservations.id',$revId);  
            $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
            $this->db->from('reservations');
            $this->db->join('user', 'user.user_id = reservations.user_id');
            $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
            $this->db->join('leases', 'leases.id = lease_areas.lease_id');
            $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
            
            $query = $this->db->get();
            $data= $query->result_array();  

            if(!empty($data))
            {            
                $this->db->where('reservation_id',$revId);
                $query = $this->db->get('harvest_reports');
                $harvest_reports = $query->result_array();  

               //print("<pre>".print_r($harvest_reports,true)."</pre>");
                
                $this->mViewData['controller'] = $this;
                $this->mViewData['data']=$data; 
                $this->mViewData['harvest_reports']=$harvest_reports; 
                $this->mPageTitle = 'Hunting & Fishing Reservations';		
                $this->render('user/harvestreportview', 'with_breadcrumb');	
            }
            else
            {
                redirect('404');
            }
        }
    }
    
    
public function reservation_users($revid)
	{
        $this->db->where('reservation_id',$revid);
         $this->db->join('reservation_users', 'id = guest_id');
		$this->db->select('*');
        $this->db->from('users_guests');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
    
    
    public function reservation_type_data($revTypeId)
	{
        $this->db->where('reservation_type_id',$revTypeId);
         $this->db->join('reservation_game_types', 'id = game_type_id');
		$this->db->select('*');
        $this->db->from('game_types');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
    
    
    public function harvest_reports($revid,$userId=NULL,$guestId=NULL )
	{
        $this->db->where('reservation_id',$revid);
        $this->db->where('badge_owner_id',$userId);
        $this->db->where('badge_guest_id',$guestId);
        $this->db->join('harvest_reports', 'harvest_reports.id = harvest_report_counts.report_id');
        $this->db->join('game_types', 'game_types.id = harvest_report_counts.game_type');
		$this->db->select('*');
        $this->db->from('harvest_report_counts');
        $query = $this->db->get();
        $query->result_array(); 
        
		return $query->result_array();	
	}

    public function harvest_report_counts($revid,$game_type,$userId=NULL )
	{
        $this->db->where('harvest_reports.reservation_id',$revid);   
        $this->db->where('harvest_report_counts.game_type',$game_type); 
        $this->db->group_start();
        $this->db->where('harvest_report_counts.badge_owner_id',$userId);   
        $this->db->or_where('harvest_report_counts.badge_guest_id',$userId);  
        $this->db->group_end();     
        $this->db->join('harvest_reports', 'harvest_reports.id = harvest_report_counts.report_id');      
		$this->db->select('harvest_reports.id,harvest_report_counts.harvest_count,harvest_reports.report_comments,harvest_reports.file_name');
        $this->db->from('harvest_report_counts');
        $query = $this->db->get();
        $query->result_array(); 
        
		return $query->result_array();	
	} 
    
    
    public function add($revId,$early_end=0)
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','class="form-horizontal" id="harvest_report"');
        $this->mViewData['form'] = $form;
       
        if ($this->input->method() === 'post') {

            $cancel = $this->input->post('cancel');
            if(!$cancel)
            {
                $file_name="";
                $owner_id= $this->input->post('owner_id');
                $guest_ids= $this->input->post('guest_ids');
                $game_type_ids= $this->input->post('game_type_ids');
                $comments = $this->input->post('comments');
                
                //*****FILE UPLOAD TO SERVER FUNCTUON START*****//  

                $this->load->helper('imagethumbnail'); 
                $upfile = $_FILES['fileToUpload']; 
                
                if ($upfile["error"] == 0) 
                {
                    $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
                    
                    //CHECK FILE TYPE TO UPLOAD ALLOWED START***************************
                    if (!in_array($upfile["type"], $allowedImageType))
                    {
                        $msg = "<strong>Error!</strong> Only image file allowed!  please try again...";
                        $this->system_message->set_error($msg);
                        redirect('harvest-reports/add/'.$revId);
                    }
                    ////END*****************************************************

                    //SET UPLOAD PATH TO SERVER****************
                    $path =  $_SERVER['DOCUMENT_ROOT'].'/uploads/harvest';
                    ////END**********************************
                    
                    //RENAME FILE**********************
                    $file = pathinfo($upfile['name']);
                    $fileType = $file["extension"];
                    $filename = rand(222, 888) . time() . ".$fileType";                                     
                    ////END******************************                    

                    //CREATING A THUMBNAIL START************************
                    $file_type = $upfile['type'];                    
                    if (in_array($upfile["type"], $allowedImageType)) {
                        $temp_path = $upfile['tmp_name'];
                        $small_thumbnail_path = $_SERVER['DOCUMENT_ROOT'].'/thumbs/harvest';                       
                        $small_thumbnail = $small_thumbnail_path . $filename;
                        $thumb1=createThumbnail($temp_path, $small_thumbnail,$file_type, 122, 91);                         
                    }
                    ////END*********************************************************************
                    
                    //MOVE FILE TEMP TO SERVER LOCATION START********************************
                    if (move_uploaded_file($upfile['tmp_name'], $path . '/' . $filename))
                    {
                        $file_name = $filename;
                    }  
                    ////END********************************                
                }
                //*****FILE UPLOAD TO SERVER FUNCTUON END*****//
                
                $this->db->trans_start();

                $data = array(
                    'reservation_id' => $revId,
                    'report_comments' => $comments,
                    'file_name' => $file_name                   
                );
            
                $this->db->set($data);
                $this->db->insert('harvest_reports');
                $insert_id = $this->db->insert_id();

                //GAME TYPE LOOP
                $game_type_values=explode(',',trim($game_type_ids,","));
                foreach($game_type_values as $game_row_id)
                {
                   if(!empty($game_row_id) || $game_row_id!="")
                   {
                        $harvest_count = $this->input->post('owner_'.$game_row_id);
                        //echo $game_row_id.' ==> '.$harvest_count.'<br>';
                        //Owner Data for Save                       
                            $data2 = array(
                                'report_id' => $insert_id,
                                'game_type' => $game_row_id,
                                'harvest_count' => $harvest_count, 
                                'badge_owner_id' => $owner_id               
                            );
                            $this->db->set($data2);
                            $this->db->insert('harvest_report_counts');
                        ////Owner Data for Save
                   }
                }
                ////GAME TYPE LOOP

                //GUEST LOOP
                $guest_id_values=explode(',',trim($guest_ids,","));
                foreach($guest_id_values as $guest_row_id)
                {
                    if(!empty($guest_row_id) || $guest_row_id!="")
                    {
                        $game_type_values=explode(',',trim($game_type_ids,","));
                        foreach($game_type_values as $game_row_id)
                        {
                            $harvest_count = $this->input->post('guest_'.$guest_row_id.'_'.$game_row_id.'');
                            //echo $game_row_id.' ==> '.$harvest_count.'<br>';
                            //Owner Data for Save                       
                                $data3 = array(
                                    'report_id' => $insert_id,
                                    'game_type' => $game_row_id,
                                    'harvest_count' => $harvest_count, 
                                    'badge_guest_id' => $guest_row_id               
                                );
                                $this->db->set($data3);
                                $this->db->insert('harvest_report_counts');
                            ////Owner Data for Save
                        }
                        ////GAME TYPE LOOP
                    }
                }
                ////GUEST LOOP               
                //UPDATE reservations
               // print_r($early_end);exit;

                if($early_end)
                {
                    $data4 = array(
                        'harvest_report' => '1',
                        'end_date' => date('Y-m-d'),
                        'reservation_status' => 'complete'
                    );
                    $this->db->set('early_end', 'end_date', false);
                    $this->db->where('id', $revId);
                    $this->db->update('reservations', $data4);
                }
                else
                {
                    $data4 = array(
                        'harvest_report' => '1',
                        'reservation_status' => 'complete'                         
                    );
                    $this->db->where('id', $revId);
                    $this->db->update('reservations', $data4);
                }
                ////UPDATE reservations
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE)
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);
                }
                else
                {
                    $msg = "<strong>Success!</strong> Harvest Report added successfully.";
                    $this->system_message->set_success($msg);
                }               
            }
            redirect('reservations/lists');
        }
        
        $this->db->where('reservations.id',$revId);  
        $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
        
        $query = $this->db->get();
        $data= $query->result_array();

        //print("<pre>".print_r($data,true)."</pre>");
        
        $this->mViewData['controller'] = $this;
        $this->mViewData['data']=$data; 
      	
        
       
        $this->mPageTitle = 'Harvest Report';		
        $this->render('user/harvestreportadd', 'with_breadcrumb');	
    }
    public function early_end($revId)
    {
        $data4 = array(            
            'end_date' => date('Y-m-d'),
            'reservation_status' => 'complete'
        );
        $this->db->set('early_end', 'end_date', false);
        $this->db->where('id', $revId);
        $this->db->update('reservations', $data4);

        $msg = "<strong>Success!</strong> Reservation end early successfully.";
        $this->system_message->set_success($msg);
        redirect('reservations/lists');
    }
}    