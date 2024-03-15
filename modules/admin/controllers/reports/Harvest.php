<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Harvest extends Admin_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
        $this->load->model('common_model');
	}
    
      public function index()
    {
            
             $startDate=$this->input->get('startDate', TRUE); 
                if($startDate=="")
                {
                 $startDate=date('Y-m-01');
                }
                $endDate=$this->input->get('endDate', TRUE); 
                if($endDate=="")
                {
                 $endDate = date('Y-m-t');
                }
                
                $lease = $this->input->get('lease', true);
                $leaseArea = $this->input->get('leaseArea', true);
                $gametype = $this->input->get('gametype', true);
                //print("<pre>".print_r($lease,true)."</pre>");
                ///get RESERVISION ID  based on date selected ///////
               // $this->db->get_compiled_select();
                 $this->db->select('reservations.id');
                 $this->db->order_by('reservations.start_date','desc');
                // $this->db->where('reservations.start_date>=',$startDate);
                // $this->db->where('reservations.end_date<=',$endDate);
                $this->db->where("(reservations.start_date BETWEEN '$startDate' AND '$endDate')");
                $this->db->or_where("(reservations.end_date BETWEEN '$startDate' AND '$endDate')");
                $this->db->or_where("(reservations.start_date <= '$startDate' AND reservations.end_date >= '$endDate')");
                 if($lease!="all" && $lease!="" )
                {
                        $this->db->where('lease_id',$lease); 
                }  
                if($leaseArea!="all" && $leaseArea!="" )
                {
                        $this->db->where('lease_areas.id',$leaseArea); 
                }     
                 ///// ADD more filter like lease , lease area , game type
                 $this->db->from('reservations');
                 $this->db->join('lease_areas', 'lease_areas.id = reservations.lease_area_id', 'left');
                 $this->db->join('leases', 'leases.id = lease_areas.lease_id', 'left');
                 $this->db->join('reservation_types', 'reservation_types.id = reservations.reservation_type_id', 'left');
                 $this->db->join('reservation_game_types', 'reservation_game_types.reservation_type_id = reservations.reservation_type_id', 'left');
                /* $this->db->join('game_types', 'game_types.id = reservation_game_types.game_type_id', 'left');*/
                 $this->db->distinct();
                 $query = $this->db->get();
                 $revIds=$query->result_array();
                  
                // print("<pre>".print_r($this->db->last_query(),true)."</pre>");
                 //// filter $revIds //// 
                 
                 
                 
                 
                 
		  ////// Don't touch bellow code ///
            $ids= array();
              foreach($revIds as $id)
              {
                 $ids[]=$id['id'];
              }
            
            
			////////////////// GRAPH DATA ////////////
			
            $tot=0;
            $gameData = array();
            $leaseData   = array();
            if(count($ids)) :
			  
              //////////// get game details //////////
               $this->db->select('SUM(harvest_count) as total,harvest_report_counts.game_type as gameid,game_types.name as gameName');
               $this->db->from('harvest_report_counts,harvest_reports,game_types');
               $this->db->where('harvest_report_counts.game_type = game_types.id');
               $this->db->where('harvest_reports.id = harvest_report_counts.report_id');
               if($gametype!="all" && $gametype!="" )
                {
                      $this->db->where('game_types.id', $gametype);
                }                 
               $this->db->where_in('harvest_reports.reservation_id',$ids);
               $this->db->group_by('harvest_report_counts.game_type'); 
               $query = $this->db->get();
              $gameData= $query->result_array();
              
              
              foreach($gameData as $data){
              $tot =$tot+$data['total'];
               
              }
            
			
            
            
            
            
			//------------------- END GRAPH DATA ------------------------//
			//////////////////// Other DATA Start //////////////////
            
             $testArray=array();
              $mygame=array();
              $filnallocationName=array();
              $i=0;
              $locationName=array();
			 
			  //1. get lease and lease are name
			  $this->db->join('lease_areas', 'lease_areas.lease_id = leases.id');
			 
			  $this->db->join('reservations', 'reservations.lease_area_id = lease_areas.id');
			  $this->db->where_in('reservations.id',$ids);
		      $this->db->select('leases.name as lname,lease_areas.name as aname,reservations.reservation_type_id,lease_areas.id as areaid ,leases.id as lid ,reservations.id as revid');
			   $this->db->order_by('leases.name');
			  // $this->db->group_by('lease_areas.name');
              $this->db->from('leases');
              $query = $this->db->get();
			  
			  $leaseDataOther=$query->result_array();
              
             
              foreach($leaseDataOther as $ldata):
              if($i++==0){
                  
              }
                   // echo $ldata['aname'];
                   $locationName[]=$ldata['lname'].' - '.$ldata['aname'];
                        $testArray[$ldata['lname']][]=$ldata['revid'];
                   
                endforeach;
			 // echo '<pre>';
			// print_r($testArray);
         //   echo '==========================';
          
             
             foreach($testArray as $testdata){
                
                  
                  //////////// get game details //////////
               $this->db->select('SUM(harvest_count) as total,harvest_report_counts.game_type as gameid,game_types.name as gameName');
               $this->db->from('harvest_report_counts,harvest_reports,game_types');
               $this->db->where('harvest_report_counts.game_type = game_types.id');
               $this->db->where('harvest_reports.id = harvest_report_counts.report_id');
               if($gametype!="all" && $gametype!="" )
                {
                      $this->db->where('game_types.id', $gametype);
                }                 
               $this->db->where_in('harvest_reports.reservation_id',$testdata);
               $this->db->group_by('harvest_report_counts.game_type'); 
               $query = $this->db->get();
              $gameDataGroup= $query->result_array();
              
              
              foreach($gameDataGroup as $data){
              $tot =$tot+$data['total'];
               
              }
                  
                  $mygame[]=$gameDataGroup;
             }
			 
            
             foreach(array_unique($locationName) as $final){
                $filnallocationName[]=$final;
             }
             
			//echo '<pre>'    ;
            //print_r($filnallocationName);
			//print_r($mygame);
			//------------------- End other data ------------------///
			
			 endif; 
               if($tot<1)
               {
                $tot=1;
               } 
            $this->mViewData['total']=$tot;
            $this->mViewData['gameData']=$gameData;    
            $this->mViewData['leaseData']=$leaseData;                            
            $this->mViewData['revIds']=$revIds;    
            $this->mViewData['startDate']=$startDate; 
            $this->mViewData['endDate']=$endDate;

            $this->mViewData['gametype'] = $gametype;
            $this->mViewData['lease'] = $lease;
            $this->mViewData['leaseArea'] = $leaseArea;
            
            
            ///////////Table data////////
            if(isset($filnallocationName)) :
            
            $this->mViewData['filnallocationName'] = $filnallocationName;
            $this->mViewData['mygame'] = $mygame;
            endif;

            $this->mViewData['controller'] = $this;
            $this->mPageTitle = 'Harvest Report';		
            $this->render('custom/reports/harvest_report', 'with_breadcrumb');	
    }
	
	
	public function finalData($revId,$game_id)
	{
		
		$this->db->select('SUM(harvest_count) as total,harvest_report_counts.game_type as gameid,game_types.name as gameName');
               $this->db->from('harvest_report_counts,harvest_reports,game_types');
               $this->db->where('harvest_report_counts.game_type = game_types.id');
               $this->db->where('harvest_reports.id = harvest_report_counts.report_id');
               $this->db->where('harvest_reports.reservation_id',$revId);
               if($game_id!="all" && $game_id!="" )
                {
                      $this->db->where('game_types.id', $game_id);
                }    
               $this->db->group_by('harvest_report_counts.game_type'); 
               $query = $this->db->get();
              $gameData_other= $query->result_array();
			  
			  return $gameData_other; 
		
	}
    
    public function  leaselist()
        {
           $this->db->select('*');
           $this->db->order_by('name','asc');
           $this->db->from('leases');
           $query = $this->db->get();
           $query->result_array(); 
		   return $query->result_array();	
        }
        
    public function leaseArealist()
     {
        
        $this->db->join('lease_areas', 'lease_areas.lease_id = leases.id');
		$this->db->select('leases.name as lname,lease_areas.name as aname,lease_areas.id');
        $this->db->from('leases');
      
        $query = $this->db->get();
		return $query->result_array();	
        
     }
     
     public function gamelist()
     {
             $this->db->select('name,id');
           $this->db->order_by('name','asc');
           $this->db->from('game_types');
           $query = $this->db->get();
          
		   return $query->result_array(); 
     }
     
}  