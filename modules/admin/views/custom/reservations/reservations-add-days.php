<?php 
$user_first_name = isset($user_details[0]["first_name"]) && $user_details[0]["first_name"] != "" ? $user_details[0]["first_name"] : "";
$user_last_name = isset($user_details[0]["last_name"]) && $user_details[0]["last_name"] != "" ? $user_details[0]["last_name"] : "";

$leasesname = isset($lease_area[0]["leasesname"]) && $lease_area[0]["leasesname"] != "" ? $lease_area[0]["leasesname"] : "";
$lease_area_name = isset($lease_area[0]["name"]) && $lease_area[0]["name"] != "" ? $lease_area[0]["name"] : ""; 
$lease_id = isset($lease_area[0]["lease_id"]) && $lease_area[0]["lease_id"] != "" ? $lease_area[0]["lease_id"] : "";    

$reservation_types_name = isset($reservation_types[0]["name"]) && $reservation_types[0]["name"] != "" ? $reservation_types[0]["name"] : "";
$reservation_types_id = isset($reservation_types[0]["id"]) && $reservation_types[0]["id"] != "" ? $reservation_types[0]["id"] : "";

$start_Date = isset($day1) && $day1 != "" ? $day1 : "";
$availbt1 = isset($availbt1) && $availbt1 != "" ? $availbt1 : "";

$day2 = isset($day2) && $day2 != "" ? $day2 : "";
$availbt2 = isset($availbt2) && $availbt2 != "" ? $availbt2 : "";

$day3 = isset($day3) && $day3 != "" ? $day3 : "";
$availbt3 = isset($availbt3) && $availbt3 != "" ? $availbt3 : "";

