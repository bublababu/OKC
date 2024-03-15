<link rel="stylesheet" href="<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.css" />
<script src='<?php echo BASE_URL?>assets/daterangepicker/moment.min.js'></script>
<script src='<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.js'></script>

<?php 
//URL PARAMETERS CONFIGARATION START
$page_no="";
if(isset($offset)&& $offset!="")
{
    $page_no="&amp;p=".$offset;
}
else{$page_no="";}

if(!isset($status)&& $status=="")
    {
        $status="all";
    }
    if(!isset($draw)&& $draw=="")
    {
        $draw="all";
    }
if(!isset($gametype)&& $gametype=="")
    {
        $gametype="all";
    }
$count_uri= isset($per_page)&& $per_page!=""?"&amp;count=".$per_page:"";
$startDate_uri= isset($startDate)&& $startDate!=""?"&amp;startDate=".$startDate:"";
$endDate_uri=isset($endDate)&& $endDate!=""?"&amp;endDate=".$endDate:"";
$status_uri=isset($status)&& $status!=""?"&amp;status=".$status:"";
$gametype_uri=isset($gametype)&& $gametype!=""?"&amp;gametype=".$gametype:"";
$lease_uri=isset($lease)&& $lease!=""?"&amp;lease=".$lease:"";
$draw_uri=isset($draw)&& $draw!=""?"&amp;draw=".$draw:"";
$search_uri=isset($search)&& $search!=""?"&amp;search=".$search:"";

