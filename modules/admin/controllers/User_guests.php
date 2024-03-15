<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class User_guests extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
	}

    public function lists($user_id = null)
    {
        if($user_id!=null)
        {
            $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="user_guests_list"');
            $this->mViewData['form'] = $form;

            $this->db->where('users_guests.user_id',$user_id);
            $this->db->where('users_guests.status','1');
            $this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
            $this->db->select('users_guests.*,guest_types.name as guest_types_name');
            $this->db->order_by('users_guests.name','asc');   
            $this->db->from('users_guests');
            $query = $this->db->get();
            $users_guests = $query->result_array();            

                $this->mViewData['user_id']=$user_id;   
                $this->mViewData['guest_types']=$users_guests;   
                $this->mPageTitle = 'Guests';		
                $this->render('custom/guest/user-guests-list', 'with_breadcrumb');
           
        }	
        else{redirect('admin/people');}
        
    }

    public function add($user_id = null)
    {
        if($user_id!="")
        {
            $form = $this->form_builder->create_form('','enctype= multipart/form-data', 'class="form-horizontal"','id="reservation_types_list"');
            $this->mViewData['form'] = $form;

            $this->db->order_by('id', 'ASC');		
            $query = $this->db->get('guest_types');       
            $guest_types = $query->result_array();	

            if ($this->input->method() === 'post') {               

                $cancel = $this->input->post('cancel');
                if(!$cancel)
                {
                    $this->db->trans_start();
                    $data = array(
                        'user_id' => $user_id,
                        'guest_type' => $this->input->post('guestType'),
                        'name' => $this->input->post('name'),
                        'birth_date' => $this->input->post('birthDate'),
                        'home_address_1' => $this->input->post('addressLine1'),
                        'home_address_2' => $this->input->post('addressLine2'),
                        'home_city' => $this->input->post('city'),
                        'home_state' => $this->input->post('addressState'),
                        'home_zipcode' => $this->input->post('zipCode'),
                        'phone' => $this->input->post('phone'),
                        'cell_phone' => $this->input->post('cellPhone'),
                        'email ' => $this->input->post('email'),
                        'secondary_email' => $this->input->post('secondaryEmail')
                       
                    );
                    $this->db->set($data);
                    $this->db->insert('users_guests');
                    $insert_id = $this->db->insert_id();
                    $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE)
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);
                    redirect('admin/user-guests/lists/'.$user_id);
                }
                else
                {
                    $msg = "<strong>Success!</strong> Guest Information added successfully.";
                    $this->system_message->set_success($msg);
                    redirect('admin/user-guests/lists/'.$user_id);
                }
            }
            redirect('admin/user-guests/lists/'.$user_id);
        }

            $this->mViewData['guest_types']=$guest_types;   
            $this->mPageTitle = 'Guests';		
            $this->render('custom/guest/user-guests-add', 'with_breadcrumb');
        }
        else
        {
            $this->mPageTitle = '404 Page Not Found';
            $this->render('errors/custom/error_404', 'full_width');
        }
    }

    public function edit($users_guests_id = null)
    {
        if($users_guests_id!=null)
        {
            $form = $this->form_builder->create_form('','enctype= multipart/form-data', 'class="form-horizontal"','id="reservation_types_list"');
            $this->mViewData['form'] = $form;
           

            $this->db->where('id', $users_guests_id);		
            $query = $this->db->get('users_guests');       
            $users_guests = $query->result_array();
            $user_id = $users_guests[0]['user_id'];

            $this->db->order_by('id', 'ASC');		
            $query = $this->db->get('guest_types');       
            $guest_types = $query->result_array();	


            if ($this->input->method() === 'post') {               

                $cancel = $this->input->post('cancel');
                if(!$cancel)
                {
                    $this->db->trans_start();
                    $data = array(
                        'user_id' => $user_id,
                        'guest_type' => $this->input->post('guestType'),
                        'name' => $this->input->post('name'),
                        'birth_date' => $this->input->post('birthDate'),
                        'home_address_1' => $this->input->post('addressLine1'),
                        'home_address_2' => $this->input->post('addressLine2'),
                        'home_city' => $this->input->post('city'),
                        'home_state' => $this->input->post('addressState'),
                        'home_zipcode' => $this->input->post('zipCode'),
                        'phone' => $this->input->post('phone'),
                        'cell_phone' => $this->input->post('cellPhone'),
                        'email ' => $this->input->post('email'),
                        'secondary_email' => $this->input->post('secondaryEmail')
                       
                    );
                    $this->db->where('id', $users_guests_id);
                    $this->db->update('users_guests', $data);

                    $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE)
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);
                    redirect('admin/user-guests/lists/'.$user_id);
                }
                else
                {
                    $msg = "<strong>Success!</strong> Guest Information added successfully.";
                    $this->system_message->set_success($msg);
                    redirect('admin/user-guests/lists/'.$user_id);
                }
            }
            redirect('admin/user-guests/lists/'.$user_id);
        }
            $this->mViewData['users_guests']=$users_guests;   
            $this->mViewData['guest_types']=$guest_types;
           
            $this->mPageTitle = 'Guests';		
            $this->render('custom/guest/user-guests-edit', 'with_breadcrumb');           
        }
        else
        {
            $this->mPageTitle = '404 Page Not Found';
            $this->render('errors/custom/error_404', 'full_width');
        }
    }

    public function remove($users_guests_id,$user_id)
    {
        $this->db->set('status', '0');
        $this->db->where('id', $users_guests_id);
        $this->db->update('users_guests');
        //print("<pre>".print_r($users_guests_id,true)."</pre>"); 
       // echo "CONT => Pending...";
       
       $msg = "<strong>Success!</strong> Guest Information deleted successfully.";
       $this->system_message->set_success($msg);
       redirect('admin/user-guests/lists/'.$user_id);
    }
}
?>