<div class="row">



	<div class="col-lg-12 col-md-12 col-sm-12">
	
		<div class="box box-primary">
				<div class="col-md-12 p-3 custom-btn-container">
							<a href="/admin/leases/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="col-md-12 p-3">
					<div class="custom-table-wrapper">
						<table class="table table-bordered table-striped bycolor-table table-hover">
							<thead>
								<tr>
									<th>Lease Name</th>
									<th>Expiration Date</th>
									<th>Last Updated</th>
									<th>Manage</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($leases as $lease): ?>
								<tr>
									<td><?=$lease['name'];?><?=$lease['active']==1?'<span class="label label-success ml-2">Active</span>':'<span class="label label-danger ml-2">Inactive</span>'?></td>
									<td><?=date('F j, Y',strtotime($lease['expiration_date']));?></td>
									<td><?=date('F j, Y',strtotime($lease['lease_updated_on']));?></td>
									<td class="text-left table-action-col">
										<a href="lease-files/lists/<?=$lease['id'];?>" data-toggle="tooltip" title="Manage Files" class="cust_file_button"><span class="file-button"></span></a>
										<a href="leases/edit/<?=$lease['id'];?>" data-toggle="tooltip" title="Edit Lease" class="cust_edit_button"><span class="edit-icon"></span></a>
										<a href="leases/remove/<?=$lease['id'];?>" data-toggle="tooltip" title="Remove Lease" class="cust_delete_button"><span class="delete-icon"></span></a>
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