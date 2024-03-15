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
if(!isset($member_id) && $member_id=="")
    {
        $member_id="all";
    }
$count_uri= isset($per_page)&& $per_page!=""?"&amp;count=".$per_page:"";
$startDate_uri= isset($startDate)&& $startDate!=""?"&amp;startDate=".$startDate:"";
$endDate_uri=isset($endDate)&& $endDate!=""?"&amp;endDate=".$endDate:"";
$status_uri=isset($status)&& $status!=""?"&amp;status=".$status:"";
$gametype_uri=isset($gametype)&& $gametype!=""?"&amp;gametype=".$gametype:"";
$lease_uri=isset($lease)&& $lease!=""?"&amp;lease=".$lease:"";
$draw_uri=isset($draw)&& $draw!=""?"&amp;draw=".$draw:"";
$search_uri=isset($search)&& $search!=""?"&amp;search=".$search:"";

$member_uri=isset($member_id)&& $member_id!=""?"&amp;member=".$member_id:"";

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
           
            <div class="row p-3">

            <div class="col-md-12 col-sm-8">
                <div class="mb-2">
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle" data-toggle="dropdown">
                        <?= $per_page ?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/reports/reservations?count=10<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">10</a></li>
                        <li><a href="/admin/reports/reservations?count=25<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">25</a></li>
                        <li><a href="/admin/reports/reservations?count=50<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">50</a></li>
                    </ul>
                </div>

                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Status: <?php echo $status ?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a href="/admin/reports/reservations?status=all<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">All</a></li>
                        <li><a href="/admin/reports/reservations?status=active<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">Active</a></li>
                        <li><a href="/admin/reports/reservations?status=cancel<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">Cancelled</a></li>
                        <li><a href="/admin/reports/reservations?status=complete<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">Completed</a></li>
                        <li><a href="/admin/reports/reservations?status=trash<?= $count_uri . $startDate_uri . $endDate_uri . $gametype_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">Trashed</a></li>
                    </ul>
                </div>

                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Reservation Type: <span id="gametype"></span> &nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a class="gametype" href="/admin/reports/reservations?gametype=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>">All</a></li>
                        <?php $reservation_types=array(); $reservation_types = $controller->reservation_types_list(); ?>
                        <?php  foreach ($reservation_types as $reservation_type) { ?>
                        <li><a class="gametype" href="/admin/reports/reservations?gametype=<?=$reservation_type['id']?><?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $lease_uri . $draw_uri .$member_uri. $search_uri?>"><?=$reservation_type['name']?></a></li>
                        <?php } ?>
                    </ul>
                </div> 
                

                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                    <?php ?>
                        <i class="fa fa-home"></i>&nbsp;Lease: <?=$lease_name?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a href="/admin/reports/reservations?lease=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $draw_uri .$member_uri. $search_uri?>">All</a></li>
                         <?php $leases=array(); $leases = $controller->leaselist(); ?>
                            <?php  foreach ($leases as $lease) { ?>
                             <li> <a href="/admin/reports/reservations?lease=<?=$lease['id']?><?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $draw_uri .$member_uri. $search_uri?>"><?=$lease['name']?> </a></li>
                        <?php } ?>
                    </ul>
                   </div> 
                   <div class="btn-group mb-3"> 
                    <button type="button" class="btn btn-md btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Draw: <span id="draw"></span>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="draw" href="/admin/reports/reservations?draw=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri .$member_uri. $search_uri?>">Both</a></li>
                        <li><a class="draw" href="/admin/reports/reservations?draw=1<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri .$member_uri. $search_uri?>">Yes</a></li>
                        <li><a class="draw" href="/admin/reports/reservations?draw=0<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri .$member_uri. $search_uri?>">No</a></li>
                    </ul>
                    
                </div>
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-user"></i>&nbsp;Member: <span id="member"></span> &nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a class="member" href="/admin/reports/reservations?member=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri .$draw_uri. $search_uri?>">All</a></li>                      
                        <?php  foreach ($members as $member) { ?>
                        <li><a class="member" href="/admin/reports/reservations?member=<?=$member['user_id']?><?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $gametype_uri . $lease_uri .$draw_uri. $search_uri?>"><?=$member['first_name']?>&nbsp;<?=$member['last_name']?>&nbsp;(<?=$member['user_id']?>)</a></li>
                        <?php } ?>
                    </ul>
                    <a class="btn btn-primary ml-3 download_csv" role="button">Download</a> 
                </div> 
                </div>
                <div class="row">
               
                    <div class="col-md-4 mb-4">              
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
            
            <div class="row col-md-12 custom-date-range p-3 pb-0 pt-0 pl-4">
                <div class="col-sm-4 mb-0">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
            
            <div class="row col-md-12 custom-date-filter">
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
            
        </div>
            <div class="col-md-12 p-3">
                <div class="custom-table-wrapper">
                    <table class="table table-bordered table-striped bycolor-table table-hover">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>DATES</th>
                                <th>Draw Hunt</th>
                                <th>Lease</th>
                                <th>Lease Area</th>
                                 <th>Reservation Type</th>
                                <th>Attending</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                        
                        <?php //print_r($reservations) ?>
                            <tr>
                               <?php $user=array(); $user = $controller->user($reservation['user_id']);?>
                                <td><?=$reservation['first_name']?> <?=$reservation['last_name']?> (#<?=$reservation['badge']?>)</td>
                               <td><?=$reservation['start_date']?> - <?=$reservation['end_date']?></td>
                               <td class="draw_hunt<?=$reservation['draw_hunt']?>"><span class="false"><?php if($reservation['draw_hunt']) echo "True";  else echo "false" ;?></span></td>
                                <?php // $lease=array(); $lease = $controller->lease($reservation['reservation_type_id']);?>
                                <!-- <td><?//=$lease[0]['name']?></td> -->
                                <td><?=$reservation['leases_name']?></td>
                                 <?php // $lease_area=array(); $lease_area = $controller->lease_area($reservation['lease_area_id']);?>
                                <!-- <td><?//=$lease_area[0]['name']?></td> -->
                                <td><?=$reservation['lease_areas_name']?></td>
                                <td><?=$controller->RevTypeName($reservation['reservation_type_id'])?></td>
                                  <td>
                                    <ul class="list-unstyled">
                                    <?php if($reservation['use_spot']) { ?>
                                            <li><i class="fa fa-check color-green"></i> <?=$reservation['first_name']?> <?=$reservation['last_name']?> (Badge)</li>
                                        <?php } else { ?>
                                            <li><i class="fa fa-check color-green"></i> <?=$reservation['first_name']?> <?=$reservation['last_name']?> (Badge) (Member Not Attending)</li>
                                        <?php } ?>
                                        <?php $users=array(); $users = $controller->reservation_users($reservation['id']); ?>
                                        <?php  foreach ($users as $guest) { ?>
                                         <li><i class="fa fa-check color-green"></i> <?=$guest['name']?> (<?=$guest['guest_types']?>)</li>
                                        <?php } ?>
                                        
                                    </ul>
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
    $( ".calendar" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
            });  
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
            //"showDropdowns": true,
            startDate: start,
            endDate: end,
          ranges: {
            'ALL':[moment('2015-01-01'),moment('2015-01-01')],
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
            var baseUrl = '/admin/reports/reservations';
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
       //Member DROPDOWN FUNCTION SET VALUE//
  $('.member').click(function(){
        var value= $(this).text();     
       Cookies.set('member', ''+value+'')//set the cookie value  
    });
    var memberValue=Cookies.get('member')//get the value from cookie  
    if (typeof memberValue !== 'undefined'){      
       $('#member').text(memberValue);
    }
    else
    {
        $('#member').text("All"); 
    }
    var memberAll = "<?php echo $member_id ?>";
    if(memberAll=="all")
    {
        $('#member').text("All"); 
    }   
    //Member.remove('draw');

     //**********//Custom Date Start
    $('#cusDate').click(function(){
      var cusStartDate = $('.CusSartDate').val();
      var cusEndDate = $('.CusEndDate').val();
     // Cookies.set('cusStartDate', ''+cusStartDate+'')//set the cookie value  
     // Cookies.set('cusEndDate', ''+cusEndDate+'')//set the cookie value  
      var baseUrl = '/admin/reports/reservations';
            var queryParameters = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;
            while (m = re.exec(queryString)) {
                queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            queryParameters['startDate'] = cusStartDate;
            queryParameters['endDate'] = cusEndDate;
            var newUrl = baseUrl + '?' + $.param(queryParameters);
            window.location.href = newUrl;
    });
    // var cusStartDate=Cookies.get('cusStartDate')//get the value from cookie  
    // if (typeof cusStartDate !== 'undefined'){      
    //    $('.CusSartDate').val(cusStartDate);
    //    Cookies.remove('cusStartDate');
    // }
    // else
    // {
    //     $('.CusSartDate').val(""); 
    // }
    // var cusEndDate=Cookies.get('cusEndDate')//get the value from cookie 
    // if (typeof cusEndDate !== 'undefined'){      
    //    $('.CusEndDate').val(cusEndDate);
    //    Cookies.remove('cusEndDate');
    // }
    // else
    // {
    //     $('.CusEndDate').val(""); 
    // } 
    //**********//Custom Date End

    $('.download_csv').click(function(){
            var baseUrl = '/admin/reports/reservations/download_csv';
            var queryParameters = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;
            while (m = re.exec(queryString)) {
                queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }            
            var newUrl = baseUrl + '?' + $.param(queryParameters);
            window.location.href = newUrl;
        //alert(newUrl);
    })
});
</script>
</div>