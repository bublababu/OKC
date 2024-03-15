<?php 

class Hunting_rules_model extends CI_Model {

	public function get_content()
	{		
		$this->db->where('slug','hunting-rules');
		$query = $this->db->get('content_pages');
		return $query->result_array();
	}
}
?>