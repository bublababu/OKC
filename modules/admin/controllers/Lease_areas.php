<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lease_areas extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    // Frontend User CRUD
    public function index()
	{
    // $crud = $this->generate_crud('leases');
    $this->db->select('lease_areas.*,leases.name as leases_name,leases.active as leases_active,lease_areas.active as lease_areas_active');
    $this->db->from('lease_areas');
    $this->db->join('leases', 'leases.id = lease_areas.lease_id');
    $this->db->order_by('leases.name ASC, lease_areas.name ASC');
    $query = $this->db->get();     
    $data['lease_areas'] = $query->result_array();	
     $this->mViewData['lease_areas']=$data['lease_areas'];		
     $_COOKIE['customclass']='Lease_areas ';        
    // $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
     $this->mPageTitle = 'Lease Areas ';		
     $this->render('custom/lease_areas/lease_areas_list', 'with_breadcrumb');	
    }

    public function edit($lease_area_id)
    {
        $this->load->library('session');
        $this->load->helper('url');    
        $form = $this->form_builder->create_form('','','class="email" id="myform"');
        $this->mViewData['form'] = $form;


        if ($this->input->method() === 'post') {

            $reservationTypes = $this->input->post('hd_reservationTypes'); 
            $dataReservationTypes = json_decode($reservationTypes, TRUE);
            $active = $this->input->post('active1'); 
           //print("<pre>".print_r($dataReservationTypes,true)."</pre>");  
           $save['active'] = $active;
           $save['area_updated_on'] =  date('Y-m-d H:i:s');
           $where = array('id' => $lease_area_id);
           $upate_id = $this->common_model->editRecord('lease_areas', $save, $where); 

           $where2 = array('lease_area_id' => $lease_area_id);
		   $delete_id=$this->common_model->deleteRecord('lease_area_reservation_types',$where2);

           foreach($dataReservationTypes as $data)
           {
               $reservation_type_id=$data['TypeId'];
               $MaxHunters=$data['MaxHunters'];
               $save_details['lease_area_id'] = $lease_area_id;
               $save_details['reservation_type_id'] = $reservation_type_id;
               $save_details['max_hunters'] = $MaxHunters;               
               $insert_save_details_id = $this->common_model->addRecord('lease_area_reservation_types', $save_details);
           }
       
       $msg = "<strong>Success!</strong> Lease Information updated successfully.";
       $this->system_message->set_success($msg);
       refresh();
        }

       
        $this->db->where('id',$lease_area_id);
        $query = $this->db->get('lease_areas');       
        $data['lease_areas'] = $query->result_array();
        $this->mViewData['lease_areas']=$data['lease_areas'];	
        $lease_id =  $data['lease_areas'][0]['lease_id'];

       
       $this->db->where('lease_id',$lease_id);
       $this->db->select('*');
       $this->db->from('lease_reservation_types');
       $this->db->join('reservation_types', 'reservation_types.id = lease_reservation_types.reservation_type_id');
       $this->db->order_by('reservation_types.name ASC');
       $query = $this->db->get();     
       $data['lease_reservation_types'] = $query->result_array();	
       $this->mViewData['lease_reservation_types']=$data['lease_reservation_types'];

       $this->db->where('lease_area_id',$lease_area_id);
       $query = $this->db->get('lease_area_reservation_types');       
       $data['lease_area_reservation_types'] = $query->result_array();       	
       $this->mViewData['lease_area_reservation_types']=$data['lease_area_reservation_types'];	 



        $this->db->select('id,name');
        $this->db->order_by('name ASC');
        $query = $this->db->get('leases');       
        $data['leases'] = $query->result_array();
        $this->mViewData['leases']=$data['leases'];	

        $this->mPageTitle = 'Lease Areas ';		
        $this->render('custom/lease_areas/lease_areas_edit', 'with_breadcrumb');

    }

    public function add()
    {
        $this->load->library('session');
        $this->load->helper('url');    
        $form = $this->form_builder->create_form('','','class="" id="lease_areas_add"');
        $this->mViewData['form'] = $form;

        $this->db->select('id,name');
        $this->db->order_by('name ASC');
        $query = $this->db->get('leases');       
        $data['leases'] = $query->result_array();
        $this->mViewData['leases']=$data['leases'];	

        if ($this->input->method() === 'post') {
            $lease_id= $this->input->post('lease_name'); 
            $lease_areas_name= $this->input->post('name'); 
            $active = $this->input->post('active1'); 
            $area_created_on = date('Y-m-d H:i:s');
            $area_updated_on = date('Y-m-d H:i:s');

            $save['lease_id'] = $lease_id;
            $save['name'] = $lease_areas_name;
            $save['active'] = $active;
            $save['area_created_on'] = $area_created_on;
            $save['area_updated_on'] = $area_updated_on;

            $insert_save_details_id = $this->common_model->addRecord('lease_areas', $save);

            if( $insert_save_details_id > 0)
            {
                $msg = "<strong>Success!</strong>Lease Area Information saved successfully.";
                $this->system_message->set_success($msg);
                refresh();

            }
            else
            {
                $errors = "something went wrong please try again...";
                $this->system_message->set_error($errors); 
                refresh();
            }
        }
        $this->mPageTitle = 'Lease Areas ';		
        $this->render('custom/lease_areas/lease_areas_add', 'with_breadcrumb');
    }

    public function remove($lease_area_id)
    {
        //print_r($lease_area_id);
        $where = array('id' => $lease_area_id);
		$delete_id=$this->common_model->deleteRecord('lease_areas',$where);	

        $where2 = array('lease_area_id' => $lease_area_id);
		$delete_id=$this->common_model->deleteRecord('lease_area_reservation_types',$where2);	

        $msg = "<strong>Success!</strong> Lease Information deleted successfully.";
       $this->system_message->set_success($msg);
       refresh();
    }
} 
?>