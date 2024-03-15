<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contentpages extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	// Frontend User CRUD
	public function index()
	{
		$crud = $this->generate_crud('content_pages');
		// $crud ->set_subject('Customer');
		$crud->columns('title', 'page_author_id', 'page_updated_on');
		$crud->display_as(array('title' => 'Title', 'page_author_id' => 'Author'));
		$crud->set_relation('page_author_id', 'user', '{first_name} {last_name}');

		$crud->callback_column('title', array($this, '_callback_webpage_url'));

		$crud->add_fields('title', 'page_status', 'slug', 'page_content', 'page_published_date', 'page_created_on', 'page_updated_on', 'page_author_id');
		$crud->change_field_type('page_author_id','invisible');
		

		$crud->edit_fields('title', 'page_status', 'slug', 'page_content', 'page_updated_on', 'page_published_date');

		$crud->field_type('page_created_on', 'hidden', date('Y-m-d H:i:s'));
		$crud->field_type('page_updated_on', 'hidden', date('Y-m-d H:i:s'));
		$crud->field_type('page_published_date', 'hidden', '');
		$user_id = (int)$this->mUser->user_id;
		
		$crud->callback_add_field('page_author_id', array($this, 'add_field_callback_2'));

		$crud->field_type('page_status', 'dropdown', array('draft' => 'Draft', 'publish' => 'Publish', 'private' => 'Private'));

	
		$crud->required_fields(array('title', 'page_status', 'slug'));

		$_COOKIE['customclass'] = 'contentpage';

		// disable direct create / delete Frontend User
		//$crud->unset_add();
		//$crud->unset_delete();

		$this->mPageTitle = 'Content Pages';
		$this->render_crud();
	}
	public function _callback_webpage_url($value, $row)
	{
		return "<a target='blank' href='" . site_url('/' . $row->slug) . "'>$value</a> <span class='label label-default' style='margin-left: 10px;'>$row->page_status</span>";
	}
	function add_field_callback_2()
	{
		return '<input type="text" maxlength="50" value="'.(int)$this->mUser->user_id.'" name="page_author_id" style="width:400px">';
	}
}

?>