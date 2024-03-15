<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Lease_files extends Admin_Controller{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    // Frontend User CRUD
    public function index()
	{
    
    }

    public function lists($lease_id)
    {
        $this->load->helper('url');     
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="myform"');
        $this->mViewData['form'] = $form;

         $this->db->where('lease_id', $lease_id);
        $query = $this->db->get('lease_files');       
        $data['leases'] = $query->result_array();	
         $this->mViewData['leases']=$data['leases'];
         
         $this->db->where('id',$lease_id);
         $this->db->select('name');
        $query = $this->db->get('leases');       
        $data['leasename'] = $query->result_array();
        //$this->mViewData['leasename']= $data['leasename'];
       // print_r($data['leasename']);
         $this->mViewData['lease_id']=$lease_id;
        $this->mPageTitle = 'Lease Files > '.$data['leasename'][0]['name'].'';		
        $this->render('custom/leases/leases-files-list', 'with_breadcrumb');	
    }

    public function add($lease_id)
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
                $path =  $_SERVER['DOCUMENT_ROOT'].'/uploads/lease';
                $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/lease/'.$img['name'];
                if ($img['name']) {
                    $ext = explode(".", $img['name']);
                    // Check if file already exists
                    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/lease/'.$img['name'])) {
                        //echo "Sorry, file already exists.";
                        $errors = "Sorry, this file name already exists.";
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

                        
                        $save_details['lease_id'] = $lease_id;
                        $save_details['file_path'] = $filePath;
                        $save_details['file_name'] = $filename; 
                        $save_details['mime_type'] = $file_type;
                        $save_details['file_size'] = $file_size;   
                        $save_details['file_description'] = $file_description;    

                        $insert_save_details_id = $this->common_model->addRecord('lease_files', $save_details);
                        
                        $msg = "<strong>Success!</strong> Lease Information updated successfully.";
                        $this->system_message->set_success($msg);
                        refresh();
                    }
                    else
                    {
                        $errors = "something went wrong please try again...";
                        $this->system_message->set_error($errors); 
                        refresh();
                    }
    
                    //$ReadFile = $path . '/' . $filename;
    
                }
            }
    
        }

         $this->db->where('lease_id', $lease_id);
        $query = $this->db->get('lease_files');       
        $data['leases'] = $query->result_array();	
         $this->mViewData['leases']=$data['leases'];	
         $this->mViewData['lease_id']=$lease_id;
       // print_r($lease_id);
        $this->mPageTitle = 'Lease Files';		
        $this->render('custom/leases/leases-files-add', 'with_breadcrumb');	
    }

    public function edit($lease_id)
    {
         $this->load->model('common_model');
         $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="myform"');
         $this->mViewData['form'] = $form;
          if ($this->input->method() === 'post') {
           // echo $lease_id; exit;
          $save2['file_description']=$this->input->post('file_description'); 
           
            $where2 = array('id' => $lease_id);
            $upate_id = $this->common_model->editRecord('lease_files', $save2, $where2);
             $msg = "<strong>Success!</strong> Information updated successfully.";
                $this->system_message->set_success($msg);
                refresh();
            
          }
         
        
         $this->db->where('id', $lease_id);
        $query = $this->db->get('lease_files');       
        $data['leases'] = $query->result_array();	
         $this->mViewData['leases']=$data['leases'];	
       // print_r($lease_id);
        $this->mPageTitle = 'Lease Files';		
        $this->render('custom/leases/leases-files-edit', 'with_breadcrumb');	
    }
   
    public function remove($lease_files_id)
    {              
        $this->db->where('id',$lease_files_id);              	
        $query = $this->db->get('lease_files'); 
        $lease_files = $query->result_array();
        $data =	$lease_files[0]["file_name"]; 
        $leases_id = $lease_files[0]["lease_id"];       
        $dir = "uploads/lease";
        $dirHandle = opendir($dir);
        while ($file = readdir($dirHandle)) {
            if ($file==$data) {
                unlink($dir.'/'.$file);
            }
        }
        closedir($dirHandle);
        $this->db->where('id', $lease_files_id);
        $this->db->delete('lease_files');

        $msg = "<strong>Success!</strong> Lease File deleted successfully.";
        $this->system_message->set_success($msg);
        redirect('admin/lease-files/lists/'.$leases_id.''); 
    }
}
?>