$lease_name=""; 
$lease_name2 = $controller->lease($lease);
$lease_name = isset($lease_name2[0]['name'])!=1?"":$lease_name2[0]['name'];
if($lease_name=="")
{
    $lease_name ="All";
}
//print_r($draw);
//URL PARAMETERS CONFIGARATION END
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
            <div class="col-md-12 p-3 custom-btn-container">
                <a href="reservations/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
            </div>

            <div class="col-md-12 col-sm-12 p-3">
                <div class="mb-2">
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle" data-toggle="dropdown">
                        <?= $per_page ?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/reservations?count=10<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">10</a></li>
                        <li><a href="/admin/reservations?count=25<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">25</a></li>
                        <li><a href="/admin/reservations?count=50<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">50</a></li>
                    </ul>
                </div>
                

                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Status: <?php echo $status ?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a href="/admin/reservations?status=all<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">All</a></li>
                        <li><a href="/admin/reservations?status=active<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">Active</a></li>
                        <li><a href="/admin/reservations?status=cancel<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">Cancelled</a></li>
                        <li><a href="/admin/reservations?status=complete<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">Completed</a></li>
                        <li><a href="/admin/reservations?status=trash<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri . $search_uri?>">Trashed</a></li>
                    </ul>
                </div>
                
                 <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Game Reservation Type: <span id="gametype"></span> &nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a class="gametype" href="/admin/reservations?gametype=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $lease_uri . $draw_uri . $search_uri?>">All</a></li>
                        <?php $reservation_types=array(); $reservation_types = $controller->reservation_types_list(); ?>
                        <?php  foreach ($reservation_types as $reservation_type) { ?>
                        <li><a class="gametype" href="/admin/reservations?gametype=<?=$reservation_type['id']?><?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $lease_uri . $draw_uri . $search_uri?>"><?=$reservation_type['name']?></a></li>
                        <?php } ?>
                    </ul>
                </div> 
                
                
                
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                    <?php ?>
                        <i class="fa fa-home"></i>&nbsp;Lease: <?=$lease_name?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a href="/admin/reservations?lease=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $draw_uri . $search_uri?>">All</a></li>
                         <?php $leases=array(); $leases = $controller->leaselist(); ?>
                            <?php  foreach ($leases as $lease) { ?>
                             <li> <a href="/admin/reservations?lease=<?=$lease['id']?><?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $draw_uri . $search_uri?>"><?=$lease['name']?> </a></li>
                        <?php } ?>
                    </ul>
                   </div> 
                <div class="btn-group mb-3"> 
                    <button type="button" class="btn btn-md btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Draw: <span id="draw"></span>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="draw" href="/admin/reservations?draw=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $search_uri?>">Both</a></li>
                        <li><a class="draw" href="/admin/reservations?draw=1<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $search_uri?>">Yes</a></li>
                        <li><a class="draw" href="/admin/reservations?draw=0<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $search_uri?>">No</a></li>
                    </ul>
                    
                </div>
                
                <div class="col-md-4 custom-search">              
                    <input type="hidden" name="page" value="2">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="<?= $search ?>" placeholder="Search Term">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>               
                </div>
                
                
                </div>

            </div>
            <div class="row col-md-12 custom-date-range p-3 pb-0 pt-0">
                <div class="col-sm-6">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
            <div class="row col-md-12 custom-date-filter p-3">
                <div class="col-md-2">
                    <label>Custom From Date :</label>
                    <div id="CusSartDate" class="input-group date" data-auto-close="true" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                        <input type="text" name="CusSartDate" autocomplete="off" class="form-control calendar CusSartDate validate[required]" value="" /> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Custom To Date :</label>
                    <div id="CusEndDate" class="input-group date" data-auto-close="true" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                        <input type="text" name="CusEndDate" autocomplete="off" class="form-control calendar CusEndDate validate[required]" value="" /> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-2">
                <button type="button" id="cusDate" class="cust-btn submit CusDateApply" name="cusDate" value="0">Apply</button>
                </div>
            </div>  

            <div class="col-md-12 col-sm-12 p-3">
                <div class="custom-table-wrapper">
                    <table class="table table-bordered table-striped bycolor-table table-hover">
                        <thead>
                            <tr>
                                 <th>#</th>
                                <th>DATES</th>
                                <th>Lease</th>
                                <th>Lease Area</th>
                                <th>Member</th>
                                <th>Attending</th>
                                <th>Status</th>
                                <th>Harvest Report</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                        
                        <?php //print_r($reservations) ?>
                            <tr>
                              <td>H00<?=$reservation['id']?></td>
                               <td><?=$reservation['start_date']?> - <?=$reservation['end_date']?></td>
                               
                                <?php // $lease=array(); $lease = $controller->lease($reservation['reservation_type_id']);?>
                                <!-- <td><?//=$lease[0]['name']?></td> -->
                                <td><?=$reservation['leases_name']?></td>
                                 <?php // $lease_area=array(); $lease_area = $controller->lease_area($reservation['lease_area_id']);?>
                                <!-- <td><?//=$lease_area[0]['name']?></td> -->
                                <td><?=$reservation['lease_areas_name']?></td>
                                 <?php $user=array(); $user = $controller->user($reservation['user_id']);?>
                                <td><?=$reservation['first_name']?> <?=$reservation['last_name']?> (#<?=$reservation['badge']?>)</td>
                                  <td>
                                    <ul>
                                    <?php if($reservation['use_spot']) { ?>
                                        <li> <?=$user[0]['first_name']?> <?=$user[0]['last_name']?> (Owner)</li>
                                    <?php } else { ?>
                                        <li> <?=$user[0]['first_name']?> <?=$user[0]['last_name']?> (Member Not Attending)</li>
                                    <?php } ?>
                                        <?php $users=array(); $users = $controller->reservation_users($reservation['id']); ?>
                                        <?php  foreach ($users as $guest) { ?>
                                         <li> <?=$guest['name']?> </li>
                                        <?php } ?>
                                        
                                    </ul>
                                 
                                  </td>
                                <td class="<?=$reservation['reservation_status']?>" style="white-space:nowrap;">
                                <?php
                                 if($reservation['reservation_status']=='active' || $reservation['reservation_status']=='complete')
                                 {  
                                   // echo 'OK';                                 
                                    if(( strtotime($reservation["end_date"]." +1 days")<=strtotime(date('Y-m-d')) ))  {                                       
                                       
                                       if($reservation['reservation_type_id']!='38' && $reservation['reservation_type_id']!='39' && $reservation['reservation_type_id']!='40') {
                                    
                                        if($reservation['reservation_status']=='active') {                                               
                                                    if($reservation['harvest_report']==0) {
                                                        echo '<span>Pending Report</span>';
                                                    }
                                                    else
                                                    {
                                                        echo '<span class="label label-primary">Completed</span>';
                                                    }                                                                                            
                                            }
                                            else
                                            {
                                                echo '<span class="label label-primary">Completed</span>';
                                            }
                                        }
                                        else{ /// ADDED By biplab 22-9-22
                                            echo '<span class="label label-primary">Completed</span>'; 
                                        }
                                    }
                                    else if ($reservation['reservation_status']=='complete')
                                    {
                                        echo '<span class="label label-primary">Completed</span>'; 
                                    }
                                    else
                                    {
                                       echo '<span>active</span>'; 
                                    }

                                 }
                                 else if($reservation['reservation_status']=='cancel') echo '<span>Cancelled</span>';
                                 else if($reservation['reservation_status']=='trash') echo '<span>Trashed</span>';
                                  else echo  $reservation['reservation_status'] ?>
                                  </td>
                                
                                <?php //$report = $controller->harvest_report($reservation['id']); ?>
                               
                                 <td>
                                 <?php if($reservation['reservation_type_id']!='38' && $reservation['reservation_type_id']!='39' && $reservation['reservation_type_id']!='40') { ?> 
                                    <?php if($reservation['reservation_status']=='active' || $reservation['reservation_status']=='complete') { ?> 
                                    <?php if($reservation['harvest_report']==0) {?> <a class="add" href="/admin/harvest-reports/add/<?=$reservation['id']?>"><i class="fa fa-plus"></i> Add</a> <?php } if($reservation['harvest_report']==1) {?> <a class="view" href="/admin/harvest-reports/view/<?=$reservation['id']?>"><i class="fa fa-search"></i> View</a><?php } ?>
                                    <?php } ?>
                                    <?php } ?>
                                 </td>
                                <td class="text-left" style="white-space:nowrap">                          
                                    <a href="/admin/reservations/view/<?=$reservation['id']?>" data-toggle="tooltip" title="View Reservation" class="cust_view_button"><span class="view-icon"></span></a>
                                    <a href="/admin/reservations/cancel/<?=$reservation['id']?>" data-toggle="tooltip" title="Cancel Reservation" class="cust_cancel_button"><span class="edit-icon"></span></a>
                                    <a href="/admin/reservations/trash/<?=$reservation['id']?>" data-toggle="tooltip" title="Trash Reservation" class="cust_delete_button"><span class="delete-icon"></span></a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="pull-left">
                <?php if(!empty($reservations)){ 
                    $count_to=$per_page + $count_from;
                    if($count_to >= $total_row)
                    {
                        $count_to = $total_row; 
                    }
                    ?>
                         Showing <?php echo $count_from+1 ?> to <?php echo  $count_to ?> of <?php echo $total_row ?> entries
                    <?php } else {?>
                         No data found! Showing 0 entries...
                    <?php } ?>
                </div>
                <div class="pull-right">
                    <?php  echo $this->pagination->create_links();   ?> 
                </div>
            </div>
        </div>
        <?php echo $form->close(); ?>   
    </div>
    <script type="text/javascript">
$(function() {
  //  var start = moment().startOf('month');
   // var end = moment().endOf('month');
    var start = new Date("<?php echo $startDate; ?>");
    var end = new Date("<?php echo $endDate; ?>");   
    function cb(start, end) {
        if(moment(start).format('YYYY-MM-DD')=='2015-01-01')
            {
                $('#reportrange span').html('ALL');
            }
            else
            {
                $('#reportrange span').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
            }
    }
    $('#reportrange').daterangepicker(
        {
            //format: 'YYYY-MM-DD',
            "showCustomRangeLabel": false,
            startDate: start,
            endDate: end,
          ranges: {
            'ALL': [moment('2015-01-01'),moment('2015-01-01')],
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
             'Last 7 Days': [moment().subtract('days', 6), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
          }          
        },
        function(start, end) {
            if(moment(start).format('YYYY-MM-DD')=='2015-01-01')
            {
                $('#reportrange span').html('ALL');
            }
            else
            {
            $('#reportrange span').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
            }
            var baseUrl = '/admin/reservations';
            var queryParameters = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;
            while (m = re.exec(queryString)) {
                queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            queryParameters['startDate'] = start.format('YYYY-MM-DD');
            queryParameters['endDate'] = end.format('YYYY-MM-DD');
            var newUrl = baseUrl + '?' + $.param(queryParameters);
            window.location.href = newUrl;
        },cb);  
    cb(start, end);
//DRAW DROPDOWN FUNCTION SET VALUE//
    $('.draw').click(function(){
        var value= $(this).text();     
       Cookies.set('draw', ''+value+'')//set the cookie value  
    });
    var drawValue=Cookies.get('draw')//get the value from cookie  
    if (typeof drawValue !== 'undefined'){      
       $('#draw').text(drawValue);
    }
    else
    {
        $('#draw').text("Both"); 
    }
    var drawAll = "<?php echo $draw ?>";
    if(drawAll=="all")
    {
        $('#draw').text("Both"); 
    }   
    //Cookies.remove('draw');
    ////DRAW DROPDOWN FUNCTION SET VALUE//

    //gametype DROPDOWN FUNCTION SET VALUE//
    $('.gametype').click(function(){
        var value= $(this).text();     
       Cookies.set('gametype', ''+value+'')//set the cookie value  
    });
    var gametypeValue=Cookies.get('gametype')//get the value from cookie  
    if (typeof gametypeValue !== 'undefined'){      
       $('#gametype').text(gametypeValue);
    }
    else
    {
        $('#gametype').text("All"); 
    }
    var gametypeAll = "<?php echo $gametype ?>";
    if(gametypeAll=="all")
    {
        $('#gametype').text("All"); 
    }   
    //Cookies.remove('draw');
    ////DRAW DROPDOWN FUNCTION SET VALUE//
});

$( ".calendar" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
 	});  
$('#cusDate').click(function(){
      var cusStartDate = $('.CusSartDate').val();
      var cusEndDate = $('.CusEndDate').val();     
      var baseUrl = '/admin/reservations';
            var queryParameters = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;
            while (m = re.exec(queryString)) {
                queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            queryParameters['startDate'] = cusStartDate;
            queryParameters['endDate'] = cusEndDate;
            var newUrl = baseUrl + '?' + $.param(queryParameters);
            window.location.href = newUrl;
    });
</script>
</div>