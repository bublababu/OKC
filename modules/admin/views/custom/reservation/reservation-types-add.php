<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
            <div class="custom-title-bar">
                <div class="ftitle">Reservation Type Information</div>
            </div>
            <div class="custom-box">
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Name</div>
                    <div class="form-input-box col-md-10">
                        <input type="text" name="name" id="name" class="form-control validate[required]" value="">
                    </div>
                </div>
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Start Date</div>
                    <div class="form-input-box col-md-4">
                        <input type="text" name="StartDate" id="StartDate" class="form-control validate[required] date" value="">
                    </div>
                </div>
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">End Date</div>
                    <div class="form-input-box col-md-4">
                        <input type="text" name="EndDate" id="EndDate" class="form-control validate[required] date" value="">
                    </div>
                </div>
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Max Days</div>
                    <div class="form-input-box col-md-10">
                        <input type="text" name="Max_Days" id="Max_Days" class="form-control validate[required]" value="">
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-xs-2 capt top" id="">Active</div>
                    <div class="form-input-box col-xs-10">
                        <input type="radio" name="active" checked="" id="active" class="icheck-input validate[required]" value="1">
                        <span>Yes</span>
                        &nbsp; &nbsp;
                        <input type="radio" name="active" id="active2" class="icheck-input validate[required]" value="0">
                        <span>No</span>
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-xs-2 capt top" id="">Use Reservation Spot?</div>
                    <div class="form-input-box col-xs-10">
                        <input type="radio" name="Reservation_Spot" checked="" id="Reservation_Spot" class="icheck-input validate[required]" value="1">
                        <span>Yes</span>
                        &nbsp; &nbsp;
                        <input type="radio" name="Reservation_Spot" id="Reservation_Spot2" class="icheck-input validate[required]" value="0">
                        <span>No</span>
                    </div>
                </div>
                
                
                <div class="form-field-box">
                    <div class="col-md-2 capt top" id="">Game Types</div>
                    <div class="form-field-box col-md-10">
                <?php foreach ($game_types as $game_type) :?>
                        <div class="form-field-box">
                            <div class="col-xs-4 captdown type">
                                <input type="checkbox" name="game_type[]" id="<?php if(isset($game_type['id'])) echo $game_type['id'];?>" class="icheck-input" value="<?php if(isset($game_type['id'])) echo $game_type['id'];?>">
                                <span><?php if(isset($game_type['name'])) echo $game_type['name'];?></span>
                            </div>
                        </div>
                      <?php endforeach; ?>
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
    <script>
	$(function() {
        $( ".date" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
            });   

    });
    </script>
	
	<script type="text/javascript">
		$("#reservation_types_add").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>