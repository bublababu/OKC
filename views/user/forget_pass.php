<div class="container home-block">	
<div class="login-box forgotpass">

	<?php /*<div class="login-box-body">
		<!-- <p class="login-box-msg">Sign in to start your session</p> -->
		<?php echo $form->open(); ?>
			<?php echo $form->messages(); ?>
            <?php echo $form->bs3_text('Email', 'email',''); ?>			
			<div class="row">
				<div class="col-xs-4 pull-left">
					< <a onclick="history.back()" class="forgotpass-link">Back</a>
				</div>
				<div class="col-xs-8 pull-right">
					<?php echo $form->bs3_submit('Reset Password', 'btn btn-primary btn-block btn-flat'); ?>
				</div>
			</div>
		<?php echo $form->close(); ?>
	</div>*/ ?>
	
	
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <form action="/account/forgot_password" method="post" class="reg-page">
	    <div class="reg-header">
                <h2>Forgot your password?</h2>
            </div>

            
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input name="email" class="form-control" placeholder="Email" type="text" value="">
	    </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn-u pull-right" type="submit">Reset Password</button>
                </div>
            </div>

            <hr>

            <p><a class="" href="/account/login">Back to login</a></p>

            </form>
	</div>

</div>
</div>