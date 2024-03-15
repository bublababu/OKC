<div id="content">		
		
		<div id="content-header">
			<h1>Dashboard  </h1>
		</div> <!-- #content-header -->	

		<div id="content-container">
            
<div class="row dashboard">

    <div class="col-md-8">

        <div class="portlet portlet-plain">
            <div class="portlet-header">
                <h3>
                    <i class="fa fa-group"></i>
                    Recent Reservations
                </h3>
                <ul class="portlet-tools pull-right">
                    <li>
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#tabHuntingReservations" data-toggle="tab">Hunting</a></li>
                            <li class=""><a href="#tabLodgeReservations" data-toggle="tab">Lodges</a></li>
                        </ul>
                    </li>
                </ul>
            </div> <!-- /.portlet-header -->
            <div class="portlet-content">

                <div class="tab-content">
                    <div id="tabHuntingReservations" class="tab-pane fade active in">
                        <h5>Hunting Reservations</h5>

                        
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped bycolor-table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Member</th>
                                        <th>Attending</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
								<?php foreach($reservations	as $reservation) { ?>	
                                    <tr>
                                       <td style="white-space:nowrap;"><?=$reservation['start_date']?>--<?=$reservation['end_date']?></td>
                                        <td><?=$reservation['first_name']?> <?=$reservation['last_name']?></td>
											<td>
											  <ul>
												  <li> <?=$reservation['first_name']?> <?=$reservation['last_name']?>(Owner)</li>
												  <?php $users=array(); $users = $controller->reservation_users($reservation['id']); ?>
												  <?php  foreach ($users as $guest) { ?>
												   <li> <?=$guest['name']?> </li>
												  <?php } ?>
												  
											  </ul>
										   
											</td>
                                            <td><?=$reservation['lease_areas_name']?><br><?=$reservation['leases_name']?></td>
                                            <td class="<?=$reservation['reservation_status']?>" style="white-space:nowrap;">
                                <span><?php 
                                 if($reservation['reservation_status']=='active')
                                 {
                                    if(( strtotime($reservation["end_date"]." +1 days")<=strtotime(date('Y-m-d')) ))  {
                                        echo 'completed';
                                    }
                                    else
                                    {
                                        echo 'active';
                                    }

                                 }
                                 else if($reservation['reservation_status']=='cancel') echo 'cancelled';
                                 else if($reservation['reservation_status']=='trash') echo 'trashed';
                                  else echo $reservation['reservation_status'] ?></span>
                                  </td>
                                        </tr>                            
									<?php } ?>										
																			
									
                                    
                                    </tbody>
                                </table>
                            </div> <!-- /.table-responsive -->

                        
                    </div>
                    <div id="tabLodgeReservations" class="tab-pane fade">
                        <h5>Lodge Reservations</h5>

                        
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Member</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lodgedata as $lodge) { ?>
                                        <tr>
                                           <td><?=$lodge['start_date']?>--<?=$lodge['end_date']?></td>
                                            <td><?=$lodge['first_name']?><br><?=$lodge['last_name']?></td>
											<?php $lodge_name=array(); $lodge_name = $controller->lodge_name($lodge['lodge_id']);?>
											 <?php $bedroom=array(); $bedroom = $controller->bedroom($lodge['bed_id'],$lodge['lodge_id']);?>
                                            <td>
                                                <?=$lodge_name[0]['name']?><br>
                                               <?=$bedroom[0]['lodgename']?> ,  <?=$bedroom[0]['name']?></td> </td>
                                            <td>
												<?php if($lodge['reservation_status']=='active') { ?>
												<span class="label label-success">Active</span>
												<?php } else { ?>
												  <span class="label label-danger">Cancelled</span>
												<?php } ?>
												
											</td>
                                        </tr>
                                       <?php } ?>
                                    
                                    </tbody>
                                </table>
                            </div> <!-- /.table-responsive -->

                        
                    </div>
                </div>

            </div> <!-- /.portlet-content -->
        </div>

    </div> <!-- /.col-md-8 -->

    


</div> <!-- /.row -->

			
		</div> <!-- /#content-container -->			
		
	</div>