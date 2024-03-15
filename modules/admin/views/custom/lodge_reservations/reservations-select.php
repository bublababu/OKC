<link rel="stylesheet" href="<?php echo BASE_URL?>assets/chosen/chosen.min.css" />
<script src='<?php echo BASE_URL?>assets/chosen/chosen.jquery.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
	    <div class="custom-title-bar">
		<div class="ftitle">Reservation Information</div>
	    </div>

    <!-- /.portlet-header -->

    <div class="custom-box">
	

        <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
            
       <div class="portlet-content">
	<div class="col-md-12">
            <h4>Here are the available beds for <b><?=$lodgeName[0]['name']?></b> on the following dates:</h4>
            <h4><?=$startDate?> to <?=$endDate?></h4><br>
        </div>

           

            <div class="form-field-box">
                <label class="control-label col-md-2 capt top">Available Beds</label>
				 <div class="col-md-10">
                    <div class="checkbox">
				      <ul>
				<?php foreach($bedId as $bed) :?>
                 <?php $bedRoom=$controller->bedroom($bed,0);
				 
				// print_r($bedRoom);
				 
				 ?>
				        
							<li>
								<input type="checkbox" class="game validate[required]" name="beds[]" value="<?=$bed?>" > <span><?=$bedRoom[0]['lodgename']?> , <?=$bedRoom[0]['name']?> </span> 
							</li>
						
                   <?php endforeach ?>
				    </ul>
                     </div>
                    </div>
                 
                    </div>
		
			<div class="form-field-box">
				<hr />
				<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="cust-btn submit" name="submit" value="0">submit</button>
				<button type="submit" class="cust-btn cancel" name="cancel" value="True">Cancel</button>
				<input type="hidden" name="user_id" value="<?= $user_id ?>">
				<input type="hidden" name="lodge_id" value="<?= $lodge_id ?>">
				<input type="hidden" name="startDate" value="<?= $startDate ?>">
				<input type="hidden" name="end_date" value="<?= $endDate ?>">
				</div>
			</div>
	    
                 </div>
            
            </div>

            
            <?php echo $form->close(); ?>
    </div>
    <!-- /.portlet-content -->

    </div>
	<script>
// var max_limit = 4;
// $(".game:input:checkbox").each(function (index){
//         this.checked = (".game:input:checkbox" < max_limit);
//     }).change(function (){
//         if ($(".game:input:checkbox:checked").length > max_limit){
//             this.checked = false;
// 			alert("You can select only four bed.")
//         }
//     });
	</script>
	
	<script type="text/javascript">
		$("#lodge_add").validationEngine({promptPosition : "bottomLeft"});
	</script>
</div>
