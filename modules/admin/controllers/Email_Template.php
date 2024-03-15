<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Email_Template extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
    }

    // Frontend User CRUD
    public function index()
    {
        $crud = $this->generate_crud('email_template');
        $crud->columns('id', 'title', 'subject','body');
        //$crud->unset_add();
        $crud->unset_delete();
       // $crud->set_field_upload('file_name', 'uploads/ppt');
        $crud->required_fields('title','subject','body');
        $this->mPageTitle = 'Email Template';
        $this->render_crud();
    }
   
}
?>
