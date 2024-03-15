<script src='<?php echo BASE_URL?>assets/grocery_crud/texteditor/tinymce/tinymce.min.js'></script>
<script src='<?php echo BASE_URL?>assets/grocery_crud/js/jquery_plugins/config/jquery.tinymce.min.js'></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
            <div class="custom-title-bar">
                <div class="ftitle">Lodge Information</div>
            </div>
            <div class="custom-box">
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Name</div>
                    <div class="form-input-box col-md-10">
                        <input type="text" name="name" id="name" class="form-control validate[required]" value="">
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-xs-2 capt top" id="">Active</div>
                    <div class="form-input-box col-xs-10">
                        <input type="radio" name="active1" id="active1" class="icheck-input validate[required]" checked="" value="1">
                        <span>Yes</span>
                        &nbsp; &nbsp;
                        <input type="radio" name="active1" id="active2" class="icheck-input validate[required]" value="0">
                        <span>No</span>
                    </div>
                </div>
                
                <div class="form-field-box">
                    <div class="col-md-2 capt" id="">Description</div>
                    <div class="form-input-box col-md-10">
                        <textarea name="desc" id="desc" class="form-control"></textarea>
                    </div>
                </div>
                
                <div class="form-field-box button-container">
                    <div class="col-md-10 pull-right">
                        <button type="submit" class="cust-btn submit">Submit</button>
                         <a href="javascript:history.back()" class="cust-btn cancel">Cancel</a>
                        <input type="hidden" id="hd_reservationTypes" name="hd_reservationTypes" value="">
                    </div>
                </div>
                
            </div>
        </form>
        <?php echo $form->close(); ?>

        <script>
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
  $('.cancel').click(function(){
                    window.location.replace("<?php BASE_URL ?>lodges");					
				});
        </script>
				
				<script type="text/javascript">
					$("#lodges_add").validationEngine({promptPosition : "bottomLeft"});
				</script>
</div>