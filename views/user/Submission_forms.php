<div class="container home-block">
  <div class="profile">
    <div class="row">
      <div class="col-md-3 md-margin-bottom-40">
      <?php $this->load->view('_partials/user_menu'); ?>
      </div>
        <div class="col-md-9">
        <!--Profile Body-->
           <div class="profile-body">
              <div class="panel-heading overflow-h">
                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-sticky-note"></i> Submission Form</h2>
              </div>
              <dt>
              <?php echo $form->open(); ?>
                    <?php echo $form->messages(); ?>
                    <dl class="dl-horizontal">
                      <dt>Upload File</dt>
                      <dd>
                        <section>
                          <input type="file" name="fileToUpload" class="form-control validate[required]">
                         </section>
                      </dd>
              
                      <dt>Comment</dt>
                      <dd>
                         <section>
                            <textarea id="comment" name="comment" cols="45" rows="10" class="form-control"></textarea>
                         </section>
                       </dd>
                    </dl>
                    
                    <hr>
                     
                    <button type="submit" class="btn-u submit">Save</button>
                    <input type="hidden"  name="settings_action" value="1">
                    <?php echo $form->close(); ?>
                 
              </div>
            </div>
        </div> 
    </div>
  </div>
  <script type="text/javascript">
		$("#submission_save").validationEngine({promptPosition : "bottomLeft"});
	
	</script>
</div>  