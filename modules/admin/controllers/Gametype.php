<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Gametype extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

    // Frontend User CRUD
    public function index()
	{
        $crud = $this->generate_crud('game_types');
		$crud->columns('name', 'active');
		$crud->order_by('name','ASC');
		$_COOKIE['customclass']='gametypes';

        	// disable direct create / delete Frontend User
	//	$crud->unset_add();
	//	$crud->unset_delete();

		$this->mPageTitle = 'Game Type';
		$this->render_crud();
    }
    
    
    

    // Create Frontend User
	public function create()
	{
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$event_title = $this->input->post('event_title');
			$event_date = $this->input->post('event_date');
			$event_body = $this->input->post('event_body');		
			// [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
			$this->ion_auth_model->tables = array(
				'event_title'				=> 'event_title',
				'event_date'			=> 'event_date',
				'event_body'		=> 'event_body',				
			);

			// proceed to create user
			$user_id = $this->ion_auth->register($event_title, $event_date, $event_body);			
			if ($user_id)
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);

				// directly activate user
				$this->ion_auth->activate($user_id);
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			refresh();
		}

		// get list of Frontend user groups
		$this->load->model('group_model', 'groups');
		$this->mViewData['groups'] = $this->groups->get_all();
		$this->mPageTitle = 'Create User';

		$this->mViewData['form'] = $form;
		$this->render('event/create');
	}
}
?>