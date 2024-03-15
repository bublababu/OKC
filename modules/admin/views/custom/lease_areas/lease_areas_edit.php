<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<?php 
 //print("<pre>".print_r($lease_reservation_types,true)."</pre>");  

$lease_area_id=$lease_areas[0]['id'];
$lease_id=$lease_areas[0]['lease_id'];
$lease_area_name=$lease_areas[0]['name'];
$lease_area_active=$lease_areas[0]['active'];;
?>
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
                    <input type="text" readonly name="name" id="name" class="form-control validate[required]" value="<?php if(isset($lease_area_name)&& $lease_area_name!="") echo stripslashes($lease_area_name) ?>">
                </div>
            </div>
            <div class="form-field-box">
                <div class="col-md-2 capt" id="">Lease Name</div>
                <div class="form-input-box col-md-10" >
                    <select name="lease_name" disabled="true" id="lease_name" class="form-control validate[required] chosen-select chosen-error">
                    <?php foreach($leases as $lease): ?>
        <option value="<?= $lease['id']; ?>" <?php echo ($lease['id']==$lease_id)?"Selected=selected":"" ?>><?= $lease['name']; ?></option>
    <?php endforeach; ?>                      
                    </select>
                </div>
            </div>
            <div class="form-field-box">
                <div class="col-xs-2 capt top" id="">Active</div>
                <div class="form-input-box col-xs-10" >
                    <input type="radio" name="active1" <?php echo $lease_area_active=="1" ? "checked" : ""?>  id="active1" class="icheck-input" checked value="1">
                    <span>Yes</span>
                    &nbsp; &nbsp;
                    <input type="radio" name="active1" <?php echo $lease_area_active=="0" ? "checked" : ""?> id="active2" class="icheck-input" value="0">
                    <span>No</span>
                </div>
            </div>
            <div class="form-field-box">
                <div class="col-md-2 capt top" id="">Reservation Types</div>
                <div class="form-field-box col-md-10">
                    <div class="form-field-box heading">
                        <div class="col-xs-4 type" id=""><strong>Type</strong></div>
                        <div class="col-xs-2 max-hunter"><strong>Max Hunters</strong></div>
                        <div class="col-xs-3"><strong>Lease Max Hunters</strong></div>
                    </div>
                    <?php foreach ($lease_reservation_types as $lease_reservation_type): ?>
                    <div class="form-field-box">
                        <div class="col-xs-4 captdown type">
                        <?php $key = array_search($lease_reservation_type['id'], array_column($lease_area_reservation_types, 'reservation_type_id'));?>
                        <input type="checkbox" name="reservationTypes[]" id="<?=$lease_reservation_type['id'];?>" <?php echo (strval($key)!="" ? ' checked="checked"' : '')?> class="icheck-input"  value="<?=$lease_reservation_type['id'];?>">
                            <span><?=$lease_reservation_type['name'];?></span>
                        </div>
                        <div class="col-xs-2 max-hunter">
                        <input type="text" name="txt_<?=$lease_reservation_type['id'];?>" id="txt_<?=$lease_reservation_type['id'];?>" class="form-control " value="<?php echo (strval($key)!="" ? $lease_area_reservation_types[$key]['max_hunters'] : '')?>">
                        </div>
                        <div class="col-xs-3">
                            <p><?=$lease_reservation_type['max_hunters'];?></p>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="form-field-box button-container">
                <div class="col-md-10 pull-right">
                <button type="button" class="cust-btn submit">Submit</button>
                    <a href="lease-areas" class="cust-btn cancel">Cancel</a>
                    <input type="hidden" id="hd_reservationTypes" name="hd_reservationTypes" value="">
                </div>
            </div>
        </div>
        <?php echo $form->close(); ?>
    </div>
    <script>
        $(function() {
            $('.submit').click(function(){
					//alert('HI');
					getReservationTypesDetails();
					$("#myform").trigger('submit');
				});
                $('.cancel').click(function(){
                    window.location.replace("<?php BASE_URL ?>lease-areas");					
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
			$("#myform").validationEngine({promptPosition : "bottomLeft"});
		</script>
		
</div>