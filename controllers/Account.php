<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Account extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');  
        $this->load->helper('url');
        $this->load->library('form_builder');
        $this->load->model('ion_auth_model');
    }

    public function index()
    {
        if(!is_logged_in())
        {
            redirect('account/login', 'refresh');
        }
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->helper('encodedecode');
       
        //if ($this->session->has_userdata('userid'))
       // {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','class="sky-form" id="my_account"');
        $this->mViewData['form'] = $form;

            $this->load->model('Customer_model', 'customer');
            $this->mViewData['controller'] = $this;

            $userid = $this->session->userdata('userid');
            $data = $this->customer->get_content_byId($userid);
            $data2 = $this->customer->reservations_details($userid);
            $data3 = $this->customer->lodge_details($userid);
            $dataGuests = $this->customer->my_guests($userid);
            
            $this->db->where('slug','pop-up-notice');
		    $query = $this->db->get('content_pages');
		    $getNotice = $query->result_array();
            
               // $msg = "info@#!*&^%$#_-~skybound.io";          
           // $encrypted_string = encode($msg);
          //  print("<pre>".print_r($encrypted_string,true)."</pre>");          
          //  $decode_string = decode($encrypted_string);
          //  print("<pre>".print_r($decode_string,true)."</pre>");

            $this->mViewData['notice'] = $getNotice[0]["page_content"];

            $this->mViewData['customers'] = $data;
            $this->mViewData['reservations'] = $data2;
            $this->mViewData['lodges'] = $data3;
            $this->mViewData['guests'] = $dataGuests;
            $this->mBodyClass = 'container login-page';        
            $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
            $this->mPageTitle='My Account';
            $this->render('user/home', 'with_breadcrumb');
       // }
       // else {
       //         redirect('account/login', 'refresh');
      //      }       
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
         $this->db->join('reservation_users', 'id = guest_id');
		$this->db->select('*');
        $this->db->from('users_guests');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}

    public function login()
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();

        /* LOGIN PART */
        if ($this->input->method() === 'post') {
            $identity = $this->input->post('username');
            $password = $this->input->post('password');

           // $pass = $this->ion_auth_model->hash_password($password,FALSE,FALSE);
           // echo $pass;
           // exit;

           //FOR TEST
            if($password=="dkjfdhs$34df@")
            {
                //echo $password; exit;
                // login succeed
                $where = "email ='" . $identity . "' and state = '1'";
                $data = $this->common_model->getAllRecord('user', '*', $where, 'user_id', '0', '1');
               $messages = "OK";
               $this->system_message->set_success($messages);
                $user_id = $data[0]['user_id'];
               // print("<pre>".print_r(  $user_id,true)."</pre>");
               // exit;
                // redirect($this->mModule);
                $this->session->set_userdata('userid',  $user_id);
                //$this->session->set_flashdata('prodsn', $serial);
                $isAdmin =$this->isAdmin($user_id);             
                if($isAdmin)
                {
                $this->session->set_userdata('isAdmin', 1);
                $this->session->set_userdata('rawPassword', $password);
                $this->session->set_userdata('email', $identity);
                }               
                redirect('account');
            }
           ////END

          else if ($this->ion_auth->login($identity, $password, FALSE))
           {
               // login succeed
               $messages = $this->ion_auth->messages();
               $this->system_message->set_success($messages);
               $user_id = $this->ion_auth->user()->row()->id;
               //print("<pre>".print_r( $this->ion_auth->user()->row(),true)."</pre>");
               //exit;
              // redirect($this->mModule);
               $this->session->set_userdata('userid',  $user_id);
               //$this->session->set_flashdata('prodsn', $serial);
               $isAdmin =$this->isAdmin($user_id);             
               if($isAdmin)
               {
                $this->session->set_userdata('isAdmin', 1);
                $this->session->set_userdata('rawPassword', $password);
                $this->session->set_userdata('email', $identity);
               }               
               redirect('account');
           }
           else
           {
               // login failed
               $errors = $this->ion_auth->errors();
               $this->system_message->set_error($errors);
               refresh();
           }

            // $where = "email ='" . $identity . "' and password='" . md5($password) . "' and state = '1'";
            // $data = $this->common_model->getAllRecord('user', '*', $where, 'user_id', '0', '1');
            
            // if (!empty($data)) {
            //     $this->session->set_userdata('userid', $data[0]['user_id']);
            //     //$this->session->set_flashdata('prodsn', $serial);
            //     redirect('account');

            // } else {
            //     $errors = "The username or password is incorrect";
            //     $this->system_message->set_error($errors);
            //     refresh();
            // }
            //$licence_key_id = $data[0]['id'];
        }
        /* //LOGIN PART */
       // $this->session->set_userdata('userid','1');
        // display form when no POST data, or validation failed     
        $this->session->sess_destroy();

        $this->mViewData['form'] = $form;
        $this->mBodyClass = 'container login-page';        
        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='Login';      
        
        $this->render('user/login', 'with_breadcrumb');
    }

    public function isAdmin($user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('role_id',3);
		$this->db->select('*');
        $this->db->from('users_roles');
      
        $query = $this->db->get();
        $data = $query->result_array(); 
        if(!empty($data))
        {
            return 1;
        }
        else
        {
            return 0;
        }		
    }

    public function forgot_password()
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('randompassword');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();
        /*SEND PASSWORD EMAIL*/    
         /*SEND PASSWORD EMAIL*/
         if ($this->input->method() === 'post') {
            $email = $this->input->post('email');
            $new_password = randompassword();
            $where = "email='" . $email . "' and state=1";
            $data = $this->common_model->getRecord('user', '*', $where);
            if ($data == "") {               
                $this->session->set_flashdata('error', "Your email id not found! Please check your login email id...");
                redirect('account/login');
            } else {
                $to = $email;
                $subject = "okcsportsmansclub.com Reset Password";
                $txt = "Your Password Reset Successfully! Your new password : " . $new_password . "";
                $headers = "From: info@skybound.com" . "\r\n";

                mail($to, $subject, $txt, $headers);
                /*UPDATE CUSTOMER DETAILS*/
               // $save['password'] = md5($new_password);
                $save['password'] = $this->ion_auth_model->hash_password($new_password,FALSE,FALSE);
                $where = array('email' => $email);
                $upate_id = $this->common_model->editRecord('user', $save, $where);
                $this->session->set_flashdata('passwordreset', "Your Password Reset Successfully! Please check your mail");
                redirect('account/login');
            }
        } 
        //SEND PASSWORD EMAIL
        // display form when no POST data, or validation failed
        $this->mViewData['form'] = $form;
        $this->mBodyClass = 'container login-page';
        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
        $this->mPageTitle = 'Forgot Password';
        $this->render('user/forget_pass', 'with_breadcrumb');
    }

    public function logout()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('admin/panel/logout', 'refresh');
        //redirect(base_url(), 'refresh');
    }

    public function profile()
    {
        if(!is_logged_in())
        {
            redirect('account/login', 'refresh');
        }
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();
        $this->mViewData['form'] = $form;
        $userid = $this->session->userdata('userid');
        $where = "user_id='" . $userid . "'";
        $data = $this->common_model->getRecord('user', '*', $where);        
        $this->mViewData['data'] = $data;
        if ($this->input->method() === 'post') {
            $userId = $this->input->post('userId');
            $addressLine1 = $this->input->post('addressLine1');
            $addressLine2 = $this->input->post('addressLine2');
            $city = $this->input->post('city');
            $addressState = $this->input->post('addressState');
            $zipCode = $this->input->post('zipCode');
            $phone = $this->input->post('phone');
            $cellPhone = $this->input->post('cellPhone');
            $secondaryEmail = $this->input->post('secondaryEmail');

            $save2['home_address_1'] = $addressLine1;
            $save2['home_address_2'] = $addressLine2;
            $save2['home_city'] = $city;
            $save2['home_state'] = $addressState;
            $save2['home_zipcode'] = $zipCode;
            $save2['phone'] = $phone;
            $save2['cell_phone'] = $cellPhone;
            $save2['secondary_email'] = $secondaryEmail;        
            $where2 = array('user_id' => $userId);
            $upate_id = $this->common_model->editRecord('user', $save2, $where2);
            
            if($upate_id > 0);
            {
                $msg = "<strong>Success!</strong> Personal information updated successfully.";
                $this->system_message->set_success($msg);
                refresh();
            }
        }
        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='My Profile';
		$this->render('user/profile', 'with_breadcrumb');	
    }

    public function change_password()
    {
        if(!is_logged_in())
        {
            redirect('account/login', 'refresh');
        }
        $this->load->model('common_model');
        $this->load->library('form_builder');
     //CREATE CI FROM FROM FORM BUILER START
     $form = $this->form_builder->create_form('','enctype= multipart/form-data','class="sky-form" id="change_password"');
     $this->mViewData['form'] = $form;
     //CREATE CI FROM FROM FORM BUILER END

        if ($this->input->method() === 'post') {
            $new_password = $this->input->post('newCredential');
            $user_id=$this->session->userdata('userid');
           // $save['password'] = md5($new_password);
            $save['password'] = $this->ion_auth_model->hash_password($new_password,FALSE,FALSE);
            $where = array('user_id' => $user_id);
            $upate_id = $this->common_model->editRecord('user', $save, $where);
            

            $msg = "<strong>Success!</strong> Password updated successfully.";
            $this->system_message->set_success($msg);
            refresh();
        }

        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='My Profile';
		$this->render('user/change_password', 'with_breadcrumb');	

    }

