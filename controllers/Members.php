<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Home page

 */

class Members extends MY_Controller {



	public function index()

	{
		$this->load->model('admin/Users_model','users');
		$users=$this->users->get_usersList(0,0,"","",""); 
		//print("<pre>".print_r($users,true)."</pre>");   
		$this->mViewData['users']=$users; 
        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';

		$this->mPageTitle='Members';

		$this->render('frontend/Members', 'with_breadcrumb');	

	}
    
}

