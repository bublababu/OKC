	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="custom-title-bar">
			<div class="ftitle">Lease File Information</div>
		</div>
		
		<div class="custom-box">
			<div class="form-field-box">
				<div class="col-md-2 capt">File Description</div>
				<div class="form-input-box col-md-10">
					<textarea name="file_description" id="file_description" class="form-control"><?=$leases[0]['file_description']?></textarea>
				</div>
			</div>
			
			<div class="form-field-box button-container">
				<div class="col-md-10 pull-right">
					<button type="submit" class="cust-btn submit">Submit</button>
					<a href="lease-files/lists/<?=$leases[0]['lease_id']?>"  class="cust-btn cancel">Cancel</a>
				</div>
			</div>
		</div>
    </div>
	<?php echo $form->close(); ?>
	<script type="text/javascript">
		$("#myform").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>