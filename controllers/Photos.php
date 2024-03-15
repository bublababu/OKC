<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Photos extends MY_Controller {

	public function index()
	{
		$this->load->model('Photos_model','photos');
		$data['users']=$this->photos->get_content();
		$this->mViewData['users']=$data['users'];	
		$this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='Photos';
		
		$this->render('frontend/home', 'with_breadcrumb');		
	}
}
