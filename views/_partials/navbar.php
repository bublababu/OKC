<nav class="navbar navbar-default container" role="navigation">
	<div class="container">
		<!-- Topbar Navigation -->
		<ul class="headerloginbar pull-right">

			<?php
if ($this->session->userdata('userid')) {
     $userid = $this->session->userdata('userid');
    ?>
	
			<li>
				<i class="fa fa-user"></i>
				<a href="/account">Hello <?php //echo $user->first_name; ?></a>
			</li>
			<li class="topbar-devider"></li>
		<?php	if($this->session->userdata('isAdmin')!="")
          {
            //print("<pre>".print_r( $this->ion_auth->user()->row()->email,true)."</pre>");
            //$identity = $this->ion_auth->user()->row()->email;
			$identity = $this->session->userdata('email');
            $rawPassword = $this->session->userdata('rawPassword');
         // echo '<a href="/admin/login/fromfrontend/'.$identity.'/'. $rawPassword.'" class="btn-u btn-u-red btn-block margin-bottom-20"><i class="fa fa-tachometer"></i> Administration Panel </a>'; 
		 echo '<li>
		 <a href="/admin/login/fromfrontend/'.encode($identity).'/'. encode($rawPassword).'">Administration</a>
		 </li>
		 <li class="topbar-devider"></li>';  
		   } ?>
		  
			

			<li><a href='<?php echo BASE_URL ?>account/logout'>Logout</a></li>
			<?php } else {?>
			<li><a href='<?php echo BASE_URL ?>account/login'>Login</a></li>
			<li class="topbar-devider"></li>
			<li><a href='<?php echo BASE_URL ?>account/signup'>Sign Up</a></li>
			<?php }?>
		</ul>
		<!-- End Topbar Navigation -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href=""><?php echo $site_name; ?></a>
		</div>
	</div>
	<div class="navbar-collapse collapse">

			<ul class="nav navbar-nav">
				<?php foreach ($menu as $parent => $parent_params): ?>

				<?php if (empty($parent_params['children'])): ?>

				<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
				<li <?php if ($active) echo 'class="active"'; ?>>
					<a href='<?php echo $parent_params['url']; ?>'>
						<?php echo $parent_params['name']; ?>
					</a>
				</li>

				<?php else: ?>

				<?php $parent_active = ($ctrler==$parent); ?>
				<li class='dropdown <?php if ($parent_active) echo 'active'; ?>'>
					<a data-toggle='dropdown' class='dropdown-toggle' href='#'>
						<?php echo $parent_params['name']; ?> <span class='caret'></span>
					</a>
					<ul role='menu' class='dropdown-menu'>
						<?php foreach ($parent_params['children'] as $name => $url): ?>
						<li><a href='<?php echo $url; ?>'><?php echo $name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>

				<?php endif; ?>

				<?php endforeach; ?>
			</ul>

			<?php $this->load->view('_partials/language_switcher'); ?>

	</div>
</nav>