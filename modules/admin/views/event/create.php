<?php echo $form->messages(); ?>

<div class="row">

	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">User Info</h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>

					<?php echo $form->bs3_text('Event Title', 'event_title'); ?>
					<?php echo $form->bs3_text('Event Date', 'event_date'); ?>
					<?php echo $form->bs3_text('Event Body', 'event_body'); ?>					

					<?php echo $form->bs3_submit(); ?>
					
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>