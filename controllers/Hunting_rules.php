<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Home page

 */

class Hunting_rules extends MY_Controller {



	public function index()

	{

		$this->load->model('Hunting_rules_model','HuntingRules');

		$data['users']=$this->HuntingRules->get_content();

		$this->mViewData['users']=$data['users'];

		$this->mPageTitlePostfix=' - Sportsman’s Hunting Club';

		$this->mPageTitle='Hunting Rules';

		$this->render('frontend/Hunting_rules', 'with_breadcrumb');		

	}

}

