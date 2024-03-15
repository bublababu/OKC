<div class="container home-block">
  <div class="profile">
    <div class="row">
      <div class="col-md-3 md-margin-bottom-40">
      <?php $this->load->view('_partials/user_menu'); ?>
      </div>
        <div class="col-md-9">
        <!--Profile Body-->
           <div class="profile-body">
           <?php echo $form->open(); ?>
                    <?php echo $form->messages(); ?>
              <div class="profile-bio assessment">
                  <?php if($examstatus==0 || $examstatus==1) { ?>
           
                  <div class="instruction">
                      Instruction: <a href="<?=$filename?>" alt="<?=$title?>" title="<?=$title?>"><?=$title?></a>
                  </div>
                  <div class="exam">
                       <span> Assessment Status :
                             <?php if($examstatus==0) {?>
                                  <span  class="pending"> Pending </span>
                              <?php } else { ?>
                                  <span  class="fail"> Fail </span>
                              <?php } ?>
                       </span>
                       
                       <p>&nbsp;</p>
                        <p class="pull-left"><strong>This member account is not eligible to book reservations. If you have already passed your assessment exam but are still receiving this message, please contact an administrator..</strong></p>
                        <input type="button" class="btn-u pull-right" value="Start Assessment " onclick='location.href="assessment/exam"' />

                  </div>
            
                  <?php  } else { ?>
                  <div class="exam">
                       <span class="pass"> Assessment Status : <span> Pass </span></span>
                  </div>
                  <?php } ?>
              </div>
              <?php echo $form->close(); ?>
            </div>
        </div> 
    </div>
  </div>
</div>  