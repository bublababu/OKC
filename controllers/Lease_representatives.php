<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Lease_representatives extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');  
        $this->load->helper('url');
        if(!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('account/login', 'refresh');
        }
    }
	
    public function index()
    {
        $this->db->where('slug', 'lease-representatives');
        $query = $this->db->get('content_pages');
        $data['users'] = $query->result_array();
        $this->mViewData['users'] = $data['users'];

        $this->mPageTitlePostfix = ' - Sportsman’s Hunting Club';
        $this->mPageTitle = 'Lease Representatives';
        $this->render('frontend/lease_representatives', 'with_breadcrumb');
    }
}
