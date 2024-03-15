<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<?php 
$colorList  = ['label-u','label-blue','label-orange','label-red','label-green','label-purple','label-sea','label-brown'];
$colorCount = 0;

$ActivityName=isset($reservation_types_data[0]["name"]) && $reservation_types_data[0]["name"] != "" ? $reservation_types_data[0]["name"] : "";
$ActivityId=$reservation_types_id;
$today=date("Y-m-d");
$startDate = new \DateTime(isset($reservation_types_data[0]["start_date"]) && $reservation_types_data[0]["start_date"] != "" ? $reservation_types_data[0]["start_date"] : "");
$endDate = new \DateTime(isset($reservation_types_data[0]["end_date"]) && $reservation_types_data[0]["end_date"] != "" ? $reservation_types_data[0]["end_date"] : "");
?>


<div class="container home-block">	
	<div class="row tab-v3">
		<div class="col-md-3 md-margin-bottom-40">
			<ul class="nav nav-pills nav-stacked">
			    <li class=""><a href="/reservations/activity"><i class="fa fa-trophy"></i> 1. Activity</a></li>
			    <li class=""><a href="/reservations/location/<?= $reservation_types_id ?>"><i class="fa fa-location-arrow"></i> 2. Location</a></li>
			    <li class="active"><a><i class="fa fa-calendar"></i> 3. Available Dates</a></li>
			    <li class="disabled"><a><i class="fa fa-book"></i> 4. Book</a></li>
			</ul>
			
			<div class="headline" style="margin-top: 20px;"><h2>Location Areas</h2></div>
           <?php $leases_area_name = $controller->leases_area_name($reservation_types_id,$leaseid); $i=1; ?>
            <?php $colorCount = 0; ?>
            <?php foreach($leases_area_name as $name): ?>
            <p><span class="label <?php echo $colorList[$colorCount]?>"><?php echo $name?></span></p>
            <?php
                $colorCount++;
                if ($colorCount > 7) $colorCount = 0;
            ?>
            <?php endforeach;?> 
			
		</div>

        <div class="col-md-9">
            <div class="tag-box tag-box-v3">
                <div class="headline"><h2>Available Dates</h2></div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <h5>Please select the location area and date you wish to start your reservation on below.</h5>

                        <ul class="list-unstyled">
                            <li><i class="fa fa-check color-green"></i> <strong>Activity:</strong> <?= $ActivityName ?></li>
                            <li><i class="fa fa-check color-green"></i> <strong>Location:</strong> <?= $leases_data[0]["name"] ?></li>
                        </ul>

                        <hr class="devider devider-db">
                        <div id="calendar<?php echo $ActivityId?>" style="background-color: white;" class="calendar"></div>
                    </div>
                </div>
            </div>
            <?php // Set calendar view date to today or start date of season
            $today = new \DateTime('today midnight');
            if ($today < $startDate) {
                $year  = $startDate->format('Y');
                $month = $startDate->format('n') - 1;
            } else {
                $year  = $today->format('Y');
                $month = $today->format('n') - 1;
                $startDate = $today;
            }
            // Start and end date of activity
            $startDate = $startDate->format('Y-m-d');
            $endDate   = $endDate->format('Y-m-d');
            ?>
            <script>
    $(document).ready(function() {
        $('#calendar<?php echo $ActivityId?>').fullCalendar({
        header: {
            left: 'title',
            center: '',
            right: 'prev,next'
        },
        contentHeight:"auto",
        handleWindowResize:true,
        themeSystem:'bootstrap3',
        defaultDate: moment('<?php echo $startDate?>'),
        events: {
            url: '/leases/get_Lease_Area_Dates',
            data: {
                lease: <?php echo $leaseid?>,
                activity: <?php echo $ActivityId?>
            }
        },
        year: <?php echo $year?>,
        month: <?php echo $month?>,
        viewRender: function(view, el) {
            var startDate = new Date('<?php echo $startDate?>');
            var endDate   = new Date('<?php echo $endDate?>');
            //alert(startDate.getMonth());
            var cal_date_string = (view.start.month()+1) + '/' + view.start.year();
            var start_date_string = (startDate.getMonth()+1) + '/' + startDate.getFullYear();
            var end_date_string = (endDate.getMonth()+1) + '/' + endDate.getFullYear();

           // if(start_date_string == cal_date_string) { jQuery('#calendar<?php echo $ActivityId?> .fc-prev-button').addClass("fc-state-disabled"); }
           // else { jQuery('#calendar<?php echo $ActivityId?> .fc-prev-button').removeClass("fc-state-disabled"); }

           // if(end_date_string == cal_date_string) { jQuery('#calendar<?php echo $ActivityId?> .fc-next-button').addClass("fc-state-disabled"); }
           // else { jQuery('#calendar<?php echo $ActivityId?> .fc-next-button').removeClass("fc-state-disabled"); }
        }
    });
    });
</script>
        </div>