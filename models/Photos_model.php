<?php 

class Photos_model extends CI_Model {

	public function get_content()
	{		
		$this->db->where('slug','photos');
		$query = $this->db->get('content_pages');
		return $query->result_array();
	}
}
?>