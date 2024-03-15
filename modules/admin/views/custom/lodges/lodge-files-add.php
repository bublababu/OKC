<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="custom-title-bar">
			<div class="ftitle">Lodge File Information</div>
		</div>
		
		<div class="custom-box">
			<div class="form-field-box">
				<div class="col-md-2 capt">File</div>
				<div class="form-input-box col-md-10">
					<input type="file" name="fileToUpload" id="fileToUpload" class="form-control validate[required]">
				</div>
			</div>
			<div class="form-field-box">
				<div class="col-md-2 capt">File Description</div>
				<div class="form-input-box col-md-10">
					<textarea name="file_description" id="file_description" class="form-control"></textarea>
				</div>
			</div>
			
			<div class="form-field-box button-container">
				<div class="col-md-10 pull-right">
					<button type="submit" class="cust-btn submit">Submit</button>
					<a href="javascript:history.back()" class="cust-btn cancel">Cancel</a>
				</div>
			</div>
		</div>
		<?php echo $form->close(); ?>
    </div>
    <script>
          $('.cancel').click(function(){
                    window.location.replace("<?php BASE_URL ?>lodges");					
				});
    </script>
	
	<script type="text/javascript">
		$("#myform").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>