<?php

class User_model extends MY_Model
{

	public function reservision_eligibility($user_id = NULL, $BookDays = NULL) //31-10-2023 ($user_id = NULL, $BookDate = NULL, $activityId = NULL)
	{
		/// check active user ////

		$allowBookCount = 3;
		// First day of the month.
		//$firstDay= date('Y-m-01', strtotime($BookDate)); //Turn off 12.10.2022
		// Last day of the month.
		// $lastday= date('Y-m-t', strtotime($BookDate)); //Turn off 12.10.2022

		$this->db->where('allow_reservations', 1);
		$this->db->where('state', 1);
		$this->db->where('user_id', $user_id);
		$this->db->select('count(*) AS total');
		$this->db->from('user');
		$query = $this->db->get();
		$userData = $query->result_array();

		if ($userData[0]['total'] == 0) {
			return 1;
		}

		//// GET reservation count ////////////



		// $this->db->where("start_date BETWEEN '$firstDay' AND '$lastday'"); //Turn off 12.10.2022

		/* ///######### Turn off 31.10.2023 as per conversation REFF SKYPE PROJECT 31.10.2023 ##########//
		$this->db->where('user_id', $user_id);
		$this->db->where('reservation_type_id', $activityId);
		$this->db->where('reservation_status', 'active');
		$this->db->where('early_end IS NULL');
		$this->db->where('draw_hunt', '0'); //Added 11.10.2022
		$this->db->select('count(*) AS count');
		$this->db->from('reservations');
		$query = $this->db->get();
		$revData = $query->result_array();

		if ($revData[0]['count'] >= $allowBookCount) {
			return 0;
		}
		*/

		$this->db->where('user_id', $user_id);
		$this->db->where('reservation_type_id NOT IN (38,39,40)');
		$this->db->where('reservation_status', 'active');
		$this->db->where('early_end IS NULL');
		$this->db->where('start_date >= CURDATE()'); 
		$this->db->where('draw_hunt', '0');
		$this->db->select('SUM(DATEDIFF(end_date,start_date)+1) as daydiffer');
		$this->db->from('reservations');
		$query = $this->db->get();
		$revData = $query->result_array();

		$totalRevDay = $revData[0]['daydiffer'] + $BookDays;

		//print("<pre>".print_r($totalRevDay,true)."</pre>"); exit;
		if ($totalRevDay > $allowBookCount) {
			return 0;
		} else {
			return 1;
		}
	}

	public function lodge_book_eligibility($user_id = NULL, $BookDate = NULL)
	{

		$allowBookCount = 3;
		// First day of the month.
		$firstDay = date('Y-m-01', strtotime($BookDate));
		// Last day of the month.
		$lastday = date('Y-m-t', strtotime($BookDate));


		$this->db->where('allow_reservations', 1);
		$this->db->where('state', 1);
		$this->db->where('user_id', $user_id);
		$this->db->select('count(*) AS total');
		$this->db->from('user');
		$query = $this->db->get();
		$userData = $query->result_array();

		if ($userData[0]['total'] == 0) {
			return 0;
		}


		$this->db->where("start_date BETWEEN '$firstDay' AND '$lastday'");
		$this->db->where('reservation_status', 'active');
		$this->db->where('user_id', $user_id);
		$this->db->group_by('start_date');
		//$this->db->where('end_date<=',$lastday); // Need to clarify from client
		//$this->db->where($where);

		$this->db->select('start_date');
		$this->db->from('lodge_reservations');
		$query = $this->db->get();
		$lodgeData = $query->result_array();

		if (count($lodgeData) >= $allowBookCount) {
			return 0;
		}

		return 1;
	}
}
