<?php 

class Lodge_model extends CI_Model {

	public function get_lodgeReservationList($limit,$offset,$startDate="",$endDate="",$status="",$lodge="",$search="")
	{
      if($status!="all" && $status!="" )
      {
              $this->db->where('reservation_status',$status); 
      }
      if($lodge!="all" && $lodge!="" )
      {
              $this->db->where('lodge_id',$lodge); 
      }    
      if($search!="")
      {
              $this->db->group_start();
              $this->db->like('lodge_reservations.id', $search);
              $this->db->or_like('lodge_reservations.start_date', $search);
              $this->db->or_like('lodge_reservations.end_date', $search);
              $this->db->or_like('user.first_name', $search);
              $this->db->or_like('user.last_name', $search);
              $this->db->or_like("CONCAT( user.first_name,  ' ', user.last_name )", $search);             
              $this->db->or_like('user.badge', $search);
              $this->db->group_end();       
      }                
      $this->db->select('lodge_reservations.*, user.first_name,user.last_name, user.badge');
      $this->db->from('lodge_reservations');
      $this->db->join('user', 'user.user_id = lodge_reservations.user_id');
			//$this->db->where('lodge_reservations.start_date >=',$startDate); 
      //$this->db->where('lodge_reservations.end_date <=',$endDate); 
      if($startDate!='2015-01-01')
      {
        $this->db->where("((lodge_reservations.start_date BETWEEN '$startDate' AND '$endDate')");
        $this->db->or_where("(lodge_reservations.end_date BETWEEN '$startDate' AND '$endDate')");
        $this->db->or_where("(lodge_reservations.start_date <= '$startDate' AND lodge_reservations.end_date >= '$endDate'))"); 
      }
			$this->db->limit($limit,$offset);  
      $this->db->order_by('lodge_reservations.start_date','desc');
			$query = $this->db->get();
            
      return $query->result_array(); 
	}

  public function num_rows($startDate="",$endDate="",$status="",$lodge="",$search="")
  {
    if($status!="all" && $status!="" )
    {
            $this->db->where('reservation_status',$status); 
    } 
    if($lodge!="all" && $lodge!="" )
      {
              $this->db->where('lodge_id',$lodge); 
      } 
      if($search!="")
      {
        $this->db->group_start();
        $this->db->like('lodge_reservations.id', $search);
        $this->db->or_like('lodge_reservations.start_date', $search);
        $this->db->or_like('lodge_reservations.end_date', $search);
        $this->db->or_like('user.first_name', $search);
        $this->db->or_like('user.last_name', $search);
        $this->db->or_like("CONCAT( user.first_name,  ' ', user.last_name )", $search);             
        $this->db->or_like('user.badge', $search);
        $this->db->group_end();          
      }   
    $this->db->select('lodge_reservations.*, user.first_name,user.last_name, user.badge');
    $this->db->from('lodge_reservations');
    $this->db->join('user', 'user.user_id = lodge_reservations.user_id');
	 // $this->db->where('lodge_reservations.start_date >=',$startDate); 
    //$this->db->where('lodge_reservations.end_date <=',$endDate); 
    if($startDate!='2015-01-01')
    {
      $this->db->where("((lodge_reservations.start_date BETWEEN '$startDate' AND '$endDate')");
      $this->db->or_where("(lodge_reservations.end_date BETWEEN '$startDate' AND '$endDate')");
      $this->db->or_where("(lodge_reservations.start_date <= '$startDate' AND lodge_reservations.end_date >= '$endDate'))"); 
    }
		$this->db->order_by('lodge_reservations.start_date','desc');
		$query = $this->db->get();
    
    return $query->num_rows(); 

  }
}
?>