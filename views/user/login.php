<div class="container home-block">	

<div class="login-box">
<?php
if ($this->session->flashdata('passwordreset')) {
    $message = $this->session->flashdata('passwordreset');
    ?>
    <div class="alert alert-success" role="alert">       
        <?php echo ($message); ?>
    </div>
    <?php }?>
    <?php
if ($this->session->flashdata('error')) {
    $message = $this->session->flashdata('error');
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo ($message); ?>
    </div>
    <?php }?>
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <form action="/account/login" method="post" class="reg-page">
            <?php echo $form->messages(); ?>
		<div class="reg-header">
                    <h2>Login to your account</h2>
                </div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input name="username" type="text" class="form-control" placeholder="Email" value="">
		</div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input name="password" type="password" class="form-control" placeholder="Password" value="">
		</div>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn-u pull-right" type="submit">Login</button>
                    </div>
                </div>
                
                <hr>

                <h4>Forget your Password ?</h4>
                <p><a class="color-green" href="/account/forgot_password">Click here</a> to reset your password.</p>

            </form>
	</div>

</div>
</div>