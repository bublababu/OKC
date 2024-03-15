<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
	<div class="custom-title-bar">
		<div class="ftitle"><i class="fa fa-user"></i> User Information</div>
	</div>
	
	<div class="custom-box">
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Email</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Email" id="Email" class="form-control validate[required]" value="">
                <span class="help-block">This is used as the user login.</span>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Password</div>
			<div class="form-input-box col-md-10" >
				<input type="Password" name="Password" id="Password" class="form-control " value="">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Password Verify</div>
			<div class="form-input-box col-md-10" >
				<input type="Password" name="confirmpassword" id="confirmpassword" class="form-control " value="">
			</div>
		</div>
		<div class="form-field-box">
			<div class="col-xs-2 capt top" id="">Active</div>
			<div class="form-input-box col-xs-10" >
				<input type="radio" name="active"   id="active1" class="icheck-input " checked value="1">
				<span>Yes</span>
				&nbsp; &nbsp;
				<input type="radio" name="active"  id="active2" class="icheck-input " value="0">
				<span>No</span>
			</div>
		</div>
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">First Name</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="First_Name" id="First_Name" class="form-control validate[required]" value="">
			</div>
		</div>
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Last Name</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Last_Name" id="LastZ_Name" class="form-control validate[required]" value="">
			</div>
		</div>
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Badge</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Badge" id="Badge" class="form-control validate[required]" value="">
			</div>
		</div>
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Birth Date</div>
			<div class="form-input-box col-md-4" >
				<input type="text" name="Birth_Date" id="Birth_Date" class="form-control validate[required] date" value="">
			</div>
		</div>
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Address Line 1</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Address_Line_1" id="Address_Line_1" class="form-control " value="">
			</div>
		</div>
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Address Line 2</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Address_Line_2" id="Address_Line_2" class="form-control " value="">
			</div>
		</div>
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">City</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="City" id="City" class="form-control " value="">
			</div>
		</div>
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">State</div>
			<div class="form-input-box col-md-10" >
			<select name="state" id="state" class="form-control  chosen-select" tabindex="-1">
                <option value="">Select One</option>
				<option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="DC">District of Columbia</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="RI">Rhode Island</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
				</select>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Zip Code</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="zip" id="zip" class="form-control " value="">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Phone</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Phone" id="Phone" class="form-control " value="">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Cell Phone</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Cell_Phone" id="Cell_Phone" class="form-control " value="">
			</div>
		</div>

        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Secondary Email</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="Secondary_Email" id="Secondary_Email" class="form-control " value="">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-xs-2 capt top" id="">Allow Reservations</div>
			<div class="form-input-box col-xs-10" >
				<input type="radio" name="Allow_Reservations"   id="active1" class="icheck-input " checked value="1">
				<span>Yes</span>
				&nbsp; &nbsp;
				<input type="radio" name="Allow_Reservations"  id="active2" class="icheck-input " value="0">
				<span>No</span>
			</div>
		</div>
		
		 <div class="form-field-box">
			<div class="col-xs-2 capt top" id="">Annual Form</div>
			<div class="form-input-box col-xs-10" >
				<input type="radio" name="Annual_Form"   id="active1" class="icheck-input "  value="1">
				<span>Yes</span>
				&nbsp; &nbsp;
				<input type="radio" name="Annual_Form"  id="active2" class="icheck-input " checked value="0">
				<span>No</span>
			</div>
		</div>
		
		
		
        <div class="form-field-box">
			<div class="col-md-2 capt" id="">Role</div>
			<div class="form-input-box col-md-10" >
              
            <select name="roles[]" id="roles" class="form-control  chosen-select" data-placeholder="Select Role" multiple tabindex="-1">
               <?php foreach ($roles as $role) :?>
            <option value="<?=$role['role_id']?>"><?=$role['role_name']?></option>
            <?php endforeach; ?>
            </select>
            <span class="help-block">The admin role inherits all the permissions from the member role.</span>
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
			

  $('#state').val("OK");


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
					$("#people_add").validationEngine({promptPosition : "bottomLeft"});
			</script>
</div>