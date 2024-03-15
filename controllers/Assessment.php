<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Assessment extends MY_Controller
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
		$this->db->select('examp_status');
        $this->db->from('user');
      
        $query = $this->db->get();
        $userData=$query->result_array();
        
        // $this->db->where('id',1);
		$this->db->select('*');
        $this->db->from('ppt_manager');
      
        $query = $this->db->get();
        $fileData=$query->result_array();
        
         
         
         $this->mViewData['examstatus'] = $userData[0]['examp_status'];
         $this->mViewData['filename'] ='uploads/ppt/'.$fileData[0]['file_name'];
         $this->mViewData['title'] =$fileData[0]['title'];
         $this->mPageTitle='My Assessment';
         $this->render('user/assessment', 'with_breadcrumb');
    }

    public function exam()
    {
        $form = $this->form_builder->create_form('assessment/result','enctype= multipart/form-data','class="sky-form assessment-exam" id="sky-form3"');
        $this->mViewData['form'] = $form;

      
		$this->db->select('no_of_question');
        $this->db->from('exam_settings'); 
        $query = $this->db->get();
        $question_limit=$query->result_array();

		$this->db->select('*');
        $this->db->from('assessment');
        $this->db->order_by('RAND()');
        $this->db->limit($question_limit[0]["no_of_question"]);   
        $query = $this->db->get();

        $questions = $query->result_array();
        //print("<pre>".print_r($questions,true)."</pre>");

        $this->mViewData['questions']=$questions;
        $this->mPageTitle='My Assessment';
        $this->render('user/assessment-exam', 'with_breadcrumb');
    }

    public function result()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','class="sky-form assessment-exam" id="sky-form3"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post')
        {
            $userid = $this->session->userdata('userid');

            $this->db->select('pass_marks');
            $this->db->from('exam_settings'); 
            $query = $this->db->get();
            $pass_marks_array=$query->result_array();
            $pass_marks =  $pass_marks_array[0]['pass_marks'];

            $results = $this->input->post('hd_assessment');        
            $results_data = json_decode($results, TRUE);
        
            $marks_obtain=0;
            $pass_status="";

            foreach($results_data as $result)
            {
                $quistion_Id=$result['quistionId'];
                $answer=$result['answer'];     
                
                $this->db->where('id',$quistion_Id);
                $this->db->select('*');
                $this->db->from('assessment');              
                $query = $this->db->get();
                $questions = $query->result_array();               
                $correct_answer=$questions[0]["correct_answer"];          
                if($correct_answer==$answer)
                {
                    $marks_obtain =  $marks_obtain + 1;
                }

            }

            if( $marks_obtain < $pass_marks)
            {
                $pass_status = "Fail";

                $this->db->set('examp_status', '1');
                $this->db->where('user_id', $userid);
                $this->db->update('user');
            }
            else
            {
                $pass_status = "Pass";

                $this->db->set('examp_status', '2');
                $this->db->where('user_id', $userid);
                $this->db->update('user');
            }

            $this->mViewData['pass_status']=$pass_status;
            $this->mViewData['marks_obtain']=$marks_obtain;
            $this->mPageTitle='My Assessment';
            $this->render('user/assessment-result', 'with_breadcrumb');
        }
        else
        {
            redirect('assessment/exam', 'refresh');
        }
        
    }
}   
?>    