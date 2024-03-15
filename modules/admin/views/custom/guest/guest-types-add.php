
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
                        <input type="text" name="name" id="name" class="form-control validate[required]" value="">
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Max Guests</div>
                    <div class="form-input-box col-md-10">
                        <input type="text" name="max-guests" id="max-guests" class="form-control validate[required]" value="">
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-xs-2 capt top" id="">Is Write In?</div>
                    <div class="form-input-box col-xs-10">
                        <input type="radio" name="active1" id="active1" class="icheck-input" value="1">
                        <span>Yes</span>
                        &nbsp; &nbsp;
                        <input type="radio" name="active1" id="active1" class="icheck-input" checked="" value="0">
                        <span>No</span>
                        <br /><br />
                        <span class="help-block">Only one guest type should be flagged for write-in entries.</span>
                    </div>
                </div>
                
                <div class="form-field-box button-container">
                    <div class="col-md-10 pull-right">
                      <button type="submit" class="cust-btn submit" name="submit" value="0">Submit</button>
                      <a href="javascript:history.back()" class="cust-btn cancel">Cancel</a>
                    </div>
                </div>
                
            </div>
            
            <?php echo $form->close(); ?>
    </div>
	
	<script type="text/javascript">
		$("#lodge_beds_list").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>