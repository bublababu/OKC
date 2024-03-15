<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Home page

 */

class Lease_Information extends MY_Controller {



	public function index()

	{

		$this->load->model('Lease_Information_model','LeaseInformation');

		$data['users']=$this->LeaseInformation->get_content();

		$this->mViewData['users']=$data['users'];

		$this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='Lease Information';

		$this->render('frontend/Lease_Information', 'with_breadcrumb');		

	}

}

