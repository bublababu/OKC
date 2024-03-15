<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">	
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
		<div class="box box-primary">
				<div class="col-md-12 p-3 custom-btn-container">
							<a href="/admin/lodge-rooms/add/<?php echo $lodge_id ?>" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="col-md-12 p-3">
					<table class="table table-bordered table-striped bycolor-table table-hover">
						<thead>
							<tr>
								<th>Room Name</th>
								<th>Beds</th>			
								<th>Manage</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($lodgesReports as $lodgesReport): ?>
							<tr>
								<td><?= $lodgesReport['name']; ?></td>
								<td><?= $lodgesReport['lodge_beds_count']; ?></td>		
								<td class="text-left">           
									<a href="lodge-beds/lists/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Manage Beds" class="cust_bell_button"><span class="file-button"></span></a>
									<a href="lodge-rooms/edit/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Edit Room" class="cust_edit_button"><span class="edit-icon"></span></a>
									<a href="lodge-rooms/remove/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Remove Room" class="cust_delete_button"><span class="delete-icon"></span></a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
		</div>
		<?php echo $form->close(); ?> 
	</div>	
   
</div>