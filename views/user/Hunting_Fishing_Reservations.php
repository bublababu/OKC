<div class="container home-block">	
	<div class="row tab-v3">
		<div class="col-md-3 md-margin-bottom-40">
			<ul class="nav nav-pills nav-stacked">
			    <li class="active"><a href="/reservations/activity"><i class="fa fa-trophy"></i> 1. Activity</a></li>
			    <li class="disabled"><a><i class="fa fa-location-arrow"></i> 2. Location</a></li>
			    <li class="disabled"><a><i class="fa fa-calendar"></i> 3. Available Dates</a></li>
			    <li class="disabled"><a><i class="fa fa-book"></i> 4. Book</a></li>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="tag-box tag-box-v3">
			<?php echo $form->open(); ?>
            <?php echo $form->messages(); ?>
			    <div class="headline"><h2>Activity</h2></div>
			    <div class="row">
				<div class="col-md-12">
				    <h5>Please select an activity from the list below. Please note, you may only select activities that are in season or have upcoming seasons.</h5>
				    <hr class="devider devider-db">
					
					
					
					<div class="reservation-listing">
						<table class="table table-hover">
						   <thead>
						      <tr>
							 <th>Activity</th>
							 <th>Season Dates</th>
							 <th>&nbsp;</th>
						      </tr>
						   </thead>
						   <tbody>
							  <?php foreach($reservation_types_data as $reservation_types) {?> 
								<?php 
									$enddate = date('Y-m-d', strtotime($reservation_types["end_date"]));

									$today = date('Y-m-d', strtotime(date('Y-m-d')));
									if ( $enddate < $today){ ?>
						      <tr class="warning">
							 <td>
							   <?= $reservation_types["name"] ?>                                    
							 </td>
							 <td>
							   <?= date('M j, Y',strtotime($reservation_types["start_date"])) ?> - 
							   <?= date('M j, Y',strtotime($reservation_types["end_date"])) ?>                          
							 </td>
							 <td>
							 </td>
						      </tr>
							  
							<?php } else { ?>

						      <tr>
							 <td>
							 <?= $reservation_types["name"] ?>                               
							 </td>
							 <td>
							 <?= date('M j, Y',strtotime($reservation_types["start_date"])) ?> - 
							   <?= date('M j, Y',strtotime($reservation_types["end_date"])) ?>                                
							 </td>
							 <td>
							    <a class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right" href="/reservations/location/<?= $reservation_types["id"] ?>">Select</a>
							 </td>
						      </tr>

							  <?php } } ?> 

						   </tbody>
						</table>
					     </div>	
					
					
					
				</div>
			    </div>
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
</div>