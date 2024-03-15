<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lease_Map extends MY_Controller{

    public function index(){
        $this->db->where('active','1');
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get('leases');       
		$data['leases'] = $query->result_array();	
		$this->mViewData['leases']=$data['leases'];	

		$this->mViewData['controller'] = $this; 	
        
        $this->mPageTitlePostfix=' - Sportsman’s Hunting Club';
		$this->mPageTitle='Lease Map';
		$this->render('frontend/Lease_Map', 'with_breadcrumb');	
    }
}

?>