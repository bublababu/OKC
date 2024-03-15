<?php 
$email_id = isset($customers[0]['email'])!=1?"":$customers[0]['email'];
$location = isset($customers[0]['home_state'])!=1?"":$customers[0]['home_state'];
$badge = isset($customers[0]['badge'])!=1?"":$customers[0]['badge'];
?>
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
          <div class="panel panel-profile">
            <div class="panel-heading overflow-h">
              <h2 class="panel-title heading-sm pull-left">
                <i class="fa fa-book">
                </i> Hunting & Fishing Reservations
              </h2>
            </div>
            <div class="panel-body margin-bottom-40">
              <div class="row">
              <div class="col-md-12">
                  <h4>Hunting &amp; Fishing
                  </h4>
                  <div class="table-responsive reservation-listing">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Reservation
                          </th>
                          <th>Location
                          </th>
                          <th>Dates
                          </th>
                          <th>Status
                          </th>
                          <th>&nbsp;
                          </th>
                        </tr>
                      </thead>
                      <tbody>


                        <?php foreach ($reservations as $reservation): ?>
                        <tr>
                          <td>
                            <p>H<?=sprintf('%07d', $reservation["id"]);?>
                            </p>
                          </td>
                          <td>
                            <p><?=$reservation["leases_name"]?>
                            </p>
                            <p><?=$reservation["lease_areas_name"]?>
                            </p>
                            <p><?=$reservation["reservation_types_name"]?>
                            </p>
                          </td>
                          <td>
                            <p><?=date('l, F j, Y', strtotime($reservation["start_date"]))?>
                            </p>
                            <p><?=date('l, F j, Y', strtotime($reservation["end_date"]))?>
                            </p>
                          </td>
                        <!-- <td>
                            <p><?=date('l, F j, Y',strtotime($reservation["start_date"]))?>
                            </p>
                            <p><?=date('l, F j, Y',strtotime($reservation["end_date"]))?>
                            </p>
                          </td> -->
                           <?php if ($reservation["reservation_status"] == "trash") {?>
                          <td>
                            <button type="button" class="btn btn-trash btn-block btn-u-xs">
                              <i class="fa fa-close margin-right-5">
                              </i> Trashed
                            </button>
                          </td>
                          <?php } if ($reservation["reservation_status"] == "cancel") {?>
                          <td>
                            <button type="button" class="btn btn-danger btn-block btn-u-xs">
                              <i class="fa fa-trash-o margin-right-5">
                              </i> Cancelled
                            </button>
                          </td>
                          <?php } if(($reservation["reservation_status"] == "active" || $reservation["reservation_status"] == "complete") && ( strtotime($reservation["end_date"]." +1 days")<=strtotime(date('Y-m-d')) || strtotime($reservation["early_end"])!=""))  {?>
                          <td>
                            <button type="button" class="btn btn-info btn-block btn-u-xs">
                              <i class="fa fa-check margin-right-5">
                              </i> 
                              <?php 
                              if($reservation['reservation_type_id']!='38' && $reservation['reservation_type_id']!='39' && $reservation['reservation_type_id']!='40') {
                                if($reservation['harvest_report']==0) {
                                    echo 'Pending Report';
                                }
                                else
                                {
                                    echo 'Completed';
                                }     
                              }
                              else
                              {
                                echo 'Completed';
                              }
                              ?>
                            </button>
                            
                          <?php if($reservation['reservation_type_id']!='38' && $reservation['reservation_type_id']!='39' && $reservation['reservation_type_id']!='40'){
                              if($reservation["harvest_report"]==1) { ?>
                            <a href="/harvest-reports/view/<?=$reservation["id"]?>"
                              class="btn-u btn-u-dark btn-block btn-u-xs">
                              <i class="fa fa-bars margin-right-5">
                              </i> View Harvest Report
                            </a>
                            <?php } else { ?>
                             <a href="/harvest-reports/add/<?=$reservation["id"]?>"
                              class="btn-u btn-u-dark btn-block btn-u-xs">
                              <i class="fa fa-plus margin-right-5">
                              </i> Add Harvest Report
                            </a>
                         <?php }}?>  
                          </td>                           
                            
                            <?php }  elseif($reservation["reservation_status"] == "active" &&( strtotime($reservation["end_date"])>=strtotime(date('Y-m-d')) )) { ?>
                              <?php if($reservation["reservation_status"] == "active" && ( strtotime($reservation["start_date"])<=strtotime(date('Y-m-d')) ) && ( strtotime($reservation["end_date"])>=strtotime(date('Y-m-d')) )) { ?> 
                                <?php if($reservation['reservation_type_id']!='38' && $reservation['reservation_type_id']!='39' && $reservation['reservation_type_id']!='40'){ ?>
                                <td>
                                    <a href="/harvest-reports/add/<?=$reservation["id"]?>/1"
                                  class="btn-u btn-u-blue text-white btn-block btn-u-xs">
                                  <i class="fa fa-close margin-right-5">
                                  </i> End Reservation Early
                                </a>
                                </td>
                                <?php } else {?>
                                  <td>
                                    <a onclick="earlyEnd(<?=$reservation['id']?>)"
                                  class="btn-u btn-u-blue text-white btn-block btn-u-xs">
                                  <i class="fa fa-close margin-right-5">
                                  </i> End Reservation Early
                                </a>
                                </td>
                                <?php }?>

                               <?php } else {?>      
                                <td>
                            <button type="button" class="btn btn-success btn-block btn-u-xs">
                              <i class="fa fa-check margin-right-5">
                              </i> Active
                            </button>
                            
                              <?php if($reservation['reservation_type_id']!='38' && $reservation['reservation_type_id']!='39' && $reservation['reservation_type_id']!='40'){
                                 if($reservation["harvest_report"]==1) { ?>
                            <a href="/harvest-reports/view/<?=$reservation["id"]?>"
                              class="btn-u btn-u-dark btn-block btn-u-xs">
                              <i class="fa fa-bars margin-right-5">
                              </i> View Harvest Report
                            </a>
                            <?php } else { ?>
                             <!-- <a href="/harvest-reports/add/<?=$reservation["id"]?>"
                              class="btn-u btn-u-dark btn-block btn-u-xs">
                              <i class="fa fa-plus margin-right-5">
                              </i> Add Harvest Report
                            </a> -->
                         <?php } }?>                            
                         </td> 
                         <?php }?>
                        <?php }?>
                         
                           
                        
                             
                       
                          <!-- MODAL START -->

                          <td>
                            <button type="button" class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right"
                              data-toggle="modal" data-target="#huntingReservation<?=$reservation["id"]?>">View
                            </button>
                            <div class="modal fade" id="huntingReservation<?=$reservation["id"]?>" tabindex="-1"
                              role="dialog" aria-labelledby="huntingReservationLabel<?=$reservation["id"]?>"
                              aria-hidden="true" style="display: none;">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button aria-hidden="true" type="button" data-dismiss="modal" class="close"
                                      type="button">×</button>
                                    <h4 id="huntingReservationLabel<?=$reservation["id"]?>" class="modal-title">Hunting
                                      &amp; Fishing Reservation
                                    </h4>
                                  </div>
                                  <div class="modal-body">
                                    <?php if ($reservation["reservation_status"] == "cancel") {?>
                                    <div class="alert alert-danger fade in">
                                      This reservation was cancelled on
                                      <?=date('l, F j, Y', strtotime($reservation["reservation_cancelled_on"]))?>
                                    </div>
                                    <?php }?>
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
                                          <li>H<?=sprintf('%07d', $reservation["id"]);?>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row margin-bottom-20">
                                      <div class="col-md-6">
                                        <h3>
                                          <i class="fa fa-map-marker">
                                          </i> Location
                                        </h3>
                                      </div>
                                      <div class="col-md-6">
                                        <ul class="list-unstyled">
                                          <li>
                                            <strong>Lease:
                                            </strong> <?=$reservation["leases_name"]?>
                                          </li>
                                          <li>
                                            <strong>Lease Area:
                                            </strong> <?=$reservation["lease_areas_name"]?>
                                          </li>
                                          <li>
                                            <strong>Game Type:
                                            </strong> <?=$reservation["reservation_types_name"]?>
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
                                            </strong> <?=date('l, F j, Y', strtotime($reservation["start_date"]))?>
                                          </li>
                                          <li>
                                            <strong>End:
                                            </strong> <?=date('l, F j, Y', strtotime($reservation["end_date"]))?>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row margin-bottom-20">
                                      <div class="col-md-6">
                                        <h3>
                                          <i class="fa fa-group">
                                          </i> Attending
                                        </h3>
                                      </div>
                                      <div class="col-md-6">
                                        <?php $user = array();
                      $user = $controller->user($reservation['user_id']);?>
                                        <ul class="list-unstyled">
                                          <li>
                                            <i class="fa fa-check color-green">
                                            </i>
                                            <?php if($reservation['use_spot']){?>
                                               <?=$user[0]['first_name']?> <?=$user[0]['last_name']?> (me)                                         
                                              <?php } else {?>
                                                <?=$user[0]['first_name']?> <?=$user[0]['last_name']?> (Member Not Attending)                                          
                                                <?php } ?>
                                          </li>
                                          <?php $users = array();
                        $users = $controller->reservation_users($reservation['id']);?>
                                          <?php foreach ($users as $guest) {?>
                                          <li> <i class="fa fa-check color-green">
                                            </i> <?=$guest['name']?> </li>
                                          <?php }?>
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
                                        <a class="btn-u btn-u-brown"
                                          href="/reservations/view/<?=$reservation["id"]?>">View People On Property
                                        </a>
                                      </div>
                                    </div>
                                    <hr>
                                    <?php if ($reservation["reservation_status"] == "active" && (strtotime($reservation["end_date"]) > strtotime(date('Y-m-d')))) {?>
                                    
                                      <?php $is_cancelAllowed = $controller->is_cancelAllowed($reservation["start_date"]);
                                        if($is_cancelAllowed) {
                                        ?>

                                      <div class="row">
                                      <div class="col-xs-6">
                                        <button class="btn-u-default edit btn btn-success pull-right" onclick="editRev(<?=$reservation['id']?>)" type="button"> <i class="fa fa-pencil-square-o margin-right-5">
                              </i> Edit Reservation</button>
                                      </div>
                                      <div class="col-xs-6">
                                        <button class="btn-u-default cancel btn btn-danger" type="button" onclick="cancelRev(<?=$reservation['id']?>)"> <i class="fa fa-trash-o margin-right-5">
                              </i> Cancel Reservation</button>
                                      </div>
                                    </div>
                                    <?php } 
                                       else {
                                       ?>
                                       <div class="alert alert-danger fade in">
                                       Cancellation not allowed for this booking...
                                      </div>                                       
                                        <?php } ?>

                                    <?php } ?>
                                    <!-- End Model Body -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <!-- MODAL END -->
                        </tr>

                        <?php endforeach;?>

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
                </div>
              <!--/end row-->
              <hr class="devider devider-db">

              <!--/end row-->
            </div>
            <div class="pull-right">
                    <?php  echo $this->pagination->create_links();   ?> 
                </div>
          </div>
          <hr>
          <?php echo $form->close(); ?>
        </div>
      </div>

    </div>
  </div>
  <script>
    function cancelRev($reservation_id) {
      //alert($reservation_id);
      var txt;
      if (confirm("Do you want to cancel!")) {
        //txt = "You pressed OK!";
        window.location = "account/cancel-reservation/" + $reservation_id;
      } else {
        //txt = "You pressed Cancel!";
      }
    }

    function editRev($reservation_id) {
      window.location = "reservations/edit/" + $reservation_id;
    }

    function earlyEnd($reservation_id) {
              //alert($reservation_id);
              var txt;
              if (confirm("Do you want to end Reservation early!")) {
                //txt = "You pressed OK!";
                window.location = "/harvest-reports/early_end/" + $reservation_id;
              } else {
                //txt = "You pressed Cancel!";
              }            
            }
  </script>
</div>