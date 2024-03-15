<script
    src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"
    integrity="sha512-RGDpUuNPNGV62jwbX1n/jNVUuK/z/GRbasvukyOim4R8gUEXSAjB4o0gBplhpO8Mv9rr7HNtGzV508Q1LBGsfA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.min.css"
    integrity="sha512-wcKDxok85zB8F9HzgUwzzzPKJhHG7qMfC7bSKrZcFTC2wZXVhmgKNXYuid02cHVnFSC8KOJCXQ8M83UVA7v5Bw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
/>
<?php 
    $reservation_types_name = isset($reservation_types[0]["name"]) && $reservation_types[0]["name"] != "" ? $reservation_types[0]["name"] : "";
    $reservation_types_id = isset($reservation_types[0]["id"]) && $reservation_types[0]["id"] != "" ? $reservation_types[0]["id"] : "";
    
    $leasesname = isset($lease_area[0]["leasesname"]) && $lease_area[0]["leasesname"] != "" ? $lease_area[0]["leasesname"] : "";
    $lease_area_name = isset($lease_area[0]["name"]) && $lease_area[0]["name"] != "" ? $lease_area[0]["name"] : ""; 
    $lease_id = isset($lease_area[0]["lease_id"]) && $lease_area[0]["lease_id"] != "" ? $lease_area[0]["lease_id"] : "";    
   
    $start_Date = isset($day1) && $day1 != "" ? $day1 : "";
    $availbt1 = isset($availbt1) && $availbt1 != "" ? $availbt1 : "";

    $day2 = isset($day2) && $day2 != "" ? $day2 : "";
    $availbt2 = isset($availbt2) && $availbt2 != "" ? $availbt2 : "";

    $day3 = isset($day3) && $day3 != "" ? $day3 : "";
    $availbt3 = isset($availbt3) && $availbt3 != "" ? $availbt3 : "";

    $user_first_name = isset($user_details[0]["first_name"]) && $user_details[0]["first_name"] != "" ? $user_details[0]["first_name"] : "";
    $user_last_name = isset($user_details[0]["last_name"]) && $user_details[0]["last_name"] != "" ? $user_details[0]["last_name"] : "";
?>

