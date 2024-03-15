
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
            <div class="col-md-12 p-3 custom-btn-container">
                <a href="reservation-types/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
            </div>
            
            <div class="col-md-12 p-3">
				<div class="custom-table-wrapper">
					<table class="table table-bordered table-striped bycolor-table table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Season Start Date</th>
								<th>Season End Date</th>
								<th>Max Hunting Days</th>
								<th>Manage</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($reservation_types as $reservation_type): ?>
							<tr>
								<td><?= $reservation_type['name']; ?> <?=$reservation_type['active']==1?'':'<span class="label label-danger ml-2">Inactive</span>'?></td>
								<td><?=date('F j, Y',strtotime($reservation_type['start_date']));?></td>
								<td><?=date('F j, Y',strtotime($reservation_type['end_date']));?></td>
								<td><?= $reservation_type['max_days']; ?></td>
								<td class="text-left table-action-col">
									<a href="reservation-types/edit/<?= $reservation_type['id']; ?>" data-toggle="tooltip" title="Edit Lodge" class="cust_edit_button"><span class="edit-icon"></span></a>
									<a href="reservation-types/remove/<?= $reservation_type['id']; ?>" data-toggle="tooltip" title="Remove Lodge" class="cust_delete_button"><span class="delete-icon"></span></a>
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