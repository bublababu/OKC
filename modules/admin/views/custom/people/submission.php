<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
	<div class="custom-title-bar">
		<div class="ftitle">Settings</div>
	</div>
	
	<div class="custom-box">
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Start Date</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="start_date" id="start_date" class="form-control validate[required] date" value="<?php echo $examData[0]['start_date'];?>">
			</div>
		</div>
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">End Date</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="end_date" id="end_date" class="form-control validate[required] date" value="<?php echo $examData[0]['end_date'];?>">
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
		$( ".date" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
            });  
	</script>
</div>   