$draw_hunt = isset($draw_hunt) && $draw_hunt != "" ? $draw_hunt : "";
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-primary">
        <?php echo $form->open(); ?>
            <?php echo $form->messages(); ?>
            <div class="col-md-6 mb-5 mt-5">
                <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="custom-title-bar">
                            <div class="ftitle">Reservation Information</div>
                        </div>
                        <div class="custom-box">
                            <div class="col-md-12">
                                <h4 class="mb-5">You are making a reservation for the following:</h4>
                                <table class="table table-bordered table-striped bycolor-table table-hover">
                                    <tbody>
                                        <tr>
                                            <td><strong>Member</strong></td>
                                            <td> <?= $user_first_name .' '. $user_last_name ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lease</strong></td>
                                            <td><?= $leasesname?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lease Area</strong></td>
                                            <td><?= $lease_area_name?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Reservation Type</strong></td>
                                            <td><?= $reservation_types_name?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Start Date</strong></td>
                                            <td><?= $start_Date?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Draw Hunt?</strong></td>
                                            <td><?php if($draw_hunt)
                                            {echo 'Yes';} 
                                            else{echo 'No';};                                            
                                            ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   </div>
                </div>		
            </div>
            
            <div class="col-md-6 mb-5 mt-5">
                <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="custom-title-bar">
                            <div class="ftitle">Days</div>
                        </div>
                        <div class="custom-box">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped bycolor-table table-hover">
                                    <thead>
                                        <tr>
                                            <th><strong>DATE</strong></th>
                                            <th><strong>SPOTS AVAILABLE</strong></th>
                                            <th><strong>OPEN?</strong></th>
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
                            </div>
                        </div>
                   </div>
                </div>		
            </div>
            
            <div class="col-md-12">
                <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12 pb-5">
                    <div class="custom-title-bar">
                            <div class="ftitle"></div>
                        </div>
                        <div class="custom-box">
                            <div class="form-field-box">
                                <div class="col-xs-2 capt top" id="">Days</div>
                                <div class="form-input-box col-xs-10">
                                    <input type="radio" name="days" id="1day" class="icheck-input" checked="" value="1">
                                    <span>1 Day</span>
                                    &nbsp; &nbsp;
                                    <input type="radio" name="days" id="2days" class="icheck-input" value="2">
                                    <span>2 Days</span>
                                    &nbsp; &nbsp;
                                    <input type="radio" name="days" id="3days" class="icheck-input" value="3">
                                    <span>3 Days</span>
                                    
                                    <span class="help-block">The number of days you want this reservation to last for.</span>
                                </div>
                            </div>
                            
                            <div class="form-field-box">
                                <div class="col-xs-2 capt top" id="">Badge Owner</div>
                                <div class="form-input-box col-xs-10">
                                    <input type="checkbox" name="useSpot" id="useSpot" class="icheck-input owner" value="1">
                                    
                                    <span class="help-block">Is the badge owner attending this reservation?</span>
                                </div>
                            </div>
                            
                            <div class="form-field-box">
                                <div class="col-md-2 capt top" id="">Guests</div>
                                <input type="hidden" id="guest_count" name="guest_count" value="0">
                                <div class="form-field-box col-md-10">
                                <?php if( !empty($users_guests))
                                     {  
                                       foreach ($users_guests as $users_guest) {                   
                                    ?>
                                    <div class="form-field-box guest">
                                        <div class="col-xs-4 captdown type guest-type">
                                            <input type="checkbox" name="reservationUsers[]" id="guest-name1" class="icheck-input guest" value="<?= $users_guest["id"] ?>">
                                            <span> <?= $users_guest["name"] ?> (<?= $users_guest["guest_types_name"] ?>)</span>
                                        </div>
                                    </div>                                   
                                    <?php }
                                  } 
                                    else {
                                    ?>
                                        <p>None</p>
                                    <?php }?>
                                 
                                </div>
                            </div>

                            <div class="form-field-box">
                                <div class="col-md-2 capt top" id="">Non-Hunting Guest</div>
                                <div class="form-field-box col-md-10">
                                <?php if( !empty($Non_Hunting_Guest))
                                     {  
                                       foreach ($Non_Hunting_Guest as $Non_Hunting) {                   
                                    ?>
                                    <div class="form-field-box guest">
                                        <div class="col-xs-4 captdown type guest-type">
                                            <input type="checkbox" name="reservationUsers[]" id="guest-name1" class="icheck-input" value="<?= $Non_Hunting["id"] ?>">
                                            <span> <?= $Non_Hunting["name"] ?> (<?= $Non_Hunting["guest_types_name"] ?>)</span>
                                        </div>
                                    </div>                                   
                                    <?php }
                                  } 
                                    else {
                                    ?>
                                        <p>None</p>
                                    <?php }?>
                                 
                                </div>
                            </div>
                            
                            <!-- <div class="form-field-box">
                                <div class="col-md-2 capt" id="">Name</div>
                                <div class="form-input-box col-md-10">
                                    <input type="text" name="guest_1" id="guest_1" class="form-control validate[required]" value="">
                                </div>
                            </div>
                            
                            <div class="form-field-box">
                                <div class="col-md-2 capt" id="">Name</div>
                                <div class="form-input-box col-md-10">
                                    <input type="text" name="guest_2" id="guest_2" class="form-control validate[required]" value="">
                                </div>
                            </div>
                            
                            <div class="form-field-box">
                                <div class="col-md-2 capt" id="">Name</div>
                                <div class="form-input-box col-md-10">
                                    <input type="text" name="guest_3" id="guest_3" class="form-control validate[required]" value="">
                                </div>
                            </div> -->
                            
                            <div class="form-field-box button-container">
                                <div class="col-md-10 pull-right">                                  
                                    <button type="submit" class="cust-btn submit" name="submit" value="0">Submit</button>
                                    <button type="submit" class="cust-btn cancel" name="cancel" value="True">Cancel</button>
                                    <input type="hidden" id="" name="" value="">
                                </div>
                            </div>
                            
                        </div>
                   </div>
                </div>
            </div>
            <?php echo $form->close(); ?>  
        </div>
    </div>
    <script type="text/javascript">
        $(function () {          
            $('.guest').on('change', function(){
                var noChecked = 0;
                $.each($('.guest'), function(){
                    if($(this).is(':checked')){
                        noChecked++;    
                    }
                });
                if(noChecked >= 3){
                    $.each($('.guest'), function(){
                        if($(this).not(':checked').length == 1){
                            $(this).attr('disabled','disabled');    
                        }
                    });
                }else{
                    $('.guest').removeAttr('disabled');    
                };
                $('#guest_count').val(noChecked);
            });

            $(".submit").on("click", function (event) {
                var ownerChecked = $('input.owner:checked').length;
                var numberOfChecked = $('input.guest:checked').length;                  
                
               if(ownerChecked>0 || numberOfChecked>0)
               {
                 $( ".submit" ).trigger( "submit" );
               }
               else
               {
                event.preventDefault();
                alert("A reservation is not allowed unless at least 1 name is selected.");
                return false;
               }
               
            });
        });
    </script>
</div>