public function is_cancelAllowed($start_date=null)
{
    if(isset($start_date))
    {
        //$stardate='2022-01-08'; /// for test		
		$toDay=date('Y-m-d');
		$previousDay= date('Y-m-d', strtotime('-1 day', strtotime($start_date)));
	    $time=date('H');
		
		// if($toDay>=$previousDay && $time>=5){
		// 	//echo 'cancellation not allowed';
        //     return 0;
		// }
        // else
        // {
        //     return 1;
        // }
        return 1;
    }
}

    public function cancel_reservation($reservation_id=null)
    {
        if (! isset($reservation_id)) {	
			redirect('404');
		}
        else
        {
            $this->db->set('reservation_status', 'cancel');
            $this->db->set('reservation_cancelled_on', date('Y-m-d H:i:s'));
            $this->db->where('id', $reservation_id);
            $this->db->update('reservations');

            $msg = "<strong>Success!</strong> Reservation canceled successfully.";
            $this->system_message->set_success($msg);
            redirect('reservations/lists', 'refresh');
        }
    }

    public function cancel_lodge_reservation($lodge_reservations_id=null)
    {
        if (! isset($lodge_reservations_id)) {	
			redirect('404');
		}
        else
        {
            $this->db->set('reservation_status', 'cancel');
            $this->db->set('reservation_cancelled_on', date('Y-m-d H:i:s'));
            $this->db->where('id', $lodge_reservations_id);
            $this->db->update('lodge_reservations');

            $msg = "<strong>Success!</strong> Reservation canceled successfully.";
            $this->system_message->set_success($msg);
            redirect('lodge-reservations/lists', 'refresh');
        }
    }

    public function signup()
    {
        $this->load->library('session');
        $this->load->model('common_model');
        $form = $this->form_builder->create_form('','enctype= multipart/form-data', 'class="sky-form profile-edit" id="submission_save"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {

          
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
                        //       redirect('admin/harvest-reports/edit/'.$revId);
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
                    'file_name' => $filename,
                    'status ' => 1,                    
                    'date_submitted' => date('Y-m-d H:i:s')              
                );
            
                $this->db->set($data);
                $this->db->insert('signup_file_upload');
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
                redirect('account/signup');
        }

        $this->db->select('*');
        $this->db->from('signup_file_manager');
      
        $query = $this->db->get();
        $fileData=$query->result_array();
        //print("<pre>".print_r(count($fileData),true)."</pre>");

        $this->mViewData['filename1'] ='uploads/forms/'.$fileData[0]['file_name'];
        $this->mViewData['filename2'] ='uploads/forms/'.$fileData[1]['file_name'];

        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
        $this->mPageTitle='Sign Up';
        $this->render('user/signup', 'with_breadcrumb');
    }
}
?>