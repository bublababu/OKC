<div class="container home-block">	
	<div class="row tab-v3">
		<div class="col-md-3 md-margin-bottom-40">
			<ul class="nav nav-pills nav-stacked">
			    <li class="disabled"><a href="/reservations/activity"><i class="fa fa-trophy"></i> 1. Activity</a></li>
			    <li class="active"><a><i class="fa fa-location-arrow"></i> 2. Location</a></li>
			    <li class="disabled"><a><i class="fa fa-calendar"></i> 3. Available Dates</a></li>
			    <li class="disabled"><a><i class="fa fa-book"></i> 4. Book</a></li>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="tag-box tag-box-v3">
			    <div class="headline"><h2>Location</h2></div>
			    <div class="row">
				<div class="col-md-12">
				    <h5>Please select an location from the list below.</h5>
					<ul class="list-unstyled">
						<li><i class="fa fa-check color-green"></i> <strong>Activity:</strong> <?= isset($reservation_types_data[0]["name"]) && $reservation_types_data[0]["name"] != "" ? $reservation_types_data[0]["name"] : "" ?></li>
					</ul>
				    <hr class="devider devider-db">
					<div class="table-responsive reservation-listing reservations-location-noscroll">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Location</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody class="accordion">
							<?php foreach ($leases_data as $lease): ?>
							<?php 
								$name=$lease['name'];
								$lease_id=$lease['id'];
								$location_description=$lease['location_description'];							
								$land_description=$lease["land_description"];
								$game_description=$lease["game_description"];
								$rules_description=$lease["rules_description"];
								$hunter_description=$lease["hunter_description"];

								$leasefiles = $controller->lease_files($lease_id);
								//print_r($count_leases);
							?>
							
								<tr class="reservation-loc-tab" >
									<td colspan="2">
										<div><h3><?php if(isset($name) && $name!="") echo stripslashes($name);?></h3></div>
									</td>
								</tr>
                                <tr class="reservation-loc-content">
                                    <td class="td-width-lg">
                                        <h3><?php if(isset($name) && $name!="") echo stripslashes($name);?></h3>
										<?php if(isset($location_description) && $location_description!="") echo stripslashes($location_description);?>
										<p style="margin-top: 10px !important;">
											<button class="btn-u btn-u-blue btn-u-xs" data-toggle="modal" data-target="#location<?= $lease_id?>">Read More</button>
										</p>
										
										<div class="modal fade" id="location<?= $lease_id?>" tabindex="-1" role="dialog" aria-labelledby="locationLabel<?= $lease_id?>" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
											   <div class="modal-content">
												  <div class="modal-header">
													 <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
													 <h4 id="locationLabel<?= $lease_id?>" class="modal-title"><?php if(isset($name) && $name!="") echo stripslashes($name);?> - Details</h4>
												  </div>
												  <!-- Model Body -->
												  <div class="modal-body">
													 <div class="row margin-bottom-10">
														<div class="col-md-4">
														   <h3><i class="fa fa-map-marker icon-custom rounded-x icon-color-u icon-sm"></i> Land</h3>
														</div>
														<div class="col-md-8">
														<?= $land_description?>
														</div>
													 </div>
													 <hr>
													 <div class="row margin-bottom-10">
														<div class="col-md-4">
														   <h3><i class="fa fa-paw icon-custom rounded-x icon-color-u icon-sm"></i> Game</h3>
														</div>
														<div class="col-md-8">
														<?= $game_description?>
														</div>
													 </div>
													 <hr>
													 <div class="row margin-bottom-10">
														<div class="col-md-4">
														   <h3><i class="fa fa-graduation-cap icon-custom rounded-x icon-color-u icon-sm"></i> Rules</h3>
														</div>
														<div class="col-md-8">
														<?= $rules_description?>
														</div>
													 </div>
													 <hr>
													 <div class="row margin-bottom-10">
														<div class="col-md-4">
														   <h3><i class="fa fa-info icon-custom rounded-x icon-color-u icon-sm"></i> Max Hunters</h3>
														</div>
														<div class="col-md-8">
														<?= $hunter_description?>
														</div>
													 </div>
													 <hr>
													 <div class="row margin-bottom-10">
														<div class="col-md-4">
														   <h3><i class="fa fa-file icon-custom rounded-x icon-color-u icon-sm"></i> Files</h3>
														</div>
														<div class="col-md-8">
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
														</div>
													 </div>
												  </div>
												  <!-- End Model Body -->
											   </div>
											</div>
										</div>
									</td>
									<td>
                                        <a class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right btn-select" href="/reservations/dates/<?= $reservation_types_id?>/<?= $lease_id?>">Select</a>
                                    </td>
								</tr>
								<?php endforeach;?>	
							</tbody>
						</table>
					</div>
				</div>
			    </div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
  $(".reservation-loc-tab").click(function(){
    
	if($(this).hasClass('active-state')){

		$(this).removeClass('active-state');
		
	} else {

		$(this).addClass('active-state');
	}
  });
});


</script>

