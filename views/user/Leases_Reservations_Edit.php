<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"
    integrity="sha512-RGDpUuNPNGV62jwbX1n/jNVUuK/z/GRbasvukyOim4R8gUEXSAjB4o0gBplhpO8Mv9rr7HNtGzV508Q1LBGsfA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.min.css"
    integrity="sha512-wcKDxok85zB8F9HzgUwzzzPKJhHG7qMfC7bSKrZcFTC2wZXVhmgKNXYuid02cHVnFSC8KOJCXQ8M83UVA7v5Bw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
$user_first_name = isset($user_details[0]["first_name"]) && $user_details[0]["first_name"] != "" ? $user_details[0]["first_name"] : "";
$user_last_name = isset($user_details[0]["last_name"]) && $user_details[0]["last_name"] != "" ? $user_details[0]["last_name"] : "";

$reservation_types_name = isset($reservation_data[0]["reservation_types_name"]) && $reservation_data[0]["reservation_types_name"] != "" ? $reservation_data[0]["reservation_types_name"] : "";
$leasesname = isset($reservation_data[0]["leases_name"]) && $reservation_data[0]["leases_name"] != "" ? $reservation_data[0]["leases_name"] : "";
$lease_area_name = isset($reservation_data[0]["lease_areas_name"]) && $reservation_data[0]["lease_areas_name"] != "" ? $reservation_data[0]["lease_areas_name"] : "";
$start_Date = isset($reservation_data[0]["start_date"]) && $reservation_data[0]["start_date"] != "" ? $reservation_data[0]["start_date"] : "";
$end_Date = isset($reservation_data[0]["end_date"]) && $reservation_data[0]["end_date"] != "" ? $reservation_data[0]["end_date"] : "";

$reservation_types_id = isset($reservation_data[0]["id"]) && $reservation_data[0]["id"] != "" ? $reservation_data[0]["id"] : "";

$useSpot=isset($reservation_data[0]["use_spot"]) && $reservation_data[0]["use_spot"] != "" ? $reservation_data[0]["use_spot"] : "";

$earlier = new DateTime($start_Date);
$later = new DateTime($end_Date);

$day_count = $later->diff($earlier)->format("%a");
//print("<pre>".print_r($day_count,true)."</pre>");
?>

<div class="container home-block">
    <div class="row tab-v3">

        <div class="col-md-12">
            <div class="tag-box tag-box-v3">
                <?php echo $form->open(); ?>
                <?php echo $form->messages(); ?>
                <div class="headline">
                    <h2>Book</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check color-green"></i> <strong>Activity:</strong>
                                <?=$reservation_types_name?></li>
                            <li><i class="fa fa-check color-green"></i> <strong>Location:</strong> <?=$leasesname?></li>
                            <li><i class="fa fa-check color-green"></i> <strong>Area:</strong> <?=$lease_area_name?>
                            </li>
                            <li><i class="fa fa-check color-green"></i> <strong>Start Date:</strong> <?=$start_Date?>
                            </li>
                            <li><i class="fa fa-check color-green"></i> <strong>End Date:</strong> <?=$end_Date?></li>
                        </ul>

                        <div class="headline">
                            <h2>Other Hunters</h2>
                        </div>
                        <?php if (!empty($other_hunters)) {
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
                        <?php for ($i=0;$i<=$day_count;$i++){?>
                            <tr><td class="bolder heading" colspan="6"><h3><?= date('l, F j, Y',strtotime($start_date))?></h3></td></tr>
                            <?php $other_hunter_details = $controller->other_hunters($userid,$start_date); ?>
                        <?php foreach ($other_hunter_details as $other_hunter) {
                             //$other_hunter_details = $controller->other_hunter_details($other_hunter["id"]);  
                             $usersAttending = $controller->reservation_users($other_hunter["id"]); 
                             //print("<pre>".print_r($other_hunter_details,true)."</pre>");
                            // print("<pre>".print_r($usersAttending,true)."</pre>");                         
                             ?>                          
                            
                            <tr>
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
                        <?php } else {
                        ?>
                        <p>None</p>
                        <?php }?>
                    </div>
                </div>

                <fieldset>
                    <section>
                        <label class="label"><strong>Who will be attending this reservation?</strong></label>
                        <div class="form-group">
                        <input type="hidden" name="useSpot" value="<?= $useSpot?>">
                                     <label class="checkbox">
                                        <input type="checkbox" name="userSpot" id="useSpot" class="icheck-input"  <?php echo $useSpot=="1" ? "checked" : ""?> value="1" style="position: absolute; opacity: 0;">
                                        <?= $user_first_name .' '. $user_last_name ?> (Badge Owner)
                                     </label>
                        </div>
                        <label class="label">Select any previous guests</label>
                        <?php if( !empty($users_guests))
                                     {  
                                       foreach ($users_guests as $users_guest) {                                            
                                        $is_reservation_users = $controller->is_reservation_users($users_guest["id"],$reservation_types_id);                                    
                                    ?>
                                  <div class="form-group">
                                     <label class="checkbox">
                                        <input type="checkbox" name="reservationUsers[]"  <?php echo $is_reservation_users=="1" ? "checked" : ""?> class="icheck-input" value="<?= $users_guest["id"] ?>" style="position: absolute; opacity: 0;">
                                        <?= $users_guest["name"] ?>
                                     </label>
                                  </div>
                                  <?php }
                                  } 
                                    else {
                                    ?>
                                        <p>None</p>
                                    <?php }?>
                        <!-- <label class="label">Write in any additional guests. Family members and family member guests
                            should not be write in guests. <b>You will be charged for any guests you put in these
                                fields. Please leave blank if you don't have any guests.</b></label>
                        <div>
                            <label class="input">
                                <input type="text" name="guest_1" placeholder="Name of Write In Guest 1"
                                    value=""></label>
                            <label class="input">
                                <input type="text" name="guest_2" placeholder="Name of Write In Guest 2"
                                    value=""></label>
                            <label class="input">
                                <input type="text" name="guest_3" placeholder="Name of Write In Guest 3"
                                    value=""></label>
                        </div> -->
                    </section>
                </fieldset>
                <footer>
                    <button class="btn-u-default edit btn btn-success" type="submit"><i class="fa fa-edit"></i>
                        Update</button>
                    &nbsp;&nbsp;
                    <button class="btn-u-default btn cancel btn btn-danger" type="button" onclick="location.href = 'account';"><i class="fa fa-trash-o"></i>
                        Cancel</button>
                </footer>
                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $("input:radio").iCheck({ //iradio_minimal-green
                radioClass: "iradio_minimal-green",
                inheritClass: true,
            });
        });

        $(function () {
            $("input:checkbox").iCheck({ //icheckbox_minimal-green
                checkboxClass: "icheckbox_minimal-green",
                inheritClass: true,
            });
        });
    </script>

</div>