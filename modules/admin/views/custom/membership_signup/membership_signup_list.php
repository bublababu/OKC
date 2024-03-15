<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
         
            
            <div class="col-md-12 p-3">
                <table class="table table-bordered table-striped bycolor-table table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Membership Form</th>
                            <th>Submitted Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($signup_file_uploads as $signup_file_upload): ?>
                        <tr>
                            <td><?= $signup_file_upload['id']; ?></td>
                            <td><a href="/uploads/forms/<?php echo $signup_file_upload['file_name']; ?>"><?= $signup_file_upload['file_name']; ?></a></td>
                            <td><?= $signup_file_upload['date_submitted']; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php echo $form->close(); ?>    
    </div>
</div>