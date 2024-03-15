<div class="row">



	<div class="col-lg-12 col-md-12 col-sm-12">
	
		<div class="box box-primary">
				<div class="col-md-12 p-3 custom-btn-container">
							<a href="/admin/lease-areas/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="col-md-12 p-3">
					<div class="custom-table-wrapper">
						<table class="table table-bordered table-striped bycolor-table table-hover">
							<thead>
								<tr>
									<th>Lease Area Name</th>
									<th>Lease Name</th>
									<th>Last Updated</th>
									<th>Manage</th>
								</tr>
							</thead>
							<tbody>
							<?php  foreach ($lease_areas as $lease_area):  ?>
								<tr>
									<td><?=$lease_area['name'];?><?=$lease_area['lease_areas_active']==1?'<span class="label label-success ml-2">Active</span>':'<span class="label label-danger ml-2">Inactive</span>'?></td>
									<td><?=$lease_area['leases_name'];?><?=$lease_area['leases_active']==1?'<span class="label label-success ml-2">Active</span>':'<span class="label label-danger ml-2">Inactive</span>'?></td>
								   
									<td><?=date('F j, Y',strtotime($lease_area['area_updated_on']));?></td>
									<td class="text-left table-action-col">               
										<a href="lease-areas/edit/<?=$lease_area['id'];?>" data-toggle="tooltip" title="Edit Lease Area" class="cust_edit_button"><span class="edit-icon"></span></a>
										<a href="lease-areas/remove/<?=$lease_area['id'];?>" data-toggle="tooltip" title="Remove Lease Area" class="cust_delete_button"><span class="delete-icon"></span></a>
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