<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
		<div class="box box-primary">
		<div class="col-md-12 p-3 custom-btn-container">
			<a href="/admin/lease-files/add/<?php if(isset($lease_id)) echo $lease_id ?>" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
		</div>
		<div class="col-md-12 p-3">
			<div class="custom-table-wrapper">
				<table class="table table-bordered table-striped bycolor-table">
					<thead>
						<tr>
							<th>File Name</th>
							<th>File Description</th>
							<th>File Size</th>
							<th>File Type</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($leases as $lease): ?>
						<tr>
							<td><a href="<?php echo BASE_URL ?>uploads/lease/<?php if(isset($lease['file_name'])) echo $lease['file_name'];?>"><?php if(isset($lease['file_name'])) echo $lease['file_name'];?></a></td>
							<td><?php if(isset($lease['file_description'])) echo $lease['file_description'];?></td>
							<td><?php if(isset($lease['file_size'])) echo formatFileSize($lease['file_size']);?></td>
							<td><?php if(isset($lease['mime_type'])) echo $lease['mime_type'];?></td>
							<td class="text-left table-action-col">                
								<a href="lease-files/edit/<?=$lease['id'];?>" data-toggle="tooltip" title="Edit File Description" class="cust_edit_button"><span class="edit-icon"></span></a>
								<a href="lease-files/remove/<?=$lease['id'];?>" data-toggle="tooltip" title="Remove File" class="cust_delete_button confirmation"><span class="delete-icon"></span></a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>

		</div>
        <?php echo $form->close(); ?>
	</div>	
	<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure to remove file?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
</div>