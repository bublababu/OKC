<div class="container home-block">

	<div class="profile">
		<div class="row">
			<div class="col-md-3 md-margin-bottom-40">
				    
            <?php $this->load->view('_partials/user_menu'); ?>
			</div>
			<div class="col-md-9">
                            
                            
                            <div class="profile-body">

                                <div class="tab-v1">
                                    <ul class="nav nav-justified nav-tabs">
                                        <li class=""><a href="/account/profile">Edit Profile</a></li>
                                        <li class="active"><a href="javascript:;">Change Password</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="profile" class="profile-edit tab-pane fade active in">
                                            <h2 class="heading-md">Below you may change the password for your account.</h2>
                                            <br>
            
                                            
                                          <?php echo $form->open(); ?>
	                                        <?php echo $form->messages(); ?>         
                                                    <dl class="dl-horizontal">
                                                    <dt>Current Password</dt>
                                                    <dd>
                                                        <section>
                                                            <label class="input">
                                                                <input name="credential" class="validate[required]" data-errormessage-value-missing="*Current Password is required!" type="password" placeholder="Current Password" value="">                                                            </label>
                                                        </section>
                                                    </dd>
                                                    <dt>New Password</dt>
                                                    <dd>
                                                        <section>
                                                            <label class="input">
                                                                <input name="newCredential" id="newCredential" type="password" class="validate[required]" placeholder="New Password" value="">                                                            </label>
                                                        </section>
                                                    </dd>
                                                    <dt>Confirm New Password</dt>
                                                    <dd>
                                                        <section>
                                                            <label class="input">
                                                                <input name="newCredentialVerify" type="password"  class="validate[required,equals[newCredential]]" placeholder="Confirm New Password" value="">                                                            </label>
                                                        </section>
                                                    </dd>
                                                </dl>
            
                                                <input name="identity" type="hidden" value="msbid03@icloud.com">
                                                <hr>
                                                <button class="btn-u" type="submit">Save Changes</button>
                                                <?php echo $form->close(); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            
                        </div>
                </div>
        </div>
        <script type="text/javascript">
            $("#change_password").validationEngine({promptPosition : "bottomLeft"});
        </script>
</div>