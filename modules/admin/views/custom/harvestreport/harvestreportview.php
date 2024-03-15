<?php 
$harvest_report_id = isset($harvest_reports[0]['id'])!=1?"":$harvest_reports[0]['id'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="pull-right mb-5">
            <a href="/admin/harvest-reports/edit/<?=$data[0]['id']?>" class="btn btn-info btn-lg custbtn-edit"><i class="fa fa-pencil"></i> Edit</a>
            <a href="/admin/harvest-reports/remove/<?=$harvest_report_id?>" class="btn btn-danger btn-lg custbtn-remove"><i class="fa fa-trash-o"></i> Remove</a>
        </div>
    </div> <!-- /.col-md-12 -->
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="custom-title-bar">
                <div class="ftitle">Harvest Report</div>
        </div>
           
        <div class="custom-box">
            <div class="col-md-12">
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
        </div> 
    
    </div>
</div>

<br />

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="custom-title-bar">
                <div class="ftitle">Harvest Report Values</div>
        </div>

        <div class="custom-box">
            <div class="col-md-12">
                <table class="table table-striped table-bordered bycolor-table">
                    <tbody>
                        <?php $comment=''; $reportDataOwner=array(); $reportDataOwner = $controller->harvest_reports($data[0]['id'],$data[0]['user_id'],NULL); ?>
                        <?php if(count($reportDataOwner)) :?>
                        
                        <tr class="info">
                            <td colspan="2"><h3><?=$data[0]['first_name']?> <?=$data[0]['last_name']?> (owner)</h3></td>
                        </tr>
                        <?php foreach($reportDataOwner as $reportData) :  ?>
                        <?php $comment=$reportData['report_comments']; ?>
                        <tr>
                            <td style="width: 50%"><strong><?=$reportData['name']?> Harvested</strong></td>
                        <td><?=$reportData['harvest_count']?></td>
                        </tr>
                        <?php endforeach ?>
                       <?php endif ?>                     
                       <?php $users=array(); $users = $controller->reservation_users($data[0]['id']); ?>
                       
                       <?php //print_r($users) ?>
                       <?php if(count($users)) :?>
                        <?php  foreach ($users as $guest) { ?>
                             <tr class="info">
                                    <td colspan="2"><h3><?=$guest['name']?> (guest)</h3></td>
                                </tr>
                            <?php $reportDataGuest=array(); $reportDataGuest = $controller->harvest_reports($data[0]['id'],NULL,$guest['id']); ?>  
                        <?php foreach($reportDataGuest as $reportData) :  ?>
                        <tr>
                            <td style="width: 50%"><strong><?=$reportData['name']?> Harvested</strong></td>
                        <td><?=$reportData['harvest_count']?></td>
                        </tr>
                        <?php endforeach ?>
                         <?php }  ?>
                       <?php endif ?>      
                        
                        <tr>
                            <td><strong>Comments</strong></td>
                            <td><?=$comment?></td>
                        </tr>
                        
                        <tr>
                            <td><strong>Photo</strong></td>
                            <td class="hunting-photo"><img src="<?= isset($harvest_reports[0]['file_name'])!=1?"":BASE_URL."/uploads/harvest/".$harvest_reports[0]['file_name'] ?>" alt="" /></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
</div>