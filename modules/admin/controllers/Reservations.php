<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reservations extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('common_model');
    }

    public function index()
    {
        $this->load->model('Reservations_model', 'reservations');
        $this->load->library('pagination');

        //CREATE CI FROM FROM FORM BUILER START
        $form = $this->form_builder->create_form('', 'enctype= multipart/form-data', 'id="people_list"');
        $this->mViewData['form'] = $form;
        //CREATE CI FROM FROM FORM BUILER END

        //SEND CONTROLLER NAME TO VIEW PAGE START
        $this->mViewData['controller'] = $this;
        //SEND CONTROLLER NAME TO VIEW PAGE END

        //SEARCH POSTBACK START
        if ($this->input->method() === 'post') {
            $search = $this->input->post('search');
            $count = $this->input->post('count');
            redirect('admin/reservations?startDate=2015-01-01&endDate=2015-01-01&count=' . $count . '&search=' . $search);
        }
        //SEARCH POSTBACK END

        //GET VALUE FROM URL PARAMETERS START
        $per_page = $this->input->get('count', true);

        $startDate = $this->input->get('startDate', true);
        if ($startDate == "") {
            $startDate = date('Y-m-01');
        }
        $endDate = $this->input->get('endDate', true);
        if ($endDate == "") {
            $endDate = date('Y-m-t');
        }

        $status = $this->input->get('status', true);
        $lease = $this->input->get('lease', true);
        $gametype = $this->input->get('gametype', true);
        $draw = $this->input->get('draw', true);
        $search = $this->input->get('search', true);

        //GET VALUE FROM URL PARAMETERS END

        //GET TOTAL ROW FROM FROM MODEL FN START
        $total_row = $this->reservations->num_rows($startDate, $endDate, $status, $gametype, $lease, $draw, $search);
        //GET TOTAL ROW FROM FROM MODEL FN END

        //SET DEFAULT PER PAGE ROWS START
        if ($per_page == "") {
            $per_page = 25;
        }
        //SET DEFAULT PER PAGE ROWS END

        // $this->db->get_compiled_select();

        //PAGINATION CONFIGARATION START
        $config = [
            'base_url' => base_url('admin/reservations'),
            'per_page' => $per_page,
            'total_rows' => $total_row,

            'full_tag_open' => "<ul class='pagination'>",
            'full_tag_close' => "</ul>",

            'next_tag_open' => "<li>",
            'next_link' => 'Next',
            'next_tag_close' => "</li>",

            'prev_tag_open' => "<li>",
            'prev_link' => 'Previous',
            'prev_tag_close' => "</li>",

            'first_tag_open' => "<li>",
            'first_link' => 'First',
            'first_tag_close' => "</li>",

            'last_tag_open' => "<li>",
            'last_link' => 'Last',
            'first_tag_close' => "</li>",

            'num_tag_open' => "<li>",
            'num_tag_close' => "<li>",

            'cur_tag_open' => "<li class='active'><a>",
            'cur_tag_close' => "</a></li>",
            'num_links' => 10,
        ];
        //PAGINATION CONFIGARATION END

        //PAGINATION INITIALIZATION START
        $this->pagination->initialize($config);
        //PAGINATION INITIALIZATION END

        //CALCULATION OF OFFSET VALUE FROM PAGE NO START
        $offset = $this->input->get('p', true);
        $page = ($offset) ? ($offset * $config["per_page"]) - $config["per_page"] : 0;
        //CALCULATION OF OFFSET VALUE FROM PAGE NO END

        //GET DATA FROM MODEL AS PER CONFIGARATION START
        $reservations = $this->reservations->get_reservationsList($config['per_page'], $page, $startDate, $endDate, $status, $gametype, $lease, $draw, $search);
        //GET DATA FROM MODEL AS PER CONFIGARATION START

        //VALUES SEND TO THE VIEW PAGE
        $this->mViewData['reservations'] = $reservations;
        $this->mViewData['total_row'] = $total_row;
        $this->mViewData['offset'] = $offset;
        //FOR URL CONFIGARATION START
        $this->mViewData['per_page'] = $per_page;
        $this->mViewData['count_from'] = $page;

        $this->mViewData['startDate'] = $startDate;
        $this->mViewData['endDate'] = $endDate;
        $this->mViewData['status'] = $status;
        $this->mViewData['gametype'] = $gametype;
        $this->mViewData['lease'] = $lease;
        $this->mViewData['draw'] = $draw;
        $this->mViewData['search'] = $search;
        //FOR URL CONFIGARATION END
        $this->mPageTitle = 'Reservations';
        $this->render('custom/reservations/reservations-list', 'with_breadcrumb');
    }

    public function add()
    {
        $form = $this->form_builder->create_form('admin/reservations/add_calendar', 'enctype= multipart/form-data', 'id="reservations_add"');
        $this->mViewData['form'] = $form;

        $this->db->order_by('name', 'asc');
        $this->db->where('active', '1');
        $query = $this->db->get('leases');
        $leases = $query->result_array();
        $this->mViewData['leases'] = $leases;

        $this->db->order_by('first_name', 'asc');
        $this->db->where('state', '1');
        $query = $this->db->get('user');
        $users = $query->result_array();
        $this->mViewData['users'] = $users;

        // $this->mViewData['roles']=$roles;
        $this->mPageTitle = 'Reservation';
        $this->render('custom/reservations/reservations-add', 'with_breadcrumb');
    }

    public function cancel($id = null)
    {
        if (!isset($id)) {
            redirect('404');
        }
        $form = $this->form_builder->create_form('admin/reservations/cancel/' . $id, 'enctype= multipart/form-data', 'id="reservations_cancel"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {
            $submit = $this->input->post('submit');
            //print("<pre>".print_r($submit,true)."</pre>");
            //exit;
            if ($submit == 1) {
                $this->db->set('reservation_status', 'cancel');
                $this->db->set('reservation_cancelled_on', date('Y-m-d H:i:s'));
                $this->db->where('id', $id);
                $this->db->update('reservations');

                $msg = "<strong>Success!</strong> Reservation canceled successfully.";
                $this->system_message->set_success($msg);
                redirect('admin/reservations/');
            } else if ($submit == 2) {
                $this->db->set('reservation_status', 'trash');
                $this->db->set('reservation_cancelled_on', date('Y-m-d H:i:s'));
                $this->db->where('id', $id);
                $this->db->update('reservations');

                $msg = "<strong>Success!</strong> Reservation canceled successfully.";
                $this->system_message->set_success($msg);
                redirect('admin/reservations/');
            } else {
                redirect('admin/reservations/');
            }
        }
        $this->db->where('reservations.id', $id);
        $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
        $this->db->order_by('reservations.start_date', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();
        if (empty($data)) {
            $errors = "Reservation details not found!";
            $this->system_message->set_error($errors);
            redirect('admin/reservations/');
        }

        $this->mViewData['data'] = $data;
        $this->mPageTitle = 'Reservation Cancel';
        $this->render('custom/reservations/reservations-cancel', 'with_breadcrumb');
    }

    public function trash($id = null)
    {
        if (!isset($id)) {
            redirect('404');
        }
        $form = $this->form_builder->create_form('admin/reservations/trash/' . $id, 'enctype= multipart/form-data', 'id="reservations_trash"');
        $this->mViewData['form'] = $form;

        if ($this->input->method() === 'post') {
            $submit = $this->input->post('submit');
            if ($submit) {
                $this->db->set('reservation_status', 'trash');
                $this->db->set('reservation_cancelled_on', date('Y-m-d H:i:s'));
                $this->db->where('id', $id);
                $this->db->update('reservations');

                $msg = "<strong>Success!</strong> Reservation trashed successfully.";
                $this->system_message->set_success($msg);
                redirect('admin/reservations/');
            } else {
                redirect('admin/reservations/');
            }
        }
        $this->db->where('reservations.id', $id);
        $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
        $this->db->order_by('reservations.start_date', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();
        if (empty($data)) {
            $errors = "Reservation details not found!";
            $this->system_message->set_error($errors);
            redirect('admin/reservations/');
        }

        $this->mViewData['data'] = $data;
        $this->mPageTitle = 'Reservation Trash';
        $this->render('custom/reservations/reservations-trash', 'with_breadcrumb');
    }

    public function view($revId)
    {
        $form = $this->form_builder->create_form('admin/reservations/view/' . $revId, 'enctype= multipart/form-data', 'id="reservations_trash"');
        $this->mViewData['form'] = $form;
        if ($this->input->method() === 'post') {
            $submit = $this->input->post('submit');
            if ($submit == 1) {
                $this->db->set('reservation_status', 'trash');
                //$this->db->set('reservation_cancelled_on', date('Y-m-d H:i:s'));
                $this->db->where('id', $revId);
                $this->db->update('reservations');
                $msg = "<strong>Success! </strong>Hold removed successfully";
                $this->system_message->set_success($msg);
                redirect($this->uri->uri_string());
            } else {
                redirect('admin/reservations/');
            }
        }
        $this->db->where('reservations.id', $revId);
        $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');

        $query = $this->db->get();
        $data = $query->result_array();
        //print("<pre>" . print_r($data, true) . "</pre>");

        //CHECK 24 HRS HOLD 13-10-2023
        $start_date = isset($data[0]["start_date"]) && $data[0]["start_date"] != "" ? $data[0]["start_date"] : "";
        $userid = isset($data[0]["user_id"]) && $data[0]["user_id"] != "" ? $data[0]["user_id"] : "";
        $lease_id = isset($data[0]["leases_id"]) && $data[0]["leases_id"] != "" ? $data[0]["leases_id"] : "";
        $lease_area_id = isset($data[0]["lease_area_id"]) && $data[0]["lease_area_id"] != "" ? $data[0]["lease_area_id"] : "";
        $this->load->model('Reservations_model', 'reservations');
        $ishold = $this->reservations->reservation_ishold($userid, $lease_id, $lease_area_id);
        //print("<pre>" . print_r($ishold, true) . "</pre>");
        ////CHECK 24 HRS HOLD 13-10-2023
        //CHEKING START DATE LESSTHAN TODAY 13-10-2023
        $startDate = date('Y-m-d', strtotime($start_date));
        $today = date('Y-m-d', strtotime(date('Y-m-d')));
        $isStartDateLessToday = 0;
        if ($startDate > $today) {
            $isStartDateLessToday = 1;
        }
        //print("<pre>" . print_r($isStartDateLessToday, true) . "</pre>");
        ////CHEKING START DATE LESSTHAN TODAY 13-10-2023
        $this->mViewData['ishold'] = $ishold;
        $this->mViewData['isStartDateLessToday'] = $isStartDateLessToday;

        $this->mViewData['controller'] = $this;
        $this->mViewData['data'] = $data;
        //$this->mViewData['harvest_reports']=$harvest_reports; 
        $this->mPageTitle = 'Reservation Details';
        $this->render('custom/reservations/reservations-view', 'with_breadcrumb');
    }

    public function getDropDown($id = 0)
    {

        $leaseId = $_POST['id'];
        $this->db->where('lease_reservation_types.lease_id', $leaseId);
        $this->db->where('reservation_types.active', 1);
        $this->db->select('reservation_types.name, reservation_types.id');
        $this->db->from('reservation_types');
        $this->db->join('lease_reservation_types', 'reservation_types.id = lease_reservation_types.reservation_type_id');
        $query = $this->db->get();
        $data = $query->result_array();
        $str = '<option value="">Select Reservation Type...</option>';
        foreach ($data as $val) {
            $str .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
        }

        echo $str;
    }

    public function add_calendar()
    {
        $form = $this->form_builder->create_form('', 'enctype= multipart/form-data', 'id="reservations_add_calendar"');
        $this->mViewData['form'] = $form;

        $data = $this->input->post();
        if (empty($data)) {
            redirect('admin/reservations/add');
        }

        $leaseid = $data['lease'];
        $reservation_types_id = $data['reservation_type'];
        $user_id = $data['member'];
        $draw_hunt = $data['hunt'];
        // print("<pre>".print_r($leaseid,true)."</pre>");
        // print("<pre>".print_r($reservation_types_id,true)."</pre>");
        // print("<pre>".print_r($user_id,true)."</pre>");
        // print("<pre>".print_r($draw_hunt,true)."</pre>");

        $this->mViewData['step1'] = $data;

        $lease_Area = $this->leases_area_name_Id($data['reservation_type'], $data['lease']);

        $this->load->model('Reservations_model', 'reservations');
        $startDate = date('Y-m-01');
        $available = $this->reservations->get_available_hunter($lease_Area[0]['id'], $data['reservation_type'], $startDate);
        //echo $available;
        //Check reservation_types_isActive
        $isActive = $this->reservations->reservation_types_isActive($reservation_types_id, $startDate);
        if (!$isActive) {
            $errors = "<strong>Error!</strong> That reservation type is not currently available.";
            $this->system_message->set_error($errors);
            redirect('admin/reservations/add', 'refresh');
        }
        //print("<pre>".print_r($isActive,true)."</pre>");
        ////END
        //CHECK HOLD 24 HORS // Closed on 13-10-2023
        // $ishold=$this->reservations->reservation_ishold($user_id, $leaseid);
        // if($ishold)
        // {
        //     $errors = "<strong>Error!</strong> This member will not be able to book this lease for 24 hours";
        //     $this->system_message->set_error($errors);            
        //     redirect('admin/reservations/add', 'refresh');
        // }
        // print("<pre>".print_r($ishold,true)."</pre>");
        // exit;
        ////END
        // reservation_types
        $this->db->where('id', $data['reservation_type']);
        $this->db->select('*');
        $this->db->from('reservation_types');

        $query = $this->db->get();
        $reservation_types_data = $query->result_array();
        //print("<pre>".print_r($reservation_types_data,true)."</pre>");
        ////reservation_types

        $this->mViewData['leaseid'] = $leaseid;
        $this->mViewData['reservation_types_id'] = $reservation_types_id;
        $this->mViewData['user_id'] = $user_id;
        $this->mViewData['draw_hunt'] = $draw_hunt;

        $this->mViewData['reservation_types_data'] = $reservation_types_data;
        $this->mViewData['lease_Area'] = $lease_Area;

        $this->mPageTitle = 'Reservation';
        $this->render('custom/reservations/reservations-add-calendar', 'with_breadcrumb');
    }

    public function leases_area_name_Id($reservationtype, $leaseid)
    {
        $areaName = array();
        $this->db->where('active', '1');
        $this->db->where('lease_id', $leaseid);
        $query = $this->db->get('lease_areas');
        $data['lease_areas'] = $query->result_array();
        foreach ($data['lease_areas'] as $ls) {
            $ls_id = $ls['id'];

            $this->db->where('lease_area_id', $ls_id);
            $this->db->where('reservation_type_id', $reservationtype);
            $query = $this->db->get('lease_area_reservation_types');
            $data['lease_area_reservation_types'] = $query->result_array();

            if (count($data['lease_area_reservation_types']) > 0) {
                $areaName[] = array('name' => $ls['name'], 'id' => $ls['id']);
            }
        }

        return $areaName;
    }

    public function get_Lease_Area_Dates()
    {
        $this->load->model('Lease_Information_model', 'Lease_Info');

        $leaseId = $this->input->get('lease', true);
        $activityId = $this->input->get('activity', true);
        $user_id = $this->input->get('user_id', true);
        $draw_hunt = $this->input->get('draw_hunt', true);
        $calendar_startDate = $this->input->get('start', true);
        $calendar_endDate = $this->input->get('end', true);

        //print("<pre>".print_r($activityId,true)."</pre>");exit;

        // Check to make sure required variables are passed in
        if (!isset($leaseId) or !isset($activityId) or !isset($calendar_startDate) or !isset($calendar_endDate)) {
            echo json_encode(array());
        }

        //GET ACTIVITY DETAILS BY ID (reservation_types)
        $this->db->where('id', $activityId);
        $query = $this->db->get('reservation_types');
        $reservation_types_data = $query->result_array();
        //print("<pre>".print_r($reservation_types_data,true)."</pre>");exit;
        ////GET ACTIVITY DETAILS BY ID (reservation_types)
        $activity_start_date = $reservation_types_data[0]["start_date"];
        $activity_end_date = $reservation_types_data[0]["end_date"];

        $startDate = date('Y-m-d', strtotime($activity_start_date));
        $endDate = date('Y-m-d', strtotime($activity_end_date));
        $today = date('Y-m-d', strtotime(date('Y-m-d')));

        if ($startDate < $today) {
            $startDate = $today;
        }
        //ADDED 01-03-20222
        // if ($endDate < $today) {
        //     $startDate = $endDate;
        // }       
        if ($endDate < $today) {
            $endDate = $today;
        }
        /////
        $leases_area_names = $this->leases_area_name_Id($activityId, $leaseId);
        //print("<pre>".print_r($leases_area_names,true)."</pre>"); exit;

        $event_data = array();

        $date1 = date_create($startDate);
        $date2 = date_create($endDate);
        $diff = (array) date_diff($date1, $date2);
        $interval = $diff['days'];

        // Build colors
        $colorList = ['', 'fc-blue', 'fc-orange', 'fc-red', 'fc-green', 'fc-purple', 'fc-sea', 'fc-brown'];
        $colorCount = 0;

        for ($days = 0; $days <= $interval; $days++) {
            foreach ($leases_area_names as $name) {
                $leseAreaId = $name['id'];
                $count_available = $this->Lease_Info->get_available_hunter($leseAreaId, $activityId, $startDate);

                if ($count_available == '0') {
                    $class_name = 'fc-gray';
                } else {
                    $class_name = $colorList[$colorCount];
                }

                $event_data[] = array($startDate, $name['name'], $class_name, $count_available, $leseAreaId);
                $colorCount++;
                if ($colorCount > 7) {
                    $colorCount = 0;
                }
            }

            $startDate = date('Y-m-d', strtotime($startDate . ' + 1 days'));
            $colorCount = 0;
        }
        //print("<pre>".print_r($event_data,true)."</pre>");
        //exit;

        foreach ($event_data as $row) {
            if ($row[3] != '0') {
                $data[] = array(
                    'id' => $leaseId,
                    'dateText' => date('l, F j, Y', strtotime($row[0])),
                    'title' => $row[1] . ' - ' . $row[3] . ' Open Slots',
                    'start' => $row[0],
                    'end' => $row[0],
                    'className' => $row[2],
                    'url' => 'reservations/add-days/' . $leaseId . '/' . $row[4] . '/' . $activityId . '/' . $user_id . '/' . $draw_hunt . '/' . $row[0] . '',
                    //URL-PARAM : "Lease_id/Lease_area_id/Reservation_Type_Id/User_id/Draw_Hunt/Selected_Date"
                );
            } else {
                $data[] = array(
                    'id' => $leaseId,
                    'dateText' => date('l, F j, Y', strtotime($row[0])),
                    'title' => $row[1] . ' - No Slots Available',
                    'start' => $row[0],
                    'end' => $row[0],
                    'className' => $row[2],
                );
            }
        }
        echo json_encode($data);
    }

    public function add_days($lease_id = null, $lease_area_id = null, $reservation_type_id = null, $userid = null, $draw_hunt = null, $startDate = null)
    {
        //URL-PARAM : "Lease_id/Lease_area_id/Reservation_Type_Id/User_id/Draw_Hunt/Selected_Date"
        if (!isset($lease_id) or !isset($lease_area_id) or !isset($reservation_type_id) or !isset($userid) or !isset($draw_hunt) or !isset($startDate)) {
            redirect('404');
        } else {
            $form = $this->form_builder->create_form('', 'enctype= multipart/form-data', 'id="reservations_add_days"');
            $this->mViewData['form'] = $form;
            $this->load->model('Lease_Information_model', 'Lease_Info');
            $this->mViewData['controller'] = $this;

            $start_date = str_replace('_', '-', $startDate);

            //CHECK FOR 5AM FOR RESERVATION//
            // $today = date('Y-m-d', strtotime(date('Y-m-d')));
            // if($start_date==$today)
            // {
            //    // $time_now = date('H:i:s');
            //    // print("<pre>".print_r($time_now,true)."</pre>");
            //     $ThatTime ="05:00:00";
            //     if (time()> strtotime($ThatTime)) {
            //         $errors = "Reservation time is over for today. Please try another day...";
            //         $this->system_message->set_error($errors);
            //         redirect('admin/reservations/add', 'refresh');
            //     }
            // }           
            ////CHECK FOR 5AM FOR RESERVATION//
            //CHECK HOLD 24 HORS // Added 13-10-2023
            $this->load->model('Reservations_model', 'reservations');
            $ishold = $this->reservations->reservation_ishold($userid, $lease_id, $lease_area_id);
            if ($ishold) {
                $errors = "<strong>Error!</strong> This member will not be able to book this lease for 24 hours";
                $this->system_message->set_error($errors);
                redirect('admin/reservations/add', 'refresh');
            }
            ////CHECK HOLD 24 HORS END
            //***************FORM SUBMIT FUNCTION *******************/
            if ($this->input->method() === 'post') {
                $cancel = $this->input->post('cancel');
                if (!$cancel) {
                    $do_booking = 1;
                    $user_id = $userid;
                    $lease_area_id = $lease_area_id;
                    $reservation_type_id = $reservation_type_id;
                    $start_date = $start_date;
                    $days = $this->input->post('days');

                    $useSpot = $this->input->post('useSpot');
                    $reservationUsers = $this->input->post('reservationUsers');
                    if ($useSpot == "") {
                        $useSpot = 0;
                    }
                    $guest_count = $this->input->post('guest_count');
                    $total_spot_count = $useSpot + $guest_count;

                    // print("<pre>".print_r($useSpot,true)."</pre>");
                    // print("<pre>".print_r($guest_count,true)."</pre>");
                    // print("<pre>".print_r($total_spot_count,true)."</pre>");exit;


                    $days = $days - 1;
                    $end_date = date('Y-m-d', strtotime($start_date . ' + ' . $days . ' days'));

                    for ($i = 0; $i <= $days; $i++) {
                        $startDate = date('Y-m-d', strtotime($start_date . ' + ' . $i . ' days'));
                        if (!$this->isLeaseOpen($startDate, $reservation_type_id)) {
                            $do_booking = 0;
                            break;
                        }

                        $availbe_spot = $this->Lease_Info->get_available_hunter($lease_area_id, $reservation_type_id, $startDate);
                        // print("<pre>".print_r($availbe_spot,true)."</pre>"); 
                        if ($total_spot_count > $availbe_spot) {
                            $do_booking = 0;
                            break;
                        }
                    }

                    if ($do_booking) {
                        //  $useSpot = $this->input->post('useSpot');
                        //  $reservationUsers = $this->input->post('reservationUsers');
                        //  $guest_1 = $this->input->post('guest_1');
                        //  $guest_2 = $this->input->post('guest_2');
                        //  $guest_3 = $this->input->post('guest_3');

                        $this->db->trans_start();
                        $data = array(
                            'user_id' => $user_id,
                            'lease_area_id' => $lease_area_id,
                            'reservation_type_id' => $reservation_type_id,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'reservation_status' => 'active',
                            'use_spot' => $useSpot,
                            'harvest_report' => 0,
                            'reservation_created_on' => date('Y-m-d H:i:s'),
                            'reservation_updated_on' => date('Y-m-d H:i:s'),
                            'draw_hunt' => $draw_hunt
                        );

                        $this->db->set($data);
                        $this->db->insert('reservations');
                        $insert_id = $this->db->insert_id();
                        if (!empty($reservationUsers)) {
                            foreach ($reservationUsers as $reservationUser) {
                                $data2 = array(
                                    'reservation_id' => $insert_id,
                                    'guest_id' => $reservationUser
                                );

                                $this->db->set($data2);
                                $this->db->insert('reservation_users');
                            }
                        }
                        $this->db->trans_complete();

                        if ($this->db->trans_status() === FALSE) {
                            $msg = "<strong>Error!</strong> Something went wrong please try again...";
                            $this->system_message->set_error($msg);
                        } else {
                            $msg = "<strong>Success!</strong> Booked successfully.";
                            $this->system_message->set_success($msg);
                            redirect('admin/reservations', 'refresh');
                        }
                    } else {
                        $errors = "Spots not available in this selected date range. Please try again...";
                        $this->system_message->set_error($errors);
                        redirect('admin/reservations', 'refresh');
                    }
                } else {
                    redirect('admin/reservations', 'refresh');
                }
            }
            ////***************FORM SUBMIT FUNCTION ****************** */

            //User Details
            $user_details = $this->user($userid);
            ////ser Details

            // lease_areas
            $this->db->where('lease_areas.id', $lease_area_id);
            $this->db->select('lease_areas.*,leases.name AS leasesname');
            $this->db->from('lease_areas');
            $this->db->join('leases', 'leases.id = lease_areas.lease_id');

            $query = $this->db->get();
            $lease_area = $query->result_array();
            ////lease_areas

            // reservation_types
            $this->db->where('id', $reservation_type_id);
            $this->db->select('*');
            $this->db->from('reservation_types');

            $query = $this->db->get();
            $reservation_types = $query->result_array();
            ////reservation_types

            //Available Spots
            $day1 = $start_date;
            $availbt1 = $this->Lease_Info->get_available_hunter($lease_area_id, $reservation_type_id, $day1);

            $day2 = date('Y-m-d', strtotime($start_date . ' + 1 days'));
            $availbt2 = $this->Lease_Info->get_available_hunter($lease_area_id, $reservation_type_id, $day2);

            $day3 = date('Y-m-d', strtotime($start_date . ' + 2 days'));
            $availbt3 = $this->Lease_Info->get_available_hunter($lease_area_id, $reservation_type_id, $day3);

            $this->mViewData['day1'] = date('l, F j, Y', strtotime($day1));
            $this->mViewData['availbt1'] = $availbt1;

            if ($this->isLeaseOpen($day2, $reservation_type_id)) {
                $this->mViewData['day2'] = date('l, F j, Y', strtotime($day2));
                $this->mViewData['availbt2'] = $availbt2;
            }
            if ($this->isLeaseOpen($day3, $reservation_type_id)) {
                $this->mViewData['day3'] = date('l, F j, Y', strtotime($day3));
                $this->mViewData['availbt3'] = $availbt3;
            }
            ////Available Spots
            // $this->db->get_compiled_select();
            //User guests
            $this->db->where('users_guests.user_id', $userid);
            $this->db->where('guest_types.id!=', 5);
            $this->db->where('users_guests.status', '1');
            $this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
            $this->db->select('users_guests.*,guest_types.name as guest_types_name');
            $this->db->order_by('users_guests.name', 'asc');
            $this->db->from('users_guests');
            $query = $this->db->get();
            $users_guests = $query->result_array();
            ////User guests
            // print("<pre>".print_r($this->db->last_query(),true)."</pre>");

            //Non-Hunting Guest
            $this->db->where('users_guests.user_id', $userid);
            $this->db->where('guest_types.id=', 5);
            $this->db->where('users_guests.status', '1');
            $this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
            $this->db->select('users_guests.*,guest_types.name as guest_types_name');
            $this->db->order_by('users_guests.name', 'asc');
            $this->db->from('users_guests');
            $query = $this->db->get();
            $Non_Hunting_Guest = $query->result_array();
            ////Non-Hunting Guest

            $this->mViewData['users_guests'] = $users_guests;
            $this->mViewData['Non_Hunting_Guest'] = $Non_Hunting_Guest;
            $this->mViewData['draw_hunt'] = $draw_hunt;
            $this->mViewData['reservation_types'] = $reservation_types;
            $this->mViewData['lease_area'] = $lease_area;
            $this->mViewData['user_details'] = $user_details;
            $this->mPageTitle = 'Reservation';
            $this->render('custom/reservations/reservations-add-days', 'with_breadcrumb');
        }
    }

    public function isLeaseOpen($date, $reservation_types_id)
    {
        $this->db->where('id', $reservation_types_id);
        $this->db->where('start_date<=', $date);
        $this->db->where('end_date>=', $date);
        $this->db->select('*');
        $this->db->from('reservation_types');
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function lease($lease_id)
    {
        $this->db->where('id', $lease_id);
        $this->db->select('name');
        $this->db->from('leases');

        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }

    //   public function lease_area($lease_area_id)
    // {
    //     $this->db->where('id',$lease_area_id);
    //     $this->db->select('name');
    //     $this->db->from('lease_areas');

    //     $query = $this->db->get();
    //     $query->result_array();
    //     return $query->result_array();
    // }
    public function user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->select('*');
        $this->db->from('user');

        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }

    public function reservation_users($revid)
    {
        $this->db->where('reservation_id', $revid);
        $this->db->join('reservation_users', 'id = guest_id');
        $this->db->select('*');
        $this->db->from('users_guests');

        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }
    //         public function harvest_report($revid)
    //    {
    //        $today=date('Y-m-d');
    //        $this->db->where('id',$revid);
    //        $this->db->where('reservation_status','active');
    //        $this->db->where('end_date >',$today);
    //        $this->db->select('harvest_report');
    //        $this->db->from('reservations');
    //
    //        $query = $this->db->get();
    //        $query->result_array();
    //        return $query->result_array();
    //    }
    public function leaselist()
    {
        $this->db->select('*');
        $this->db->order_by('name', 'asc');
        $this->db->from('leases');
        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }

    public function reservation_types_list()
    {
        $this->db->select('*');
        $this->db->order_by('name', 'asc');
        $this->db->from('reservation_types');
        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }
}
