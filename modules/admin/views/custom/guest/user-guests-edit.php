<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<?php
  //print("<pre>".print_r($users,true)."</pre>");
    $name = isset($users_guests[0]['name'])!=1?"":$users_guests[0]['name'];   
    $user_id = isset($users_guests[0]['user_id'])!=1?"":$users_guests[0]['user_id'];  
    $guest_type_id = isset($users_guests[0]['guest_type'])!=1?"":$users_guests[0]['guest_type'];    
    $birth_date = isset($users_guests[0]['birth_date'])!=1?"":$users_guests[0]['birth_date']; 
    $home_address_1 = isset($users_guests[0]['home_address_1'])!=1?"":$users_guests[0]['home_address_1']; 
    $home_address_2 = isset($users_guests[0]['home_address_2'])!=1?"":$users_guests[0]['home_address_2']; 
    $home_city = isset($users_guests[0]['home_city'])!=1?"":$users_guests[0]['home_city']; 
    $home_state = isset($users_guests[0]['home_state'])!=1?"":$users_guests[0]['home_state']; 
    $home_zipcode = isset($users_guests[0]['home_zipcode'])!=1?"":$users_guests[0]['home_zipcode']; 
    $phone = isset($users_guests[0]['phone'])!=1?"":$users_guests[0]['phone']; 
    $cell_phone = isset($users_guests[0]['cell_phone'])!=1?"":$users_guests[0]['cell_phone']; 
    $email = isset($users_guests[0]['email'])!=1?"":$users_guests[0]['email']; 
    $secondary_email = isset($users_guests[0]['secondary_email'])!=1?"":$users_guests[0]['secondary_email']; 
   // print("<pre>".print_r($guest_type,true)."</pre>");
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="custom-title-bar">
	<div class="ftitle">Guest Information</div>
    </div>

    <div class="portlet-content">
	<div class="custom-box">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <!-- <form action="/admin/user-guests/add/212" method="post" name="user_guest" class="form-horizontal" id="user_guest"> -->
            <input type="hidden" name="id" value="" />
            <div class="form-field-box">
                <label class="capt col-md-2">Name</label>

                <div class="col-md-10">
                    <input type="text" name="name" class="form-control" value="<?= $name ?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2" for="birthDate">Birth Date</label>

                <div class="col-md-4">
                    <div id="birthDate" class="input-group date" data-auto-close="true" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                        <input type="text" name="birthDate" class="form-control calendar" value="<?= $birth_date ?>" /> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2">Address Line 1</label>

                <div class="col-md-10">
                    <input type="text" name="addressLine1" class="form-control" value="<?=$home_address_1?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2">Address Line 2</label>

                <div class="col-md-10">
                    <input type="text" name="addressLine2" class="form-control" value="<?=$home_address_2?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2">City</label>

                <div class="col-md-10">
                    <input type="text" name="city" class="form-control" value="<?=$home_city?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2" for="s2id_autogen1">State</label>

                <div class="col-md-10">

                    <select name="addressState" id="addressState" class="form-control chosen-select" tabindex="-1">
                        <option value=""></option>
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
                <label class="capt col-md-2">Zip Code</label>

                <div class="col-md-10">
                    <input type="text" name="zipCode" class="form-control" value="<?=$home_zipcode?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2" for="phone">Phone</label>

                <div class="col-md-10">
                    <input type="text" name="phone" id="phone" class="form-control" value="<?=$phone?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2" for="cellPhone">Cell Phone</label>

                <div class="col-md-10">
                    <input type="text" name="cellPhone" id="cellPhone" class="form-control" value="<?=$cell_phone?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2">Email</label>

                <div class="col-md-10">
                    <input type="text" name="email" class="form-control" value="<?=$email?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2">Secondary Email</label>

                <div class="col-md-10">
                    <input type="text" name="secondaryEmail" class="form-control" value="<?=$secondary_email?>" />
                </div>
            </div>

            <div class="form-field-box">
                <label class="capt col-md-2" for="s2id_autogen2">Guest Type</label>

                <div class="col-md-10">
                    <select name="guestType" id="guestType" class="form-control chosen-select" tabindex="-1">
                        <option value=""></option>
                        <?php foreach ($guest_types as $guest_type) :?>
                            <option value="<?=$guest_type['id']?>"><?=$guest_type['name']?></option>
                        <?php endforeach; ?>                      
                    </select>
                </div>
            </div>

            <div class="form-field-box">
                <hr />
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="cust-btn submit" name="submit" value="0">Submit</button>
                <a href="user-guests/lists/<?=$users_guests[0]['user_id']?>" class="cust-btn cancel">Cancel</a>
                </div>
            </div>
            <?php echo $form->close(); ?>
	</div>
    </div>
    <!-- /.portlet-content -->
	<script>
	$(function() {
            $( ".calendar" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
            });   
			

  $('#addressState').val("<?php echo $home_state ?>"); 
  $('#guestType').val("<?php echo $guest_type_id ?>").trigger('chosen:updated');
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
    </div>
</div>