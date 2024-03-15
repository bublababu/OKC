<?php 
 $room_id = isset($lodge_rooms_id)!=1?"":$lodge_rooms_id;

?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">	
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
		<div class="box box-primary">
				<div class="col-md-12 p-3 custom-btn-container">
							<a href="/admin/lodge-beds/add/<?= $room_id ?>" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="col-md-12 p-3">
      <table class="table table-bordered table-striped bycolor-table table-hover">
        <thead>
         <tr>
          <th>Bed Name</th>					
          <th>Manage</th>
         </tr>
        </thead>
        <tbody>
           <?php foreach ($lodgesReports as $lodgesReport): ?>
         <tr>
          <td><?= $lodgesReport['name']; ?></td>				
          <td class="text-left">                    
                       <a href="lodge-beds/edit/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Edit Lodge" class="cust_edit_button"><span class="edit-icon"></span></a>
                       <a href="lodge-beds/remove/<?=$lodgesReport['id'];?>" data-toggle="tooltip" title="Remove Lodge" class="cust_delete_button"><span class="delete-icon"></span></a>
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