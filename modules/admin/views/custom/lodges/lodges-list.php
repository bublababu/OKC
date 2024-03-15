<div class="row">



	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->messages(); ?>
		<div class="box box-primary">
				<div class="col-md-12 p-3 custom-btn-container">
							<a href="/admin/lodges/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="col-md-12 p-3">
					<div class="custom-table-wrapper">
						<table class="table table-bordered table-striped bycolor-table table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Rooms</th>
									<th>Beds</th>
									<th>Manage</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($lodgesReports as $lodgesReport): ?>
								<tr>
									<td><?= $lodgesReport['name']; ?></td>
									<td><?= $lodgesReport['lodge_rooms_count']; ?></td>
									<td><?= $lodgesReport['lodge_beds_count']; ?></td>
									<td class="text-left">
									<a href="lodge-rooms/lists/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Manage Rooms" class="cust_bell_button"><span class="bell-button"></span></a>
										<a href="lodge-files/lists/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Manage Files" class="cust_file_button"><span class="file-button"></span></a>
										<a href="lodges/edit/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Edit Lodge" class="cust_edit_button"><span class="edit-icon"></span></a>
										<a href="lodges/remove/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Remove Lodge" class="cust_delete_button"><span class="delete-icon"></span></a>
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