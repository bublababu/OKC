<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Home page

 */

class Brag_board_photos extends MY_Controller {



	public function index()

	{
        $this->db->where('slug','brag-board-photos');
		$query = $this->db->get('content_pages');
	     

		$data['users']=$query->result_array();

		$this->mViewData['users']=$data['users'];

		$this->mPageTitlePostfix=' - Sportsman’s Hunting Club';

		$this->mPageTitle='Photos';

		$this->render('frontend/brag_board_2010', 'with_breadcrumb');		

	}

}

