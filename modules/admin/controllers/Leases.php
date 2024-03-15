<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Leases extends Admin_Controller{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    // Frontend User CRUD
    public function index()
	{
       // $crud = $this->generate_crud('leases');
       $query = $this->db->get('leases');       
       $data['leases'] = $query->result_array();	
	    $this->mViewData['leases']=$data['leases'];		
		$_COOKIE['customclass']='leases';        
       // $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle = 'Leases';		
        $this->render('custom/leases/leases-list', 'with_breadcrumb');	
    }

    public function add()
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','','class="email" id="myform"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {
            $name = $this->input->post('name');
            $location_address_1 = $this->input->post('addressLine1'); 
            $location_address_2  = $this->input->post('addressLine2'); 
            $location_city = $this->input->post('city'); 
            $location_state  = $this->input->post('state'); 
            $location_zipcode = $this->input->post('zip'); 
            $latitude = $this->input->post('latitude'); 
            $longitude = $this->input->post('longitude'); 
            $active = $this->input->post('active1'); 
            $expiration_date = $this->input->post('ExpirationDate'); 
            $location_description = $this->input->post('loc-desc'); 
            $land_description = $this->input->post('land-desc'); 
            $game_description = $this->input->post('game-desc'); 
            $rules_description = $this->input->post('spl-rule-desc'); 
            $hunter_description  = $this->input->post('max-hunt-desc'); 
            $max_hunters = $this->input->post('maxHunters'); 
            $lease_created_on = date('Y-m-d H:i:s');
            $lease_updated_on = date('Y-m-d H:i:s');

            $save['name'] = $name;
            $save['location_address_1'] = $location_address_1;
            $save['location_address_2'] = $location_address_2 ;
            $save['location_city'] = $location_city;
            $save['location_state'] = $location_state;
            $save['location_zipcode'] = $location_zipcode;
            $save['latitude'] = $latitude;
            $save['longitude'] = $longitude;
            $save['active'] = $active;
            $save['expiration_date'] = $expiration_date;
            $save['location_description'] = $location_description;
            $save['land_description'] = $land_description;
            $save['game_description'] = $game_description;
            $save['rules_description'] = $rules_description;
            $save['hunter_description'] = $hunter_description;
            $save['max_hunters'] = $max_hunters;
            $save['lease_created_on'] = $lease_created_on;
            $save['lease_updated_on'] = $lease_updated_on;

            $insert_save_details_id = $this->common_model->addRecord('leases', $save);

            if( $insert_save_details_id > 0)
            {
                $msg = "<strong>Success!</strong> Lease Information saved successfully.";
                $this->system_message->set_success($msg);
                refresh();

            }
            else
            {
                $errors = "something went wrong please try again...";
                $this->system_message->set_error($errors); 
                refresh();
            }
        }

        $this->mPageTitle = 'Leases';		
        $this->render('custom/leases/leases-add', 'with_breadcrumb');	

    }


    public function edit($lease_id)
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('common_model');
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form('','','class="email" id="myform"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {
            $name = $this->input->post('name');
            $location_address_1 = $this->input->post('addressLine1'); 
            $location_address_2  = $this->input->post('addressLine2'); 
            $location_city = $this->input->post('city'); 
            $location_state  = $this->input->post('state'); 
            $location_zipcode = $this->input->post('zip'); 
            $latitude = $this->input->post('latitude'); 
            $longitude = $this->input->post('longitude'); 
            $active = $this->input->post('active1'); 
            $expiration_date = $this->input->post('ExpirationDate'); 
            $location_description = $this->input->post('loc-desc'); 
            $land_description = $this->input->post('land-desc'); 
            $game_description = $this->input->post('game-desc'); 
            $rules_description = $this->input->post('spl-rule-desc'); 
            $hunter_description  = $this->input->post('max-hunt-desc'); 
            $max_hunters = $this->input->post('maxHunters'); 
            $lease_updated_on = date('Y-m-d H:i:s');

            $save2['name'] = $name;
            $save2['location_address_1'] = $location_address_1;
            $save2['location_address_2'] = $location_address_2 ;
            $save2['location_city'] = $location_city;
            $save2['location_state'] = $location_state;
            $save2['location_zipcode'] = $location_zipcode;
            $save2['latitude'] = $latitude;
            $save2['longitude'] = $longitude;
            $save2['active'] = $active;
            $save2['expiration_date'] = $expiration_date;
            $save2['location_description'] = $location_description;
            $save2['land_description'] = $land_description;
            $save2['game_description'] = $game_description;
            $save2['rules_description'] = $rules_description;
            $save2['hunter_description'] = $hunter_description;
            $save2['max_hunters'] = $max_hunters;
            $save2['lease_updated_on'] = $lease_updated_on;
            $where2 = array('id' => $lease_id);
            $upate_id = $this->common_model->editRecord('leases', $save2, $where2); 
           //print_r($upate_id);
            if($upate_id > 0)
            {
                $where3 = array('lease_id' => $lease_id);
		        $delete_id=$this->common_model->deleteRecord('lease_reservation_types',$where3);
               
                    $reservationTypes = $this->input->post('hd_reservationTypes'); 
                    $dataReservationTypes = json_decode($reservationTypes, TRUE);
                // print("<pre>".print_r($dataReservationTypes,true)."</pre>");  
                    foreach($dataReservationTypes as $data)
                    {
                        $TypeId=$data['TypeId'];
                        $MaxHunters=$data['MaxHunters'];
                        $save_details['lease_id'] = $lease_id;
                        $save_details['reservation_type_id'] = $TypeId;
                        $save_details['max_hunters'] = $MaxHunters;               
                        $insert_save_details_id = $this->common_model->addRecord('lease_reservation_types', $save_details);
                    }
                
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
        };



        $this->db->where('id',$lease_id);
        $query = $this->db->get('leases');       
        $data['leases'] = $query->result_array();
        $this->mViewData['leases']=$data['leases'];	

        $this->db->where('active','1');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('reservation_types');       
        $data['reserv_types'] = $query->result_array();       	
	   	$this->mViewData['reserv_types']=$data['reserv_types'];	
         
       // $this->db->order_by('name', 'ASC');
        $this->db->where('lease_id',$lease_id);
        $query = $this->db->get('lease_reservation_types');       
        $data['lease_reserv_types'] = $query->result_array();  
       // print_r($query);
       // print("<pre>".print_r($query,true)."</pre>");  	
        $this->mViewData['lease_reserv_types']=$data['lease_reserv_types'];	 

       // $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';		
        $this->mPageTitle = 'Leases';		
        $this->render('custom/leases/leases-edit', 'with_breadcrumb');	
    }

    public function remove($lease_id)
    {
        print_r($lease_id);
       // $this->mPageTitle = 'Leases';		
       // $this->render('custom/leases/leases-edit', 'with_breadcrumb');	
    }
}
?>