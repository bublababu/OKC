<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {

	public function index()
	{
		$this->load->model('FrontHome_model','home');
		$data['users']=$this->home->get_content();
		$this->mViewData['users']=$data['users'];
		$this->mPageTitle='Home - Sportsman’s Hunting Club';
		$this->render('frontend/home', 'full_width');		
	}
}
