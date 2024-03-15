<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Submission extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');  
        $this->load->helper('url');
        $this->load->library('form_builder');

        if(!is_logged_in())
        {
            redirect('account/login', 'refresh');
        }
    }
    
     public function index()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data', 'class="sky-form profile-edit" id="submission"');
        $this->mViewData['form'] = $form;

        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('Customer_model', 'customer');
        $this->mViewData['controller'] = $this;
        $userid = $this->session->userdata('userid');
        
        $this->db->where('user_id',$userid);
		$this->db->select('annual_form_status');
        $this->db->from('user');
      
        $query = $this->db->get();
        $userData=$query->result_array();
        
        $this->db->where('status',1);
		$this->db->select('*');
        $this->db->from('submission_file_manager');
        $query = $this->db->get();
        $fileData=$query->result_array();
        
        
        $this->db->select('*');
        $this->db->from('submission_settings');
        $query = $this->db->get();
        $submissionDate=$query->result_array();
        
        
        $this->db->where('user_id',$userid);
        $this->db->order_by('id','desc');
		$this->db->select('*');
        $this->db->from('submitted_forms');
        $query = $this->db->get();
        $subMittedData=$query->result_array();
        
        
        
         $this->mViewData['subMittedData'] = $subMittedData;
         $this->mViewData['submissionDate'] = $submissionDate;
         $this->mViewData['examstatus'] = $userData[0]['annual_form_status'];
         $this->mViewData['filename'] ='uploads/forms/'.$fileData[0]['file_name'];
         $this->mViewData['title'] =$fileData[0]['title'];
         $this->mPageTitle='My submission';
         $this->render('user/submission', 'with_breadcrumb');
    }
    
    public function forms()
      {
         
        $form = $this->form_builder->create_form('','enctype= multipart/form-data', 'class="sky-form profile-edit" id="submission_save"');
        $this->mViewData['form'] = $form;
         
        if ($this->input->method() === 'post') {

            $userid = $this->session->userdata('userid');
            $comments = $this->input->post('comment');
          
              //*****FILE UPLOAD TO SERVER FUNCTUON START*****//  
              $this->load->helper('imagethumbnail'); 
              $upfile = $_FILES['fileToUpload']; 
             
              if ($upfile["error"] == 0) 
              {
                  $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
                  
                  //CHECK FILE TYPE TO UPLOAD ALLOWED START***************************
                        //   if (!in_array($upfile["type"], $allowedImageType))
                        //   {
                        //       $msg = "<strong>Error!</strong> Only image file allowed!  please try again...";
                        //       $this->system_message->set_error($msg);
                        //       redirect('submission/forms');
                        //   }
                  ////END*****************************************************

                  //SET UPLOAD PATH TO SERVER****************
                  $path =  $_SERVER['DOCUMENT_ROOT'].'/uploads/forms';
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
                      $small_thumbnail_path = $_SERVER['DOCUMENT_ROOT'].'/thumbs/forms';                       
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

                $data = array(
                    'user_id' => $userid,                  
                    'file_name' => $filename,
                    'status ' => 0,
                    'comment ' => $comments,  
                    'date_submitted' => date('Y-m-d H:i:s')              
                );
            
                $this->db->set($data);
                $this->db->insert('submitted_forms');
                $insert_id = $this->db->insert_id();

                if($insert_id > 0)
                {
                    $msg = "<strong>Success!</strong> Form submitted successfully.";
                    $this->system_message->set_success($msg);
                   
                }
                else
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);

                }
                redirect('submission');
        }


         $this->render('user/Submission_forms', 'with_breadcrumb');
         
         
      }
}   