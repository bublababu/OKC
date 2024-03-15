<?php 
 $pass_status1= isset($pass_status)&& $pass_status!=""?$pass_status:"";
 $marks_obtain1= isset($marks_obtain)&& $marks_obtain!=""?$marks_obtain:"";
?>

<div class="container home-block">

	<div class="profile">
		<div class="row">
       <div class="col-md-3 md-margin-bottom-40">  
            <?php $this->load->view('_partials/user_menu'); ?>
       </div>
       <div class="col-md-9">
           <div class="tag-box tag-box-v3">
               
                  <h2 class="complete-assess-msg">You have completed the assessment.</h2>
                  
                  <h3 class="marks-obtained">Marks Obtained: <?= $marks_obtain1 ?></h3>
                  <h3 class="assess-status">Status: <span><?= $pass_status1 ?></span></h3>
           </div>
       </div>
  </div>
 </div>
  
