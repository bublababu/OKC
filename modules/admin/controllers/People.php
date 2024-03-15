<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class People extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    public function index()
    {
        $this->load->model('Users_model','users');
        $this->load->library('pagination');

        //CREATE CI FROM FROM FORM BUILER START
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="people_list"');
        $this->mViewData['form'] = $form;
        //CREATE CI FROM FROM FORM BUILER END

        //SEND CONTROLLER NAME TO VIEW PAGE START
        $this->mViewData['controller'] = $this;
        //SEND CONTROLLER NAME TO VIEW PAGE END

       //SEARCH POSTBACK START
       if ($this->input->method() === 'post') {
            $search= $this->input->post('search');
            $role=$this->input->post('role');
            $count=$this->input->post('count');
            $status=$this->input->get('status', TRUE);            
            redirect('admin/people?role='.$role.'&count='.$count.'&status='.$status.'&search='.$search);
        }
        //SEARCH POSTBACK END

        //GET VALUE FROM URL PARAMETERS START 
       $role=$this->input->get('role', TRUE);   
       $per_page=$this->input->get('count', TRUE);   
       $search=$this->input->get('search', TRUE);
       $status=$this->input->get('status', TRUE);   
        //GET VALUE FROM URL PARAMETERS END

         //GET TOTAL ROW FROM FROM MODEL FN START 
       $total_row = $this->users->num_rows($role,$search,$status);      
        //GET TOTAL ROW FROM FROM MODEL FN END 

        //SET DEFAULT PER PAGE ROWS START 
        if($per_page=="")
        {
            $per_page=25;
        }
        //SET DEFAULT PER PAGE ROWS END
         
        //PAGINATION CONFIGARATION START
        $config=[
            'base_url' => base_url('admin/people'),
            'per_page' => $per_page,
            'total_rows' => $total_row,

            'full_tag_open'=>"<ul class='pagination'>",
            'full_tag_close'=>"</ul>",

            'next_tag_open' =>"<li>",
            'next_link'=>'Next',
            'next_tag_close' =>"</li>",

            'prev_tag_open' =>"<li>",
            'prev_link'=>'Previous',
            'prev_tag_close' =>"</li>",

            'first_tag_open' =>"<li>",
            'first_link'=>'First',
            'first_tag_close' =>"</li>",

            'last_tag_open' =>"<li>",
            'last_link'=>'Last',
            'first_tag_close' =>"</li>",

            'num_tag_open' =>"<li>",
            'num_tag_close' =>"<li>",

            'cur_tag_open' =>"<li class='active'><a>",
            'cur_tag_close' =>"</a></li>",
            'num_links' => 10    
        ];   
        //PAGINATION CONFIGARATION END
    
        //PAGINATION INITIALIZATION START
        $this->pagination->initialize($config);
        //PAGINATION INITIALIZATION END

        //CALCULATION OF OFFSET VALUE FROM PAGE NO START
        $offset=$this->input->get('p', TRUE);    
        $page = ($offset) ? ($offset * $config["per_page"]) - $config["per_page"] : 0;   
        //CALCULATION OF OFFSET VALUE FROM PAGE NO END

        //GET DATA FROM MODEL AS PER CONFIGARATION START
        $users=$this->users->get_usersList($config['per_page'],$page,$role,$search,$status); 
        //GET DATA FROM MODEL AS PER CONFIGARATION START

        //VALUES SEND TO THE VIEW PAGE
        $this->mViewData['users']=$users; 
        $this->mViewData['total_row']=$total_row;        
        $this->mViewData['offset']=$offset;        
        //FOR URL CONFIGARATION START
        $this->mViewData['per_page']=$per_page; 
        $this->mViewData['count_from']=$page; 
        $this->mViewData['role']=$role; 
        $this->mViewData['status']=$status; 
        //FOR URL CONFIGARATION END
        $this->mViewData['search']=$search; 
        $this->mPageTitle = 'People';		
        $this->render('custom/people/people-list', 'with_breadcrumb');	
    }

    public function add()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="people_add"');
        $this->mViewData['form'] = $form;
      

        //////Mail Send Function Start
            // $this->load->helper('emailsend');
            // $findArr = array('[user_name]');
            // $replaceArr = array('Test User');
            // $email_send=email_send('test@gmail.com',1,$findArr,$replaceArr);
            // print("<pre>".print_r($email_send,true)."</pre>");
        //////Mail Send Function End

        $this->db->order_by('role_id', 'ASC');		
		$query = $this->db->get('role');       
		$roles = $query->result_array();	

        if ($this->input->method() === 'post') {
            
            $Email= $this->input->post('Email');
            $Password= $this->input->post('Password');
            $active= $this->input->post('active');
            $First_Name= $this->input->post('First_Name');
            $Last_Name= $this->input->post('Last_Name');
            $Badge= $this->input->post('Badge');
            $Birth_Date= $this->input->post('Birth_Date');
            $Address_Line_1= $this->input->post('Address_Line_1');
            $Address_Line_2= $this->input->post('Address_Line_2');
            $City= $this->input->post('City');
            $state= $this->input->post('state');
            $zip= $this->input->post('zip');
            $Phone= $this->input->post('Phone');
            $Cell_Phone= $this->input->post('Cell_Phone');
            $Secondary_Email= $this->input->post('Secondary_Email');
            $Allow_Reservations= $this->input->post('Allow_Reservations');
            $roles_id= $this->input->post('roles');
            $annual_form_status = $this->input->post('Annual_Form');
            
            //print("<pre>".print_r($roles_id,true)."</pre>");           
            $cancel = $this->input->post('cancel');

            if(!$cancel)
            {
                $this->db->trans_start();
                $data = array(
                    'email' => $Email,
                    'password' => $this->ion_auth_model->hash_password($Password,FALSE,FALSE),
                    'state' => $active,
                    'first_name' => $First_Name,
                    'last_name' => $Last_Name,
                    'badge' => $Badge,
                    'birth_date' => $Birth_Date,
                    'home_address_1' => $Address_Line_1,
                    'home_address_2' => $Address_Line_2,
                    'home_city' => $City,
                    'home_state' => $state,
                    'home_zipcode' => $zip,
                    'phone' => $Phone,
                    'cell_phone' => $Cell_Phone,
                    'secondary_email' => $Secondary_Email,
                    'allow_reservations' => $Allow_Reservations,
                    'annual_form_status' => $annual_form_status 
                );
            
                $this->db->set($data);
                $this->db->insert('user');
                $insert_id = $this->db->insert_id();

                foreach($roles_id as $role_id)
                {
                    $data2 = array(
                        'user_id' => $insert_id,
                        'role_id' => $role_id                       
                    );                
                    $this->db->set($data2);
                    $this->db->insert('users_roles');
                }

                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE)
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);
                }
                else
                {
                    $msg = "<strong>Success!</strong> User Information added successfully.";
                    $this->system_message->set_success($msg);
                }
            }
            redirect('admin/people');
        }

        $this->mViewData['roles']=$roles; 
        $this->mPageTitle = 'People';		
        $this->render('custom/people/people-add', 'with_breadcrumb');	
    }

    public function edit($user_id)
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="people_add"');
        $this->mViewData['form'] = $form;

        $this->db->where('user_id',$user_id);  
        $this->db->order_by('last_name','asc');             	
        $query = $this->db->get('user'); 
        $users = $query->result_array();	

        $this->db->where('users_roles.user_id',$user_id);
		$this->db->select('role_id');
        $this->db->from('users_roles');        
        $query = $this->db->get();
        $users_roles = $query->result_array(); 

        if ($this->input->method() === 'post') {
            
            $Email= $this->input->post('Email');
            $Password= $this->input->post('Password');
            $active= $this->input->post('active');
            $First_Name= $this->input->post('First_Name');
            $Last_Name= $this->input->post('Last_Name');
            $Badge= $this->input->post('Badge');
            $Birth_Date= $this->input->post('Birth_Date');
            $Address_Line_1= $this->input->post('Address_Line_1');
            $Address_Line_2= $this->input->post('Address_Line_2');
            $City= $this->input->post('City');
            $state= $this->input->post('state');
            $zip= $this->input->post('zip');
            $Phone= $this->input->post('Phone');
            $Cell_Phone= $this->input->post('Cell_Phone');
            $Secondary_Email= $this->input->post('Secondary_Email');
            $Allow_Reservations= $this->input->post('Allow_Reservations');
            $roles_id= $this->input->post('roles');
            $annual_form_status = $this->input->post('Annual_Form');
            
            //print("<pre>".print_r($roles_id,true)."</pre>");           
            $cancel = $this->input->post('cancel');

            if(!$cancel)
            {
                $this->db->trans_start();
                if($Password!="")
                {
                    $data = array(
                        'email' => $Email,
                        'password' => $this->ion_auth_model->hash_password($Password,FALSE,FALSE),
                        'state' => $active,
                        'first_name' => $First_Name,
                        'last_name' => $Last_Name,
                        'badge' => $Badge,
                        'birth_date' => $Birth_Date,
                        'home_address_1' => $Address_Line_1,
                        'home_address_2' => $Address_Line_2,
                        'home_city' => $City,
                        'home_state' => $state,
                        'home_zipcode' => $zip,
                        'phone' => $Phone,
                        'cell_phone' => $Cell_Phone,
                        'secondary_email' => $Secondary_Email,
                        'allow_reservations' => $Allow_Reservations,
                        'annual_form_status' => $annual_form_status  
                    );    
                }
                else
                {
                    $data = array(
                        'email' => $Email,                       
                        'state' => $active,
                        'first_name' => $First_Name,
                        'last_name' => $Last_Name,
                        'badge' => $Badge,
                        'birth_date' => $Birth_Date,
                        'home_address_1' => $Address_Line_1,
                        'home_address_2' => $Address_Line_2,
                        'home_city' => $City,
                        'home_state' => $state,
                        'home_zipcode' => $zip,
                        'phone' => $Phone,
                        'cell_phone' => $Cell_Phone,
                        'secondary_email' => $Secondary_Email,
                        'allow_reservations' => $Allow_Reservations,
                        'annual_form_status' => $annual_form_status 
                         
                    );      
                }
                $this->db->where('user_id', $user_id);
                $this->db->update('user', $data);

                $this->db->where('user_id', $user_id);
                $this->db->delete('users_roles');

                foreach($roles_id as $role_id)
                {
                    $data2 = array(
                        'user_id' => $user_id,
                        'role_id' => $role_id                       
                    );                
                    $this->db->set($data2);
                    $this->db->insert('users_roles');
                }

                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE)
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);
                }
                else
                {
                    $msg = "<strong>Success!</strong> User Information updated successfully.";
                    $this->system_message->set_success($msg);
                }
            }
            redirect('admin/people');
        }
        $this->db->order_by('role_id', 'ASC');		
		$query = $this->db->get('role');       
		$roles = $query->result_array();	

        $this->mViewData['users']=$users; 
        $this->mViewData['roles']=$roles; 
        $this->mViewData['users_roles']=$users_roles; 
        $this->mPageTitle = 'People';		
        $this->render('custom/people/people-edit', 'with_breadcrumb');	
    }

    public function remove($user_id)
    {
        print("<pre>".print_r($user_id,true)."</pre>"); 
        echo "CONT => Pending...";
    }
    
    public function forms()
     {
        $crud = $this->generate_crud('submission_file_manager');
        $crud->columns('id', 'title', 'file_name','status');
       // $crud->unset_add();
       // $crud->unset_delete();
        $crud->set_field_upload('file_name', 'uploads/forms');
         $crud->callback_edit_field('status', [$this, 'edit_field_callback_2']);
          $crud->callback_add_field('status', [$this, 'add_field_callback_2']);
        $crud->required_fields('title');
        $this->mPageTitle = 'Manage Files';
         $crud->callback_column('status', [$this, 'form_status']);
        $this->render_crud();
     }
    
    function add_field_callback_2()
    {
        return ' <select id="status" name="status">
          <option value="1">Processed</option>
          <option value="0">Pending</option>
         
        </select>';
    }
    
      function edit_field_callback_2($value)
    {
        $str1 =$str2='';
        if ($value == 1) {
            $str1 = 'selected="selected"';
        }
        if ($value == 0) {
            $str2 = 'selected="selected"';
        }
       

        $return =
            ' <select id="status" name="status">
          <option value="1"' .
            $str1 .
            '"  >Processed</option>
          <option value="0"' .
            $str2 .
            '">Pending</option>
        </select>';

        return $return;
    }
    
    
     public function form_status($value, $row)
    {
        if ($value == 1) {
            return '<div style="color:green;">Active</div>';
        } else {
            return '<div style="color:red;">Disabled</div>';
        }
    }
    
    
    public function processing_status($value, $row)
    {
       if ($value == 1) {
            return '<div style="color:green;">Processed</div>';
        } else {
            return '<div style="color:red;">Pending</div>';
        }  
    }
    
    public function submission()
    {
        $form = $this->form_builder->create_form('', 'class="form-horizontal"', 'id="settings_save"');
        $this->mViewData['form'] = $form;
        if ($this->input->method() === 'post') {
            /// Update data
            if ($this->input->post('settings_action') == 1) {
                $data = [
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
                   
                ];

                $this->db->update('submission_settings', $data);
                $msg = "<strong>Success!</strong> Data updated successfully.";
                $this->system_message->set_success($msg);
            }
        }

        $this->db->select('*');
        $this->db->from('submission_settings');
        $query = $this->db->get();
        $examData = $query->result_array();

        $this->mViewData['examData'] = $examData;

        $this->mPageTitle = 'Settings';
      
       $this->render('custom/people/submission', 'with_breadcrumb');	 
    }
    
    
    public function forms_list()
     {
        $crud = $this->generate_crud('submitted_forms');
        $crud->columns('user_id','date_submitted','file_name', 'status');
        $crud->order_by('id', 'DESC');
        $crud->callback_add_field('status', [$this, 'add_field_callback_2']);
        $crud->callback_edit_field('status', [$this, 'edit_field_callback_2']);
        
        $crud->callback_add_field('user_id', [$this, 'add_field_callback_1']);
        $crud->callback_edit_field('user_id', [$this, 'edit_field_callback_1']);
       $crud->display_as('user_id','Member Name');
     
        $crud->callback_column('status', [$this, 'processing_status']);
        $crud->callback_column('user_id', [$this, 'user_name']);
        $crud->set_field_upload('file_name', 'uploads/forms');
        $crud->required_fields('user_id', 'date_submitted', 'file_name','status');
        $this->mPageTitle = 'Annual forms ';
        $this->render_crud();
     }
     
     public function user_name($value, $row)
     {
         $this->db->select('*');
         $this->db->where('user_id',$value);
        $this->db->from('user');
        $query = $this->db->get();
        $userdata=$query->result_array();
        
        return $userdata[0]['first_name'].'&nbsp;'.$userdata[0]['last_name'];
     }
     
      function add_field_callback_1()
    {
        
		$this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        $userdata=$query->result_array();  
        $str=' <select id="user_id" name="user_id">';
        foreach($userdata as $user)
        {
            $str.='<option value="'.$user['user_id'].'">'.$user['first_name'].'&nbsp;'.$user['last_name'].'</option>';
        }
        $str.=' </select>';
        return $str;
    }
    
    
      function edit_field_callback_1($value)
    {
        
       // echo $value ; exit;
        
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        $userdata=$query->result_array();  
        $str=' <select id="user_id" name="user_id">';
       
        foreach($userdata as $user)
        {
             $selected='';
            if($user['user_id']==$value)  {  $selected='selected'; }
            $str.='<option value="'.$user['user_id'].'"' .$selected.' >'.$user['first_name'].'&nbsp;'.$user['last_name'].'</option>';
        }
        $str.=' </select>';
        return $str;
    }
    
    
    

    public function user_roles($user_id)
	{
        $this->db->where('users_roles.user_id',$user_id);
		$this->db->select('role.role_name');
        $this->db->from('users_roles');
        $this->db->join('role', 'role.role_id = users_roles.role_id');
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}

    public function signup_form()
    {
        $crud = $this->generate_crud('signup_file_manager');
        $crud->columns('id', 'title', 'file_name','status');
        $crud->unset_add();
        $crud->unset_delete();
        $crud->set_field_upload('file_name', 'uploads/forms');
         $crud->callback_edit_field('status', [$this, 'edit_field_callback_2']);
          $crud->callback_add_field('status', [$this, 'add_field_callback_2']);
        $crud->required_fields('title');
        $this->mPageTitle = 'Manage Files';
         $crud->callback_column('status', [$this, 'form_status']);
        $this->render_crud();
    }

    public function signup_submitted_form()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="membership_signup_list"');
        $this->mViewData['form'] = $form;
        
        $this->db->order_by('id','asc');             	
        $query = $this->db->get('signup_file_upload');       
        $signup_file_upload = $query->result_array();       

      // print("<pre>".print_r($guest_types,true)."</pre>");

        $this->mViewData['signup_file_uploads']=$signup_file_upload;   
        
        $this->mPageTitle = 'Membership Forms';		
        $this->render('custom/membership_signup/membership_signup_list', 'with_breadcrumb');	
    }

}