<?php

class Reservations_model extends CI_Model
{

    public function get_reservationsList($limit, $offset, $startDate = "", $endDate = "", $status = "", $gametype = "", $lease = "", $draw = "", $search = "", $user_id = "")
    {
        //print("<pre>".print_r($search,true)."</pre>");
        // $this->db->get_compiled_select();
        if ($gametype != "all" && $gametype != "") {
            $this->db->where('reservation_type_id', $gametype);
        }
        if ($draw != "all" && $draw != "") {
            $this->db->where('draw_hunt', $draw);
        }
        if ($lease != "all" && $lease != "") {
            $this->db->where('lease_id', $lease);
        }
        if ($status != "all" && $status != "") {
            $this->db->where('reservation_status', $status);
        }
        if ($user_id != "all" && $user_id != "") {
            $this->db->where('user.user_id', $user_id);
        }
        if ($search != "") {
            $this->db->group_start();
            $this->db->like('reservations.id', $search);
            $this->db->or_like('reservations.start_date', $search);
            $this->db->or_like('reservations.end_date', $search);
            $this->db->or_like('user.first_name', $search);
            $this->db->or_like('user.last_name', $search);
            $this->db->or_like("CONCAT( user.first_name,  ' ', user.last_name )", $search);
            $this->db->or_like('leases.name', $search);
            $this->db->or_like('reservation_types.name', $search);
            $this->db->or_like('user.badge', $search);
            $this->db->group_end();
        }
        // $this->db->where('reservations.start_date >=', $startDate);
        //$this->db->where('reservations.end_date <=', $endDate);
        if ($startDate != '2015-01-01') {
            $this->db->where("((reservations.start_date BETWEEN '$startDate' AND '$endDate')");
            $this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$endDate')");
            $this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$endDate'))");
        }
        $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
        $this->db->order_by('reservations.start_date', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        // print("<pre>".print_r($this->db->last_query(),true)."</pre>");
        return $query->result_array();
    }

    public function num_rows($startDate = "", $endDate = "", $status = "", $gametype = "", $lease = "", $draw = "", $search = "", $user_id = "")
    {
        if ($gametype != "all" && $gametype != "") {
            $this->db->where('reservation_type_id', $gametype);
        }
        if ($draw != "all" && $draw != "") {
            $this->db->where('draw_hunt', $draw);
        }
        if ($lease != "all" && $lease != "") {
            $this->db->where('lease_id', $lease);
        }
        if ($status != "all" && $status != "") {
            $this->db->where('reservation_status', $status);
        }
        if ($user_id != "all" && $user_id != "") {
            $this->db->where('user.user_id', $user_id);
        }
        if ($search != "") {
            $this->db->group_start();
            $this->db->like('reservations.id', $search);
            $this->db->or_like('reservations.start_date', $search);
            $this->db->or_like('reservations.end_date', $search);
            $this->db->or_like('user.first_name', $search);
            $this->db->or_like('user.last_name', $search);
            $this->db->or_like("CONCAT( user.first_name,  ' ', user.last_name )", $search);
            $this->db->or_like('leases.name', $search);
            $this->db->or_like('reservation_types.name', $search);
            $this->db->or_like('user.badge', $search);
            $this->db->group_end();
        }

        //$this->db->where('reservations.start_date >=', $startDate);
        //$this->db->where('reservations.end_date <=', $endDate);
        if ($startDate != '2015-01-01') {
            $this->db->where("((reservations.start_date BETWEEN '$startDate' AND '$endDate')");
            $this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$endDate')");
            $this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$endDate'))");
        }
        $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
        $this->db->order_by('reservations.start_date', 'desc');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_available_hunter($leseAreaId = null, $activity = null, $startDate = null)
    {
        $avilableData = 0;
        $bookedSlots = 0;
        $toDay = date('Y-m-d');
        if ($leseAreaId != null && $activity != null && $toDay != null) {

            /// Get Max hunter
            $this->db->where('lease_area_id', $leseAreaId);
            $this->db->where('reservation_type_id', $activity);
            $this->db->select('max_hunters');
            $this->db->from('lease_area_reservation_types');
            $query = $this->db->get();
            $hunterdata = $query->result_array();

            //////////////Check Booked data////////////////////
            //    $this->db->where('lease_area_id',$leseAreaId);
            //    $this->db->where('reservation_type_id',$activity);
            //    $this->db->where('start_date',$toDay);
            //    $this->db->where('reservation_status','active');
            //    $this->db->select('count(*) AS count');
            //    $this->db->from('reservations');
            //
            //    $query = $this->db->get();
            //    $bokeddata= $query->result_array();

            $this->db->where('lease_area_id', $leseAreaId);
            $this->db->where('reservation_type_id', $activity);
            $this->db->where('start_date', $startDate);
            $this->db->where('reservation_status', 'active');
            $this->db->select('id,count(*) AS count');
            $this->db->from('reservations');
            $query = $this->db->get();
            $bokeddata = $query->result_array();

            if ($startDate == $toDay) {
                //////////// check for end date
                $bookedSlots = $bookedSlots + $bokeddata[0]['count'];
                $this->db->where('lease_area_id', $leseAreaId);
                $this->db->where('reservation_type_id', $activity);
                $this->db->where('end_date', $startDate);
                $this->db->where('reservation_status', 'active');
                $this->db->select('id,count(*) AS count');
                $this->db->from('reservations');
                $query = $this->db->get();
                $bokeddata = $query->result_array();

                $bookedSlots = $bookedSlots + $bokeddata[0]['count'];

                return $hunterdata[0]['max_hunters'] - $bokeddata[0]['count'];
            }

            if ($startDate != $toDay) {
                $bookedSlots = $bookedSlots + $bokeddata[0]['count']; /// match with start date

                //////////// check for end date
                $this->db->where('lease_area_id', $leseAreaId);
                $this->db->where('reservation_type_id', $activity);
                $this->db->where('end_date', $startDate);
                $this->db->where('reservation_status', 'active');
                $this->db->select('id,count(*) AS count');
                $this->db->from('reservations');
                $query = $this->db->get();
                $bokeddata = $query->result_array();

                $bookedSlots = $bookedSlots + $bokeddata[0]['count'];

                ///////////// Check for middle date ////////////
                $this->db->where('lease_area_id', $leseAreaId);
                $this->db->where('reservation_type_id', $activity);
                $this->db->where('end_date>', $startDate);
                $this->db->where('start_date<', $startDate);
                $this->db->where('reservation_status', 'active');
                $this->db->select('id,count(*) AS count');
                $this->db->from('reservations');
                $query = $this->db->get();
                $bokeddata = $query->result_array();
                $bookedSlots = $bookedSlots + $bokeddata[0]['count'];
            }
            $avilableData = $hunterdata[0]['max_hunters'] - $bookedSlots;
        }
        return $avilableData;
    }
    public function reservation_types_isActive($reservation_types_id, $endDate)
    {
        $this->db->where('id', $reservation_types_id);
        $this->db->where('end_date>=', $endDate);
        $this->db->select('*');
        $this->db->from('reservation_types');
        $query = $this->db->get();
        $open_area = count($query->result_array());
        if (!$open_area) {
            return 0;
        } else {
            return 1;
        }
    }

    public function reservation_ishold($user_id, $leases_id, $leasesAreaId)
    {
        //$this->db->get_compiled_select();
        $this->db->where('reservations.user_id', $user_id);
        $this->db->where('leases.id', $leases_id);
        $this->db->where('reservations.lease_area_id', $leasesAreaId);
        $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
        $this->db->order_by('reservations.reservation_created_on', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->result_array();
        if (!empty($data)) {
            $status = $data[0]["reservation_status"];
            if ($status == "cancel") {
                $hour = 0;
                $hour1 = 0;
                $hour2 = 0;
                $cancel_date = new DateTime($data[0]["reservation_cancelled_on"]);
                $toDay = new DateTime(date('Y-m-d H:i:s'));
                $interval = $cancel_date->diff($toDay); // get difference between two dates
                if ($interval->format('%a') > 0) {
                    $hour1 = $interval->format('%a') * 24;
                }
                if ($interval->format('%h') > 0) {
                    $hour2 = $interval->format('%h');
                }
                // echo date('Y-m-d H:i:s');
                // echo "Difference between two dates is " . ($hour1 + $hour2) . " hours.";

                $hour = $hour1 + $hour2;
                if ($hour > 24) {
                    return 0;
                } else {
                    return 1;
                }
            }
        }
        // echo  $this->db->last_query(); 
        return 0;
    }
}
