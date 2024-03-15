<link rel="stylesheet" href="<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.css" />
<script src='<?php echo BASE_URL?>assets/daterangepicker/moment.min.js'></script>
<script src='<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.js'></script>
<?php 
$page="";
$page_no="";
if(isset($offset)&& $offset!="")
{
    $page_no="&amp;p=".$offset;
}
else{$page_no="";}
$startDate_uri= isset($startDate)&& $startDate!=""?"&amp;startDate=".$startDate:"";
$endDate_uri=isset($endDate)&& $endDate!=""?"&amp;endDate=".$endDate:"";
if(!isset($member_id) && $member_id=="")
    {
        $member_id="all";
    }
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
            
         <div class="row p-3">

            
           <div class="col-sm-12 col-md-8 btn-group mb-4 member-field">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-user"></i>&nbsp;Member: <span id="member"></span> &nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize ml-4">
                        <li><a class="member" href="/admin/reports/guests?member=all<?= $startDate_uri . $endDate_uri?>">All</a></li>                      
                        <?php  foreach ($members as $member) { ?>
                        <li><a class="member" href="/admin/reports/guests?member=<?=$member['user_id']?><?= $startDate_uri . $endDate_uri?>"><?=$member['first_name']?>&nbsp;<?=$member['last_name']?>&nbsp;(<?=$member['user_id']?>)</a></li>
                        <?php } ?>
                    </ul>

                     <a class="btn btn-primary ml-3 download_csv" role="button">Download</a> 
                </div> 
        </div>
            
        <div class="row col-md-12 custom-date-range p-3 pb-0 pt-0">
           <div class="col-sm-4 mb-0">
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
        
        <div class="col-md-12 pl-0 total-count">              
            <span class="pull-right rpt-teritory">Total Guests: <?php echo $total_row ?></span>
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
                             <th>Guests</th>
                            
                         </tr>
                     </thead>
                     <tbody>
                     <?php foreach ($reservations as $reservations): ?>
                     
                     <?php //print_r($reservations) ?>
                         <tr>
                            <?php $user=array(); $user = $controller->user($reservations['user_id']);?>
                             <td><?=$user[0]['first_name']?> <?=$user[0]['last_name']?>(#<?=$user[0]['badge']?>)</td>
                            <td><?=$reservations['start_date']?> - <?=$reservations['end_date']?></td>
                             <td>
                                 <?php if($reservations['draw_hunt']==0) {?><span class="false">False</span> <?php } if($reservations['draw_hunt']==1) {?> <span class="true">True</span> <?php } ?>
                                 
                              </td>
                            
                             <?php $lease=array(); $lease = $controller->leaseData($reservations['lease_area_id']);?>
                             <?php //print_r($lease); exit; ?>
                             <td><?=$lease[0]['lname']?></td>
                             <td><?=$lease[0]['aname']?></td>
                             <td><?=$controller->RevTypeName($reservations['reservation_type_id'])?></td>
                             
                               <td>
                                 <ul class="list-unstyled">
                                     
                                     <?php $users=array(); $users = $controller->reservation_users($reservations['id']); ?>
                                     <?php  foreach ($users as $guest) { ?>
                                      <li><i class="fa fa-check color-green"></i> <?=$guest['name']?> (<?=$guest['guest_types']?>) </li>
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
            var baseUrl = '/admin/reports/guests';
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

    $('.download_csv').click(function(){
            var baseUrl = '/admin/reports/guests/download_csv';
            var queryParameters = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;
            while (m = re.exec(queryString)) {
                queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }            
            var newUrl = baseUrl + '?' + $.param(queryParameters);
            window.location.href = newUrl;
        //alert(newUrl);
    });
});

$( ".calendar" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
 	});  
$('#cusDate').click(function(){
      var cusStartDate = $('.CusSartDate').val();
      var cusEndDate = $('.CusEndDate').val();     
      var baseUrl = '/admin/reports/guests';
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