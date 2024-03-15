<?php 
$name = isset($guest_types[0]['name'])!=1?"":$guest_types[0]['name'];
$max_guests = isset($guest_types[0]['max_guests'])!=1?"":$guest_types[0]['max_guests'];
$active = isset($guest_types[0]['general'])!=1?"":$guest_types[0]['general'];
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
            <div class="custom-title-bar">
                <div class="ftitle">Guest Type Information</div>
            </div>
            
            <div class="custom-box">
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Name</div>
                    <div class="form-input-box col-md-10">
                        <input type="text" name="name" id="name" class="form-control validate[required]" value="<?= $name ?>">
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Max Guests</div>
                    <div class="form-input-box col-md-10">
                        <input type="text" name="max-guests" id="max-guests" class="form-control validate[required]" value="<?= $max_guests ?>">
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-xs-2 capt top" id="">Is Write In?</div>
                    <div class="form-input-box col-xs-10">
                        <input type="radio" name="active1" id="active1" class="icheck-input" <?php echo $active=="1"?"checked":"" ?> value="1">
                        <span>Yes</span>
                        &nbsp; &nbsp;
                        <input type="radio" name="active1" id="active2" class="icheck-input" <?php echo $active=="0"?"checked":"" ?> value="0">
                        <span>No</span>
                        <br /><br />
                        <span class="help-block">Only one guest type should be flagged for write-in entries.</span>
                    </div>
                </div>
                
                <div class="form-field-box button-container">
                    <div class="col-md-10 pull-right">
                        <button type="submit" class="cust-btn submit">Submit</button>
                        <button type="submit" class="cust-btn cancel" name="cancel" value="True">Cancel</button>
                    </div>
                </div>
                
            </div>
            
            <?php echo $form->close(); ?>
    </div>
	
	<script type="text/javascript">
		$("#guest_types_edit").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>