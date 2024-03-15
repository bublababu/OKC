<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	    <div class="custom-title-bar">
		<div class="ftitle">Reservation Information</div>
	    </div>

    <!-- /.portlet-header -->

    <div class="custom-box">
	<div class="col-md-12 mb-4">
	    <p>Please choose the member, choose a lodge and select the dates you wish to make a reservation for. Then click on the proceed button to view available beds.</p>
	</div>

        <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
            <div class="form-field-box">
                <label class="control-label col-md-2" for="s2id_autogen1">Member</label>

                <div class="col-md-10">
                    <select name="user" id="user" class="form-control chosen-select validate[required] chosen-error" tabindex="-1">
                        <option value=""></option>
                        <?php foreach ($users as $user) :?>
                        <option value="<?=$user['user_id']?>"><?=$user['last_name']?>, <?=$user['first_name']?> (Badge #<?=$user['badge']?>)</option>
                        <?php endforeach; ?>  
                    </select>
                </div>
            </div>

            <div class="form-field-box">
                <label class="control-label col-md-2" for="s2id_autogen2">Lodge</label>

                <div class="col-md-10">
                    <select name="lodge" id="lodge" class="form-control chosen-select validate[required] chosen-error" tabindex="-1">
                        <option value=""></option>
                        <?php foreach ($lodges as $lodge) :?>
                        <option value="<?=$lodge['id']?>"><?=$lodge['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-field-box">
                <label class="control-label col-md-2" for="startDate">Start Date</label>

                <div class="col-md-4">
                    <div id="startDate" class="input-group date" data-auto-close="true" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                        <input type="text" name="startDate" class="form-control calendar validate[required]" value="" /> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-field-box">
                <label class="control-label col-md-2">Days</label>

                <div class="col-md-10">
                    <label class="radio-inline">
                      
                        <input type="radio" name="days" class="icheck-input validate[required]" value="1" checked="checked" />
                        1 Day
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="days" class="icheck-input validate[required]" value="2" />
                        2 Days
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="days" class="icheck-input validate[required]" value="3" />
                        3 Days
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="days" class="icheck-input validate[required]" value="4" />
                        4 Days
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="days" class="icheck-input validate[required]" value="5" />
                        5 Days
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="days" class="icheck-input validate[required]" value="6" />
                        6 Days
                    </label>
                </div>
            </div>

            <div class="form-field-box">
                <hr />
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="cust-btn submit" name="submit" value="0">Proceed</button>
                <button type="submit" class="cust-btn cancel" name="cancel" value="True">Cancel</button>
                </div>
            </div>
            <?php echo $form->close(); ?>
    </div>
    <!-- /.portlet-content -->
    <script>
	$(function() {
            $( ".calendar" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
            });   
			

  $('#addressState').val("OK");


        if ($("#people_add").length > 0) {
            $("#people_add").validate({
                rules: {                   
                    Password: "required",
                    confirmpassword: {
                        equalTo: "#Password"
                    },

                },
                messages: {   
                    Password: "*Enter Password",
                    confirmpassword: "*Enter Confirm Password Same as Password",           
                                  
                },
            })
        }

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
				$("#lodge_add").validationEngine({promptPosition : "bottomLeft"});
				
		</script>
		
    </div>
</div>
