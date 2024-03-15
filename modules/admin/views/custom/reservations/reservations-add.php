<!-- <link rel="stylesheet" href="<?php echo BASE_URL?>assets/grocery_crud/css/jquery_plugins/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/grocery_crud/js/jquery_plugins/jquery.chosen.min.js'></script> -->
<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
             <?php echo $form->open(); ?>
	              <?php echo $form->messages(); ?>
                <div class="custom-title-bar">
                    <div class="ftitle">Reservation Information</div>
                </div>
                <div class="custom-box">
                    <div class="form-field-box">
			<div class="col-md-2 capt" id="">Lease</div>
			<div class="form-input-box col-md-10" >
                            <select name="lease" id="lease" class="form-control chosen-select validate[required] chosen-error" data-errormessage-value-missing="*This is a test" tabindex="-1">
                                <option value="">Select Lease</option>
								<?php foreach($leases as $lease) :?>
                                <option value="<?=$lease['id']?>"><?=$lease['name']?></option>
								<?php endforeach?>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-field-box">
			<div class="col-md-2 capt" id="">Reservation Type</div>
			<div class="form-input-box col-md-10" >
                            <select name="reservation_type" id="reservation_type" class="form-control chosen-select validate[required]  chosen-error" tabindex="-1">

								
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-field-box">
			<div class="col-md-2 capt" id="">Member</div>
			<div class="form-input-box col-md-10" >
                            <select name="member" id="member" class="form-control chosen-select validate[required] chosen-error" tabindex="-1">
                                <option value="">Select Member...</option>
								<?php foreach($users as $user) :?>
								 <option value="<?=$user['user_id']?>"><?=$user['first_name']?>&nbsp;<?=$user['last_name']?>(#<?=$user['badge']?>)</option>
								<?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-field-box">
			<div class="col-xs-2 capt top" id="">Draw Hunt?</div>
			<div class="form-input-box col-xs-10">
                            <input type="radio" name="hunt" id="hunt" class="icheck-input validate[required]" value="1">
                            <span>Yes</span>
                            &nbsp; &nbsp;
                            <input type="radio" name="hunt" id="hunt1" class="icheck-input validate[required]" checked="" value="0">
                            <span>No</span>
			</div>
                    </div>
                    
                    <div class="form-field-box button-container">
			<div class="col-md-10 pull-right">
                            <button type="submit" class="cust-btn submit" name="submit" value="0">Proceed</button>
                            <a href="javascript:history.back()" class="cust-btn cancel">Cancel</a>
			</div>
                    </div>
                    
                </div>
             <?php echo $form->close(); ?>  
        </div>
</div>


<script>
$("#lease").change(function(){
	var option = $(this).find('option:selected');
	 var leaseid = option.val();
	//alert(value);
	
	  $.ajax({
        type: "POST",
        url: "/admin/reservations/getdropdown/",
        data: { id: leaseid },

        success: function(response) { //alert(response);
           $('#reservation_type').html(response);
           $("#reservation_type").trigger("chosen:updated");
        }
    });
	
	
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
</script>

<script type="text/javascript">
            $("#reservations_add").validationEngine({promptPosition : "bottomLeft"});
        </script>