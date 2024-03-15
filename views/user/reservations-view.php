<?php 
$earlier = new DateTime($data[0]["start_date"]);
$later = new DateTime($data[0]["end_date"]);

$day_count = $later->diff($earlier)->format("%a");
//print("<pre>".print_r($day_count,true)."</pre>");

?>
<div class="container home-block">
   <div class="profile">
      <div class="row">
         <div class="col-md-3 md-margin-bottom-40">
            <a href="http://www.gravatar.com" target="_blank"><img class="img-responsive profile-img margin-bottom-20" src="http://www.gravatar.com/avatar/c738c6fc8ac5bdfa051d8fbbe4f035da?s=150&amp;d=mm&amp;r=g"></a>
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
                     <li><a href="/lodge-reservations/list"><i class="fa fa-building"></i> Lodges</a></li>
                  </ul>
               </li>
            </ul>
         </div>
         <div class="col-md-9">
            <div class="profile-body">
                <div class="panel panel-profile">
                    <div class="panel-heading overflow-h">
                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-book"></i> Hunting & Fishing Reservations</h2>
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
                                        <?php if($data[0]['use_spot']) {?>
                                                <li><i class="fa fa-check color-green"></i> <?=$data[0]['first_name']?> <?=$data[0]['last_name']?> (me)</li>
                                                <?php } else {?>
                                                    <li><i class="fa fa-check color-green"></i> <?=$data[0]['first_name']?> <?=$data[0]['last_name']?> (Member Not Attending)</li>
                                            <?php } ?>
                                            <?php $users=array(); $users = $controller->reservation_users($data[0]['id']); ?>
                                            <?php  foreach ($users as $guest) { ?>
                                            <li><i class="fa fa-check color-green"></i> <?=$guest['name']?> </li>
                                            <?php } ?>
                                         </ul>
                                    </div>
                                </div>

                                <hr class="devider devider-db">
                                 <div class="row margin-bottom-20">
                                    <div class="col-md-6">
                                       <h3>Others On Lease Area</h3>
                                    </div>
                                    <div class="col-md-12">
                                       <?php if(count($dataOther)) { ?>
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
                        <?php foreach ($dataOther as $other_hunter) {
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
                                       <?php } else { ?>
                                          <p>No member found!!</p>
                                       <?php } ?>
                                    </div>
                                 </div>
                                
                                <hr class="devider devider-db">
                                
                                
                                
                            </div>
                        </div>  <!--/end row-->

                    </div>
                    
                    
                </div>
            </div>
         </div>
      </div>
   </div>
</div>