<script src='<?php echo BASE_URL?>assets/grocery_crud/texteditor/tinymce/tinymce.min.js'></script>
<script src='<?php echo BASE_URL?>assets/grocery_crud/js/jquery_plugins/config/jquery.tinymce.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	<?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
	<div class="custom-title-bar">
		<div class="ftitle">Lease Information</div>
	</div>
	
	<div class="custom-box">
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Name</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="name" id="name" class="form-control validate[required]" value="<?php echo $leases[0]['name'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Address Line 1</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="addressLine1" id="addressLine1" class="form-control" value="<?php echo $leases[0]['location_address_1'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Address Line 2</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="addressLine2" id="addressLine2" class="form-control" value="<?php echo $leases[0]['location_address_2'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">City</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="city" id="city" class="form-control validate[required]" value="<?php echo $leases[0]['location_city'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">State</div>
			<div class="form-input-box col-md-10" >
			<select name="state" id="state" class="form-control validate[required] select2-offscreen" tabindex="-1"><option value="">Select State</option>
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
				<input type="text" name="zip" id="zip" class="form-control" value="<?php echo $leases[0]['location_zipcode'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Latitude</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="latitude" id="latitude" class="form-control validate[required]" value="<?php echo $leases[0]['latitude'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Longitude</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="longitude" id="longitude" class="form-control validate[required]" value="<?php echo $leases[0]['longitude'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-xs-2 capt top" id="">Active</div>
			<div class="form-input-box col-xs-10" >
				<input type="radio" name="active1"  <?php echo $leases[0]['active']=="1" ? "checked" : ""?> id="active1" class="icheck-input" value="1">
				<span>Yes</span>
				&nbsp; &nbsp;
				<input type="radio" name="active1" <?php echo $leases[0]['active']=="0" ? "checked" : ""?> id="active2" class="icheck-input" value="0">
				<span>No</span>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Expiration Date</div>
			<div class="form-input-box col-md-4" >
				<input type="text" name="ExpirationDate" id="ExpirationDate" class="form-control validate[required]" value="<?=date('Y-m-d',strtotime( $leases[0]['expiration_date']));?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Location Description</div>
			<div class="form-input-box col-md-10" >
				<textarea name="loc-desc" id="loc-desc" class="form-control "><?php echo $leases[0]['location_description'];?></textarea>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Land Description</div>
			<div class="form-input-box col-md-10" >
				<textarea name="land-desc" id="land-desc" class="form-control "><?php echo $leases[0]['land_description'];?></textarea>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Game Description</div>
			<div class="form-input-box col-md-10" >
				<textarea name="game-desc" id="game-desc" class="form-control "><?php echo $leases[0]['game_description'];?></textarea>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Special Rules Description</div>
			<div class="form-input-box col-md-10" >
				<textarea name="spl-rule-desc" id="spl-rule-desc" class="form-control "><?php echo $leases[0]['rules_description'];?></textarea>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Max Hunter Description</div>
			<div class="form-input-box col-md-10" >
				<textarea name="max-hunt-desc" id="max-hunt-desc" class="form-control "><?php echo $leases[0]['hunter_description'];?></textarea>
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt" id="">Max Hunters</div>
			<div class="form-input-box col-md-10" >
				<input type="text" name="maxHunters" id="maxHunters" class="form-control validate[required]" value="<?php echo $leases[0]['max_hunters'];?>">
			</div>
		</div>
		
		<div class="form-field-box">
			<div class="col-md-2 capt top" id="">Reservation Types</div>
			<div class="form-field-box col-md-10">
				<div class="form-field-box heading">
					<div class="col-xs-4 type" id=""><strong>Type</strong></div>
					<div class="col-xs-2 max-hunter"><strong>Max Hunters</strong></div>
				</div>
				<?php foreach ($reserv_types as $reserv_type): ?>
					<div class="form-field-box">
					<div class="col-xs-4 captdown type">
						<?php $key = array_search($reserv_type['id'], array_column($lease_reserv_types, 'reservation_type_id'));?>
						<input type="checkbox" name="reservationTypes[]" id="<?=$reserv_type['id'];?>" <?php echo (strval($key)!="" ? ' checked="checked"' : '')?> class="icheck-input"  value="<?=$reserv_type['id'];?>">
						<span><?=$reserv_type['name'];?></span>
					</div>
					<div class="col-xs-2 max-hunter">
						<input type="text" name="txt_<?=$reserv_type['id'];?>" id="txt_<?=$reserv_type['id'];?>" class="form-control" value="<?php echo (strval($key)!="" ? $lease_reserv_types[$key]['max_hunters'] : '')?>">
					</div>
				</div>
				<?php endforeach;?>

				<!-- <div class="form-field-box">
					<div class="col-xs-4 captdown type">
						<input type="checkbox" name="" id="" class="icheck-input" value="1">
						<span>Deer / Youth Deer</span>
					</div>
					<div class="col-xs-2 max-hunter">
						<input type="text" name="" id="" class="form-control validate[required]" value="">
					</div>
				</div>
				<div class="form-field-box">
					<div class="col-xs-4 captdown type">
						<input type="checkbox" name="" id="" class="icheck-input" value="1">
						<span>Dove</span>
					</div>
					<div class="col-xs-2 max-hunter">
						<input type="text" name="" id="" class="form-control validate[required]" value="">
					</div>
				</div>
				<div class="form-field-box">
					<div class="col-xs-4 captdown type">
						<input type="checkbox" name="" id="" class="icheck-input" value="1">
						<span>Dove - Late Season</span>
					</div>
					<div class="col-xs-2 max-hunter">
						<input type="text" name="" id="" class="form-control validate[required]" value="">
					</div>
				</div>
				<div class="form-field-box">
					<div class="col-xs-4 captdown type">
						<input type="checkbox" name="" id="" class="icheck-input" value="1">
						<span>Duck Youth Zone 1</span>
					</div>
					<div class="col-xs-2 max-hunter">
						<input type="text" name="" id="" class="form-control validate[required]" value="">
					</div>
				</div>
				<div class="form-field-box">
					<div class="col-xs-4 captdown type">
						<input type="checkbox" name="" id="" class="icheck-input" value="1">
						<span>Duck Youth Zone 2</span>
					</div>
					<div class="col-xs-2 max-hunter">
						<input type="text" name="" id="" class="form-control validate[required]" value="">
					</div>
				</div> -->

			</div>
		</div>
		
		<div class="form-field-box button-container">
			<div class="col-md-10 pull-right">
				<button type="button" class="cust-btn submit">Submit</button>
				<a href="javascript:history.back()" class="cust-btn cancel">Cancel</a>
				<input type="hidden" id="hd_reservationTypes" name="hd_reservationTypes" value="">
			</div>
		</div>
	</div>
	<?php echo $form->close(); ?>
	</div>
	<script>
	$(function() {
            $( "#ExpirationDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: 'yy-mm-dd'
            });   
			
	/********************TinyMCE FILE UPLOAD****************/
	$("textarea").each(function () {
				var ID = $(this).attr("id");
				//var BASE_URL = "http://dev.ecomsoft.co.in/Okc/"; // use your own base url
				var BASE_URL = "<?php echo BASE_URL?>"; // use your own base url
				tinymce.init({
					selector: "#" + ID,
					theme: "modern",
					//width: '100%',
					height: 200,
					relative_urls: false,
					remove_script_host: false,
					// document_base_url: BASE_URL,
					plugins: [
						"advlist autolink  link image lists charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
						"table contextmenu directionality emoticons paste textcolor responsivefilemanager code",
					],
					toolbar1:
						"undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
					toolbar2:
						"| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
					image_advtab: true,
					external_filemanager_path: BASE_URL + "/filemanager/",
					filemanager_title: "Media Gallery",
					external_plugins: {
						filemanager: BASE_URL + "/filemanager/plugin.min.js",
					},
    			});
 			 });
  ////************************ TinyMCE Text Editor End****************************************/

				$('#state').val("<?php echo $leases[0]['location_state'];?>");

				$('.submit').click(function(){
					//alert('HI');
					getReservationTypesDetails();
					$("#myform").trigger('submit');
				});
					
 //GET Reservation Types DETAILS START
 function getReservationTypesDetails() {
            var data = [];
            $('input[type=checkbox]:checked').each(function () {
                var TypeId = $(this).attr("id");
				//alert(id);
                var MaxHunters = $('#txt_'+TypeId).val();
				//alert(MaxHunters); 
                var alldata = {
                'TypeId' : TypeId,
                'MaxHunters' : MaxHunters               
                };
                data.push(alldata);
            });
            $("#hd_reservationTypes").val(JSON.stringify(data));
        };
        //GET Reservation Types DETAILS END
         });
      </script>
	
	<script type="text/javascript">
		$("#myform").validationEngine({promptPosition : "bottomLeft"});
	</script>
	
</div>