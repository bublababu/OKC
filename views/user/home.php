<?php
$email_id = isset($customers[0]['email']) != 1 ? "" : $customers[0]['email'];
$location = isset($customers[0]['home_state']) != 1 ? "" : $customers[0]['home_state'];
$badge = isset($customers[0]['badge']) != 1 ? "" : $customers[0]['badge'];

$fname = isset($customers[0]['first_name'])!=1?"":$customers[0]['first_name'];
$lname=isset($customers[0]['last_name'])!=1?"":$customers[0]['last_name'];

?>

<div class="container home-block">
  <div class="profile">

    <div class="row">
      <div class="col-md-3 md-margin-bottom-40">
        <?php 
        if($this->session->userdata('isAdmin')!="")
          {
            //print("<pre>".print_r( $this->ion_auth->user()->row()->email,true)."</pre>");
            //$identity = $this->ion_auth->user()->row()->email;
            $identity = $this->session->userdata('email');
            $rawPassword = $this->session->userdata('rawPassword');
          echo '<a href="/admin/login/fromfrontend/'.encode($identity).'/'.encode($rawPassword).'" class="btn-u btn-u-red btn-block margin-bottom-20"><i class="fa fa-tachometer"></i> Administration Panel </a>'; 
          }
        ?>
        
        <?php $this->load->view('_partials/user_menu');?>
       
        <!-- Begin MailChimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
          #mc_embed_signup {
            background: #fff;
            clear: left;
            font: 14px Helvetica, Arial, sans-serif;
          }

          /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
          We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
        </style>
        <div id="mc_embed_signup">
          <form
            action="//okcsportsmansclub.us13.list-manage.com/subscribe/post?u=78dc582624b4a5599b4028f1b&amp;id=00f6a43c91"
            method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
            target="_blank" novalidate="novalidate">
            <div id="mc_embed_signup_scroll">
              <h4>Subscribe to our mailing list
              </h4>
              <div class="indicates-required">
                <span class="asterisk">*
                </span> indicates required
              </div>
              <div class="mc-field-group">
                <label for="mce-EMAIL">Email Address
                  <span class="asterisk">*
                  </span>
                </label>
                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" aria-required="true">
              </div>
              <div class="mc-field-group">
                <label for="mce-FNAME">First Name
                </label>
                <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
              </div>
              <div class="mc-field-group">
                <label for="mce-LNAME">Last Name
                </label>
                <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
              </div>
              <div class="mc-field-group">
                <label for="mce-MMERGE3">Member Name/Number
                </label>
                <input type="text" value="" name="MMERGE3" class="" id="mce-MMERGE3">
              </div>
              <p>
                <a href="http://us13.campaign-archive1.com/home/?u=78dc582624b4a5599b4028f1b&amp;id=00f6a43c91"
                  title="View previous campaigns">View previous campaigns.
                </a>
              </p>
              <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none">
                </div>
                <div class="response" id="mce-success-response" style="display:none">
                </div>
              </div>
              <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
              <div style="position: absolute; left: -5000px;" aria-hidden="true">
                <input type="text" name="b_78dc582624b4a5599b4028f1b_00f6a43c91" tabindex="-1" value="">
              </div>
              <div class="clear">
                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
              </div>
            </div>
          </form>
        </div>
        <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js">
        </script>
        <script type="text/javascript">
          (function ($) {
              window.fnames = new Array();
              window.ftypes = new Array();
              fnames[0] = 'EMAIL';
              ftypes[0] = 'email';
              fnames[1] = 'FNAME';
              ftypes[1] = 'text';
              fnames[2] = 'LNAME';
              ftypes[2] = 'text';
              fnames[3] = 'MMERGE3';
              ftypes[3] = 'text';
            }
            (jQuery));
          var $mcj = jQuery.noConflict(true);
        </script>
        <!--End mc_embed_signup-->
      </div>
      <div class="col-md-9">
        <!--Profile Body-->
        <div class="profile-body">
        <?php echo $form->open(); ?>
