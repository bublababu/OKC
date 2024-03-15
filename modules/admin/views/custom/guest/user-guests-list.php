<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
            <div class="col-md-12 p-3 custom-btn-container">
                <a href="user-guests/add/<?= $user_id ?>" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
            </div>
            
            <div class="col-md-12 p-3">
				<div class="custom-table-wrapper">
					<table class="table table-bordered table-striped bycolor-table table-hover user-guest-listing">
						<thead>
							<tr>
								<th>Name</th>
								<th>Contact Info</th>
								<th>Guest Type</th>
								<th>Manage</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($guest_types as $guest_type): ?>
							<tr>
								<td><?= $guest_type['name']; ?></td>
								<td><?= $guest_type['phone']; ?></td>
								<td><?= $guest_type['guest_types_name']; ?></td>
								<td class="text-left">
									<a href="user-guests/edit/<?= $guest_type['id']; ?>" data-toggle="tooltip" title="Edit Guest" class="cust_edit_button"><span class="edit-icon"></span></a>
									<a href="user-guests/remove/<?= $guest_type['id']; ?>/<?= $user_id ?>" data-toggle="tooltip" title="Remove Guest" class="cust_delete_button confirmation"><span class="delete-icon"></span></a>
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
        if (!confirm('Are you sure to remove this Guest?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
</div>