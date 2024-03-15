<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
            <div class="col-md-12 p-3 custom-btn-container">
                <a href="guest-types/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
            </div>
            
            <div class="col-md-12 p-3">
                <table class="table table-bordered table-striped bycolor-table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Max Guests</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($guest_types as $guest_type): ?>
                        <tr>
                            <td><?= $guest_type['name']; ?></td>
                            <td><?= $guest_type['max_guests']; ?></td>
                            <td class="text-left">
                                <a href="guest-types/edit/<?= $guest_type['id']; ?>" data-toggle="tooltip" title="Edit Guest Type" class="cust_edit_button"><span class="edit-icon"></span></a>
                                <a href="guest-types/remove/<?= $guest_type['id']; ?>" data-toggle="tooltip" title="Remove Guest Type" class="cust_delete_button"><span class="delete-icon"></span></a>
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