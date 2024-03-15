<?php 
class Common_model extends CI_Model
{
	function getRecord($table,$field_value,$where="")
	{
		try {
			$this->db->select($field_value); 
			$this->db->from($table);
			if(is_array($where) || !empty($where)){
				$this->db->where($where);
			}
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			$getRecordData = $query->row_array();
			return $getRecordData;
		} catch (Exception $e) {
			return false;
		}
	}
	
	function getAllRecord($table,$field_value,$where="",$order_by="",$start_record="",$show_record="")
	{
		try {
			$this->db->select($field_value); 
			
			$this->db->from($table);
			if(is_array($where) || !empty($where)){
				$this->db->where($where);
			}
			if(!empty($order_by)){
				$this->db->order_by($order_by);
			}
			if(!empty($start_record) && !empty($show_record)){
				$this->db->limit($show_record, $start_record);
			}elseif(!empty($show_record)){
				$this->db->limit($show_record);
			}
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			$getAllRecordData = array();
			$i = 0;
			foreach($query->result_array() as $data) {
				$getAllRecordData[$i++]=$data;
			}
			return $getAllRecordData;
		
		} catch (Exception $e) {
			return false;
		}
	}
	
	function addRecord($table,$field_value)
	{
		try {
			$query = $this->db->insert($table, $field_value); 
			//echo $this->db->last_query();exit;
			return $this->db->insert_id();
		} catch (Exception $e) {
			return false;
		}
	}
	
	function editRecord($table,$field_value,$where="")
	{
		try {
			if(is_array($where) || !empty($where)){
				$this->db->where($where);
			}
			$query = $this->db->update($table, $field_value); 
			//echo $this->db->last_query();exit;
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	
	function deleteRecord($table,$where="")
	{
		try {
			if(is_array($where) || !empty($where)){
				$this->db->where($where);
			}
			$this->db->delete($table); 
			//echo $this->db->last_query();exit;
			$is_deleted = $this->db->affected_rows();
			return $is_deleted;
		} catch (Exception $e) {
			return false;
		}
	}
	

}