<div class="container home-block">
	<div class="row tab-v3">
		<div class="col-md-3 md-margin-bottom-40">
			<ul class="nav nav-pills nav-stacked">
			    <li class="active"><a href="/reservations/activity"><i class="fa fa-location-arrow"></i> 1. Location</a></li>
			    <li class="disabled"><a href="#"><i class="fa fa-calendar"></i> 2. Available Dates</a></li>
			    <li class="disabled"><a href="#"><i class="fa fa-book"></i> 3. Book</a></li>
			</ul>
		</div>
	
		<div class="col-md-9">
		<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
	<?php echo $form->close(); ?>
			<div class="tag-box tag-box-v3">
			    <div class="headline"><h2>Location</h2></div>
				<div class="row">
					<div class="col-md-12">
					    <h5>Please select an location from the list below.</h5>
					    <hr class="devider devider-db">
						
						
					    <div class="table-responsive reservation-listing">
						<table class="table table-hover">
						   <thead>
						      <tr>
							 <th>Location</th>
							 <th>&nbsp;</th>
						      </tr>
						   </thead>
						   <tbody>
						   <?php  foreach ($lodges as $lodge) { ?>
						      <tr>
							 <td class="td-width-lg">
							    <h3><?= $lodge["name"] ?></h3>
							    <p><?= $lodge["location_description"] ?></p>							   
							    <p style="margin-top: 10px !important;"><button class="btn-u btn-u-blue btn-u-xs" data-toggle="modal" data-target="#location<?= $lodge["id"] ?>">Read More</button></p>
							    <div class="modal fade" id="location<?= $lodge["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="locationLabel<?= $lodge["id"] ?>" aria-hidden="true" style="display: none;">
							       <div class="modal-dialog">
								  <div class="modal-content">
								     <div class="modal-header">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
									<h4 id="locationLabel<?= $lodge["id"] ?>" class="modal-title"><?= $lodge["name"] ?> - Details</h4>
								     </div>
								     <!-- Model Body -->
								    <div class="modal-body">
									<!-- Land Details -->
									<div class="row margin-bottom-10">
									   <div class="col-md-4">
									      <h3><i class="fa fa-map-marker icon-custom rounded-x icon-color-u icon-sm"></i> Land</h3>
									   </div>
									   <div class="col-md-8">
									      <p></p>
									   </div>
									</div>
									<hr>
									<!-- //Land Details -->
									<!-- Files Details -->
									<?php  $lodge_files=array(); $lodge_files = $controller->lodge_files($lodge["id"]); 
									if(!empty($lodge_files)){
									?>
									<div class="row margin-bottom-10">
									   <div class="col-md-4">
									      <h3><i class="fa fa-file icon-custom rounded-x icon-color-u icon-sm"></i> Files</h3>
									   </div>
									   <div class="col-md-8">
									      <ul class="list-unstyled">
											  <?php foreach ($lodge_files as $lodge_file){ ?>
										 <li>
										    <i class="fa fa-file-pdf-o"></i>
										    <a href="<?= BASE_URL?>uploads/lodge/<?= $lodge_file["file_name"]?>" target="_blank"><?= $lodge_file["file_name"]?></a>
										 </li>
										 <?php } ?>
									      </ul>
									   </div>
									</div>
									<?php }?>
									<!-- //Files Details -->
								     </div>
								     <!-- End Model Body -->
								  </div>
							       </div>
							    </div>
							 </td>
							 <td>
							 <?php if ($lodge["active"]){?>
							    <a class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right" href="/lodge-reservations/dates/<?= $lodge["id"] ?>">Select</a>
							<?php } ?>
							</td>
						      </tr>
							<?php } ?>
						    
						   </tbody>
						</table>
					     </div>	
						
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>