<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="custom-title-bar">
            <div class="ftitle">Lodge Bed Information</div>
        </div>
        
        <div class="custom-box">
            <div class="form-field-box">
                <div class="col-md-2 capt" id="">Name</div>
                <div class="form-input-box col-md-10" >
                    <input type="text" name="name" id="name" class="form-control validate[required]" value="<?php if(isset($lodge_beds[0]['name']) && $lodge_beds[0]['name']!="") echo $lodge_beds[0]['name'] ?>">
                </div>
            </div>          
          
            
            <div class="form-field-box button-container">
                <div class="col-md-10 pull-right">
					<button type="submit" class="cust-btn submit" name="submit" value="0">Submit</button>
					<a href="lodge-beds/lists/<?=$lodge_beds[0]['room_id']?>" class="cust-btn cancel">Cancel</a>
                    <input type="hidden" id="hd_reservationTypes" name="hd_reservationTypes" value="">
                </div>
            </div>
        </div>
        <?php echo $form->close(); ?>
    </div> 
    <script>
        //   $('.cancel').click(function(){
        //             window.location.replace("<?php BASE_URL ?>lodges");					
		// 		});
    </script>
	
	<script type="text/javascript">
		$("#myform").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>