<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lodge_rooms extends Admin_Controller {
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

    public function lists($lodge_id)
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodges_room_list"');
        $this->mViewData['form'] = $form;

        $lodgesReport=array();
        $i=0;
        $this->db->where('lodge_id', $lodge_id);
        $this->db->order_by('id', 'ASC');		
        $query = $this->db->get('lodge_rooms');       
        $lodge_rooms = $query->result_array();
        if (!empty($lodge_rooms) || isset($lodge_rooms))
        {                   
            foreach($lodge_rooms as $lodge_room)
            { 
                $lodge_rooms_id = $lodge_room['id'];

                $lodgesReport[$i]['id']=  $lodge_rooms_id;
                $lodgesReport[$i]['name']= $lodge_room['name'];   

              
               $lodge_beds_count=0;
               $this->db->where('room_id', $lodge_rooms_id);                    	
               $query = $this->db->get('lodge_beds');       
               $lodge_beds = $query->result_array();
               if (!empty($lodge_beds) || isset($lodge_beds))
               {
                   $lodge_beds_count+=count($lodge_beds);
                  
               }
              // print("<pre>".print_r($lodge_beds_count,true)."</pre>");  
               $lodgesReport[$i++]['lodge_beds_count']= $lodge_beds_count; 
            } 
            
        }
       // print("<pre>".print_r($lodgesReport,true)."</pre>"); 

        $Lodge_name="";
       $this->db->where('id', $lodge_id);		
       $query = $this->db->get('lodges');       
       $lodges = $query->result_array();
       if (!empty($lodges) || isset($lodges))
       {
         $Lodge_name=$lodges[0]['name'];
       }

       $this->mViewData['lodge_id']=$lodge_id;
       $this->mViewData['lodgesReports']=$lodgesReport;
        $this->mPageTitle = 'Lodge Rooms > '.$Lodge_name;		
        $this->render('custom/lodges/lodge-rooms', 'with_breadcrumb');
    }

    public function add($lodge_id)
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodges_room_add"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {
            $room_name= $this->input->post('name');
            $cancel = $this->input->post('cancel');
            //print_r($cancel);
            if(!$cancel)
            {
                $save_details['lodge_id'] = $lodge_id; 
                $save_details['name'] = $room_name;  
                $insert_save_details_id = $this->common_model->addRecord('lodge_rooms', $save_details);
                $msg = "<strong>Success!</strong>Lodge Room added successfully.";
                $this->system_message->set_success($msg);
            }
            redirect('admin/lodge-rooms/lists/'.$lodge_id);
        }

        $this->mPageTitle = 'Lodge Rooms';		
        $this->render('custom/lodges/lodge-rooms-add', 'with_breadcrumb');	
    }

    public function edit($room_id)
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodges_room_edit"');
        $this->mViewData['form'] = $form;

        $where = array('id' => $room_id);
        $room_data = $this->common_model->getRecord('lodge_rooms','*',$where);
        
        $lodge_id = $room_data['lodge_id'];

        if ($this->input->method() === 'post') {
            $room_name= $this->input->post('name');
            $cancel = $this->input->post('cancel');            
            if(!$cancel)
            {               
               
                $save2['name'] =  $room_name;  
                $where2 = array('id' => $room_id);
                $upate_id = $this->common_model->editRecord('lodge_rooms', $save2, $where2); 

                $msg = "<strong>Success!</strong>Lodge Room updated successfully.";
                $this->system_message->set_success($msg);
            }
            redirect('admin/lodge-rooms/lists/'.$lodge_id);
        }

        $this->mViewData['room'] =  $room_data;
        $this->mPageTitle = 'Lodge Rooms';		
        $this->render('custom/lodges/lodge-rooms-edit', 'with_breadcrumb');	
    }


    public function remove($lodge_id)
    { 
       
        print("<pre>".print_r($lodge_id,true)."</pre>"); 
        echo "CONT => Lodge_rooms.php => Pending...";
        
   
    }

}
?>