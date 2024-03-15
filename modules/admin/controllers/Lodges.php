<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Lodges extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    public function index()
    {
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();
        $this->mViewData['form'] = $form;

        $lodgesReport=array();
        $lodge_id="";
        $lodge_name="";

        $this->db->order_by('name', 'ASC');		
		$query = $this->db->get('lodges');       
		$lodges = $query->result_array();	
        $i=0;

        if (!empty($lodges) || isset($lodges)) {
            foreach ($lodges as $lodge)
            {
                // $lodgesReport[1]['id']= $lodge['id'];
                // $lodgesReport[1]['name']= $lodge['name'];
               // $lodgesReport[] = array('id' => $lodge['id'],'name' => $lodge['name']);
               // $lodgesReport[] = array('name' => $lodge['name']);

               $lodge_id = $lodge['id'];
               $lodge_name=$lodge['name'];
              
               $lodgesReport[$i]['id']= $lodge['id'];
               $lodgesReport[$i]['name']= $lodge['name'];

               $this->db->where('lodge_id', $lodge_id);
               $this->db->order_by('id', 'ASC');		
               $query = $this->db->get('lodge_rooms');       
               $lodge_rooms = $query->result_array();
               if (!empty($lodge_rooms) || isset($lodge_rooms))
               {
                 $lodge_rooms_count=count($lodge_rooms);
                 $lodgesReport[$i]['lodge_rooms_count']= $lodge_rooms_count;
                 $lodge_beds_count=0;
                 foreach($lodge_rooms as $lodge_room)
                 {
                    $lodge_rooms_id = $lodge_room['id'];
                   
                    $this->db->where('room_id', $lodge_rooms_id);                    	
                    $query = $this->db->get('lodge_beds');       
                    $lodge_beds = $query->result_array();
                    if (!empty($lodge_beds) || isset($lodge_beds))
                    {
                        $lodge_beds_count+=count($lodge_beds);
                       
                    }
                 } 
                 $lodgesReport[$i++]['lodge_beds_count']= $lodge_beds_count;                 
               }
            }
           
        }
        //print("<pre>".print_r($lodgesReport,true)."</pre>"); 
        $this->mViewData['lodgesReports']=$lodgesReport;
        $this->mPageTitle = 'Lodges';		
        $this->render('custom/lodges/lodges-list', 'with_breadcrumb');	
    }

    public function add()
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodges_add"');
        $this->mViewData['form'] = $form;
        if ($this->input->method() === 'post') {
            $lodge_name= $this->input->post('name');
            $lodge_status=$this->input->post('active1');
            $location_description=$this->input->post('desc');

            $save_details['name'] = $lodge_name;   
            $save_details['active'] = $lodge_status; 
            $save_details['location_description'] = $location_description;  
            $insert_save_details_id = $this->common_model->addRecord('lodges', $save_details);
            
            $msg = "<strong>Success!</strong> Lodge added successfully.";
            $this->system_message->set_success($msg);
            redirect('admin/lodges');

        }
        $this->mPageTitle = 'Lodges';		
        $this->render('custom/lodges/lodges-add', 'with_breadcrumb');	
    }

    public function edit($lodge_id)
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodges_edit"');
        $this->mViewData['form'] = $form;

        $this->db->where('id',$lodge_id);
        $query = $this->db->get('lodges');       
		$lodges = $query->result_array();	

        if ($this->input->method() === 'post') {
            $lodge_name= $this->input->post('name');
            $lodge_status=$this->input->post('active1');
            $location_description=$this->input->post('desc');

            $save2['name'] = $lodge_name;
            $save2['active'] = $lodge_status;
            $save2['location_description'] = $location_description;
            $where2 = array('id' => $lodge_id);
            $upate_id = $this->common_model->editRecord('lodges', $save2, $where2); 

            $msg = "<strong>Success!</strong> Lodge updated successfully.";
            $this->system_message->set_success($msg);
            redirect('admin/lodges');
        }

        $this->mViewData['lodges']=$lodges;

        $this->mPageTitle = 'Lodges';		
        $this->render('custom/lodges/lodges-edit', 'with_breadcrumb');	
    }

    public function remove($lodge_id)
    {
        print_r($lodge_id);
        print_r("--This Process Pending for Approval");
       // $this->mPageTitle = 'Leases';		
       // $this->render('custom/leases/leases-edit', 'with_breadcrumb');	
    }
}
?>