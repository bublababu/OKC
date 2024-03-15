<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends Admin_Controller{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}

    public function index()
	{
       // $crud = $this->generate_crud('leases');
       
		$this->mPageTitle = 'Media Files';		
        $this->render('custom/media', 'with_breadcrumb');	
    }

}

?>