
<div class="container home-block">
   <div class="profile">
      <div class="row">
         <div class="col-md-3 md-margin-bottom-40">
            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
               <li class="list-group-item">
                  <a href="/account"><i class="fa fa-bar-chart-o"></i> Overall</a>
               </li>
               <li class="list-group-item">
                  <a href="/account/profile"><i class="fa fa-user"></i> My Profile</a>
               </li>
               <li class="list-group-item list-toggle active">
                  <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-reservations" class="collapsed"><i class="fa fa-book"></i> My Reservations</a>
                  <ul id="collapse-reservations" class="collapse in" style="height: auto;">
                     <li class="active"><a href="/reservations/lists"><i class="fa fa-tree"></i> Hunting &amp; Fishing</a></li>
                     <li><a href="/lodge-reservations/lists"><i class="fa fa-building"></i> Lodges</a></li>
                  </ul>
               </li>
            </ul>
         </div>
         <div class="col-md-9">
            <div class="profile-body">
                <div class="panel panel-profile">
                    <div class="panel-heading overflow-h">
                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-paw"></i> Harvest Report</h2>
                    </div>
                    
                    
                    <div class="panel-body margin-bottom-40">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row margin-bottom-20">
                                    <div class="col-md-6">
                                        <h3><i class="fa fa-map-marker"></i> Location</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><strong>Lease:</strong> <?=$data[0]['leases_name']?></li>
                                            <li><strong>Lease Area:</strong> <?=$data[0]['lease_areas_name']?></li>
                                            <li><strong>Game Type:</strong> <?=$data[0]['reservation_types_name']?></li>
                                        </ul>
                                    </div>
                                </div>

                                <hr>

                                <div class="row margin-bottom-20">
                                    <div class="col-md-6">
                                        <h3><i class="fa fa-calendar"></i> Dates</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><strong>Start:</strong> <?=date('l, F j, Y',strtotime($data[0]["start_date"]))?></li>
                                            <li><strong>End:</strong> <?=date('l, F j, Y',strtotime($data[0]["end_date"]))?></li>
                                        </ul>
                                    </div>
                                </div>

                                <hr>

                                <div class="row margin-bottom-20">
                                    <div class="col-md-6">
                                        <h3><i class="fa fa-group"></i> Attending</h3>
                                    </div>
                                    <div class="col-md-6">                                        
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-check color-green"></i> <?=$data[0]['first_name']?> <?=$data[0]['last_name']?> (me)</li>
                                            <?php $users=array(); $users = $controller->reservation_users($data[0]['id']); ?>
                                            <?php  foreach ($users as $guest) { ?>
                                            <li><i class="fa fa-check color-green"></i> <?=$guest['name']?> </li>
                                            <?php } ?>
                                         </ul>
                                    </div>
                                </div>

                                <hr class="devider devider-db">

                                <h3>Harvest Counts</h3>
                                <table class="table table-striped bycolor-table">
                    <tbody>
                        <?php $comment=''; $reportDataOwner=array(); $reportDataOwner = $controller->harvest_reports($data[0]['id'],$data[0]['user_id'],NULL); ?>
                        <?php if(count($reportDataOwner)) :?>
                        
                        <tr class="info">
                            <td colspan="2"><h3><?=$data[0]['first_name']?> <?=$data[0]['last_name']?> (me)</h3></td>
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

                                <hr class="devider devider-db">

                                <button type="button" class="btn-u btn-u-default btn-block" onclick="window.history.back();">Back to Previous Page</button>
                            </div>
                        </div>  <!--/end row-->

                    </div>
                    
                    
                </div>
            </div>
         </div>
      </div>
   </div>
</div>