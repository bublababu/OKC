<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lodge_beds extends Admin_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
	}

    // public function index()
    // {
    //     $this->mPageTitle = 'Lodges';		
    //     $this->render('custom/lodges/lodge-rooms', 'with_breadcrumb');
    // }

    public function lists($lodge_rooms_id)
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodge_beds_list"');
        $this->mViewData['form'] = $form;
        
        $this->db->where('room_id', $lodge_rooms_id);                    	
        $query = $this->db->get('lodge_beds');       
        $lodge_beds = $query->result_array();       

        $this->mViewData['lodge_rooms_id']=$lodge_rooms_id;

        $this->mViewData['lodgesReports']=$lodge_beds;
        
        $this->mPageTitle = 'Lodge Beds';		
        $this->render('custom/lodges/lodge-beds-list', 'with_breadcrumb');
    }

    public function edit($lodge_beds_id)
    {
        $this->load->library('session');
        $this->load->helper('url');    
        $form = $this->form_builder->create_form('','','class="email" id="myform"');
        $this->mViewData['form'] = $form;

        $this->db->where('id', $lodge_beds_id);                    	
        $query = $this->db->get('lodge_beds');       
        $lodge_beds = $query->result_array();
        
        $lodge_rooms_id = $lodge_beds[0]['room_id'];

        if ($this->input->method() === 'post') {
            $cancel = $this->input->post('cancel');
            if(!$cancel)
            {
                $lodge_beds_name = $this->input->post('name');
                $save2['name'] = $lodge_beds_name;
                $where2 = array('id' => $lodge_beds_id);
                $upate_id = $this->common_model->editRecord('lodge_beds', $save2, $where2);            
                if($upate_id > 0)
                {
                    $msg = "<strong>Success!</strong> The bed was updated.";
                    $this->system_message->set_success($msg);
                // refresh();
                redirect('admin/lodge-beds/lists/'.$lodge_rooms_id);
                }
            }
            redirect('admin/lodge-beds/lists/'.$lodge_rooms_id);

        }
        
        $this->mViewData['lodge_beds_id']=$lodge_beds_id;
        $this->mViewData['lodge_beds']=$lodge_beds;
        $this->mPageTitle = 'Lodge Beds';		
        $this->render('custom/lodges/lodge-beds-edit', 'with_breadcrumb');
    }
    public function add($lodge_rooms_id)
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodge_beds_list"');
        $this->mViewData['form'] = $form;

        
        if ($this->input->method() === 'post') {
            $bed_name= $this->input->post('name');
            $cancel = $this->input->post('cancel');
            //print_r($cancel);
            if(!$cancel)
            {
                $save_details['room_id'] = $lodge_rooms_id; 
                $save_details['name'] = $bed_name;  
                $insert_save_details_id = $this->common_model->addRecord('lodge_beds', $save_details);
                $msg = "<strong>Success!</strong>Lodge Bed added successfully.";
                $this->system_message->set_success($msg);
            }
            redirect('admin/lodge-beds/lists/'.$lodge_rooms_id);
        }

        $this->mPageTitle = 'Lodge Beds';		
        $this->render('custom/lodges/lodge-beds-add', 'with_breadcrumb');
    }

    public function remove($lodge_beds_id)
    {
        print("<pre>".print_r($lodge_beds_id,true)."</pre>"); 
        echo "CONT => Lodge_beds.php => Pending...";
    }
}
?>