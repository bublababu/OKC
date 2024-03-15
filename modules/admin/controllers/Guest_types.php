<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Guest_types extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
	}

    public function index()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="guest_types_list"');
        $this->mViewData['form'] = $form;
        
        $this->db->order_by('name','asc');             	
        $query = $this->db->get('guest_types');       
        $guest_types = $query->result_array();       

      // print("<pre>".print_r($guest_types,true)."</pre>");

        $this->mViewData['guest_types']=$guest_types;   
        
        $this->mPageTitle = 'Guest Types';		
        $this->render('custom/guest/guest-types-list', 'with_breadcrumb');	
    }

    public function add()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodge_beds_list"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {
            $guest_types_name= $this->input->post('name');
            $max_guests = $this->input->post('max-guests');
            $general = $this->input->post('active1');
            $cancel = $this->input->post('cancel');
            //print_r($cancel);
            if(!$cancel)
            {
                $save_details['name'] = $guest_types_name; 
                $save_details['max_guests'] = $max_guests;  
                $save_details['general'] = $general; 
                $insert_save_details_id = $this->common_model->addRecord('guest_types', $save_details);
                $msg = "<strong>Success!</strong> Guest Type added successfully.";
                $this->system_message->set_success($msg);
            }
            redirect('admin/guest-types');
        }

        $this->mPageTitle = 'Guest Types';		
        $this->render('custom/guest/guest-types-add', 'with_breadcrumb');	
    }

    public function edit($guest_types_id)
    {
        $form = $this->form_builder->create_form('','','class="email" id="guest_types_edit"');
        $this->mViewData['form'] = $form;

        $this->db->where('id', $guest_types_id);                    	
        $query = $this->db->get('guest_types');       
        $guest_types = $query->result_array();

       // print("<pre>".print_r($guest_types,true)."</pre>");
       if ($this->input->method() === 'post') {
            $guest_types_name= $this->input->post('name');
            $max_guests = $this->input->post('max-guests');
            $general = $this->input->post('active1');
            $cancel = $this->input->post('cancel');
            if(!$cancel)
            {
                
                $save_details['name'] = $guest_types_name; 
                $save_details['max_guests'] = $max_guests;  
                $save_details['general'] = $general; 
                $where2 = array('id' => $guest_types_id);
                $upate_id = $this->common_model->editRecord('guest_types', $save_details, $where2);            
                if($upate_id > 0)
                {
                    $msg = "<strong>Success!</strong> Guest Type updated.";
                    $this->system_message->set_success($msg);
                // refresh();
                redirect('admin/guest-types');
                }
            }
        redirect('admin/guest-types');
    }

        $this->mViewData['guest_types']=$guest_types;
        $this->mPageTitle = 'Guest Types';		
        $this->render('custom/guest/guest-types-edit', 'with_breadcrumb');	
    }

    public function remove($guest_types_id)
    {
        $where2 = array('id' => $guest_types_id);
        $this->common_model->deleteRecord('guest_types',$where2);

        $msg = "<strong>Success!</strong> Guest Type deleted.";
                    $this->system_message->set_success($msg);           
                redirect('admin/guest-types');
    }
}

?>