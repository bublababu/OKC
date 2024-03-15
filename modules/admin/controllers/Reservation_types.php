<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Reservation_types extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    public function index()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="reservation_types_list"');
        $this->mViewData['form'] = $form;

        $this->db->order_by('name','asc');             	
        $query = $this->db->get('reservation_types');       
        $reservation_types = $query->result_array(); 

        //print("<pre>".print_r($reservation_types,true)."</pre>");

        $this->mViewData['reservation_types']=$reservation_types;  

        $this->mPageTitle = 'Reservation types';		
        $this->render('custom/reservation/reservation-types-list', 'with_breadcrumb');	
    }

    public function add()
    {
        $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="reservation_types_add"');
        $this->mViewData['form'] = $form;

        $this->db->order_by('name','asc'); 
        $this->db->where('active','1');             	
        $query = $this->db->get('game_types');       
        $game_types = $query->result_array(); 

        if ($this->input->method() === 'post') {

            $name= $this->input->post('name');
            $StartDate= $this->input->post('StartDate');
            $EndDate= $this->input->post('EndDate');
            $Max_Days= $this->input->post('Max_Days');
            $active= $this->input->post('active');
            $Reservation_Spot= $this->input->post('Reservation_Spot');

            $game_types= $this->input->post('game_type');
           // print("<pre>".print_r($game_types,true)."</pre>");
            $cancel = $this->input->post('cancel');
           
            if(!$cancel)
            {
                $this->db->trans_start();
                $data = array(
                    'name' => $name,
                    'start_date' => $StartDate,
                    'end_date' => $EndDate,
                    'max_days' => $Max_Days,
                    'active' => $active,
                    'use_reservation_spot' => $Reservation_Spot
                );
            
                $this->db->set($data);
                $this->db->insert('reservation_types');
                $insert_id = $this->db->insert_id();
                foreach($game_types as $game_type)
                {
                    $data2 = array(
                        'reservation_type_id' => $insert_id,
                        'game_type_id' => $game_type                       
                    );
                
                    $this->db->set($data2);
                    $this->db->insert('reservation_game_types');
                }

                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE)
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);
                }
                else
                {
                    $msg = "<strong>Success!</strong> Reservation Type Information added successfully.";
                    $this->system_message->set_success($msg);
                }
               
            }
            redirect('admin/reservation-types');
        }      

        $this->mViewData['game_types']=$game_types;  
        $this->mPageTitle = 'Reservation types';		
        $this->render('custom/reservation/reservation-types-add', 'with_breadcrumb');	
    }

    public function edit($reservation_types_id = null)
    {
        if($reservation_types_id!=null)
        {
            $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="reservation_types_edit"');
            $this->mViewData['form'] = $form;

            $this->db->order_by('name','asc'); 
            $this->db->where('active','1');             	
            $query = $this->db->get('game_types');       
            $game_types = $query->result_array(); 

            $this->db->where('reservation_type_id',$reservation_types_id);             	
            $query = $this->db->get('reservation_game_types');       
            $reservation_game_types = $query->result_array(); 
        
            $this->db->where('id',$reservation_types_id);             	
            $query = $this->db->get('reservation_types');       
            $reservation_types = $query->result_array(); 

            if(!empty($reservation_types))
            {
              
                if ($this->input->method() === 'post') {

                    $name= $this->input->post('name');
                    $StartDate= $this->input->post('StartDate');
                    $EndDate= $this->input->post('EndDate');
                    $Max_Days= $this->input->post('Max_Days');
                    $active= $this->input->post('active');
                    $Reservation_Spot= $this->input->post('Reservation_Spot');
        
                    $game_types= $this->input->post('game_type');
                    //print("<pre>".print_r($game_types,true)."</pre>");
                    $cancel = $this->input->post('cancel');

                    if(!$cancel)
                    {
                        $this->db->trans_start();
                        $data = array(
                            'name' => $name,
                            'start_date' => $StartDate,
                            'end_date' => $EndDate,
                            'max_days' => $Max_Days,
                            'active' => $active,
                            'use_reservation_spot' => $Reservation_Spot
                        );
                    
                        $this->db->where('id', $reservation_types_id);
                        $this->db->update('reservation_types', $data);

                        $this->db->where('reservation_type_id', $reservation_types_id);
                        $this->db->delete('reservation_game_types');

                        foreach($game_types as $game_type)
                        {
                            $data2 = array(
                                'reservation_type_id' => $reservation_types_id,
                                'game_type_id' => $game_type                       
                            );
                        
                            $this->db->set($data2);
                            $this->db->insert('reservation_game_types');
                        }

                        $this->db->trans_complete();
                        
                        if ($this->db->trans_status() === FALSE)
                        {
                            $msg = "<strong>Error!</strong> Something went wrong please try again...";
                            $this->system_message->set_error($msg);
                        }
                        else
                        {
                            $msg = "<strong>Success!</strong> Reservation Type Information updated successfully.";
                            $this->system_message->set_success($msg);
                        }
                    
                    }
                    redirect('admin/reservation-types');
                }

                $this->mViewData['reservation_game_types']=$reservation_game_types;  
                $this->mViewData['reservation_types']=$reservation_types;  
                $this->mViewData['game_types']=$game_types;  
                $this->mPageTitle = 'Reservation types';		
                $this->render('custom/reservation/reservation-types-edit', 'with_breadcrumb');	
            }
            else
            {
                redirect('admin/reservation-types');
            }
        }
        else
        {
            redirect('admin/reservation-types');
        }
    }

    public function remove($reservation_types_id)
    {
        print("<pre>".print_r($reservation_types_id,true)."</pre>"); 
        echo "CONT => Pending...";
    }
}
?>