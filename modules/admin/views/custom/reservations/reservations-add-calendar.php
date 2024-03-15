<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<?php
//echo '<pre>';

//print_r($lease_Area)
 // Build colors
        $colorList  = ['label-u','label-blue','label-orange','label-red','label-green','label-purple','label-sea','label-brown'];
        $colorCount = 0;
 
$ActivityName=isset($reservation_types_data[0]["name"]) && $reservation_types_data[0]["name"] != "" ? $reservation_types_data[0]["name"] : "";
$ActivityId=$reservation_types_id;
$today=date("Y-m-d");
$startDate = new \DateTime(isset($reservation_types_data[0]["start_date"]) && $reservation_types_data[0]["start_date"] != "" ? $reservation_types_data[0]["start_date"] : "");
$endDate = new \DateTime(isset($reservation_types_data[0]["end_date"]) && $reservation_types_data[0]["end_date"] != "" ? $reservation_types_data[0]["end_date"] : "");

?>


<div class="row">
	<div class="col-lg-10 col-md-10 col-sm-10 mb-4">
        <div class="custom-title-bar">
            <div class="ftitle">
                <i class="fa fa-calendar"></i>
                Select Reservation Date
            </div>
        </div>
        <div class="custom-box">
        <div id="calendar<?php echo $ActivityId?>" style="background-color: white;" class="calendar"></div>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
        
        <div class="portlet portlet-plain">
            <div class="portlet-header">
                <h3>Lease Areas</h3>
            </div> <!-- /.portlet-header -->
            <div class="portlet-content">
                <div>
                    <?php foreach($lease_Area as $leaseareaName) : ?>
                    <div class="external-event label fc-<?=$colorList[$colorCount++]?>"><?=$leaseareaName['name']?></div>
                 <?php   if ($colorCount > 7) {
							$colorCount = 0;
						} ?>
                    <?php endforeach ?>
                    
                </div>
            </div> <!-- /.portlet-content -->
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
            url: 'reservations/get_Lease_Area_Dates',
            data: {
                lease: <?php echo $leaseid?>,
                activity: <?php echo $ActivityId?>,
                user_id:<?php echo $user_id?>,
                draw_hunt:<?php echo $draw_hunt?>
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

           // if(start_date_string == cal_date_string) { jQuery('#calendar<?php echo $ActivityId?> .fc-button-prev').addClass("fc-state-disabled"); }
           // else { jQuery('#calendar<?php echo $ActivityId?> .fc-button-prev').removeClass("fc-state-disabled"); }

           // if(end_date_string == cal_date_string) { jQuery('#calendar<?php echo $ActivityId?> .fc-button-next').addClass("fc-state-disabled"); }
           // else { jQuery('#calendar<?php echo $ActivityId?> .fc-button-next').removeClass("fc-state-disabled"); }
        }
    });
    });
</script>
</div>