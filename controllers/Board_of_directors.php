<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Home page

 */

class Board_of_directors extends MY_Controller {



	public function index()

	{
        $this->db->where('slug','board-of-directors');
		$query = $this->db->get('content_pages');
	     

		$data['users']=$query->result_array();

		$this->mViewData['users']=$data['users'];

		$this->mPageTitlePostfix=' - Sportsman’s Hunting Club';

		$this->mPageTitle='Board Of Directors';

		$this->render('frontend/board_of_directors', 'with_breadcrumb');		

	}

}

