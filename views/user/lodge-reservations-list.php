<div class="container home-block">
    <div class="profile">
        <div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
            <?php $this->load->view('_partials/user_menu'); ?>
            </div>
            <!--End Left Sidebar-->

            <div class="col-md-9">

                <!--Profile Body-->
                <div class="profile-body">

                    <div class="panel panel-profile">
                    <?php echo $form->open(); ?>
                     <?php echo $form->messages(); ?>
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-book"></i> Lodge Reservations</h2>
                        </div>
                        <div class="panel-body margin-bottom-40">
                            <div class="row">
                                <div class="col-md-12">
                                    
                       <!-- Lodges Table -->
                        <?php if(count($lodges)) { ?>
                              <div class="table-responsive reservation-listing">
                                <table class="table table-hover">
                                    <thead>
                                       <tr>
                                          <th>Booking ID</th>
                                          <th>Lodges</th>
                                          <th>Room / Bed</th>
                                          <th>Dates</th>
                                          <th>Status</th>
                                          <th>&nbsp;</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($lodges as $lodge): ?>
                                        <tr>
                                          <td><p>L<?=sprintf('%08d', $lodge["id"]); ?></p></td>
                                          <td><p><?=$lodge["name"]?></p></td>
                                          <td><p><?=$lodge["roomname"]?></p><p><?=$lodge["bedname"]?></p></td>
                                          <td>
                                          <p><?=date('l, F j, Y', strtotime($lodge["start_date"]))?></p>
                                          <p><?=date('l, F j, Y', strtotime($lodge["end_date"]))?></p>
                                          </td>
                                      <?php if($lodge["reservation_status"]=="cancel"){ ?>
                                          <td>
                                            <button class="btn btn-danger btn-block btn-u-xs">
                                              <i class="fa fa-trash-o margin-right-5">
                                              </i> Cancelled
                                            </button>
                                          </td>
                                          <?php } elseif ($lodge["reservation_status"] == "active" && (strtotime($lodge["end_date"]) <= strtotime(date('Y-m-d')))) {?>
                                          <td>
                                             <button type="button" class="btn btn-success btn-block btn-u-xs">
                                                <i class="fa fa-check margin-right-5">
                                                </i> Completed
                                             </button>
                                             <?php } else {?>
                                          <td>
                                            <button class="btn btn-success btn-block btn-u-xs">
                                              <i class="fa fa-check margin-right-5">
                                              </i> Active
                                            </button>
                                          </td>
                                          <?php } ?>
                                          <td>
                                          <button type="button"  data-toggle="modal" data-target="#lodgeReservation<?=$lodge["id"]?>" class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right">View</button>
                                            
                                            
                                            <!-- MODAL START -->
                                            
                                            <div class="modal fade" id="lodgeReservation<?=$lodge["id"]?>" tabindex="-1" role="dialog" aria-labelledby="lodgeReservation<?=$lodge["id"]?>" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                   <div class="modal-content">
                                      <div class="modal-header">
                                         <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                         <h4 id="lodgeReservation<?=$lodge["id"]?>" class="modal-title">Lodges Reservation
                                         </h4>
                                      </div>
                                      <div class="modal-body">
                                         <!-- Model Body -->
                                         <div class="row margin-bottom-20">
                                            <div class="col-md-6">
                                               <h3>
                                                  <i class="fa fa-flag">
                                                  </i> Reservation
                                               </h3>
                                            </div>
                                            <div class="col-md-6">
                                               <ul class="list-unstyled">
                                                  <li><p>L<?=sprintf('%08d', $lodge["id"]);?></p> </li>
                                               </ul>
                                            </div>
                                         </div>
                                         <hr>
                                         <div class="row margin-bottom-20">
                                            <div class="col-md-6">
                                               <h3>
                                                  <i class="fa fa-map-marker">
                                                  </i> Lodges
                                               </h3>
                                            </div>
                                            <div class="col-md-6">
                                               <ul class="list-unstyled">
                                                  <li>
                                                     <strong>Lodges:
                                                     </strong> <?=$lodge["name"]?>             
                                                  </li>
                                                  <li>
                                                     <strong>Room / Bed:
                                                     </strong><?=$lodge["roomname"]?>                                                                                        
                                                  </li>
                                                  <li>
                                                     <strong>Bed:
                                                     </strong><?=$lodge["bedname"]?>                                      
                                                  </li>
                                               </ul>
                                            </div>
                                         </div>
                                         <hr>
                                         <div class="row margin-bottom-20">
                                            <div class="col-md-6">
                                               <h3>
                                                  <i class="fa fa-calendar">
                                                  </i> Dates
                                               </h3>
                                            </div>
                                            <div class="col-md-6">
                                               <ul class="list-unstyled">
                                                  <li>
                                                     <strong>Start:
                                                     </strong> <?=date('l, F j, Y', strtotime($lodge["start_date"]))?>                                          
                                                  </li>
                                                  <li>
                                                     <strong>End:
                                                     </strong> <?=date('l, F j, Y', strtotime($lodge["end_date"]))?>                                   
                                                  </li>
                                               </ul>
                                            </div>
                                         </div>
                                         <hr>
                                         <!-- <div class="row margin-bottom-20">
                                            <div class="col-md-6">
                                               <h3>
                                                  <i class="fa fa-group">
                                                  </i> Attending
                                               </h3>
                                            </div>
                                            <div class="col-md-6">
                                               <ul class="list-unstyled">
                                                  <li>
                                                     <i class="fa fa-check color-green">
                                                     </i> Webtest Update (me)
                                                  </li>
                                               </ul>
                                            </div>
                                         </div>
                                         <hr>
                                          <div class="row margin-bottom-20">
                                            <div class="col-md-6">
                                               <h3>
                                                  <i class="fa fa-search">
                                                  </i> On Property
                                               </h3>
                                            </div>
                                            <div class="col-md-6">
                                               <a class="btn-u btn-u-brown" href="/reservations/view/10638">View People On Property
                                               </a>
                                            </div>
                                         </div> 
                                         <hr> -->
                                         <?php if ($lodge["reservation_status"] == "active" && (strtotime($lodge["end_date"]) > strtotime(date('Y-m-d')))) {?>
                                         <div class="row">
                                            <!-- <div class="col-xs-6">
                                               <button class="btn-u-default edit btn btn-success pull-right" type="submit"><i class="fa fa-pencil-square-o margin-right-5">
                                               </i> Edit Reservation</button>
                                            </div> -->
                                            <div class="col-xs-12">
                                               <button class="btn-u-default cancel btn btn-danger pull-right" onclick="cancelLodgeRev(<?=$lodge['id']?>)" type="button"><i class="fa fa-trash-o margin-right-5">
                                               </i> Cancel Reservation</button>
                                            </div>
                                         </div>
                                         <?php } ?>
                                         <!-- End Model Body -->
                                      </div>
                                   </div>
                                </div>
                            </div>
                                            
                                            <!-- End Model Body -->
                                            
                                          </td>
                                       </tr>
                                     <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <td colspan="5">
                                             <em class="pull-right">
                                             <strong>Tip:
                                             </strong> Need to cancel? Click on view next to the reservation.
                                             </em>
                                          </td>
                                       </tr>
                                    </tfoot>
                                  </table>
                              </div>
                                <?php } else { ?>
                                <p>You currently don't have any lodge reservations.</p>
                                <?php } ?>
                                 <!--/end row-->    
                                    
                                </div>
                            </div>  <!--/end row-->
                            <div class="pull-right">
                    <?php  echo $this->pagination->create_links();   ?> 
                </div>
                        </div> <!--/end panel-body -->
                        <?php echo $form->close(); ?>
                    </div> <!--/end panel-profile -->

                <!--End Profile Body-->
            </div>
        </div><!--/end row-->
    </div><!--/container-->
    </div>
    <script>
        function cancelLodgeRev($lodge_reservations_id) {
              //alert($reservation_id);
              var txt;
              if (confirm("Do you want to cancel!")) {
                //txt = "You pressed OK!";
                window.location = "account/cancel-lodge-reservation/" + $lodge_reservations_id;
              } else {
                //txt = "You pressed Cancel!";
              }            
            }
   </script>
</div>