<?php echo $form->messages(); ?>	
          <div class="profile-bio">
            <div class="row">
              <div class="col-md-12">
                <h2><?= $fname ?> <?= $lname ?>
                </h2>
                <span>
                  <strong>Email:
                  </strong>
                  <?=$email_id?>
                </span>
                <span>
                  <strong>Location:
                  </strong>
                  <?=$location?>
                </span>
                <span>
                  <strong>Badge #:
                  </strong>
                  <?=$badge?>
                </span>
                <hr>
                <p>Welcome to the Sportsman's Hunting Club account management page. To the left you may access and
                  update your profile information or change your password within the "My Profile" section. Directly
                  below are your most recent reservations. If you wish to view all your reservations, you may do so by
                  visiting the "Manage Reservations" section on the left.
                </p>
              </div>
            </div>
            <!--/end row-->
          </div>
          <hr>
          <div class="panel panel-profile">
            <div class="panel-heading overflow-h">
              <h2 class="panel-title heading-sm pull-left">
                <i class="fa fa-book">
                </i> Recent Reservations
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
                          <!-- ************************************* -->
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
                           <!-- ************************************* -->  
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
                         <!-- ************************************* --> 
                           
                        
                             
                       
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
              </div>
              <!--/end row-->
              <hr class="devider devider-db">
              <div class="row">
                <div class="col-md-12">
                  <h4>Lodges
                  </h4>



                  <!-- Lodges Table -->


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
                          <td>
                            <p>L<?=sprintf('%08d', $lodge["id"]);?></p>
                          </td>
                          <td>
                            <p><?=$lodge["name"]?></p>
                          </td>
                          <td>
                            <p><?=$lodge["roomname"]?></p>
                            <p><?=$lodge["bedname"]?></p>
                          </td>
                          <td>
                            <p><?=date('l, F j, Y', strtotime($lodge["start_date"]))?></p>
                            <p><?=date('l, F j, Y', strtotime($lodge["end_date"]))?></p>
                          </td>
                          <?php if ($lodge["reservation_status"] == "cancel") {?>
                          <td>
                            <button type="button" class="btn btn-danger btn-block btn-u-xs">
                              <i class="fa fa-trash-o margin-right-5">
                              </i> Cancelled
                            </button>
                          </td>
                          <?php } elseif ($lodge["reservation_status"] == "active" && (strtotime($lodge["end_date"]." +1 days") <= strtotime(date('Y-m-d')))) {?>
                          <td>
                            <button type="button" class="btn btn-info btn-block btn-u-xs">
                              <i class="fa fa-check margin-right-5">
                              </i> Completed
                            </button>
                            <?php } else {?>
                          <td>
                            <button type="button" class="btn btn-success btn-block btn-u-xs">
                              <i class="fa fa-check margin-right-5">
                              </i> Active
                            </button>
                          </td>
                          <?php }?>
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
                                          <?php $is_cancelAllowed = $controller->is_cancelAllowed($lodge["start_date"]);
                                        if($is_cancelAllowed) {
                                        ?>
                                         
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
                                            
                            <!-- End Model Body -->
                            
                            
                            
                          </td>
                        </tr>
                        <?php endforeach?>
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
              </div>
              <!--/end row-->
            </div>
          </div>
          <hr>
          <div class="panel panel-profile">
            <div class="panel-heading overflow-h">
              <h2 class="panel-title heading-sm pull-left">
                <i class="fa fa-group">
                </i> My Guests
              </h2>
            </div>
            <div class="panel-body margin-bottom-40">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Type</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!count($guests)) {?>
                      <tr>
                        <td colspan="2">
                          <p>You currently don't have any guests.</p>
                        </td>
                      </tr>
                      <?php } else {?>
                      <?php foreach ($guests as $guest): ?>
                      <tr>
                        <td><?=$guest['name']?></td>
                        <td><?=$guest['guestname']?></td>
                      </tr>
                      <?php endforeach?>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php echo $form->close(); ?>
        </div>
      </div>
      <div class="noticeCover" id="noticeCover" style="overflow:auto">
        <div class="noticeBox" id="noticeBox">
          <h4>Notice:
          </h4>
          <div><?php echo $notice ?></div>
          <p>&nbsp;
          </p>
          <br>
          <br>
          <br>
          I have read and understand this notice.
          <button type="button" onclick="closeNotice()">Close
          </button>
          <script async="" src="//www.google-analytics.com/analytics.js">
          </script>
          <script>
            function closeNotice() {
              document.getElementById("noticeCover").style.display = 'none';
              document.getElementById("noticeBox").style.display = 'none';
            }
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
      </div>
    </div>
  </div>
</div>