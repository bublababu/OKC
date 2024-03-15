<?php
$name = $room['name'];
?>
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
                        <input type="text" name="name" id="name" class="form-control validate[required]" value="<?php if(isset($name)&&$name!="") echo stripcslashes($name) ?>">
                    </div>
                </div>
                
                <div class="form-field-box button-container">
                    <div class="col-md-10 pull-right">
                       <button type="submit" class="cust-btn submit" name="submit" value="0">Submit</button>
                       <a href="lodge-rooms/lists/<?=$room['lodge_id']?>" class="cust-btn cancel">Cancel</a>
						
                    </div>
                </div>
                
            </div>
            <?php echo $form->close(); ?>
    </div>
	
	<script type="text/javascript">
		$("#lodges_room_edit").validationEngine({promptPosition : "bottomLeft"});
	</script>
</div>