<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="custom-title-bar">
            <div class="ftitle">Lease Area Information</div>
        </div>
        
        <div class="custom-box">
            <div class="form-field-box">
                <div class="col-md-2 capt" id="">Name</div>
                <div class="form-input-box col-md-10" >
                    <input type="text" name="name" id="name" class="form-control validate[required]" value="">
                </div>
            </div>
            <div class="form-field-box">
                <div class="col-md-2 capt" id="">Lease Name</div>
                <div class="form-input-box col-md-10" >
                    <select name="lease_name" id="lease_name" class="form-control validate[required] chosen-select chosen-error" data-placeholder="Select Lease...">
                    <option></option>
                    <?php foreach($leases as $lease): ?>
        <option value="<?= $lease['id']; ?>"><?= $lease['name']; ?></option>
    <?php endforeach; ?>  
                    </select>
                </div>
            </div>
            <div class="form-field-box">
                <div class="col-xs-2 capt top" id="">Active</div>
                <div class="form-input-box col-xs-10" >
                    <input type="radio" name="active1"   id="active1" class="icheck-input validate[required]" checked value="1">
                    <span>Yes</span>
                    &nbsp; &nbsp;
                    <input type="radio" name="active1"  id="active2" class="icheck-input validate[required]" value="0">
                    <span>No</span>
                </div>
            </div>
            
            <div class="form-field-box button-container">
                <div class="col-md-10 pull-right">
                    <button type="submit" class="cust-btn submit">Submit</button>
                    <a href="lease-areas" class="cust-btn cancel">Cancel</a>
                    <input type="hidden" id="hd_reservationTypes" name="hd_reservationTypes" value="">
                </div>
            </div>
        </div>
        <?php echo $form->close(); ?>
    </div>
    <script>
        $(function() {
          
                $('.cancel').click(function(){
                    window.location.replace("<?php BASE_URL ?>lease-areas");					
				});

  /***********CONVERT CHOSEN START***************/
  $('.chosen-select').chosen({ allow_single_deselect: true });
        $(window)
					.off('resize.chosen')
					.on('resize.chosen', function () {
					    $('.chosen-select').each(function () {
					        var $this = $(this);
					        $this.next().css({ 'width': $this.parent().width() });
					    })
			}).trigger('resize.chosen');
    /***********CONVERT CHOSEN END***************/
        });
    </script>
		
		<script type="text/javascript">
			$("#lease_areas_add").validationEngine({promptPosition : "bottomLeft"});
		</script>
		
</div>