<div class="container home-block">	
	<div class="row tab-v3">
		<div class="col-md-3 md-margin-bottom-40">
			<ul class="nav nav-pills nav-stacked">
			    <li class=""><a href="/reservations/activity"><i class="fa fa-trophy"></i> 1. Activity</a></li>
			    <li class=""><a href="/reservations/location/<?= $reservation_types_id ?>"><i class="fa fa-location-arrow"></i> 2. Location</a></li>
			    <li class=""><a href="/reservations/dates/<?= $reservation_types_id ?>/<?= $lease_id ?>"><i class="fa fa-calendar"></i> 3. Available Dates</a></li>
			    <li class="active"><a ><i class="fa fa-book"></i> 4. Book</a></li>
			</ul>
		</div>
        <div class="col-md-9">
			<div class="tag-box tag-box-v3">
            <?php echo $form->open(); ?>
            <?php echo $form->messages(); ?>
			    <div class="headline"><h2>Book</h2></div>
			    <div class="row">
					<div class="col-md-12">
                        <h5>Please fill out the form below with the number of days you wish to go on this reservation along with who will be attending. Also below is a table with the number of open spots per day.</h5>

                        <ul class="list-unstyled">
                            <li><i class="fa fa-check color-green"></i> <strong>Activity:</strong> <?= $reservation_types_name?></li>
                            <li><i class="fa fa-check color-green"></i> <strong>Location:</strong> <?= $leasesname?></li>
                            <li><i class="fa fa-check color-green"></i> <strong>Area:</strong> <?= $lease_area_name?></li>
                            <li><i class="fa fa-check color-green"></i> <strong>Start Date:</strong> <?= $start_Date?></li>
                        </ul>

                        <hr class="devider devider-db">

                        <div class="headline"><h2>Available Spots</h2></div>
                        
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Spots Available</th>
                                <th>Open?</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $start_Date?></td>
                                    <td><?= $availbt1?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?= $day2?></td>
                                    <td><?= $availbt2?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?= $day3?></td>
                                    <td><?= $availbt3?></td>
                                    <td></td>
                                </tr>
                             </tbody>
                        </table>

                        <hr class="devider devider-db">
                        <fieldset>
                               <section>
                                  <label class="label"><strong>Select the number of days for this reservation</strong></label>
                                  <div class="form-group">
                                     <label class="radio-inline">
                                        <input type="radio" name="days" id="days" class="icheck-input" value="1" checked="checked" style="position: absolute; opacity: 0;">
                                        1 Day
                                     </label>
                                     <label class="radio-inline">
                                        <input type="radio" name="days" class="icheck-input" value="2" style="position: absolute; opacity: 0;">
                                        2 Days
                                     </label>
                                     <label class="radio-inline">
                                        <input type="radio" name="days" class="icheck-input" value="3" style="position: absolute; opacity: 0;">
                                        3 Days
                                     </label>
                                  </div>
                               </section>
                            </fieldset>
                            <hr class="devider devider-db">
                        <div class="headline"><h2>Other Hunters</h2></div>
                    <?php if( !empty($other_hunters))
                    {                    
                    ?>                    
                        <table class="table table-bordered table-striped bycolor-table table-hover">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Reservation Type</th>
                                <th>Lease Area</th>
                                <!-- <th>Start Date</th>
                                <th>End Date</th> -->
                                <th>Attending</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php for ($i=0;$i<3;$i++){?>
                            <tr class="tr<?= $i+1 ?>"><td class="bolder heading" colspan="6"><h3><?= date('l, F j, Y',strtotime($start_date))?></h3></td></tr>
                            <?php $other_hunter_details = $controller->other_hunters($userid,$start_date,$start_date,$lease_area_id); ?>
                        <?php foreach ($other_hunter_details as $other_hunter) {
                            //print("<pre>".print_r($this->db->last_query(),true)."</pre>"); 
                             //$other_hunter_details = $controller->other_hunter_details($other_hunter["id"]);  
                             $usersAttending = $controller->reservation_users($other_hunter["id"]); 
                             //print("<pre>".print_r($other_hunter_details,true)."</pre>");
                            // print("<pre>".print_r($usersAttending,true)."</pre>");                         
                             ?>                          
                            
                            <tr class="tr<?= $i+1 ?>">
                                <td><?= $other_hunter["first_name"] ?> <?= $other_hunter["last_name"] ?></td>
                                <td><?=$other_hunter["reservation_types_name"] ?></td>
                                <td><?=$other_hunter["lease_areas_name"] ?></td>
                                <!-- <td><?=$other_hunter["start_date"] ?></td>
                                <td><?=$other_hunter["end_date"] ?></td> -->
                                <td>
                                    <ul class="list-unstyled">
                                    <?php  foreach ($usersAttending as $guest) { ?>
                                        <li><i class="fa fa-check color-green"></i> <?=$guest['name']?> (<?=$guest['guest_types']?>)</li>
                                    <?php } ?>
                                    </ul>
                                </td>
                            </tr>
                            <?php } 
                            $start_date = date('Y-m-d', strtotime($start_date. ' + 1 days'));
                        }?>

                        </tbody>
                        
                    </table>
                    <?php } 
                    else {
                    ?>
                        <p>None</p>
                    <?php }?>
                       
                        
                        <hr class="devider devider-db">                                      
                      

                            
                            <fieldset>
                                <section>
                                  <label class="label"><strong>Who will be attending this reservation?</strong></label>
                                  <div class="form-group">
                                     <input type="hidden" name="useSpot" value="0">
                                     <label class="checkbox">
                                        <input type="checkbox" name="useSpot" id="useSpot" class="icheck-input owner" value="1" style="position: absolute; opacity: 0;">
                                        <?= $user_first_name .' '. $user_last_name ?> (Badge Owner)
                                     </label>
                                  </div>
                                  <label class="label">Select any previous guests</label>
                                  <input type="hidden" id="guest_count" name="guest_count" value="0">
                                  <?php if( !empty($users_guests))
                                     {  
                                       foreach ($users_guests as $users_guest) {                   
                                    ?>
                                  <div class="form-group">
                                     <label class="checkbox">
                                        <input type="checkbox" name="reservationUsers[]" class="icheck-input guest" value=" <?= $users_guest["id"] ?>" style="position: absolute; opacity: 0;">
                                        <?= $users_guest["name"] ?>
                                     </label>
                                  </div>
                                  <?php }
                                  } 
                                    else {
                                    ?>
                                        <p>None</p>
                                    <?php }?>
                                    <label class="label">Select any Non-Hunting Guest</label>
                                    <?php if( !empty($Non_Hunting_Guest))
                                     {  
                                       foreach ($Non_Hunting_Guest as $Non_Hunting) {                   
                                    ?>
                                  <div class="form-group">
                                     <label class="checkbox">
                                        <input type="checkbox" name="reservationUsers[]" class="icheck-input" value=" <?= $Non_Hunting["id"] ?>" style="position: absolute; opacity: 0;">
                                        <?= $Non_Hunting["name"] ?>
                                     </label>
                                  </div>
                                  <?php }
                                  } 
                                    else {
                                    ?>
                                        <p>None</p>
                                    <?php }?>
                                  <!-- <label class="label">Write in any additional guests. Family members and family member guests should not be write in guests. <b>You will be charged for any guests you put in these fields. Please leave blank if you don't have any guests.</b></label>
                                  <div>
                                     <label class="input">
                                     <input type="text" name="guest_1" placeholder="Name of Write In Guest 1" value=""></label>
                                     <label class="input">
                                     <input type="text" name="guest_2" placeholder="Name of Write In Guest 2" value=""></label>
                                     <label class="input">
                                     <input type="text" name="guest_3" placeholder="Name of Write In Guest 3" value=""></label>
                                  </div> -->
                                </section>
                            </fieldset>
                            <footer>
                                <?php if($iseligible){ ?>
                               <button class="btn-u btn-submit" type="submit">Book It</button>
                               <?php } else { ?>
                                <h3 class="text-danger">This reservation cannot be completed as you already have three active reservations of this kind. Please ensure harvest reports are complete or contact an administrator.</h3>
                                <?php } ?>
                            </footer>
                      
                        
                    </div>
                </div>
                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(function () {
            $("input:radio").iCheck({//iradio_minimal-green
                radioClass: "iradio_minimal-green",
                inheritClass: true,
            });
        });
        
        $(function () {
            $("input:checkbox").iCheck({//icheckbox_minimal-green
                checkboxClass: "icheckbox_minimal-green",
                inheritClass: true,
            });
            $("input.guest").on("ifToggled", function (e) {
                if ($("input.guest").filter(":checked").length >= 3) {
                    $("input.guest").not(":checked").iCheck("disable");
                } else {
                    $("input.guest").not(":checked").iCheck("enable");
                }
            });

            $("input.guest").on("ifToggled", function (e) {
                var numberOfChecked = $('input.guest:checked').length;
                $('#guest_count').val(numberOfChecked);
            });

            $(".btn-submit").on("click", function (event) {
                var ownerChecked = $('input.owner:checked').length;
                var numberOfChecked = $('input.guest:checked').length;              
               if(ownerChecked>0 || numberOfChecked>0)
               {
                 $( ".btn-submit" ).trigger( "submit" );
               }
               else
               {
                event.preventDefault();
                alert("A reservation is not allowed unless at least 1 name is selected.");
                return false;
               }
               
            });
        });
        $('.tr2').hide();
        $('.tr3').hide();
        $('input').on('ifClicked', function (event) {
            var value = $(this).val();
	        //alert(value);
            if(value==1)
            {
                $('.tr2').hide();
                $('.tr3').hide();
            }
            else if(value==2)
            {
                $('.tr2').show();
                $('.tr3').hide();
            }
            else if(value==3)
            {
                $('.tr2').show();
                $('.tr3').show();
            }
            else
            {
                $('.tr2').hide();
                $('.tr3').hide();
            }
	    });
    </script>
    
</div>