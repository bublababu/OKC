<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<?php 
$location_description=$leases[0]["location_description"];
$land_description=$leases[0]["land_description"];
$game_description=$leases[0]["game_description"];
$rules_description=$leases[0]["rules_description"];
$hunter_description=$leases[0]["hunter_description"];
$lodgeId= isset($lease_Id)&& $lease_Id!=""?$lease_Id:"";
// Colors
$colorList  = ['label-u','label-blue','label-orange','label-red','label-green','label-purple','label-sea','label-brown'];
$colorCount = 0;

?>
<div class="container home-block">	
	<div class="row">
		<div class="col-md-8">
            <div class="headline"><h2>Overview</h2></div>
            
                <div class="row clients-page">
                    <div class="col-md-1">
                        <i class="icon-book-open icon-custom rounded-x icon-bg-u"></i>
                    </div>
                    <div class="col-md-11">
                        <h3>Location</h3>
                        <?php if(isset($location_description) && $location_description!="") echo stripslashes($location_description);?>
                    </div>
                </div>

                <div class="row clients-page">
                    <div class="col-md-1">
                        <i class="icon-pointer icon-custom rounded-x icon-bg-u"></i>
                    </div>
                    <div class="col-md-11">
                        <h3>Land</h3>
                        <?php if(isset($land_description) && $land_description!="") echo stripslashes($land_description);?>
                    </div>
                </div>
            
                <div class="row clients-page">
                    <div class="col-md-1">
                        <i class="icon-social-twitter icon-custom rounded-x icon-bg-u"></i>
                    </div>
                    <div class="col-md-11">
                        <h3>Game</h3>
                        <?php if(isset($game_description) && $game_description!="") echo stripslashes($game_description);?>
                    </div>
                </div>
            
                <div class="row clients-page">
                    <div class="col-md-1">
                        <i class="icon-star icon-custom rounded-x icon-bg-u"></i>
                    </div>
                    <div class="col-md-11">
                        <h3>Special Rules</h3>
                        <?php if(isset($rules_description) && $rules_description!="") echo stripslashes($rules_description);?>
                    </div>
                </div>
            
                <div class="row clients-page">
                    <div class="col-md-1">
                        <i class="fa fa-info icon-custom rounded-x icon-bg-u"></i>
                    </div>
                    <div class="col-md-11">
                        <h3>Max Hunters</h3>
                        <?php if(isset($hunter_description) && $hunter_description!="") echo stripslashes($hunter_description);?>
                    </div>
                </div>
            
        </div>
        <div class="col-md-4">
            <div class="headline"><h2>Maps</h2></div>
            <ul class="list-unstyled">
            <?php foreach ($leasefiles as $leasefile): ?>
                <?php 
                    $file_description=$leasefile['file_description'];
                    $file_name=$leasefile['file_name'];
                    $mime_type=$leasefile['mime_type'];   
                    $faIcon="";                    
                    $filetype = substr($mime_type, strpos($mime_type, "/") + 1);   
                   if($filetype == "jpeg" || $filetype == "jpg" || $filetype == "png" || $filetype == "tiff")
                   {
                    $faIcon="fa-file-image-o";
                   }
                   else if($filetype == "pdf")
                   {
                    $faIcon="fa-file-pdf-o";
                   }
                   else if($filetype == "xml")
                   {
                    $faIcon="fa-file-text-o";
                   }
                   else
                   {
                    $faIcon="fa-file-o";
                   }
                ?>
                <li>
                    <i class="fa <?php if(isset($faIcon) && $faIcon!="") echo stripslashes($faIcon); ?>"></i>
                    <a href="<?php echo BASE_URL?>uploads/lease/<?php if(isset($file_name) && $file_name!="") echo stripslashes($file_name); ?>" target="_blank"><?php if(isset($file_description) && $file_description!="") echo stripslashes($file_description); ?></a>
                </li>
              
                <?php endforeach;?>
            </ul>
            <div id="googleMap" style="width:100%;height:350px;"></div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-11">
    <div class="headline"><h2>Lease Activity Calendars</h2></div>

    <?php foreach ($reservationtypes as $reservationtype): ?>
        <?php 
            $ActivityName=$reservationtype['name'];
            $ActivityId=$reservationtype['id'];
            $today=date("Y-m-d");
            $startDate = new \DateTime($reservationtype['start_date']);
            $endDate = new \DateTime($reservationtype['end_date']);
        ?>
    <h3><?php if(isset($ActivityName) && $ActivityName!="") echo stripslashes($ActivityName); ?></h3>
    <div class="row clients-page">
    <div class="col-md-9">
    <div id="calendar<?php echo $ActivityId?>" style="background-color: white;" class="calendar"></div>  
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
                lease: <?php echo $lodgeId?>,
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
    <div class="col-md-3">
            <div class="headline" style="margin-top: 20px;"><h2>Location Areas</h2></div>
           <?php $leases_area_name = $controller->leases_area_name($reservationtype['id'],$leases[0]["id"]); $i=1; ?>
            <?php $colorCount = 0; ?>
            <?php foreach($leases_area_name as $name): ?>
            <p><span class="label <?php echo $colorList[$colorCount]?>"><?php echo $name?></span></p>
            <?php
                $colorCount++;
                if ($colorCount > 7) $colorCount = 0;
            ?>
            <?php endforeach;?>
                <!-- <p><span class="label label-blue">A1A</span></p>
                <p><span class="label label-orange">A2</span></p>
                <p><span class="label label-red">A3E</span></p>
                <p><span class="label label-green">A3W</span></p>
                <p><span class="label label-purple">A4</span></p>
                <p><span class="label label-sea">A4B</span></p>
                <p><span class="label label-brown">A5</span></p> -->

     </div>
    </div>
    <?php endforeach;?>
    </div>
    </div>
	<script>
		function LeasesMap() {
    var mapProp= {
      center:new google.maps.LatLng(36.084621,-96.921387),
      zoom:6,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	<?php foreach ($leases as $lease): ?>
	var myLatLng = new google.maps.LatLng(<?= $lease['latitude']; ?>, <?= $lease['longitude']; ?>);
		var myMarkerOptions = {
		position: myLatLng,
		map: map,
		title: '<?= $lease['name']; ?>'
		}
	var myMarker = new google.maps.Marker(myMarkerOptions);
	<?php endforeach;?>	
    }
	</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJDRg3eIoFF01OXLowbSwtFVz2nYUAxOQ&callback=LeasesMap"></script>
</div>