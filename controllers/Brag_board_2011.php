<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Home page

 */

class Brag_board_2011 extends MY_Controller {



	public function index()

	{
        $this->db->where('slug','brag-board-2011');
		$query = $this->db->get('content_pages');
	     

		$data['users']=$query->result_array();

		$this->mViewData['users']=$data['users'];

		$this->mPageTitlePostfix=' - Sportsman’s Hunting Club';

		$this->mPageTitle='Brag Board 2011';

		$this->render('frontend/brag_board_2011', 'with_breadcrumb');		

	}

}

