<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Lodge_reservations extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}
    
    
      public function index()
    {
        $this->load->model('Lodge_model','lodge');
        $this->load->library('pagination');

       //CREATE CI FROM FROM FORM BUILER START
       $form = $this->form_builder->create_form('','enctype= multipart/form-data','id="lodge_reservations_list"');
       $this->mViewData['form'] = $form;
       //CREATE CI FROM FROM FORM BUILER END

       //SEND CONTROLLER NAME TO VIEW PAGE START
       $this->mViewData['controller'] = $this;
       //SEND CONTROLLER NAME TO VIEW PAGE END

       
        //SEARCH POSTBACK START
        if ($this->input->method() === 'post') 
        {
            $search= $this->input->post('search');            
            $count=$this->input->post('count');           
            redirect('admin/lodge-reservations?startDate=2015-01-01&endDate=2015-01-01&count='.$count.'&search='.$search);
        }
        //SEARCH POSTBACK END
 
        //GET VALUE FROM URL PARAMETERS START      
        $per_page=$this->input->get('count', TRUE);
        $startDate=$this->input->get('startDate', TRUE); 
        if($startDate=="")
        {
            $startDate=date('Y-m-01');
        }
        $endDate=$this->input->get('endDate', TRUE); 
        if($endDate=="")
        {
            $endDate = date('Y-m-t');
        }
        
         $status=$this->input->get('status', TRUE); 
         $lodge=$this->input->get('lodge', TRUE);
         $search=$this->input->get('search', TRUE);
        //GET VALUE FROM URL PARAMETERS END

        //GET TOTAL ROW FROM FROM MODEL FN START 
         $total_row = $this->lodge->num_rows($startDate,$endDate,$status,$lodge,$search);      
        //GET TOTAL ROW FROM FROM MODEL FN END 

        //SET DEFAULT PER PAGE ROWS START 
        if($per_page=="")
        {
            $per_page=25;
        }
        //SET DEFAULT PER PAGE ROWS END
        
        //PAGINATION CONFIGARATION START   
        $config=[
            'base_url' => base_url('admin/lodge-reservations'),
            'per_page' => $per_page,
            'total_rows' =>  $total_row,

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
      
    
        //CALCULATION OF OFFSET VALUE FROM PAGE NO START
        $offset=$this->input->get('p', TRUE);    
        $page = ($offset) ? ($offset * $config["per_page"]) - $config["per_page"] : 0;   
        //CALCULATION OF OFFSET VALUE FROM PAGE NO END
       
        //GET DATA FROM MODEL AS PER CONFIGARATION START
        $reservations=$this->lodge->get_lodgeReservationList($config['per_page'],$page,$startDate,$endDate,$status,$lodge,$search);
       //GET DATA FROM MODEL AS PER CONFIGARATION START

        //print("<pre>".print_r($reservations,true)."</pre>");
         //VALUES SEND TO THE VIEW PAGE
          //FOR URL CONFIGARATION START
          $this->mViewData['reservations']=$reservations; 
          $this->mViewData['total_row']=$total_row;
          $this->mViewData['offset']=$offset;  
          //FOR URL CONFIGARATION END 
          $this->mViewData['per_page']=$per_page; 
          $this->mViewData['count_from']=$page; 

          $this->mViewData['startDate']=$startDate; 
          $this->mViewData['endDate']=$endDate; 

          $this->mViewData['status']=$status; 
          $this->mViewData['lodge']=$lodge; 
          $this->mViewData['search']=$search;   
        ////VALUES SEND TO THE VIEW PAGE//
        
        $this->mPageTitle = 'Lodge Reservations';		
        $this->render('custom/lodge_reservations/reservations-list', 'with_breadcrumb');	
    }
    
    public function lodgelist()
	{
        $this->db->select('*');
        $this->db->order_by('name','asc');
        $this->db->from('lodges');
        $query = $this->db->get();
        $query->result_array(); 
        return $query->result_array();	
	}

      public function add()
    {
        $form = $this->form_builder->create_form('admin/lodge_reservations/select','enctype= multipart/form-data','class="form-horizontal" id="lodge_add"');
        $this->mViewData['form'] = $form;

        $this->db->order_by('last_name','asc');             	
        $query = $this->db->get('user');       
        $users = $query->result_array(); 

        $this->db->order_by('name','asc');             	
        $query = $this->db->get('lodges');       
        $lodges = $query->result_array(); 
        
        
       // print("<pre>".print_r($users,true)."</pre>");
        $this->mViewData['users']=$users; 
        $this->mViewData['lodges']=$lodges; 
        $this->mPageTitle = 'Reservation Information';		
        $this->render('custom/lodge_reservations/reservations-add', 'with_breadcrumb');	
    }
    
    
	public function select()
	{
		$form = $this->form_builder->create_form('admin/lodge_reservations/lodge_reservations_save','class="form-horizontal"','id="lodge_add"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') { 
            $cancel = $this->input->post('cancel');
            if(!$cancel)
            {
                $user_id = $this->input->post('user');
                $lodge_id = $this->input->post('lodge');
                $startDate = $this->input->post('startDate');        
                $days = $this->input->post('days');
                $days=$days-1;
                $end_date = date('Y-m-d', strtotime($startDate. ' + '.$days.' days'));
             
            }
            else
            {
                redirect('admin/lodge-reservations', 'refresh');
            }
        }

		$bedId=array();
		$this->load->model('Bedavailable_model','bedavailable');
        $bedId=$this->bedavailable->get_bed($lodge_id,$startDate,$end_date); 
		//print("<pre>".print_r($lodge_id,true)."</pre>");
		//print_r();
		$this->mViewData['lodgeName'] = $this->lodge_name($lodge_id);
		 $this->mViewData['controller'] = $this;
		 $this->mViewData['bedId']=$bedId;
		 $this->mViewData['lodge_id']=$lodge_id;
		 $this->mViewData['user_id']=$user_id;
		 $this->mViewData['startDate']=$startDate; 
         $this->mViewData['endDate']=$end_date; 
         $this->mViewData['form'] = $form;
		 $this->mPageTitle = 'Reservation Information';		
         $this->render('custom/lodge_reservations/reservations-select', 'with_breadcrumb');	
		
	}
	
    public function lodge_reservations_save()
    {
        if ($this->input->method() === 'post') { 
            $cancel = $this->input->post('cancel');
            if(!$cancel)
            {
                $user_id = $this->input->post('user_id');
                $lodge_id = $this->input->post('lodge_id');
                $startDate = $this->input->post('startDate'); 
                $end_date = $this->input->post('end_date'); 
                $beds= $this->input->post('beds');

                $this->db->trans_start();
                foreach($beds as $bed)
                {
                    $data = array(
                        'user_id' => $user_id,
                        'lodge_id' => $lodge_id,
                        'bed_id' => $bed,
                        'start_date' => $startDate,
                        'end_date' =>  $end_date,
                        'reservation_status' => 'active',
                        'reservation_created_on' => date('Y-m-d H:i:s'),
                        'reservation_updated_on' => date('Y-m-d H:i:s')                   
                    );
                    $this->db->set($data);
                    $this->db->insert('lodge_reservations');
                }
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE)
                {
                    $msg = "<strong>Error!</strong> Something went wrong please try again...";
                    $this->system_message->set_error($msg);
                }
                else
                {
                    $msg = "<strong>Success!</strong> Lodge Reservations added successfully.";
                    $this->system_message->set_success($msg);
                    redirect('admin/lodge-reservations');  
                }
            }
            else
            {
                redirect('admin/lodge-reservations', 'refresh');  
            }
        }
    }
	
    
  public function reservation_users($usrid)
	{
        $this->db->where('user_id',$usrid);
       
		$this->db->select('*');
        $this->db->from('user');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
    
     public function lodge_name($lodgeid)
	{
        $this->db->where('id',$lodgeid);
       
		$this->db->select('name');
        $this->db->from('lodges');
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
    
    
    public function bedroom($bedid,$lodgeid)
	{
        // $this->db->get_compiled_select();
        $this->db->where('lodge_beds.id',$bedid);
         $this->db->join('lodge_rooms', 'lodge_rooms.id = lodge_beds.room_id');
		$this->db->select('lodge_beds.name,lodge_rooms.name as lodgename');
        $this->db->from('lodge_beds');
      
    //  echo  $this->db->last_query(); 
       
      
        $query = $this->db->get();
        $query->result_array(); 
		return $query->result_array();	
	}
    
    public function cancel($lodge_reservations_id)
    {
        $data = array(
            'reservation_status ' => 'cancel',
            'reservation_cancelled_on' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $lodge_reservations_id);
        $this->db->update('lodge_reservations', $data);

        $msg = "<strong>Success!</strong> Lodge Reservation canceled successfully.";
        $this->system_message->set_success($msg);

        redirect('admin/lodge-reservations', 'refresh');
    }

    public function trash($lodge_reservations_id)
    {
        $data = array(
            'reservation_status ' => 'trash',
            'reservation_cancelled_on' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $lodge_reservations_id);
        $this->db->update('lodge_reservations', $data);

        $msg = "<strong>Success!</strong> Lodge Reservation trashed successfully.";
        $this->system_message->set_success($msg);

        redirect('admin/lodge-reservations', 'refresh');
    }
}   
