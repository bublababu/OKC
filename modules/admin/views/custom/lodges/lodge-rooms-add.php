<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
            <div class="custom-title-bar">
                <div class="ftitle">Lodge Room Information</div>
            </div>
            <div class="custom-box">
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Name</div>
                    <div class="form-input-box col-md-10">
                        <input type="text" name="name" id="name" class="form-control validate[required]" value="">
                    </div>
                </div>
                
                <div class="form-field-box button-container">
                    <div class="col-md-10 pull-right">
                        <button type="submit" class="cust-btn submit" name="submit" value="0">Submit</button>
                        <a href="javascript:history.back()" class="cust-btn cancel">Cancel</a>
                        <input type="hidden" id="hd_reservationTypes" name="hd_reservationTypes" value="">
                    </div>
                </div>
                
            </div>
            <?php echo $form->close(); ?>
    </div>
	<script type="text/javascript">
		$("#lodges_room_add").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>