<?php 
$guest_ids="";
$game_type_ids="";
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="custom-title-bar">
                <div class="ftitle">Harvest Report</div>
        </div>
    
        <div class="custom-box">
            <div class="col-md-12">
                <h4>You are creating a harvest report for the following:</h4>
                <br />
                <table class="table table-striped table-bordered bycolor-table">
                    <tbody>
                    <tr>
                        <td style="width: 50%"><strong>Badge Owner</strong></td>
                        <td><?=$data[0]['first_name']?> <?=$data[0]['last_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Lease</strong></td>
                        <td><?=$data[0]['leases_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Lease Area</strong></td>
                        <td><?=$data[0]['lease_areas_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Reservation Type</strong></td>
                        <td><?=$data[0]['reservation_types_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Date</strong></td>
                        <td><?=$data[0]['start_date']?></td>
                    </tr>
                    <tr>
                        <td><strong>Attending</strong></td>
                        <td>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check color-green"></i> <?=$data[0]['first_name']?> <?=$data[0]['last_name']?> (owner)</li>
                                 <?php $users=array(); $users = $controller->reservation_users($data[0]['id']); ?>
                                    <?php  foreach ($users as $guest) { ?>
                                     <li><i class="fa fa-check color-green"></i> <?=$guest['name']?> </li>
                                    <?php } ?>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- /.portlet-content -->
    
    </div>

</div>
<br />

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="custom-title-bar">
                <div class="ftitle"></div>
        </div>
        <?php $gameTypes=array(); $gameTypes = $controller->reservation_type_data($data[0]['reservation_type_id']); ?>
           <div class="custom-box">
       
           <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
                                           
                   <input type="hidden" name="id" value="">
                    <div class="col-md-12">
                       <h3><?=$data[0]['first_name']?> <?=$data[0]['last_name']?> (owner)</h3>
                       <hr>
                    </div>
                  
                   <?php foreach($gameTypes as $gameType) { ?>
                    <?php $game_type_ids =$game_type_ids.','. $gameType['id']  ?>
                     <?php $harvest_report_counts = $controller->harvest_report_counts($data[0]['id'],$gameType['id'],$data[0]['user_id']); ?>
                     
                     <?php if(count($harvest_report_counts)) :?>
                       <div class="form-field-box">
                           <label class="capt col-md-2"><?=$gameType['name']?> Harvested</label>
                               <div class="col-md-10">
                              
                                   <input type="text" name="owner_<?=$gameType['id']?>" class="form-control" value="<?= $harvest_report_counts[0]["harvest_count"]?>">
                               </div>
                       </div>
                       <?php endif ?>
                       
                <?php } ?>  
                <?php $users=array(); $users = $controller->reservation_users($data[0]['id']); ?>
                 <?php  foreach ($users as $guest) { ?>
                 <div class="col-md-12">
                   <h3><?=$guest['name']?> (guest)</h3>
                    <hr>
                 </div>
                 <?php $guest_ids = $guest_ids.','.$guest['id'] ?>                  
                   <?php foreach($gameTypes as $gameType) { ?>
                       <div class="form-field-box">
                           <label class="capt col-md-2"><?=$gameType['name']?> Harvested</label>
                           <div class="col-md-10">
                           <?php $harvest_report_counts = $controller->harvest_report_counts($data[0]['id'],$gameType['id'],$guest['id']); ?>
                             <input type="text" name="guest_<?=$guest['id']?>_<?=$gameType['id']?>" class="form-control" value="<?= $harvest_report_counts[0]["harvest_count"]?>">
                           </div>
                       </div>
                     <?php } ?>  
               <?php } ?>
                           <div class="form-field-box">
                                <label class="capt col-md-2">Comments</label>
                                <div class="col-md-10">
                                    <textarea name="comments" class="form-control"><?= $harvest_report_counts[0]["report_comments"]?></textarea>
                                </div>
                            </div>
                           
                            <div class="form-field-box ">
                                <label class="capt col-md-2">Upload</label>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" name="fileToUpload">
                                    <div class="uploaded-image">
                                        <?php $image_uploaded = isset( $harvest_report_counts[0]["file_name"])!=1?"": $harvest_report_counts[0]["file_name"]; 
                                        if($image_uploaded!="")
                                        {
                                        ?>
                                        <img src="<?=BASE_URL?>uploads/harvest/<?= $harvest_report_counts[0]["file_name"]?>" alt="" />
                                        <?php } else { ?>
                                            <img src="<?=BASE_URL?>uploads/harvest/no-image.jpg" alt="" />
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        $filname=$reportsId='';
                              if(count($harvest_report_counts))
                               {
                                $filname=$harvest_report_counts[0]["file_name"];
                                $reportsId=$harvest_report_counts[0]["id"];
                               }
                        ?>
                        
                     
               
                           <div class="form-field-box button-container">
                                <div class="col-md-10 pull-right">
                                <button type="submit" class="cust-btn submit" name="submit" value="0">Submit</button>
                                <button type="submit" class="cust-btn cancel" name="cancel" value="True">Cancel</button>
                                <input type="hidden" name="image_name" value="<?= $filname ?>">
                                <input type="hidden" name="harvest_reports_id" value="<?= $reportsId ?>">
                                <input type="hidden" name="owner_id" value="<?= $data[0]['user_id'] ?>">
                                <input type="hidden" name="guest_ids" value="<?=$guest_ids?>">
                                <input type="hidden" name="game_type_ids" value="<?=$game_type_ids?>">
                                </div>
                            </div>
                            <?php echo $form->close(); ?>
           </div> <!-- /.portlet-content -->
       
    </div>
</div>