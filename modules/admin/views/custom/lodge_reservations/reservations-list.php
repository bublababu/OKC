<link rel="stylesheet" href="<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.css" />
<script src='<?php echo BASE_URL?>assets/daterangepicker/moment.min.js'></script>
<script src='<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.js'></script>
<?php 
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
    if(!isset($lodge)&& $lodge=="")
    {
        $lodge="all";
    }

$count_uri= isset($per_page)&& $per_page!=""?"&amp;count=".$per_page:"";
$startDate_uri= isset($startDate)&& $startDate!=""?"&amp;startDate=".$startDate:"";
$endDate_uri=isset($endDate)&& $endDate!=""?"&amp;endDate=".$endDate:"";
$status_uri=isset($status)&& $status!=""?"&amp;status=".$status:"";
$lodge_uri=isset($lodge)&& $lodge!=""?"&amp;lodge=".$lodge:"";
$search_uri=isset($search)&& $search!=""?"&amp;search=".$search:"";
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
            <div class="col-md-12 p-3 custom-btn-container">
                <a href="lodge_reservations/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
            </div>
            <div class="col-md-12 p-3">

                <div class="col-md-4 mb-3 pl-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-md btn-default dropdown-toggle" data-toggle="dropdown">
                            <?= $per_page ?>&nbsp;<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/lodge-reservations?count=10<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $lodge_uri . $search_uri?>">10</a></li>
                            <li><a href="/admin/lodge-reservations?count=25<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $lodge_uri . $search_uri?>">25</a></li>
                            <li><a href="/admin/lodge-reservations?count=50<?= $page_no . $startDate_uri . $endDate_uri . $status_uri . $lodge_uri . $search_uri?>">50</a></li>
                        </ul>
                    </div>
    
                    <div class="btn-group">
                        <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>&nbsp;Status: <?php echo $status ?>&nbsp;<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/lodge-reservations?status=all<?= $count_uri . $startDate_uri . $endDate_uri . $lodge_uri . $search_uri?>">All</a></li>
                            <li><a href="/admin/lodge-reservations?status=active<?= $count_uri . $startDate_uri . $endDate_uri . $lodge_uri . $search_uri?>">Active</a></li>
                            <li><a href="/admin/lodge-reservations?status=cancel<?= $count_uri . $startDate_uri . $endDate_uri . $lodge_uri . $search_uri?>">Cancelled</a></li>
                            <li><a href="/admin/lodge-reservations?status=trash<?= $count_uri . $startDate_uri . $endDate_uri . $lodge_uri . $search_uri?>">Trashed</a></li>
                        </ul>
                    </div> 
                   
                    <div class="btn-group"> 
                        <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                            <i class="fa fa-home"></i>&nbsp;Lodge: All&nbsp;<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu text-capitalize">
                        <li><a href="/admin/lodge-reservations?lodge=all<?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $search_uri?>">All</a></li>
                             <?php $lodgeLists=array(); $lodgeLists = $controller->lodgelist(); ?>
                                <?php  foreach ($lodgeLists as $lodgeList) { ?>
                                 <li> <a href="/admin/lodge-reservations?lodge=<?=$lodgeList['id']?><?= $count_uri . $startDate_uri . $endDate_uri . $status_uri . $search_uri?>"><?=$lodgeList['name']?> </a></li>
                            <?php } ?>                      
                        </ul>
                        
                    </div>
                </div>
            
                <div class="col-md-4 custom-search">              
                    <input type="hidden" name="page" value="2">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="" placeholder="Search Term">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>               
                </div>
        </div>
        <div class="row col-md-12 custom-date-range p-3 pb-0 pt-0">
            <div class="col-sm-4">
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
            <div class="col-md-12 p-3">
                <div class="custom-table-wrapper">
                    <table class="table table-bordered table-striped bycolor-table table-hover">
                        <thead>
                            <tr>
                                 <th>#</th>
                                <th>Start DATE</th>
                                <th>End DATE</th>
                                <th>Lodge</th>
                                <th>Bed</th>
                                <th>Name</th>
                                <th>Status</th>
                              
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservations as $reservations): ?>
                        
                        <?php //print_r($reservations) ?>
                            <tr>
                              <td>L000<?=$reservations['id']?></td>
                               <td><?=$reservations['start_date']?></td>
                               
                                
                                <td><?=$reservations['end_date']?></td>
                                 <?php $lodge_name=array(); $lodge_name = $controller->lodge_name($reservations['lodge_id']);?>
                                <td><?=$lodge_name[0]['name']?></td>
                                <?php $bedroom=array(); $bedroom = $controller->bedroom($reservations['bed_id'],$reservations['lodge_id']);?>
                                
                                <?php //print_r($bedroom); ?>
                                
                                <td><?=$bedroom[0]['lodgename']?> ,  <?=$bedroom[0]['name']?></td>
                                 <?php $user=array(); $user = $controller->reservation_users($reservations['user_id']);?>
                                  <td>
                                   <?=$user[0]['first_name']?> &nbsp; <?=$user[0]['last_name']?>
                                  </td>
                                <td class="<?=$reservations['reservation_status']?>"><span>
                                <?php if($reservations['reservation_status']=='cancel') echo 'cancelled'; else if($reservations['reservation_status']=='trash') echo 'trashed'; else echo $reservations['reservation_status'] ?>
                                </span></td>
                                
                                
                                <td class="text-left table-action-col">
                                    <a href="lodge-reservations/cancel/<?=$reservations['id']?>" data-toggle="tooltip" title="Cancel Reservation" class="cust_cancel_button"><span class="edit-icon"></span></a>
                                    <a href="lodge-reservations/trash/<?=$reservations['id']?>" data-toggle="tooltip" title="Trash Reservation" class="cust_delete_button"><span class="delete-icon"></span></a>
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
            var baseUrl = '/admin/lodge-reservations';
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
});

$( ".calendar" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
 	});  
$('#cusDate').click(function(){
      var cusStartDate = $('.CusSartDate').val();
      var cusEndDate = $('.CusEndDate').val();     
      var baseUrl = '/admin/lodge-reservations';
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