<div class="container home-block">	
	<div class="row">
		<div class="col-md-10">
		   <div class="table-responsive">
		      <table class="table table-hover">
			 <thead>
			    <tr>
			       <th>Member</th>
			       <th>Home Phone</th>
				   <th>Cell Phone</th>
			    </tr>
			 </thead>
			 <tbody>
			 <?php foreach ($users as $user): ?>
			    <tr>
			       <td><?= $user['first_name']; ?> <?= $user['last_name']; ?></td>
			       <td><?php if(isset($user['phone'])&&$user['phone']!="") echo $user['phone']."" ; ?></td>
				   <td><?=$user['cell_phone']?></td>
			    </tr>
				<?php endforeach;?>			   
			 </tbody>
		      </table>
		   </div>
		</div>
		<!--/col-md-12-->
	</div>
</div>