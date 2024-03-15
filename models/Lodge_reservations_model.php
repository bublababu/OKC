<?php 
class Lodge_reservations_model extends CI_Model {

	public function get_lodges()
	{			
		$query = $this->db->get('lodges');
		return $query->result_array();
	}

    public function get_lodge_byid($lodgeId)
	{
        $this->db->where('id',$lodgeId);			
		$query = $this->db->get('lodges');
		return $query->result_array();
	}
}

?>