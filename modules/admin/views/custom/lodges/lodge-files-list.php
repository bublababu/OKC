<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
		<div class="box box-primary">
		<div class="col-md-12 p-3 custom-btn-container">
			<a href="/admin/lodge-files/add/<?php if(isset($lodge_id)) echo $lodge_id ?>" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
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
					<?php foreach ($lodge_files as $lodge_file): ?>
						<tr>
							<td><a target="_blank" href="<?php echo BASE_URL ?>uploads/lodge/<?php if(isset($lodge_file['file_name'])) echo $lodge_file['file_name'];?>"><?php if(isset($lodge_file['file_name'])) echo $lodge_file['file_name'];?></a></td>
							<td><?php if(isset($lodge_file['file_description'])) echo $lodge_file['file_description'];?></td>
							<td><?php if(isset($lodge_file['file_size'])) echo formatFileSize($lodge_file['file_size']);?></td>
							<td><?php if(isset($lodge_file['mime_type'])) echo $lodge_file['mime_type'];?></td>
							<td class="text-left">                
								<a href="lodge-files/edit/<?=$lodge_file['id'];?>" data-toggle="tooltip" title="Edit File Description" class="cust_edit_button"><span class="edit-icon"></span></a>
								<a href="lodge-files/remove/<?=$lodge_file['id'];?>" data-toggle="tooltip" title="Remove File" class="cust_delete_button"><span class="delete-icon"></span></a>
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
	
</div>