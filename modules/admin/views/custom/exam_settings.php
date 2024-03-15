<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
	<div class="custom-title-bar">
		<div class="ftitle">Settings</div>
	</div>
	
	<div class="custom-box">
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">No. of Questions</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="no_of_question" id="no_of_question" class="form-control validate[required]" value="<?php echo $examData[0]['no_of_question'];?>">
			</div>
		</div>
        
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Pass Marks</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="pass_marks" id="pass_marks" class="form-control validate[required]" value="<?php echo $examData[0]['pass_marks'];?>">
			</div>
		</div>
        
        	<div class="form-field-box button-container">
			<div class="col-md-10 pull-right">
				<button type="submit" class="cust-btn submit">Save</button>
				<input type="hidden"  name="settings_action" value="1">
			</div>
		</div>
        
    </div>
    
    <?php echo $form->close(); ?>
    
    </div>
	<script type="text/javascript">
		$("#settings_save").validationEngine({promptPosition : "bottomLeft"});
	</script>
</div>   