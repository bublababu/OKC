<div class="footer container">
	<div class="footer-top">
		<div class="container">
		    <div class="row">
			<div class="col-md-4 md-margin-bottom-40">
			    <!-- About -->
			    <div class="headline"><h2>Become A Member</h2></div>
			    <p>Sportsman's owns or leases around 50,000 acres of prime hunting land throughout Oklahoma, from west of Buffalo to east of Atoka.  We have more varied lease areas than any other hunting club in Oklahoma.</p>
			    <p class="margin-bottom-25 md-margin-bottom-40">Membership Information - Call 405-696-6343</p>
			    <!-- End About -->
			</div><!--/col-md-4-->
			<div class="col-md-4">
			    <!-- Useful Links -->
			    <div class="headline"><h2>Sportsmans Hunting Club</h2></div>
			    <ul class="list-unstyled link-list">
				<li><a href="/calendar">Calendar</a><i class="fa fa-angle-right"></i></li>
				<li><a href="/lease-Information">Lease Information</a><i class="fa fa-angle-right"></i></li>
				<li><a href="/photos">Photos</a><i class="fa fa-angle-right"></i></li>
			    </ul>
			    <!-- End Useful Links -->
			</div><!--/col-md-4-->
			<div class="col-md-4">
			    <!-- Contact Us -->
			    <div class="headline"><h2>Member Area</h2></div>
			    <ul class="list-unstyled link-list">
							    <li><a href="/account/login">Member Login</a><i class="fa fa-angle-right"></i></li>
						    </ul>
			    <!-- End Contact Us -->
			</div><!--/col-md-4-->
		    </div>
		</div>
	</div>
	<div class="copyright container">
		<?php /*<?php if (ENVIRONMENT=='development'): ?>
			<p class="pull-right text-muted">
				CI Bootstrap Version: <strong><?php echo CI_BOOTSTRAP_VERSION; ?></strong>, 
				CI Version: <strong><?php echo CI_VERSION; ?></strong>, 
				Elapsed Time: <strong>{elapsed_time}</strong> seconds, 
				Memory Usage: <strong>{memory_usage}</strong>
			</p>
		<?php endif; ?>*/ ?>
		<p class="text-muted"><?php echo date('Y'); ?> &copy; All Rights Reserved. Sportsman's Hunting Club. Web Site Design &amp; Hosting <a target="_blank" href="http://www.sparklinetech.com">Spark Line Technologies</a></p>
	</div>
	<script type="text/javascript">	
	$(function(){
       $("#sidebar_nav_1 li a").each(function(){
               if ($(this).attr("href") == window.location.pathname){
                     //  $(this).addClass("selected");
					 $(this).parent().addClass('active').siblings().removeClass('active');
               }
       });
	});
	</script>
</div>


