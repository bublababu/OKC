<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Reservations extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->library('session');
        $this->load->helper('url');
        if (!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('account/login', 'refresh');
        }
    }

    public function index()

    {
        $this->db->where('slug', 'brag-board-2012');
        $query = $this->db->get('content_pages');


        $data['users'] = $query->result_array();

        $this->mViewData['users'] = $data['users'];

        $this->mPageTitlePostfix = ' - Sportsman’s Hunting Club';

        $this->mPageTitle = 'Brag Board 2012';

        $this->render('frontend/brag_board_2012', 'with_breadcrumb');
    }

    public function activity()
    {
        $form = $this->form_builder->create_form('', 'enctype= multipart/form-data', 'class="sky-form" id="Hunting_Fishing_Reservations"');
        $this->mViewData['form'] = $form;

        $this->mViewData['controller'] = $this;

        //**CHECK Assessment Status START******************************************************
        $userid = $this->session->userdata('userid');

        $this->db->where('user_id', $userid);
        $this->db->select('examp_status,annual_form_status,allow_reservations');
        $this->db->from('user');

        $query = $this->db->get();
        $userData = $query->result_array();

        //print("<pre>".print_r($userData[0]['annual_form_status'],true)."</pre>"); 
        $examstatus = $userData[0]['examp_status'];
        if ($examstatus != 2) {
            $errors = "This reservation cannot be completed as some member details have not been submitted. Please contact an administrator.";
            $this->system_message->set_error($errors);
            redirect('assessment/index', 'refresh');
        }
        $annual_form_status = $userData[0]['annual_form_status'];
        if ($annual_form_status == 0) {
            $errors = "This reservation cannot be completed as annual form submission in pending. If you believe this to be in error, please contact an administrator.";
            $this->system_message->set_error($errors);
            redirect('submission/index', 'refresh');
        }
        $allow_reservations = $userData[0]['allow_reservations'];
        if ($allow_reservations == 0) {
            $errors = "This reservation cannot be completed. If you believe this to be in error, please contact an administrator.";
            $this->system_message->set_error($errors);
            redirect('account', 'refresh');
        }
        
        ///Code added on 10-Feb-24 
        
        
          $this->load->model('Customer_model', 'customer');
           
           // $data = $this->customer->get_content_byId($userid);
            $data2 = $this->customer->reservations_details($userid);
           // $data3 = $this->customer->lodge_details($userid);
            $pending_report=0;
            $i=0;
           foreach($data2 as $harvest):
              $today=  strtotime( date('Y-m-d'));         
              $lastday= strtotime($harvest['end_date']);
          $days_between = ($today - $lastday) / 86400;
          
            
            //  if($harvest['reservation_type_id']=='38' || $harvest['reservation_type_id']=='39' || $harvest['reservation_type_id']!='40')
       //   {
          //  continue;
         // }
            
          
              if($harvest['harvest_report'] == 0 && ( $harvest['reservation_status']=='active' || $harvest['reservation_status']=='complete') &&   $harvest['reservation_type_id']!='38' && $harvest['reservation_type_id']!='39' && $harvest['reservation_type_id']!='40') 
              {
                $pending_report=$pending_report+1;
                
              }
               if($i++>5)  break;
           endforeach;
       
           
          if ($pending_report>0) {
            $errors = "New reservations cannot be completed as you have  pending harvest reports. If you believe this to be in error, please contact an administrator.";
            $this->system_message->set_error($errors);
            redirect('account', 'refresh');
        }
        
        
        
        //**CHECK Assessment Status END********************************************************

        // reservation_types       
        $this->db->select('*');
        $this->db->from('reservation_types');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        $reservation_types_data = $query->result_array();

        //print("<pre>".print_r($reservation_types_data,true)."</pre>"); 

        $this->mViewData['reservation_types_data'] = $reservation_types_data;

        $this->mPageTitlePostfix = ' - Sportsman’s Hunting Club';
        $this->mPageTitle = 'Hunting & Fishing Reservations';
        $this->render('user/Hunting_Fishing_Reservations', 'with_breadcrumb');
    }

    public function location($reservation_types_id = null)
    {
        if (!isset($reservation_types_id)) {
            redirect('404');
        } else {
            $this->mViewData['controller'] = $this;

            // reservation_types
            $this->db->where('id', $reservation_types_id);
            $this->db->select('*');
            $this->db->from('reservation_types');

            $query = $this->db->get();
            $reservation_types_data = $query->result_array();

            ////reservation_types

            if (!empty($reservation_types_data)) {

                $this->db->where('active', '1');
                $this->db->order_by('name', 'ASC');
                $query = $this->db->get('leases');
                $leases_data = $query->result_array();

                $this->mViewData['leases_data'] = $leases_data;
                $this->mViewData['reservation_types_data'] = $reservation_types_data;
                $this->mViewData['reservation_types_id'] = $reservation_types_id;
                $this->mPageTitlePostfix = ' - Sportsman’s Hunting Club';
                $this->mPageTitle = 'Hunting & Fishing Reservations';
                $this->render('user/Hunting_Fishing_Reservations_Location', 'with_breadcrumb');
            } else {
                redirect('404');
            }
        }
    }

    public function lease_files($lease_id = null)
    {
        $this->db->where('lease_id', $lease_id);
        $this->db->order_by('file_name', 'ASC');
        $query = $this->db->get('lease_files');

        $query->result_array();
        return $query->result_array();
    }

    public function view($revId = null)
    {
        if (is_null($revId)) {
            redirect('404');
        } else {


            $this->db->where('reservations.id', $revId);
            $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
            $this->db->from('reservations');
            $this->db->join('user', 'user.user_id = reservations.user_id');
            $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
            $this->db->join('leases', 'leases.id = lease_areas.lease_id');
            $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');

            $query = $this->db->get();
            $data = $query->result_array();


            /////////////// get other user data on same date in same area ///////////
            // $this->db->where('reservations.start_date',$data[0]['start_date']);
            // $this->db->where('reservations.lease_area_id',$data[0]['lease_area_id']);
            // $this->db->where('reservations.reservation_type_id',$data[0]['reservation_type_id']);
            // $this->db->where('reservations.user_id!=',$data[0]['user_id']);
            // $this->db->where('reservations.reservation_status','active');
            // $this->db->from('reservations');
            // $this->db->select('reservations.user_id, user.first_name,user.last_name, user.badge');
            // $this->db->join('user', 'user.user_id = reservations.user_id');
            // $query1 = $this->db->get();
            // $dataOther= $query1->result_array();
            //  echo '<pre>'; print_r($dataOther);
            //////////////////////
            // $this->load->model('Lease_Information_model','Lease_Info');
            //$dataOther = $this->Lease_Info->get_other_hunter($data[0]['lease_area_id'],$data[0]['reservation_type_id'],$data[0]['start_date'],$data[0]['user_id']);  
            //View People On Property   
            //$this->db->get_compiled_select();
            // $startDate=$data[0]['start_date'];
            // $endDate=$data[0]['end_date'];
            // $this->db->select('user.first_name,user.last_name, user.badge,reservations.id as reservations_id');
            // $this->db->distinct();
            // $this->db->from('reservations');
            // $this->db->join('user', 'user.user_id = reservations.user_id');
            // $this->db->where('reservations.user_id !=', $data[0]['user_id']);
            // $this->db->where("((reservations.start_date BETWEEN '$startDate' AND '$endDate')");
            // $this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$endDate')");
            // $this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$endDate'))");          
            // $query2 = $this->db->get();
            // $dataOther= $query2->result_array();
            $dataOther = $this->other_hunters($data[0]['user_id'], $data[0]['start_date'], $data[0]['end_date'], $data[0]['lease_area_id']);
            //$this->mViewData['other_hunters']=$other_hunters;          
            //print("<pre>".print_r($this->db->last_query(),true)."</pre>");
            //print("<pre>".print_r($dataOther2,true)."</pre>");
            ////END 

            if (!empty($data)) {
                $this->db->where('reservation_id', $revId);
                $query = $this->db->get('harvest_reports');
                $harvest_reports = $query->result_array();

                //print("<pre>".print_r($data,true)."</pre>");

                $this->mViewData['controller'] = $this;
                $this->mViewData['data'] = $data;
                $this->mViewData['dataOther'] = $dataOther;

                $this->mViewData['userid'] = $data[0]['user_id'];
                $this->mViewData['start_date'] = $data[0]['start_date'];

                $this->mViewData['harvest_reports'] = $harvest_reports;
                $this->mPageTitle = 'Hunting & Fishing Reservations';
                $this->render('user/reservations-view', 'with_breadcrumb');
            } else {
                redirect('404');
            }
        }
    }

    public function reservation_users($revid)
    {
        // $this->db->where('reservation_id',$revid);
        //  $this->db->join('reservation_users', 'id = guest_id');
        // $this->db->select('*');
        // $this->db->from('users_guests');

        $this->db->where('reservation_id', $revid);
        $this->db->join('users_guests', 'users_guests.id = reservation_users.guest_id');
        $this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
        $this->db->select('users_guests.*,guest_types.name as guest_types');
        $this->db->from('reservation_users');

        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }

    public function lists()
    {
        $this->load->library('pagination');
        $form = $this->form_builder->create_form('', 'enctype= multipart/form-data', 'class="sky-form" id="reservations_list"');
        $this->mViewData['form'] = $form;

        $this->load->library('session');
        $this->load->model('common_model');

        $this->load->model('Customer_model', 'customer');
        $this->mViewData['controller'] = $this;

        $userid = $this->session->userdata('userid');

        //GET TOTAL ROW FROM FROM MODEL FN START 
        $total_row = $this->customer->reservations_details_num_rows($userid);
        //GET TOTAL ROW FROM FROM MODEL FN END 

        //SET DEFAULT PER PAGE ROWS START         
        $per_page = 10;
        //SET DEFAULT PER PAGE ROWS END

        //PAGINATION CONFIGARATION START
        $config = [
            'base_url' => base_url('reservations/lists'),
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
            'num_links' => 10
        ];
        //PAGINATION CONFIGARATION END

        //PAGINATION INITIALIZATION START
        $this->pagination->initialize($config);
        //PAGINATION INITIALIZATION END

        //CALCULATION OF OFFSET VALUE FROM PAGE NO START
        $offset = $this->input->get('p', TRUE);
        $page = ($offset) ? ($offset * $config["per_page"]) - $config["per_page"] : 0;
        //CALCULATION OF OFFSET VALUE FROM PAGE NO END

        //GET DATA FROM MODEL AS PER CONFIGARATION START       
        $data2 = $this->customer->reservations_details($userid, $config['per_page'], $page);
        //GET DATA FROM MODEL AS PER CONFIGARATION START


        $data = $this->customer->get_content_byId($userid);


        // $data2 = $this->customer->reservations_details($userid);
        // print("<pre>".print_r($data2,true)."</pre>");

        $this->mViewData['customers'] = $data;
        $this->mViewData['reservations'] = $data2;
        $this->mBodyClass = 'container login-page';
        $this->mPageTitlePostfix = ' - Sportsman’s Hunting Club';
        $this->mPageTitle = 'Hunting & Fishing Reservations';
        $this->render('user/reservations-list', 'with_breadcrumb');
    }

    public function is_cancelAllowed($start_date = null)
    {
        if (isset($start_date)) {
            // //$stardate='2022-01-08'; /// for test		
            // $toDay=date('Y-m-d');
            // $previousDay= date('Y-m-d', strtotime('-1 day', strtotime($start_date)));
            // $time=date('H');

            // if($toDay>=$previousDay && $time>=5){
            // 	//echo 'cancellation not allowed';
            //     return 0;
            // }
            // else
            // {
            //     return 1;
            // }

            //CHECK FOR 5AM FOR RESERVATION//
            $today = date('Y-m-d', strtotime(date('Y-m-d')));
            if ($today >= $start_date) {
                // $time_now = date('H:i:s');
                // print("<pre>".print_r($time_now,true)."</pre>");
                $ThatTime = "05:00:00";
                if (time() > strtotime($ThatTime)) {
                    return 0;
                } else {
                    return 1;
                }
            } else {
                return 1;
            }
            ////CHECK FOR 5AM FOR RESERVATION//
        }
    }

    public function user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->select('*');
        $this->db->from('user');

        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }


    public function dates($reservation_types_id = null, $leaseid = null)
    {
        if (!isset($reservation_types_id) or !isset($leaseid)) {
            redirect('404');
        } else {
            $this->mViewData['controller'] = $this;

            //CHECK HOLD 24 HORS // Closed on 13-10-2023
            // $this->load->model('admin/Reservations_model', 'reservations');
            // $userid = $this->session->userdata('userid');
            // $ishold = $this->reservations->reservation_ishold($userid, $leaseid);
            // if ($ishold) {
            //     $errors = "This reservation cannot be completed as you've recently cancelled a reservation on this lease. Please try again tomorrow or contact an administrator.";
            //     $this->system_message->set_error($errors);
            //     redirect('reservations/activity', 'refresh');
            // }
            // print("<pre>".print_r($ishold,true)."</pre>");
            // exit;
            ////END

            // reservation_types
            $this->db->where('id', $reservation_types_id);
            $this->db->select('*');
            $this->db->from('reservation_types');

            $query = $this->db->get();
            $reservation_types_data = $query->result_array();
            //print("<pre>".print_r($reservation_types_data,true)."</pre>"); 
            ////reservation_types              

            if (!empty($reservation_types_data)) {
                //Lease Data
                $this->db->where('id', $leaseid);
                $query = $this->db->get('leases');
                $leases_data = $query->result_array();
                // print("<pre>".print_r($leases_data,true)."</pre>"); 
                ////Lease Data

                if (!empty($leases_data)) {
                    $this->mViewData['reservation_types_id'] = $reservation_types_id;
                    $this->mViewData['leaseid'] = $leaseid;
                    $this->mViewData['reservation_types_data'] = $reservation_types_data;
                    $this->mViewData['leases_data'] = $leases_data;

                    $this->mPageTitlePostfix = ' - Sportsman’s Hunting Club';
                    $this->mPageTitle = 'Hunting & Fishing Reservations';
                    $this->render('user/Leases_Reservations_Dates', 'with_breadcrumb');
                } else {
                    redirect('404');
                }
            } else {
                redirect('404');
            }
        }
    }



    public function leases_area_name($reservationtype, $leaseid)
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
                $areaName[] = $ls['name'];
            }
        }

        return $areaName;
    }

    public function book($activityId = null, $leasesAreaId = null, $startDate = null)
    {
        if (!isset($activityId) or !isset($leasesAreaId) or !isset($startDate)) {
            redirect('404');
        } else {

            $start_date = str_replace('_', '-', $startDate);
            //CHECK FOR 5AM FOR RESERVATION//
            // $today = date('Y-m-d', strtotime(date('Y-m-d')));
            // if($start_date==$today)
            // {
            // // $time_now = date('H:i:s');
            // // print("<pre>".print_r($time_now,true)."</pre>");
            //     $ThatTime ="05:00:00";
            //     if (time()> strtotime($ThatTime)) {
            //         $errors = "Reservation time is over for today. Please try another day...";
            //         $this->system_message->set_error($errors);
            //         redirect('reservations/activity', 'refresh');
            //     }
            // }           
            ////CHECK FOR 5AM FOR RESERVATION//

            $userid = $this->session->userdata('userid');

            $this->load->model('Lease_Information_model', 'Lease_Info');
            $this->load->model('User_model', 'eligibility');

            $form = $this->form_builder->create_form('', 'enctype= multipart/form-data', 'class="sky-form" id="sky-form3"');
            $this->mViewData['form'] = $form;
            $this->mViewData['controller'] = $this;


            //***************FORM SUBMIT FUNCTION *******************/
            if ($this->input->method() === 'post') {
                $do_booking = 1;
                $user_id = $userid;
                $lease_area_id = $leasesAreaId;
                $reservation_type_id = $activityId;
                $start_date =  $start_date;
                $days = $this->input->post('days');

                $useSpot = $this->input->post('useSpot');
                $reservationUsers = $this->input->post('reservationUsers');
                $guest_count = $this->input->post('guest_count');

                $total_spot_count = $useSpot + $guest_count;

                /* ///######### ADD 31.10.2023 as per conversation REFF SKYPE PROJECT 31.10.2023 ##########///*/
                $iseligible = $this->eligibility->reservision_eligibility($userid, $days);
                if (!$iseligible) {
                    $errors = "This reservation cannot be completed as you already have 3 days reservations. Please contact administrator.";
                    $this->system_message->set_error($errors);
                    redirect('reservations/book/' . $activityId . '/' . $leasesAreaId . '/' . $start_date, 'refresh');
                }
                //print("<pre>".print_r($iseligible,true)."</pre>");exit;
                //#### ADDED END ##### //


                //print("<pre>".print_r($useSpot,true)."</pre>");
                //print("<pre>".print_r($guest_count,true)."</pre>");
                //print("<pre>".print_r($total_spot_count,true)."</pre>");exit;

                $days = $days - 1;
                $end_date = date('Y-m-d', strtotime($start_date . ' + ' . $days . ' days'));

                for ($i = 0; $i <= $days; $i++) {
                    $startDate = date('Y-m-d', strtotime($start_date . ' + ' . $i . ' days'));
                    if (!$this->isLeaseOpen($startDate, $activityId)) {
                        $do_booking = 0;
                        break;
                    }
                    $availbe_spot = $this->Lease_Info->get_available_hunter($leasesAreaId, $activityId, $startDate);
                    // print("<pre>".print_r($availbe_spot,true)."</pre>"); 
                    if ($total_spot_count > $availbe_spot) {
                        $do_booking = 0;
                        break;
                    }
                }
                //print("<pre>".print_r($do_booking,true)."</pre>");
                if ($do_booking) {
                    // $useSpot = $this->input->post('useSpot');
                    // $reservationUsers = $this->input->post('reservationUsers');
                    // $guest_1 = $this->input->post('guest_1');
                    // $guest_2 = $this->input->post('guest_2');
                    // $guest_3 = $this->input->post('guest_3');

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
                        'draw_hunt' => 0
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
                        redirect('reservations/lists', 'refresh');
                    }
                } else {
                    $errors = "Spots not available in this selected date range. Please try again...";
                    $this->system_message->set_error($errors);
                    redirect('reservations/book/' . $activityId . '/' . $leasesAreaId . '/' . $start_date, 'refresh');
                }
            }
            ////***************FORM SUBMIT FUNCTION ****************** */


            // lease_areas
            $this->db->where('lease_areas.id', $leasesAreaId);
            $this->db->select('lease_areas.*,leases.name AS leasesname');
            $this->db->from('lease_areas');
            $this->db->join('leases', 'leases.id = lease_areas.lease_id');



            $query = $this->db->get();
            $lease_area = $query->result_array();
            //CHECK HOLD 24 HORS // Added 13-10-2023
            $this->load->model('admin/Reservations_model', 'reservations');
            $lease_id = isset($lease_area[0]["lease_id"]) && $lease_area[0]["lease_id"] != "" ? $lease_area[0]["lease_id"] : "";
            if ($lease_id != "") {
                $ishold = $this->reservations->reservation_ishold($userid, $lease_id, $leasesAreaId);
                if ($ishold) {
                    $errors = "This reservation cannot be completed as you've recently cancelled a reservation on this lease. Please try again tomorrow or try another or contact an administrator.";
                    $this->system_message->set_error($errors);
                    redirect('reservations/activity', 'refresh');
                }
            }
            ////CHECK HOLD 24 HORS END
            ////lease_areas

            // reservation_types
            $this->db->where('id', $activityId);
            $this->db->select('*');
            $this->db->from('reservation_types');

            $query = $this->db->get();
            $reservation_types = $query->result_array();
            //print("<pre>".print_r($lease_area,true)."</pre>"); 
            ////reservation_types
            //Available Spots
            $day1 =  $start_date;
            $availbt1 = $this->Lease_Info->get_available_hunter($leasesAreaId, $activityId, $day1);

            $day2 = date('Y-m-d', strtotime($start_date . ' + 1 days'));
            $availbt2 = $this->Lease_Info->get_available_hunter($leasesAreaId, $activityId, $day2);

            $day3 = date('Y-m-d', strtotime($start_date . ' + 2 days'));
            $availbt3 = $this->Lease_Info->get_available_hunter($leasesAreaId, $activityId, $day3);


            $this->mViewData['day1'] = date('l, F j, Y', strtotime($day1));
            $this->mViewData['availbt1'] = $availbt1;

            if ($this->isLeaseOpen($day2, $activityId)) {
                $this->mViewData['day2'] = date('l, F j, Y', strtotime($day2));
                $this->mViewData['availbt2'] = $availbt2;
            }
            if ($this->isLeaseOpen($day3, $activityId)) {
                $this->mViewData['day3'] = date('l, F j, Y', strtotime($day3));
                $this->mViewData['availbt3'] = $availbt3;
            }
            ////Available Spots

            /////////////// get other user data on same date in same area ///////////
            //
            //$this->db->where('reservations.start_date',$start_date);
            //$this->db->where('reservations.lease_area_id',$leasesAreaId);
            //$this->db->where('reservations.reservation_type_id',$activityId);
            //$this->db->where('reservations.user_id!=',$userid);
            //$this->db->where('reservations.reservation_status','active');
            //$this->db->from('reservations');
            //$this->db->select('reservations.user_id, user.first_name,user.last_name, user.badge');
            //$this->db->join('user', 'user.user_id = reservations.user_id');
            //$query1 = $this->db->get();
            //$other_hunters = $query1->result_array();



            //$other_hunters = $this->Lease_Info->get_other_hunter($leasesAreaId,$activityId,$start_date,$userid);

            // $startDate=$start_date;
            // $endDate=$start_date;
            // $this->db->select('reservations.*,user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
            // $this->db->distinct();
            // $this->db->from('reservations');
            // $this->db->join('user', 'user.user_id = reservations.user_id');
            // $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
            // $this->db->join('leases', 'leases.id = lease_areas.lease_id');
            // $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
            // $this->db->where('reservations.user_id !=', $userid);
            // $this->db->where("((reservations.start_date BETWEEN '$startDate' AND '$endDate')");
            // $this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$endDate')");
            // $this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$endDate'))");         
            // $this->db->order_by('reservations.start_date', 'asc'); 
            // $query2 = $this->db->get();
            // $other_hunters= $query2->result_array();
            //print("<pre>".print_r($other_hunters,true)."</pre>");
            $other_hunters = $this->other_hunters($userid, $start_date, $day3, $leasesAreaId);
            //print("<pre>".print_r($other_hunters,true)."</pre>");
            $this->mViewData['other_hunters'] = $other_hunters;
            ////get other user data on same date in same area 

            //User Details
            $user_details = $this->user($userid);
            ////ser Details

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


            //// Reservision booking check
            //$iseligible = $this->eligibility->reservision_eligibility($userid,$start_date);
            //print("<pre>".print_r($activityId,true)."</pre>");
            //Updated on 19-08-2022   

            /*  ///######### Turn off 31.10.2023 as per conversation REFF SKYPE PROJECT 31.10.2023 ##########//              
            if ($activityId != '38' && $activityId != '39' && $activityId != '40') {
                $iseligible = $this->eligibility->reservision_eligibility($userid, $start_date, $activityId);
            } else {
                $iseligible = 1;
            }           
            */

            // $iseligible=0;
            //print("<pre>".print_r($iseligible,true)."</pre>"); 

            $this->mViewData['iseligible'] = 1; // $this->mViewData['iseligible'] = $iseligible; //31-10-2023
            $this->mViewData['reservation_types'] = $reservation_types;
            $this->mViewData['lease_area'] = $lease_area;
            $this->mViewData['lease_area_id'] = $leasesAreaId;
            $this->mViewData['user_details'] = $user_details;
            $this->mViewData['users_guests'] = $users_guests;
            $this->mViewData['Non_Hunting_Guest'] = $Non_Hunting_Guest;

            $this->mViewData['userid'] = $userid;
            $this->mViewData['start_date'] = $start_date;

            $this->mPageTitlePostfix = ' - Sportsman’s Hunting Club';
            $this->mPageTitle = 'Hunting & Fishing Reservations';
            $this->render('user/Leases_Reservations_Book', 'with_breadcrumb');
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

    public function edit($reservation_id = null)
    {
        if (!isset($reservation_id)) {
            redirect('404');
        } else {
            $form = $this->form_builder->create_form('', 'enctype= multipart/form-data', 'class="sky-form" id="sky-form3"');
            $this->mViewData['form'] = $form;
            $this->mViewData['controller'] = $this;
            $this->load->model('Lease_Information_model', 'Lease_Info');
            //***************FORM SUBMIT FUNCTION *******************/
            //***************FORM SUBMIT FUNCTION *******************/
            if ($this->input->method() === 'post') {

                $useSpot = $this->input->post('userSpot');
                // print("<pre>".print_r($useSpot,true)."</pre>");exit; 
                $reservationUsers = $this->input->post('reservationUsers');
                // $guest_1 = $this->input->post('guest_1');
                // $guest_2 = $this->input->post('guest_2');
                // $guest_3 = $this->input->post('guest_3');

                $this->db->trans_start();

                $this->db->set('use_spot', $useSpot);
                $this->db->where('id', $reservation_id);
                $this->db->update('reservations');

                $this->db->where('reservation_id', $reservation_id);
                $this->db->delete('reservation_users');

                if (!empty($reservationUsers)) {
                    foreach ($reservationUsers as $reservationUser) {
                        $data2 = array(
                            'reservation_id' => $reservation_id,
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
                    $msg = "<strong>Success!</strong> Booking edited successfully.";
                    $this->system_message->set_success($msg);
                    redirect('reservations/lists', 'refresh');
                }
            }
            ////***************FORM SUBMIT FUNCTION ****************** */        

            $this->db->where('reservations.id', $reservation_id);
            $this->db->select('reservations.*, user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
            $this->db->from('reservations');
            $this->db->join('user', 'user.user_id = reservations.user_id');
            $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
            $this->db->join('leases', 'leases.id = lease_areas.lease_id');
            $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
            $query = $this->db->get();
            $reservation_data = $query->result_array();

            if (!empty($reservation_data)) {
                $start_Date = isset($reservation_data[0]["start_date"]) && $reservation_data[0]["start_date"] != "" ? $reservation_data[0]["start_date"] : "";
                $end_Date = isset($reservation_data[0]["end_date"]) && $reservation_data[0]["end_date"] != "" ? $reservation_data[0]["end_date"] : "";
                $leasesAreaId = isset($reservation_data[0]["lease_area_id"]) && $reservation_data[0]["lease_area_id"] != "" ? $reservation_data[0]["lease_area_id"] : "";
                $activityId = isset($reservation_data[0]["reservation_type_id"]) && $reservation_data[0]["reservation_type_id"] != "" ? $reservation_data[0]["reservation_type_id"] : "";
                $userid = isset($reservation_data[0]["user_id"]) && $reservation_data[0]["user_id"] != "" ? $reservation_data[0]["user_id"] : "";

                /////////////// get other user data on same date in same area ///////////
                // $this->db->where('reservations.start_date',$start_Date);
                // $this->db->where('reservations.lease_area_id',$leasesAreaId);
                // $this->db->where('reservations.reservation_type_id',$activityId);
                // $this->db->where('reservations.user_id!=',$userid);
                // $this->db->where('reservations.reservation_status','active');
                // $this->db->from('reservations');
                // $this->db->select('reservations.user_id, user.first_name,user.last_name, user.badge');
                // $this->db->join('user', 'user.user_id = reservations.user_id');
                // $query1 = $this->db->get();
                // $other_hunters = $query1->result_array();

                // $other_hunters = $this->Lease_Info->get_other_hunter($leasesAreaId,$activityId,$start_Date,$userid);
                //    $startDate=$start_Date;
                //    $endDate=$end_Date;
                //    $this->db->select('user.first_name,user.last_name, user.badge,reservations.id as reservations_id');
                //    $this->db->distinct();
                //    $this->db->from('reservations');
                //    $this->db->join('user', 'user.user_id = reservations.user_id');
                //    $this->db->where('reservations.user_id !=', $userid);
                //    $this->db->where("((reservations.start_date BETWEEN '$startDate' AND '$endDate')");
                //    $this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$endDate')");
                //    $this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$endDate'))");          
                //    $query2 = $this->db->get();
                //    $other_hunters= $query2->result_array(); 
                $other_hunters = $this->other_hunters($userid, $start_Date, $end_Date, $leasesAreaId);
                $this->mViewData['other_hunters'] = $other_hunters;
                $this->mViewData['userid'] = $userid;
                $this->mViewData['start_date'] = $start_Date;
                ////get other user data on same date in same area 

                //User Details
                $user_details = $this->user($userid);
                ////ser Details

                //User guests
                $this->db->where('users_guests.user_id', $userid);
                $this->db->join('guest_types', 'guest_types.id = users_guests.guest_type');
                $this->db->select('users_guests.*,guest_types.name as guest_types_name');
                $this->db->order_by('users_guests.name', 'asc');
                $this->db->from('users_guests');
                $query = $this->db->get();
                $users_guests = $query->result_array();
                ////User guests

                // print("<pre>".print_r($users_guests,true)."</pre>"); 
                $this->mViewData['users_guests'] = $users_guests;
                $this->mViewData['user_details'] = $user_details;
                $this->mViewData['reservation_data'] = $reservation_data;
                $this->mPageTitle = 'Hunting & Fishing Reservations';
                $this->render('user/Leases_Reservations_Edit', 'with_breadcrumb');
            } else {
                redirect('404');
            }
        }
    }

    public function is_reservation_users($guest_id, $reservation_id)
    {
        $this->db->where('reservation_id', $reservation_id);
        $this->db->where('guest_id', $guest_id);
        $this->db->from('reservation_users');
        return $guest = $this->db->count_all_results();
    }

    public function other_hunter_details($reservation_id)
    {
        $this->load->model('admin/Reservations_model', 'reservations');
        $reservations = $this->reservations->get_reservationsList(0, 0, "2015-01-01", "2015-01-01", "", "", "", "", $reservation_id, "");
        return  $reservations;
    }

    public function other_hunters($userid, $startDate, $endDate = "", $lease_area_id = "")
    {
        // $startDate=$start_date;
        // $endDate=$start_date;
        if ($endDate == "") {
            $endDate = $startDate;
        }
        $this->db->select('reservations.*,user.first_name,user.last_name, user.badge,lease_areas.name AS lease_areas_name,leases.id AS leases_id,leases.name AS leases_name,reservation_types.name AS reservation_types_name');
        $this->db->distinct();
        $this->db->from('reservations');
        $this->db->join('user', 'user.user_id = reservations.user_id');
        $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id');
        $this->db->join('leases', 'leases.id = lease_areas.lease_id');
        $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id');
        $this->db->where('reservations.user_id !=', $userid);
        $this->db->where('reservations.lease_area_id =', $lease_area_id);
        $this->db->where('reservations.reservation_status =', 'active');
        $this->db->where("((reservations.start_date BETWEEN '$startDate' AND '$endDate')");
        $this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$endDate')");
        $this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$endDate'))");
        $this->db->order_by('reservations.start_date', 'asc');
        $query2 = $this->db->get();
        return $other_hunters = $query2->result_array();
    }
}
