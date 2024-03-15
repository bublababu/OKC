<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lodge_files extends Admin_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    public function lists($lodge_id)
    {
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','','class="email" id="myform"');
        $this->mViewData['form'] = $form;
        
        $this->db->where('lodge_id', $lodge_id);                    	
        $query = $this->db->get('lodge_files');       
        $lodge_files = $query->result_array();
        
       // print("<pre>".print_r($lodge_beds,true)."</pre>"); 

       $this->mViewData['lodge_id']=$lodge_id;
        $this->mViewData['lodge_files']=$lodge_files;
        $this->mPageTitle = 'Lodge Files';		
        $this->render('custom/lodges/lodge-files-list', 'with_breadcrumb');
    }

    public function add($lodge_id)
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="myform"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {
            $img = $_FILES['fileToUpload'];
            $file_description = $this->input->post('file_description');
            if (!empty($img)) {
                $path =  $_SERVER['DOCUMENT_ROOT'].'/uploads/lodge';
                $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/lodge/'.$img['name'];
                if ($img['name']) {
                    $ext = explode(".", $img['name']);
                    // Check if file already exists
                    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/lodge/'.$img['name'])) {
                        //echo "Sorry, file already exists.";
                        $errors = "Sorry, Same file name already exists.";
                        $this->system_message->set_error($errors); 
                        refresh();
                    }          
                   // $filename = $ext[0] . time() . "." . end($ext);
                   $filename = $img['name'];
                    $filename = str_replace(" ", "_", $filename);
    
                    if (move_uploaded_file($img['tmp_name'], $path . '/' . $filename))
                    {
                        $file_name = $_FILES['fileToUpload']['name'];
                        $file_size = $_FILES['fileToUpload']['size'];                       
                        $file_type = $_FILES['fileToUpload']['type'];

                        
                        $save_details['lodge_id'] = $lodge_id;
                        $save_details['file_path'] = $filePath;
                        $save_details['file_name'] = $file_name; 
                        $save_details['mime_type'] = $file_type;
                        $save_details['file_size'] = $file_size;   
                        $save_details['file_description'] = $file_description;    

                        $insert_save_details_id = $this->common_model->addRecord('lodge_files', $save_details);
                        
                        $msg = "<strong>Success!</strong> Lodge File Information Add successfully.";
                        $this->system_message->set_success($msg);
                        redirect('admin/lodge-files/lists/'.$lodge_id);
                    }
                    else
                    {
                        $errors = "something went wrong please try again...";
                        $this->system_message->set_error($errors); 
                        refresh();
                    }
    
                    $ReadFile = $path . '/' . $filename;
    
                }
            }
    
        }

        //  $this->db->where('lease_id', $lodge_id);
        // $query = $this->db->get('lease_files');       
        // $data['leases'] = $query->result_array();	
        //  $this->mViewData['leases']=$data['leases'];	
        //  $this->mViewData['lease_id']=$lease_id;
       // print_r($lease_id);
        $this->mPageTitle = 'Lodge Files';		
        $this->render('custom/lodges/lodge-files-add', 'with_breadcrumb');	

    }

    public function edit($lodge_files_id)
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','','class="email" id="myform"');
        $this->mViewData['form'] = $form;

        $this->db->where('id', $lodge_files_id);
        $query = $this->db->get('lodge_files');       
        $data['lodge'] = $query->result_array();	
        $this->mViewData['lodge']=$data['lodge'];	
        $lodge_id=$data['lodge'][0]['lodge_id'];

        if ($this->input->method() === 'post') {
            $fileDesc= $this->input->post('fileDesc');

            $save2['file_description'] = $fileDesc;
            $where2 = array('id' => $lodge_files_id);
            $upate_id = $this->common_model->editRecord('lodge_files', $save2, $where2); 
            if($upate_id > 0)
            {
                $msg = "<strong>Success!</strong> File Description updated successfully.";
                $this->system_message->set_success($msg);
                redirect('admin/lodge-files/lists/'.$lodge_id);
            }
        }       
      
        $this->mPageTitle = 'Lodge Files';		
        $this->render('custom/lodges/lodge-files-edit', 'with_breadcrumb');	
    }

    public function remove($lodge_files_id)
    {
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->helper("file");
        
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','','class="email" id="myform"');
        $this->mViewData['form'] = $form;

        $this->db->where('id', $lodge_files_id);
        $query = $this->db->get('lodge_files');       
        $data['lodge_files'] = $query->result_array();	
        $lodge_id=$data['lodge_files'][0]['lodge_id'];
       //$delete = delete_files(''.$data['lodge_files'][0]['file_path'].'');
       unlink($data['lodge_files'][0]['file_path']);

        $where3 = array('id' => $lodge_files_id);
        $delete_id=$this->common_model->deleteRecord('lodge_files',$where3);

      //  print("<pre>".print_r($data['lodge_files'][0]['file_path'],true)."</pre>"); 

        $this->mViewData['lodge_files']=$data['lodge_files'];	

        $msg = "<strong>Success!</strong> Lodge File deleted successfully.";
        $this->system_message->set_success($msg);
       
        redirect('admin/lodge-files/lists/'.$lodge_id);

    }
}
?>