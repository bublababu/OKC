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
              <div class="profile-bio submission">
                  <div class="instruction">
                      Instruction: <a href="<?=$filename?>" alt="<?=$title?>" title="<?=$title?>"><?=$title?></a>
                  </div>
                  <div class="exam">
                       <span> Status :
                             <?php if($examstatus==0) {?>
                                  <span  class="pending"> Pending </span>
                              <?php } else { ?>
                                  <span  class="fail"> Active </span>
                              <?php } ?>
                       </span>
                       
                       
                       
                       <p>&nbsp;</p>
                        
                        <p>Opening Date : <?= date('F j, Y',strtotime($submissionDate[0]['start_date']))?></p>
                         <p>Closing  Date : <?= date('F j, Y',strtotime($submissionDate[0]['end_date']))?></p>
                         
                        
                  </div>
                  
                  <hr>
                  
                  <div class="panel-heading overflow-h">
                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-check"></i> Annual Submissions</h2>
                  </div>
                  <div class="panel-body margin-bottom-40">
                          <div class="row">
                             <div class="col-md-12">
                                <!-- Lodges Table -->
                                <table class="table table-hover">
                                   <thead>
                                      <tr>
                                         <th>Date Submitted</th>
                                         <th>File Name</th>
                                         <th>Status</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                    <?php foreach($subMittedData as $data) { ?>
                                      <tr>
                                         <td>
                                            <p><?=date('F j, Y',strtotime($data['date_submitted']))?></p>
                                         </td>
                                         <td>
                                            <p><a href="/upload/forms/<?=$data['file_name']?>"><?=$data['file_name']?></a></p>
                                         </td>
                                         <td>
                                           <?php if( $data['status']==1) { ?>
                                            <button class="btn btn-success btn-block btn-u-xs">
                                            
                                            <i class="fa fa-check margin-right-5">
                                            </i> Processed
                                            </button>
                                            <?php } else { ?>
                                            <button class="btn btn-success btn-block btn-u-xs btn-danger">
                                            
                                            <i class="fa fa-check margin-right-5">
                                            </i> Pending
                                            </button>
                                            <?php } ?>
                                         </td>
                                      </tr>
                                      <?php } ?>
                                      
                                   </tbody>
                                </table>
                                <!--/end row-->    
                             </div>
                          </div>
                          <!--/end row-->
                       </div>
                         
                         
                       <?php
                       $today=date('Y-m-d');
                       if($submissionDate[0]['start_date']<= $today && $today<=$submissionDate[0]['end_date'] ) {?>
                        <input type="button" class="btn-u pull-right" value="Submit Form" onclick='location.href="submission/forms"' />
                        <?php }else {  ?>
                        <p> Submission Date expire Please contact Admin </p>
                            
                        <?php } ?>
                  
              </div>
              <?php echo $form->close(); ?>
            </div>
        </div>
    </div>
  </div>
</div>  